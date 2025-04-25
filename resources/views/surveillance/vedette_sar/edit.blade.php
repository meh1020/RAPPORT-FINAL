@extends('general.top')

@section('title', 'Modifier un Cabotage Vedette SAR')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier Vedette SAR</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vedette_sar.update', $vedette->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $vedette->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="unite_sar" class="form-label">Unité SAR</label>
            <input type="text" name="unite_sar" id="unite_sar" class="form-control"
                   value="{{ old('unite_sar', $vedette->unite_sar) }}" required maxlength="255">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="total_interventions" class="form-label">Total interventions</label>
                <input type="number" name="total_interventions" id="total_interventions"
                       class="form-control"
                       value="{{ old('total_interventions', $vedette->total_interventions) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="total_pob" class="form-label">Total POB</label>
                <input type="number" name="total_pob" id="total_pob" class="form-control"
                       value="{{ old('total_pob', $vedette->total_pob) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="total_survivants" class="form-label">Total survivants</label>
                <input type="number" name="total_survivants" id="total_survivants"
                       class="form-control"
                       value="{{ old('total_survivants', $vedette->total_survivants) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="total_morts" class="form-label">Total morts</label>
                <input type="number" name="total_morts" id="total_morts" class="form-control"
                       value="{{ old('total_morts', $vedette->total_morts) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="total_disparus" class="form-label">Total disparus</label>
                <input type="number" name="total_disparus" id="total_disparus"
                       class="form-control"
                       value="{{ old('total_disparus', $vedette->total_disparus) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('vedette_sar.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection