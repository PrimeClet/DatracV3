@extends('layouts.layout_superadmin')

@section('page-content')

	<!--User Dashboard-->

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Etablissements</h5>

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des Etablissements</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ajouter Etablissement</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col" class="align-middle">code etablissement</th>
						<th scope="col" class="align-middle">Logo</th>
						<th scope="col" class="align-middle">Nom</th>
						<th scope="col" class="align-middle">Statut</th>
						<th scope="col" class="align-middle">Localisation</th>
						<th scope="col" class="align-middle">Telephone</th>
						<th scope="col" class="align-middle">Actions</th>
	                  </tr>
	                </thead>
	                <tbody>
	                  @if(count($actes) != 0)
                    	@foreach($actes as $acte)
                        <tr>
							<td class="fw-bolder align-middle">{{ $acte->code_etablissement }}</td>
							<td class=""><img src="/assets/img{{ $acte->logo }}" alt="" style="width: 60px; height: 40px; border-radius: 5px"> </td>
							<td class="align-middle">{{ $acte->nom_etablissement }}</td>
							<td class="align-middle text-sm-center" style="font-size: 12px">{{ $acte->statut_juridique }}</td>
							<td class="align-middle text-sm-center" style="font-size: 12px">{{ $acte->raison_sociale }}</td>
							<td class="fw-bolder align-middle">{{ $acte->tel }}</td>
							<td class="text-center">
                                <button type="button" class="btn p-0 px-1 btn-outline-success" data-bs-toggle="modal" data-bs-target="#{{ $acte->code_etablissement }}">
                                    <i class="bi bi-eye-fill pe-none"></i>
                                </button>
                                <button type="button" class="btn p-0 px-1 btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $acte->code_etablissement }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
								<a href="{{ URL::to('dashboard/root/edit-acte') }}/{{ $acte->id }}" class="btn p-0 px-1 btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
							</td>
                            <!-- Modal SEE -->
                            <div class="modal fade" id="{{ $acte->code_etablissement }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Etablissement #{{ $acte->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 d-flex flex-column align-content-between justify-content-center">
                                                    <img src="/assets/img{{ $acte->logo }}" class="img-fluid" alt="" width="" height="">
                                                </div>
                                                <div class="col-md-6 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Code Etablissement</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $acte->code_etablissement }}" disabled>

                                                    <label class="form-label fw-bolder">Telephone Etablissement</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $acte->tel }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="form-label fw-bolder">Nom Etablisement</label>
                                                <input type="text" class="form-control mb-1" value="{{ $acte->nom_etablissement }}" disabled>

                                                <div class="col-md-12 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Localisation</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $acte->raison_sociale }}" disabled>
                                                </div>
                                                <div class="col-md-12 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Statut Juridique</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $acte->statut_juridique }}" disabled>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit{{ $acte->code_etablissement }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Edit Etablissement #{{ $acte->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" enctype="multipart/form-data" action="{{ route('updateEtablissementSuperAdmin') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">logo Etablissement</label>
                                                        <input class="form-control" type="file" id="formFile" name="picass">
                                                    </div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Code Etablissement</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->code_etablissement }}" name="code">

                                                        <label class="form-label fw-bolder">Nom Etablissement</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->nom_etablissement }}" name="nom">

                                                        <label class="form-label fw-bolder">Telephone Etablissement</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->tel }}" name="tel">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Localisation</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->raison_sociale }}" name="localistation">
                                                    </div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Statut Juridique</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->statut_juridique }}" name="statt">
                                                    </div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Site Web</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->site_web }}" name="site">
                                                    </div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">BP</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $acte->bp }}" name="bp">
                                                    </div>
                                                </div>
                                                <div class="d-grid gap-2 mt-3">
                                                    <button type="submit" class="btn btn-outline-primary btn-block">Editer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</tr>
                        @endforeach
                    @else
                    <tr>
                        <td>Aucune donnée</td>
                        <td>Aucune donnée</td>
                        <td>Aucune donnée</td>
                        <td>Aucune donnée</td>
                        <td>Aucune donnée</td>
                    </tr>
                    @endif

	                </tbody>
	              </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" enctype="multipart/form-data" action="{{ route('newEtablissementSuperAdmin') }}">
						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between mb-2">
                                        <label class="form-label fw-bolder">logo Etablissement</label>
                                        <input class="form-control mb-1" type="file" id="formFile" name="picass" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Code Etablissement</label>
                                        <input type="text" class="form-control mb-1" value="{{old('code')}}" name="code" required>

                                        <label class="form-label fw-bolder">Nom Etablissement</label>
                                        <input type="text" class="form-control mb-1" value="{{old('nom')}}" name="nom" required>

                                        <label class="form-label fw-bolder">Telephone Etablissement</label>
                                        <input type="text" class="form-control mb-1" value="{{old('tel')}}" name="tel" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Localisation</label>
                                        <input type="text" class="form-control mb-1" value="{{old('localistation')}}" name="localistation" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Statut Juridique</label>
                                        <input type="text" class="form-control mb-1" value="{{old('statt')}}" name="statt" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Site Web</label>
                                        <input type="text" class="form-control mb-1" value="{{old('site')}}" name="site" >
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">BP</label>
                                        <input type="text" class="form-control mb-1" value="{{ old('bp') }}" name="bp">
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-outline-primary btn-block">Soumettre</button>
                                </div>
							</div>
						</div>

					</form>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>


        </div>

	<!--/User Dashboard-->


@endsection
