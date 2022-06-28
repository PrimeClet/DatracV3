@extends('layouts.layout_praticienetablissement')

@section('page-content')

	<!--User Dashboard-->

	<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
                
            <div class="card-body">
                <h5 class="card-title">Prescriptions médicales</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="nomPatie" class="form-label">Médicaments</label><br>
                        <div class="input-group mb-3">
                            <select id="medicament_id" class="form-select">
                                    <option selected="" value="0">-- Nom médicament --</option>
                                    @foreach($medicaments as $medicament)
                                        <option value="{{$medicament->id}}">
                                            {{ $medicament->nom_commercial }}
                                        </option>
                                    @endforeach
                            </select>
                            <label for="posologie" class="form-label">Posologie</label><br>
                            <input type="text" class="form-control" id="posologie" value="0">

                            <label for="nomPatie" class="form-label">Quantite</label><br>
                            <input type="text" class="form-control" id="quantite" value="0">

                            <span class="input-group-text" id="searchAss">Valider</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="nomPatie" class="form-label">Appareillage</label><br>
                        <div class="input-group mb-3">
                            <select id="prestation_id" class="form-select">
                                    <option selected="" value="0">-- Nature de la prestation --</option>
                                    @foreach($appareillages as $appareillage)
                                        <option value="{{$appareillage->id}}">
                                            {{ $appareillage->libelle }}
                                        </option>
                                    @endforeach
                            </select>                           
                            <span class="input-group-text" id="searchAss">Valider</span>
                        </div>
                    </div>

                </form><!-- End Multi Columns Form -->
                <div class="mb-3 mt-5">
                    <label for="exampleFormControlTextarea1" class="form-label pl-3">Résultat Recherche </label>
                    <div class="row d-none" id="noResults">
                        <div class="col-12">
                            <h3>Pas de Résultats</h3>
                        </div>
                    </div>
                    <div class="row" id="result">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Médicament / Posologie</th>
                                    <th scope="col">Posologie</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="assureTrouve">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card d-none" id="prestationI">
                    <input type="text" id="choice" value="0" disabled class="d-none">
                    <h5 class="card-header">Prestations</h5>
                    <div class="card-body">
                        <h6 class="card-title">Prestations A faire :</h6>
                        <div class="row">
                            <div class="col-md-8 m-0 p-0 mr-1">
                                <select id="examen_id" class="form-select">
                                    <option selected="" value="0">-- Prestations --</option>
                                    @foreach($medicaments as $medicament)
                                        <option value="{{$medicament->id}}" data-value="{{$medicament->nom_commercial}}">
                                            {{   (\App\Models\Medicament::where('id', $medicament->medicament_id)->first())  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8 m-0 p-0 mr-1">
                                <select id="examen_id" class="form-select">
                                    <option selected="" value="0">-- Actes --</option>
                                    @foreach($appareillages as $appareillage)
                                        <option value="{{$appareillage->id}}" data-value="{{$appareillage->libelle}}">
                                            {{   (\App\Models\Appareillages::where('id', $appareillage->appareillage_id)->first())  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-content-end justify-content-end mt-2">
                            <button class="btn btn-sm" id="addPaiement">+ Add Prescription</button>
                        </div>
                    </div>
                </div>


                <div class="row mb-3 d-none" id="fei">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Numero de Feuille de Soin</label>
                        <input type="text" class="form-control" id="nFeuille" value="0">
                    </div>
                </div>

                <div class="row d-none" id="valid">
                    <div class="col-12">
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="button">Ajouter Fiche</button>
                        </div>
                    </div>
                </div>

            </div>
		</div>
    </div>
</div>

	<!--/User Dashboard-->


@endsection
