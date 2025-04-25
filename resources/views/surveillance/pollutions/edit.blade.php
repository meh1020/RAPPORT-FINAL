@extends('general.top')

@section('title', 'Modifier Pollution')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier une pollution</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pollutions.update', $pollution->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $pollution->date) }}" required>
        </div>

        {{-- Numéro, zone, coordonnées --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="numero" class="form-label">Numéro</label>
                <input type="text" name="numero" id="numero" class="form-control"
                       value="{{ old('numero', $pollution->numero) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="zone" class="form-label">Zone</label>
                <input type="text" name="zone" id="zone" class="form-control"
                       value="{{ old('zone', $pollution->zone) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="coordonnees" class="form-label">Coordonnées</label>
                <input type="text" name="coordonnees" id="coordonnees" class="form-control"
                       value="{{ old('coordonnees', $pollution->coordonnees) }}" required>
            </div>
        </div>

        {{-- Type de pollution --}}
        <div class="mb-3">
            <label for="type_pollution" class="form-label">Type de pollution</label>
            <input type="text" name="type_pollution" id="type_pollution" class="form-control"
                   value="{{ old('type_pollution', $pollution->type_pollution) }}" required>
        </div>

        {{-- Image satellite --}}
        <div class="mb-3">
            <label for="image_satellite" class="form-label">Nouvelle image satellite (optionnel)</label>
            <input type="file" name="image_satellite" id="image_satellite" class="form-control">
            @if($pollution->image_satellite)
                <div class="mt-2">
                    <small>Image actuelle :</small><br>
                    <img src="{{ asset('storage/'.$pollution->image_satellite) }}"
                         class="img-thumbnail" width="150">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('pollutions.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection