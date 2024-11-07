@extends('layouts.app')

@section('template_title')
    {{ $archivo->name ?? __('Show') . " " . __('Archivo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Archivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('archivos.index') }}"> {{ __('Atras') }}</a>
                        </div>
                    </div>

                    <div class="bg-white card-body">
                        <div class="mb-2 form-group mb20">
                            <strong>Tipo Id:</strong>
                            {{ $archivo->tipo_id }}
                        </div>
                        <div class="mb-2 form-group mb20">
                            <strong>Descripcion:</strong>
                            {{ $archivo->descripcion }}
                        </div>
                        <div class="mb-2 form-group mb20">
                            <strong>Archivo:</strong>
                            <a href="{{ Storage::url($archivo->archivo) }}" target="_blank">{{ $archivo->nombre_original}}</a>
                            {{-- <a href="{{ Storage::url($archivo->archivo) }}" target="_blank">{{ $archivo->descripcion }}</a> --}}
                            {{-- <a href="{{ Storage::url($archivo->archivo) }}" target="_blank">{{ $archivo->descripcion }}</a> --}}
                            {{-- <a href="{{ Storage::url($archivoPath) }}" target="_blank">{{ $archivo->archivo }}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
