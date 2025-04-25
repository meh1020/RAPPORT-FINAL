@extends('general.top')

@section('title', 'Modifier un Bilan SAR')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier un Bilan SAR</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bilan_sars.update', $bilanSar->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $bilanSar->date) }}">
        </div>

        {{-- Nom du navire --}}
        <div class="mb-3">
            <label for="nom_du_navire" class="form-label">Nom du Navire</label>
            <input type="text" name="nom_du_navire" id="nom_du_navire" class="form-control"
                   value="{{ old('nom_du_navire', $bilanSar->nom_du_navire) }}">
        </div>

        {{-- Pavillon et callsign --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pavillon" class="form-label">Pavillon</label>
                <input type="text" name="pavillon" id="pavillon" class="form-control"
                       value="{{ old('pavillon', $bilanSar->pavillon) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="immatriculation_callsign" class="form-label">Immatriculation / Callsign</label>
                <input type="text" name="immatriculation_callsign" id="immatriculation_callsign"
                       class="form-control" value="{{ old('immatriculation_callsign', $bilanSar->immatriculation_callsign) }}">
            </div>
        </div>

        {{-- Armateur, type et coque --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="armateur_proprietaire" class="form-label">Armateur / Propriétaire</label>
                <input type="text" name="armateur_proprietaire" id="armateur_proprietaire"
                       class="form-control" value="{{ old('armateur_proprietaire', $bilanSar->armateur_proprietaire) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="type_du_navire" class="form-label">Type du Navire</label>
                <input type="text" name="type_du_navire" id="type_du_navire" class="form-control"
                       value="{{ old('type_du_navire', $bilanSar->type_du_navire) }}">
            </div>
            <div class="col-md-4 mb-3">
                <label for="coque" class="form-label">Coque</label>
                <input type="text" name="coque" id="coque" class="form-control"
                       value="{{ old('coque', $bilanSar->coque) }}">
            </div>
        </div>

        {{-- Propulsion et alerte --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="propulsion" class="form-label">Propulsion</label>
                <input type="text" name="propulsion" id="propulsion" class="form-control"
                       value="{{ old('propulsion', $bilanSar->propulsion) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="moyen_d_alerte" class="form-label">Moyen d'Alerte</label>
                <input type="text" name="moyen_d_alerte" id="moyen_d_alerte" class="form-control"
                       value="{{ old('moyen_d_alerte', $bilanSar->moyen_d_alerte) }}">
            </div>
        </div>

        {{-- Type & cause d'événement --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type_d_evenement_id" class="form-label">Type d'Événement</label>
                <select name="type_d_evenement_id" id="type_d_evenement_id" class="form-control">
                    <option value="">-- Sélectionnez --</option>
                    @foreach($types_evenement as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type_d_evenement_id', $bilanSar->type_d_evenement_id)==$type->id ? 'selected':'' }}>
                            {{ $type->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cause_de_l_evenement_id" class="form-label">Cause de l'Événement</label>
                <select name="cause_de_l_evenement_id" id="cause_de_l_evenement_id" class="form-control">
                    <option value="">-- Sélectionnez --</option>
                    @foreach($causes_evenement as $cause)
                        <option value="{{ $cause->id }}"
                            {{ old('cause_de_l_evenement_id', $bilanSar->cause_de_l_evenement_id)==$cause->id ? 'selected':'' }}>
                            {{ $cause->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Description & lieu --}}
        <div class="mb-3">
            <label for="description_de_l_evenement" class="form-label">Description de l'Événement</label>
            <textarea name="description_de_l_evenement" id="description_de_l_evenement" class="form-control" rows="3">{{ old('description_de_l_evenement', $bilanSar->description_de_l_evenement) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="lieu_de_l_evenement" class="form-label">Lieu de l'Événement</label>
            <input type="text" name="lieu_de_l_evenement" id="lieu_de_l_evenement" class="form-control"
                   value="{{ old('lieu_de_l_evenement', $bilanSar->lieu_de_l_evenement) }}">
        </div>

        {{-- Région --}}
        <div class="mb-3">
            <label for="region_id" class="form-label">Région</label>
            <select name="region_id" id="region_id" class="form-control">
                <option value="">-- Sélectionnez --</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}"
                        {{ old('region_id', $bilanSar->region_id)==$region->id ? 'selected':'' }}>
                        {{ $region->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Intervention & sources --}}
        <div class="mb-3">
            <label for="type_d_intervention" class="form-label">Type d'Intervention</label>
            <input type="text" name="type_d_intervention" id="type_d_intervention" class="form-control"
                   value="{{ old('type_d_intervention', $bilanSar->type_d_intervention) }}">
        </div>
        <div class="mb-3">
            <label for="description_de_l_intervention" class="form-label">Description de l'Intervention</label>
            <textarea name="description_de_l_intervention" id="description_de_l_intervention" class="form-control" rows="3">{{ old('description_de_l_intervention', $bilanSar->description_de_l_intervention) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="source_de_l_information" class="form-label">Source de l'Information</label>
            <input type="text" name="source_de_l_information" id="source_de_l_information" class="form-control"
                   value="{{ old('source_de_l_information', $bilanSar->source_de_l_information) }}">
        </div>

        {{-- Données chiffrées --}}
        <div class="row">
            <div class="col-md-3 mb-3"><label for="pob" class="form-label">POB</label><input type="number" name="pob" id="pob" class="form-control" value="{{ old('pob', $bilanSar->pob) }}"></div>
            <div class="col-md-3 mb-3"><label for="survivants" class="form-label">Survivants</label><input type="number" name="survivants" id="survivants" class="form-control" value="{{ old('survivants', $bilanSar->survivants) }}"></div>
            <div class="col-md-3 mb-3"><label for="blesses" class="form-label">Blessés</label><input type="number" name="blesses" id="blesses" class="form-control" value="{{ old('blesses', $bilanSar->blesses) }}"></div>
            <div class="col-md-3 mb-3"><label for="morts" class="form-label">Morts</label><input type="number" name="morts" id="morts" class="form-control" value="{{ old('morts', $bilanSar->morts) }}"></div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3"><label for="disparus" class="form-label">Disparus</label><input type="number" name="disparus" id="disparus" class="form-control" value="{{ old('disparus', $bilanSar->disparus) }}"></div>
            <div class="col-md-3 mb-3"><label for="evasan" class="form-label">Évasan</label><input type="number" name="evasan" id="evasan" class="form-control" value="{{ old('evasan', $bilanSar->evasan) }}"></div>
            <div class="col-md-6 mb-3"><label for="bilan_materiel" class="form-label">Bilan Matériel</label><input type="text" name="bilan_materiel" id="bilan_materiel" class="form-control" value="{{ old('bilan_materiel', $bilanSar->bilan_materiel) }}"></div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('bilan_sars.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection