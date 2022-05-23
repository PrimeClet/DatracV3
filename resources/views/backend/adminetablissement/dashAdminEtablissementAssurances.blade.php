@extends('layouts.layout_adminets')

@section('page-content')

	<!--User Dashboard-->

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Assurances</h5>

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des Assurances</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ajouter Assurance</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col" class="align-middle">Id Assurance</th>
						<th scope="col" class="align-middle">Assurance</th>
						<th scope="col" class="align-middle">Etablissement</th>
						<th scope="col" class="align-middle">Début Contrat</th>
                        <th scope="col" class="align-middle">Fin Contrat</th>
						<th scope="col" class="align-middle">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>
	                  @if(count($etablissementAssurances) != 0)
                    	@foreach($etablissementAssurances as $etablissementAssurance)
                        <tr>
							<td class="fw-bolder align-middle">{{ $etablissementAssurance->id }}</td>
							<td class="align-middle fw-bolder">{{ $etablissementAssurance->assurance_id }}</td>
                            <td class="align-middle fw-bolder">{{ $etablissementAssurance->etablissement_id }}</td>
							<td class="fw-bolder align-middle">{{ $etablissementAssurance->date_debut }}</td>
                            <td class="fw-bolder align-middle">{{ $etablissementAssurance->date_fin }}</td>
							<td class="text-center align-middle">
                                <button type="button" class="btn p-0 px-1 btn-outline-success" data-bs-toggle="modal" data-bs-target="#{{ $etablissementAssurance->id }}">
                                    <i class="bi bi-eye-fill pe-none"></i>
                                </button>
                                <button type="button" class="btn p-0 px-1 btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $etablissementAssurance->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
								<a href="" onclick="if(confirm('Do you want to delete this user?'))event.preventDefault(); document.getElementById('delete-{{$etablissementAssurance->id}}').submit();" class="btn p-0 px-1 btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
							</td>

                            <!-- Modal SEE -->
                            <div class="modal fade" id="{{ $etablissementAssurance->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Assurance #{{ $etablissementAssurance->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Id Assurance</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $etablissementAssurance->id }}" disabled>

                                                    <label class="form-label fw-bolder">Nom Assurance</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $etablissementAssurance->assurance_id }}" disabled>

                                                    <label class="form-label fw-bolder">Etablissement</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $etablissementAssurance->etablissement_id }}" disabled>

                                                    <label class="form-label fw-bolder">Début contrat</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $etablissementAssurance->date_debut }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Fin Contrat</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $etablissementAssurance->date_fin }}" disabled>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit{{ $etablissementAssurance->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Editer Assurance #{{ $etablissementAssurance->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" enctype="multipart/form-data" action="{{ route('updateAssuranceAdminEtablissement') }}">
                                                @csrf
                                                    <div class="col-md-12 d-flex flex-column align-content-between">

                                                        <label class="form-label fw-bolder">Assurance</label>
                                                        <select class="form-control" name="assurance_id">
                                                            @if(count($assurances) !=0)
                                                                @foreach ($assurances as $assurance)
                                                                    <option value="{{ $assurance->id}}">
                                                                        {{ $assurance->nom_assurance }}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                <option value="">Aucune Assurance</option>
                                                            @endif
                                                        </select>

                                                        <label class="form-label fw-bolder">Début Contrat</label>
                                                        <input type="date" class="form-control mb-1" value="{{ $etablissementAssurance->date_debut }}" name="date_debut">
                                                    </div>
                                                </div>
                                                <div class="row">
													<div class="form-group col-md-6">
														<label class="text-black font-w500">Fin Contrat</label>
														<input type="date" class="form-control" value="{{ $etablissementAssurance->date_fin }}" name="date_fin">
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
                    </tr>
                    @endif



	                </tbody>
	              </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" enctype="multipart/form-data" action="{{ route('newAssuranceAdminEtablissement') }}">
						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between">

                                        <label class="form-label fw-bolder">Assurance</label>
                                        <select class="form-control" name="assurance_id">
                                            @if(count($assurances) !=0)
                                                @foreach ($assurances as $assurance)
                                                    <option value="{{ $assurance->id}}">
                                                        {{ $assurance->nom_assurance }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">Aucune assurance</option>
                                            @endif
                                        </select>

                                        <label class="form-label fw-bolder">Début Contrat</label>
                                        <input type="date" class="form-control mb-1" value="{{old('date_debut')}}" name="date_debut" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Fin Contrat</label>
                                        <input type="date" class="form-control mb-1" value="{{old('date_fin')}}" name="date_fin" required>
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
