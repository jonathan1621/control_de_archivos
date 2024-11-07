<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ArchivoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $archivos = Archivo::paginate();

        return view('archivos.index', compact('archivos'))
            ->with('i', ($request->input('page', 1) - 1) * $archivos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $archivo = new Archivo();

        return view('archivos.create', compact('archivo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_id' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Captura el nombre original del archivo
        $nombreOriginal = $request->file('archivo')->getClientOriginalName();


        // Genera una ruta única para evitar colisiones de archivos con el mismo nombre
        $nombreLimpio = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreOriginal);

        // Guarda el archivo en el almacenamiento con su nombre original (limpio) y obtiene la ruta completa
        $archivoPath = $request->file('archivo')->storeAs('archivos', $nombreLimpio, 'public');

        // Guarda el registro en la base de datos, almacenando tanto el nombre original como la ruta en el sistema
        Archivo::create([
            'tipo_id' => $request->tipo_id,
            'descripcion' => $request->descripcion,
            'archivo' => $archivoPath, // Guarda la ruta generada para acceder al archivo
            'nombre_original' => $nombreOriginal, // Guarda el nombre original en la base de datos
        ]);

        return redirect()->route('archivos.index')
            ->with('success', 'Registro creado exitosamente');
    }

    public function show($id): View
    {
        $archivo = Archivo::find($id);

        return view('archivos.show', compact('archivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $archivo = Archivo::find($id);

        return view('archivos.edit', compact('archivo'));
    }

    public function update(Request $request, Archivo $archivo)
    {
        $request->validate([
            'tipo_id' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Captura el nombre original si se proporciona un nuevo archivo
        if ($request->hasFile('archivo')) {
            $nombreOriginal = $request->file('archivo')->getClientOriginalName();
            $nombreLimpio = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $nombreOriginal);

            // Elimina el archivo anterior si existe en el almacenamiento
            if ($archivo->archivo && Storage::disk('public')->exists($archivo->archivo)) {
                Storage::disk('public')->delete($archivo->archivo);
            }

            // Guarda el nuevo archivo y obtiene la nueva ruta
            $archivoPath = $request->file('archivo')->storeAs('archivos', $nombreLimpio, 'public');

            // Actualiza los campos relacionados con el archivo
            $archivo->archivo = $archivoPath;
            $archivo->nombre_original = $nombreOriginal;
        }

        // Actualiza otros campos
        $archivo->tipo_id = $request->tipo_id;
        $archivo->descripcion = $request->descripcion;
        $archivo->save();

        return redirect()->route('archivos.index')
            ->with('success', 'Registro actualizado exitosamente');
    }



    public function destroy($id): RedirectResponse
    {
        //Archivo::find($id)->delete();
        $archivo = Archivo::findOrFail($id);

            // Elimina el archivo físico del almacenamiento
        if ($archivo->archivo && Storage::disk('public')->exists($archivo->archivo)) {
            Storage::disk('public')->delete($archivo->archivo);
        }

        // Borra el registro de la base de datos
        $archivo->delete();

        return Redirect::route('archivos.index')
            ->with('success', 'Archivo borrado exitosamente');
    }
}
