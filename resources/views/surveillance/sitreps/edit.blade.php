@extends('general.top')

@section('title', 'Modifier SITREP')

@section('content')
<div class="container-fluid px-4">
    <h2 class="mb-4">✏️ Modifier un SITREP</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sitreps.update', $sitrep->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control"
                   value="{{ old('date', $sitrep->date) }}">
        </div>

        {{-- Champs texte --}}
        @foreach ([
            'sitrep_sar' => 'SITREP SAR',
            'mrcc_madagascar' => 'MRCC Madagascar',
            'event' => 'Event',
            'position' => 'Position',
            'situation' => 'Situation',
            'number_of_persons' => 'Number of Persons',
            'assistance_required' => 'Assistance Required',
            'coordinating_rcc' => 'Coordinating RCC',
            'initial_action_taken' => 'Initial Action Taken',
            'chronology' => 'Chronology',
        ] as $field => $label)
        <div class="mb-3">
            <label for="{{ $field }}" class="form-label">{{ $label }}</label>
            <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control"
                   value="{{ old($field, $sitrep->$field) }}" required>
        </div>
        @endforeach

        {{-- Additional information --}}
        <div class="mb-3">
            <label for="additional_information" class="form-label">Additional Information</label>
            <textarea name="additional_information" id="additional_information" class="form-control" rows="3">{{ old('additional_information', $sitrep->additional_information) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('sitreps.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>
@endsection