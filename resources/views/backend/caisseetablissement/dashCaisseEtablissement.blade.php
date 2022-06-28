@extends('layouts.layout_caisseetablissement')

@section('page-content')

	<!--User Dashboard-->

	<div class="container-fluid">
    <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h5 class="text-primary font-w600">Bienvenue sur DATRAC 2.0 !</h5>
            <p class="mb-0">CAISSE : <b>{{ $caisseetablissement->nom_etablissement }}</b></p>
        </div>

        <div class="input-group search-area ml-auto d-inline-flex">
            <!--input type="text" class="form-control" placeholder="Search here">
            <div class="input-group-append">
                <a href="javascript:void(0)" class="input-group-text"><i class="flaticon-381-search-2"></i></a>
            </div-->
        </div>
        <a class="btn btn-primary ml-3 btn-sm">
            <?php
                \Carbon\Carbon::setLocale('fr');
                echo \Carbon\Carbon::now()->translatedFormat('l jS F Y');
            ?>
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
			<div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-warning-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Prestation</p>
                                        <h3 class="">{{ $count_prestations }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-dark-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Clients</p>
                                        <h3 class="">{{ $count_prestations }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-xl-4 col-lg-4 col-sm-4">
					<div class="widget-stat card bg-info-light bg-opacity-100">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-heart"></i>
								</span>
								<div class="media-body text-right">
									<p class="mb-1">Rendez-Vous</p>
									<h3 class="">{{ $count_prestations }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="card-body">
                <h5 class="card-title">Identification Client | Ajout Client</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="nomPatie" class="form-label">Nom Patient | Ayant Droit</label><br>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg searchValue" id="searchValue" placeholder="Nom Patient" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="searchAss">Chercher</span>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <div class="col-md-2 mr-3">
                            <select id="typePatient" class="form-select form-control-sm">
                                <option selected="">-- Type Patient --</option>
                                <option value="0">Assuré</option>
                                <option value="1">Ayant-Droit</option>s
                            </select>
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="col-md-2">
                            <select id="inputState" class="form-select form-control-sm">
                                <option selected="">-- Assurance --</option>
                                @foreach($assurances as $assurance)
                                    <option value="{{ $assurance->id }}">{{$assurance->nom_assurance}}</option>
                                @endforeach
                            </select>
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
                                    <th scope="col">Noms</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Adresse</th>
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
                                <select id="presId" class="form-select">
                                    <option selected="" value="0">-- Prestations --</option>
                                    @foreach($prestation_etablissements as $pres)
                                        <option value="{{$pres->id}}" data-value="{{$pres->tarif_structure}}">{{   (\App\Models\Prestations::where('id', $pres->prestation_id)->first())->libelle   }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mx-0 p-0 pl-2">
                                <div class="input-group mb-3 pl-2">
                                    <input type="text" class="form-control disabled" id="price" value="0">
                                    <span class="input-group-text">FCFA</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-content-end justify-content-end mt-2">
                            <button class="btn btn-sm" id="addPaiement">+ Add paiement</button>
                        </div>
                    </div>
                </div>

                <div class="card d-none" id="paiements">
                    <h5 class="card-header">Paiements</h5>
                    <div class="card-body">
                        <h6 class="card-title">Moyen De Paiements :</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <form id="paid_box">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paid" id="gridRadios1" value="1" checked="">
                                        <label class="form-check-label" for="gridRadios1">
                                            Paiement Cash
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paid" id="gridRadios2" value="2">
                                        <label class="form-check-label" for="gridRadios2">
                                            Carte Bancaire
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paid" id="gridRadios3" value="3">
                                        <label class="form-check-label" for="gridRadios3">
                                            PayPal
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-12 col-md-4 offset-md-1 d-none" id="carteCred">
                                <form>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="username" placeholder="Nom complet (sur la carte)" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cardNumber" placeholder="Card number">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Expiration</span> </label>
                                                <div class="d-flex flex-row">
                                                    <input class="form-control" required="" type="text">
                                                    <span style="width:10%; text-align: center"> / </span>
                                                    <input class="form-control" required="" type="text">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                                <input class="form-control" required="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                            <button class="btn btn-primary" type="button">Creer Fiche</button>
                        </div>
                    </div>
                </div>

            </div>
		</div>
    </div>
</div>

	<!--/User Dashboard-->


@endsection
