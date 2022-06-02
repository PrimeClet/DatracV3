@extends('layouts.layout_adminassu')

@section('page-content')

	<!--User Dashboard-->

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Assurés</h5>

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des Assurés</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ajouter Assuré</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col" class="align-middle">Numero assure</th>
						<th scope="col" class="align-middle">Photo</th>
						<th scope="col" class="align-middle">Nom</th>
                        <th scope="col" class="align-middle">Date naissance</th>
                        <th scope="col" class="align-middle">Situation patient</th>
                        <th scope="col" class="align-middle">Numero patient</th>
						<th scope="col" class="align-middle">Email</th>
                        <th scope="col" class="align-middle">Signature patient</th>
						<th scope="col" class="align-middle">Telephone</th>
						<th scope="col" class="align-middle">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>
	                  @if(count($users) != 0)
                    	@foreach($users as $user)
                        <tr>
							<td class="fw-bolder align-middle">{{ $user->numero_assure }}</td>
							<td class=""><img src="/assets/photos/agents{{ $user->photo_url }}" alt="" style="width: 60px; height: 40px; border-radius: 5px"> </td>
							<td class="align-middle fw-bolder">{{ $user->name }}</td>
                            <td class="align-middle fw-bolder">{{ $user->datenaiss }}</td>
                            <td class="align-middle fw-bolder">{{ $user->situation_patient }}</td>
                            <td class="align-middle fw-bolder">{{ $user->numero_patient }}</td>
							<td class="align-middle text-sm-center" style="font-size: 12px">{{ $user->email }}</td>
                            <td class=""><img src="/assets/photos/agents{{ $user->signature_patient }}" alt="" style="width: 60px; height: 40px; border-radius: 5px"> </td>
							<td class="fw-bolder align-middle">{{ $user->telephone }}</td>
							<td class="text-center align-middle">
                                <button type="button" class="btn p-0 px-1 btn-outline-success" data-bs-toggle="modal" data-bs-target="#{{ $user->id }}">
                                    <i class="bi bi-eye-fill pe-none"></i>
                                </button>
                                <button type="button" class="btn p-0 px-1 btn-outline-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
								<a href="" onclick="if(confirm('Do you want to delete this user?'))event.preventDefault(); document.getElementById('delete-{{$user->id}}').submit();" class="btn p-0 px-1 btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
							</td>

                            <!-- Modal SEE -->
                            <div class="modal fade" id="{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Admin #{{ $user->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 d-flex flex-column align-content-between justify-content-center">
                                                    <img src="/assets/photos/roots{{ $user->photo_url }}" class="img-fluid" alt="" width="" height="">
                                                </div>
                                                <div class="col-md-6 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Numéro Assure</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $user->numero_assure }}" disabled>

                                                    <label class="form-label fw-bolder">Nom</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $user->name }}" disabled>

                                                    <label class="form-label fw-bolder">Date Naissance</label>
                                                    <input type="date" class="form-control mb-1" value="{{ $user->datenaiss }}" disabled>

                                                    <label class="form-label fw-bolder">Situation Patient</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $user->situation_patient }}" disabled>

                                                    <label class="form-label fw-bolder">Telephone</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $user->telephone }}" disabled>
                                                </div>
                                                <div class="col-md-6 d-flex flex-column align-content-between justify-content-center">
                                                    <img src="/assets/photos/roots{{ $user->signature_patient }}" class="img-fluid" alt="" width="" height="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-column align-content-between">
                                                    <label class="form-label fw-bolder">Email</label>
                                                    <input type="text" class="form-control mb-1" value="{{ $user->email }}" disabled>
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bolder" id="">Editer Assure #{{ $user->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" enctype="multipart/form-data" action="{{ route('updateAssureAdminAssurance') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Photo</label>
                                                        <input class="form-control" type="file" id="formFile" name="photo_url">
                                                    </div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Nom Assuré</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $user->name }}" name="name">

                                                        <label class="form-label fw-bolder">Numéro patient</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $user->numero_patient }}" name="numero_patient">

                                                        <label class="form-label fw-bolder">Date Naissance</label>
                                                        <input type="date" class="form-control mb-1" value="{{ $user->datenaiss }}" name="datenaiss">

                                                        <label class="form-label fw-bolder">Telephone</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $user->telephone }}" name="telephone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Signature</label>
                                                        <input class="form-control" type="file" id="formFile" name="signature_patient">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Mot de Passe</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $user->password }}" name="password">
                                                    </div>
													<div class="form-group col-md-6">
														<label class="text-black font-w500">Confirmez mot de passe</label>
														<input type="password" name="confirm_password" class="form-control">
													</div>
                                                    <div class="col-md-12 d-flex flex-column align-content-between">
														<label class="text-black font-w500">Situation patient</label>
														<select name="situation_patient" class="form-control">
															<option value="Assuré"> Assuré </option>
														</select>
                                                    </div>
													<div class="col-md-12 d-flex flex-column align-content-between">
                                                        <label class="form-label fw-bolder">Adresse</label>
                                                        <input type="text" class="form-control mb-1" value="{{ $user->adresse }}" name="adresse">
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
						<td>Aucune donnée</td>
                    </tr>
                    @endif



	                </tbody>
	              </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" enctype="multipart/form-data" action="{{ route('newAssureAdminAssurance') }}">
						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between mb-2">
                                        <label class="form-label fw-bolder">Photo</label>
                                        <input class="form-control mb-1" type="file" id="formFile" name="photo_url" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
										<label class="text-black font-w500">Situation patient</label>
										<select name="situation_patient" value="{{old('situation_patient')}}" class="form-control">
                                            <option value="Assuré"> Assuré </option>
										</select>
									</div>
                                    <div class="col-md-12 d-flex flex-column align-content-between mb-2">
                                        <label class="form-label fw-bolder">Signature patient</label>
                                        <input class="form-control mb-1" type="file" id="formFile" name="signature_patient" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">

                                        <label class="form-label fw-bolder">Nom Assuré</label>
                                        <input type="text" class="form-control mb-1" value="{{old('name')}}" name="name" required>

                                        <label class="form-label fw-bolder">Numero assure</label>
                                        <input type="text" class="form-control mb-1" value="{{old('numero_assure')}}" name="codeAgent" required>

                                        <label class="form-label fw-bolder">Telephone</label>
                                        <input type="text" class="form-control mb-1" value="{{old('telephone')}}" name="telephone" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">E-mail</label>
                                        <input type="text" class="form-control mb-1" value="{{old('email')}}" name="email" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Mot de Passe</label>
                                        <input type="text" class="form-control mb-1" value="{{old('password')}}" name="password" required>
                                    </div>
									<div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Confirmation Mot de Passe</label>
                                        <input type="text" class="form-control mb-1" value="{{old('confirm_password')}}" name="confirm_password" required>
                                    </div>
                                    <div class="col-md-12 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Adresse</label>
                                        <input type="text" class="form-control mb-1" value="{{old('adresse')}}" name="adresse" required>
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
