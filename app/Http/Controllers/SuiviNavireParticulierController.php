<?php

namespace App\Http\Controllers;

use App\Models\SuiviNavireParticulier;
use Illuminate\Http\Request;

class SuiviNavireParticulierController extends Controller
{
    // Affiche la liste des suivis avec filtrage
    public function index(Request $request)
    {
        $query = SuiviNavireParticulier::query();

        // Filtrage par année sur la colonne 'date'
        if ($request->filled('year')) {
            $query->whereYear('date', $request->year);
        }

        // Filtrage par mois sur la colonne 'date'
        if ($request->filled('month')) {
            $query->whereMonth('date', $request->month);
        }

        // Filtrage par jour sur la colonne 'date'
        if ($request->filled('day')) {
            $query->whereDay('date', $request->day);
        }

        // Filtrage sur un intervalle de dates (date de début et date de fin)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Recherche sur plusieurs colonnes (nom_navire, mmsi, observations)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom_navire', 'LIKE', '%' . $search . '%')
                  ->orWhere('mmsi', 'LIKE', '%' . $search . '%')
                  ->orWhere('observations', 'LIKE', '%' . $search . '%');
            });
        }

        // Tri par date décroissante
        $suivis = $query->orderBy('date', 'desc')->get();

        return view('suivi_navire_particulier.index', compact('suivis'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('suivi_navire_particulier.create');
    }

    // Stocke un nouveau suivi
    public function store(Request $request)
    {
        $request->validate([
            'date'       => 'required|date',
            'nom_navire' => 'required|string|max:255',
            'mmsi'       => 'required|string|max:255',
            'observations' => 'nullable|string',
        ]);

        SuiviNavireParticulier::create($request->all());

        return redirect()->route('suivi_navire_particuliers.index')
                         ->with('success', 'Suivi créé avec succès.');
    }

    public function edit($id)
{
    $suivi = SuiviNavireParticulier::findOrFail($id);
    return view('suivi_navire_particulier.edit', compact('suivi'));
}

    // Traite la mise à jour du suivi
    public function update(Request $request, $id)
    {
        $request->validate([
            'date'         => 'required|date',
            'nom_navire'   => 'required|string|max:255',
            'mmsi'         => 'required|string|max:255',
            'observations' => 'nullable|string',
        ]);

        $suivi = SuiviNavireParticulier::findOrFail($id);
        $suivi->update($request->only(['date', 'nom_navire', 'mmsi', 'observations']));

        return redirect()->route('suivi_navire_particuliers.index')
                        ->with('success', 'Suivi mis à jour avec succès.');
    }

    // Supprime un suivi
    public function destroy($id)
    {
        $suivi = SuiviNavireParticulier::findOrFail($id);
        $suivi->delete();

        return redirect()->route('suivi_navire_particuliers.index')
                         ->with('success', 'Suivi supprimé avec succès.');
    }
}

