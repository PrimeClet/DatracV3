<?php

namespace App\Http\Controllers;

use App\Models\Actes;
use App\Models\Assurance;
use App\Models\Etablissements;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class feuilleController extends Controller
{
    /**
     * Display a listing of the resource.
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function feuilleSoins()
    {
        return view('feuilleSoin.fileHealth');

    }

    public function getPostPdf ()
    {
        // L'instance PDF avec la vue resources/views/posts/show.blade.php
        $pdf = PDF::loadView('feuilleSoin.fileHealth');

        // Lancement du téléchargement du fichier PDF
//        return $pdf->download(\Str::slug($post->title).".pdf");
//        return $pdf->download(\Str::slug("CNAMGS").".pdf");
        return $pdf->stream();
    }

}
