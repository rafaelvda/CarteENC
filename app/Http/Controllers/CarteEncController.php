<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarteEncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cartesEtudiant = \App\Models\CarteEtudiant::all();
        return view('index', compact('cartesEtudiant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $carteEtudiant = new \App\Models\CarteEtudiant;
        $request->validate([
            'fichier' => 'required|file|max:8192'
        ]);
        $nomFichierAttache = time().request()->fichier->getClientOriginalName();
        $request->fichier->storeAs('fichiers', $nomFichierAttache);

        $carteEtudiant->nomEtudiant = $request->get('nomEtudiantFormulaire');
        $carteEtudiant->email = $request->get('email');
        $carteEtudiant->numeroTelephone = $request->get('numeroTelephoneFormulaire');
        $date = date_create($request->get('dateEntreeEnc'));
        $format = date_format($date, "Y-m-d");
/*        $carteEtudiant->dateEntreeEnc = strtotime($format);*/
        $carteEtudiant->dateEntreeEnc = $format;

        $carteEtudiant->section = $request->get('section');
        $carteEtudiant->fichier = $nomFichierAttache;
        $carteEtudiant->save();

        return redirect('demandeCarte')->with('success', 'Une nouvelle demande a été enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $carteEtudiant = \App\Models\CarteEtudiant::find($id);
        return view('edit', compact('carteEtudiant', 'id'));
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
        $carteEtudiant = \App\Models\CarteEtudiant::find($id);
        $carteEtudiant->nomEtudiant = $request->get('nom');
        $carteEtudiant->email = $request->get('email');
        $carteEtudiant->numeroTelephone = $request->get('number');
        $carteEtudiant->section = $request->get('section');
        $carteEtudiant->save();

        return redirect('demandeCarte');
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
        $carteEtudiant = \App\Models\CarteEtudiant::find($id);
        $carteEtudiant->delete();
        return redirect('demandeCarte')->with('success', 'La demande a bien été supprimée');

    }
}
