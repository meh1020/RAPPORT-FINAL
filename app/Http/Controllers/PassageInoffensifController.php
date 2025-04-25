<?php

namespace App\Http\Controllers;

use App\Models\PassageInoffensif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PassageInoffensifController extends Controller
{
    // Affiche la liste de tous les passages inoffensifs
    public function index(Request $request)
    {
        $query = PassageInoffensif::query();

        // Filtrage par année sur la date d'entrée
        if ($request->filled('year')) {
            $query->whereYear('date_entree', $request->year);
        }

        // Filtrage par mois sur la date d'entrée
        if ($request->filled('month')) {
            $query->whereMonth('date_entree', $request->month);
        }

        // Filtrage par jour sur la date d'entrée
        if ($request->filled('day')) {
            $query->whereDay('date_entree', $request->day);
        }

        // Filtrage sur un intervalle de dates (date de début et date de fin) sur la date d'entrée
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date_entree', [$request->start_date, $request->end_date]);
        }

        // Recherche full text sur le champ 'navire'
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('navire', 'LIKE', '%' . $search . '%');
        }

        // Récupération des résultats paginés, triés par date d'entrée décroissante et conservation des paramètres
        $passages = $query->orderBy('date_entree', 'desc')->paginate(50)->appends($request->all());

        return view('passage_inoffensif.index', compact('passages'));
    }

    // Affiche le formulaire de création d'un nouveau passage inoffensif
    public function create()
    {
        return view('passage_inoffensif.create');
    }

    // Stocke un nouveau passage inoffensif dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'date_entree' => 'nullable|date',
            'date_sortie' => 'nullable|date|after_or_equal:date_entree',
            'navire'      => 'required|string|max:255',
        ]);

        PassageInoffensif::create($request->all());

        return redirect()->route('passage_inoffensifs.index')
                         ->with('success', 'Passage inoffensif créé avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $passage = PassageInoffensif::findOrFail($id);
        return view('passage_inoffensif.edit', compact('passage'));
    }

    // Met à jour le passage inoffensif
    public function update(Request $request, $id)
    {
        $request->validate([
            'date_entree' => 'nullable|date',
            'date_sortie' => 'nullable|date|after_or_equal:date_entree',
            'navire'      => 'required|string|max:255',
        ]);

        $passage = PassageInoffensif::findOrFail($id);
        $passage->update($request->only(['date_entree', 'date_sortie', 'navire']));

        return redirect()->route('passage_inoffensifs.index')
                        ->with('success', 'Passage inoffensif mis à jour avec succès.');
    }

    // Supprime un passage inoffensif
    public function destroy($id)
    {
        $passage = PassageInoffensif::findOrFail($id);
        $passage->delete();

        return redirect()->route('passage_inoffensifs.index')
                         ->with('success', 'Passage inoffensif supprimé avec succès.');
    }
    
    public function import(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    $file   = $request->file('csv_file');
    $handle = fopen($file->getPathname(), "r");

    if ($handle !== false) {
        $rowNumber = 0;
        $headers   = fgetcsv($handle, 1000, ";");

        if (!$headers || count($headers) < 3) {
            fclose($handle);
            return redirect()->back()
                             ->withErrors(['csv_file' => 'Le fichier CSV ne contient pas de colonnes valides.']);
        }

        while (($row = fgetcsv($handle, 1000, ";")) !== false) {
            $rowNumber++;
            if (count($row) < 3) {
                Log::error("Ligne $rowNumber ignorée : Données incomplètes.");
                continue;
            }

            $navire     = trim($row[0]);
            $rawEntree  = trim($row[1]);
            $rawSortie  = trim($row[2]);

            // Si champ vide, on garde null
            $dateEntreeObj = $rawEntree !== ''
                ? \DateTime::createFromFormat('d/m/Y', $rawEntree)
                : null;
            $dateSortieObj = $rawSortie !== ''
                ? \DateTime::createFromFormat('d/m/Y', $rawSortie)
                : null;

            // Si le format est incorrect pour une date renseignée => on ignore la ligne
            if (($rawEntree !== '' && !$dateEntreeObj) || ($rawSortie !== '' && !$dateSortieObj)) {
                Log::error("Ligne $rowNumber ignorée : Format de date incorrect (entrée: $rawEntree, sortie: $rawSortie).");
                continue;
            }

            // Conversion en YYYY‑MM‑DD ou null
            $dateEntree = $dateEntreeObj ? $dateEntreeObj->format('Y-m-d') : null;
            $dateSortie = $dateSortieObj ? $dateSortieObj->format('Y-m-d') : null;

            // Encodage du navire
            $encoding = mb_detect_encoding($navire, 'UTF-8, ISO-8859-1, WINDOWS-1252', true);
            if ($encoding !== 'UTF-8') {
                $navire = mb_convert_encoding($navire, 'UTF-8', $encoding);
            }
            $navire = preg_replace('/^\xEF\xBB\xBF/', '', $navire);

            Log::info("Insertion ligne $rowNumber : entrée={$dateEntree}, sortie={$dateSortie}, navire={$navire}");

            PassageInoffensif::create([
                'navire'      => $navire,
                'date_entree' => $dateEntree,
                'date_sortie' => $dateSortie,
            ]);
        }

        fclose($handle);
    }

    return redirect()->back()
                     ->with('success', 'Importation terminée avec succès !');
}

}
