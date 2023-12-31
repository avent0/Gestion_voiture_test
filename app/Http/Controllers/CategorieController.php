<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Voiture;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        $voitures = Voiture::get();
        return view('index', ['categories' => $categories, 'voitures' => $voitures]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::get();
        return view('categories.addCategorie', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required'
        ]);

        $categorie = new Categorie();
        $categorie->name = $request->name;
        $categorie->save();

        return back()->withSucces('categorie created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ public function show($id)
    {
        $categorie = Categorie::find($id);
        $voiture = Voiture::find($id)->with('categorie')->get();
        dd($voiture);

        if ($categorie) {

            // Récupérez les 4 dernières voitures de cette catégorie
            $recentVoitures = Voiture::where('id_categorie', $id)
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        } else {
            $voitures = collect();
            $recentVoitures = collect(); 
        }

        return view('categories.showVoiture', ['categorie' => $categorie, 'voitures' => $voitures, 'recentVoitures' => $recentVoitures]);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
