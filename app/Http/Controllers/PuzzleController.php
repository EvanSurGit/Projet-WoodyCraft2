<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;
use App\Models\Categorie;

class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puzzles = Puzzle::all();
        return view('puzzles.index', compact('puzzles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('puzzles.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|max:100',
            'prix' => 'required|numeric|between:0,999.99',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'required|max:500',
            'note' => 'required|numeric|between:0,5.00',
            'image' => 'required|max:100',
        ]);
    
        $puzzle = new Puzzle();
        $puzzle->nom = $request->nom;
        $puzzle->prix = $request->prix;
        $puzzle->categorie_id = $data['categorie_id']; // <== ici
        $puzzle->description = $request->description;
        $puzzle->note = $request->note;
        $puzzle->image = $request->image;
        $puzzle->save();
    
        return back()->with('message', "Le puzzle a bien été créé !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Puzzle $puzzle)
    {
        return view('puzzles.show' , compact('puzzle')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puzzle $puzzle)
    {
        return view('puzzles.edit' , compact('puzzle')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puzzle $puzzle)
    {
        $data = $request->validate([
            'nom' => 'required|max:100',
            'prix' => 'required|numeric|between:0,999.99',
            'categorie_id' => 'required|max:100',
            'description' => 'required|max:500',
            'note' => 'required|numeric|between:0,5.00',
            'image' => 'required|max:100',
        ]);
        
        $puzzle->nom = $request->nom;
        $puzzle->prix = $request->prix;
        $puzzle->categorie = $request->categorie;
        $puzzle->description = $request->description;
        $puzzle->note = $request->note;
        $puzzle->image = $request->image;
        
        $puzzle->save(); // N'oublie pas de sauvegarder l'objet pour que les modifications soient appliquées
        
        return back()->with('message', "Le puzzle a bien été mis a jour !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        $puzzle -> delete();
        return redirect()-> route('puzzles.index')->with('message', "le puzzle a bien été supprimé");
    }

    public function byCategorie(Categorie $categorie)
    {
        // Charge les puzzles liés à cette catégorie
        $puzzles = $categorie->puzzles()->get();

        return view('puzzles.byCategorie', compact('categorie', 'puzzles'));
    }

}
