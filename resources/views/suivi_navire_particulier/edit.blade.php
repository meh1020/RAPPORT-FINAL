@extends('general.top')

@section('title', 'Modifier un Suivi Navire Particulier')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier un suivi particulier</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suivi_navire_particuliers.update', $suivi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date"
                   class="form-control"
                   value="{{ old('date', $suivi->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="nom_navire" class="form-label">Nom du Navire</label>
            <input type="text" name="nom_navire" id="nom_navire"
                   class="form-control"
                   value="{{ old('nom_navire', $suivi->nom_navire) }}" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="mmsi" class="form-label">MMSI</label>
            <input type="text" name="mmsi" id="mmsi"
                   class="form-control"
                   value="{{ old('mmsi', $suivi->mmsi) }}" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="observations" class="form-label">Observations</label>
            <textarea name="observations" id="observations" class="form-control" rows="3">{{ old('observations', $suivi->observations) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('suivi_navire_particuliers.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection