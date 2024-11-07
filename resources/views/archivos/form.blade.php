<div class="p-1 row padding-1">
    <div class="col-md-12">

        <div class="mb-2 form-group mb20">
            <label for="tipo_id" class="form-label">{{ __('Tipo Id') }}</label>
            <input type="text" name="tipo_id" class="form-control @error('tipo_id') is-invalid @enderror" value="{{ old('tipo_id', $archivo?->tipo_id) }}" id="tipo_id" placeholder="Tipo Id">
            {!! $errors->first('tipo_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="mb-2 form-group mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $archivo?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="mb-2 form-group mb20">
            <label for="archivo" class="form-label">{{ __('Archivo') }}</label>
            <input type="file" name="archivo" class="form-control @error('archivo') is-invalid @enderror" value="{{ old('archivo', $archivo?->nombreoriginal) }}" id="archivo" placeholder="Archivo">
            {!! $errors->first('archivo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="mt-2 col-md-12 mt20">
        <a class="btn btn-secondary" href="{{ route('archivos.index') }}"> {{ __('Cancelar') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>
