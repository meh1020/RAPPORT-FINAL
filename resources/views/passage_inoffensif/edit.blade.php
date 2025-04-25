@extends('general.top')

@section('title', 'Modifier un Passage Inoffensif')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier Passage Inoffensif</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('passage_inoffensifs.update', $passage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="navire" class="form-label">Navire</label>
            <input type="text" name="navire" id="navire"
                   class="form-control"
                   value="{{ old('navire', $passage->navire) }}"
                   required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="date_entree" class="form-label">Date d'entrée</label>
            <input type="date" name="date_entree" id="date_entree"
                   class="form-control"
                   value="{{ old('date_entree', $passage->date_entree) }}">
        </div>

        <div class="mb-3">
            <label for="date_sortie" class="form-label">Date de sortie</label>
            <input type="date" name="date_sortie" id="date_sortie"
                   class="form-control"
                   value="{{ old('date_sortie', $passage->date_sortie) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('passage_inoffensifs.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection