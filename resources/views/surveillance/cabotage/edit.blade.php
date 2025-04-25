@extends('general.top')

@section('title', 'Modifier un Cabotage')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier un Cabotage</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cabotage.update', $cabotage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $cabotage->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="provenance" class="form-label">Provenance</label>
            <input type="text" name="provenance" id="provenance" class="form-control"
                   value="{{ old('provenance', $cabotage->provenance) }}" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="navires" class="form-label">Navires</label>
            <input type="text" name="navires" id="navires" class="form-control"
                   value="{{ old('navires', $cabotage->navires) }}" required maxlength="255">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="equipage" class="form-label">Équipage</label>
                <input type="number" name="equipage" id="equipage" class="form-control"
                       value="{{ old('equipage', $cabotage->equipage) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="passagers" class="form-label">Passagers</label>
                <input type="number" name="passagers" id="passagers"
                       class="form-control"
                       value="{{ old('passagers', $cabotage->passagers) }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('cabotage.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection