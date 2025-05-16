<?php

namespace App\Http\Controllers;

use App\Models\Annonce; // Assurez-vous que vous avez un modèle Annonce
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les annonces
        $annonces = Annonce::all();

        // Retourner la vue avec les annonces
        return view('home', compact('annonces'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $annonces = Annonce::where('titre', 'like', "%$query%")
                        ->orWhere('description', 'like', "%$query%")
                        ->get();

        return view('home', compact('annonces'));
    }


    public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
    ]);

    // Gestion de l'upload de l'image si présente
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('annonces', 'public');
    }

    // Création de l'annonce avec l'image
    Annonce::create([
        'titre' => $validated['titre'],
        'description' => $validated['description'],
        'image_path' => $imagePath,
    ]);

    return redirect()->route('home');
    }
    public function create()
    {
        return view('create-annonce');
    }

    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);

        // Supprimer l'image associée si elle existe
        if ($annonce->image_path) {
            Storage::disk('public')->delete($annonce->image_path);
        }

        // Supprimer l'annonce
        $annonce->delete();

        return redirect()->route('home')->with('success', 'Annonce supprimée avec succès.');
    }


}
