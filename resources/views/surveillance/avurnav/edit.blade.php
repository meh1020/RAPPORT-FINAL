@extends('general.top')

@section('title', 'Modifier AVURNAV')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier un enregistrement AVURNAV</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('avurnav.update', $avurnav->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $avurnav->date) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="avurnav_local" class="form-label">AVURNAV Local</label>
                <input type="text" name="avurnav_local" id="avurnav_local" class="form-control"
                       value="{{ old('avurnav_local', $avurnav->avurnav_local) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ile" class="form-label">Île</label>
                <input type="text" name="ile" id="ile" class="form-control"
                       value="{{ old('ile', $avurnav->ile) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="vous_signale" class="form-label">Vous signale</label>
            <textarea name="vous_signale" id="vous_signale" class="form-control" rows="2">{{ old('vous_signale', $avurnav->vous_signale) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control"
                       value="{{ old('position', $avurnav->position) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="navire" class="form-label">Navire</label>
                <input type="text" name="navire" id="navire" class="form-control"
                       value="{{ old('navire', $avurnav->navire) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="pob" class="form-label">POB</label>
                <input type="number" name="pob" id="pob" class="form-control"
                       value="{{ old('pob', $avurnav->pob) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" name="type" id="type" class="form-control"
                       value="{{ old('type', $avurnav->type) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="zone" class="form-label">Zone</label>
                <input type="text" name="zone" id="zone" class="form-control"
                       value="{{ old('zone', $avurnav->zone) }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="caracteristiques" class="form-label">Caractéristiques</label>
            <textarea name="caracteristiques" id="caracteristiques" class="form-control" rows="2">{{ old('caracteristiques', $avurnav->caracteristiques) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="derniere_communication" class="form-label">Dernière communication</label>
                <input type="date" name="derniere_communication" id="derniere_communication" class="form-control"
                       value="{{ old('derniere_communication', $avurnav->derniere_communication) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="contacts" class="form-label">Contacts</label>
                <input type="text" name="contacts" id="contacts" class="form-control"
                       value="{{ old('contacts', $avurnav->contacts) }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('avurnav.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection