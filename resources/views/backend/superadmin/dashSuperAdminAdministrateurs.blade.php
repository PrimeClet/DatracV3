@extends('layouts.layout_superadmin')

@section('page-content')

	<!--User Dashboard-->
	<!-- row -->
<div class="container-fluid">
    <div class="form-head d-flex mb-3  mb-lg-5   align-items-start">
		<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#ajouterUtilisateurModal">
			+Nouvel utilisateur
		</a>
	</div>
	<!-- Ajouter Utilisateur -->
	<div class="modal fade" id="ajouterUtilisateurModal">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ajouter Utilisateur</h5>
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{ route(' creeSuperAdminUtilisateur') }}">
						@csrf
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="text-black font-w500">Nom complet</label>
								<input type="text" name="name" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="text-black font-w500">Email</label>
								<input type="email" name="email" class="form-control">
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-4">
								<label class="text-black font-w500">Téléphone</label>
								<input type="phone" name="telephone" class="form-control">
							</div>
							<div class="form-group col-md-4">
								<label class="text-black font-w500">Niveau d'accès</label>
								<select name="role" class="form-control">
									<option value="SuperAdmin">SUPER ADMIN</option>
									<option value="AdminEtablissement">Admin Etablissement</option>
									<option value="AdminAssurance">Admin Assurance</option>
								</select>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="text-black font-w500">Mot de passe</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label class="text-black font-w500">Confirmez mot de passe</label>
								<input type="password" name="confirm_password" class="form-control">
							</div>
						</div>	

						<div class="form-group">
							<label class="text-black font-w500">Adresse</label>
							<textarea class="form-control" name="adresse" placeholder="Votre description..."></textarea>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">SOUMETTRE</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-12">

        	@if(Session::get('success'))
	            <div class="alert alert-success alert-dismissible alert-alt solid fade show">
	                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
	                </button>
	                <strong>Succès!</strong> {{ Session::get('success') }}.
	            </div>
	        @endif

	        @if(Session::get('failed'))
	            <div class="alert alert-warning alert-dismissible alert-alt solid fade show">
	                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
	                </button>
	                <strong>Attention!</strong> {{ Session::get('failed') }}.
	            </div>
	        @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des utilisateurs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">


                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>N#</th>
                                    <th>Nom complet</th>
                                    <th>Téléphone</th>
                                    <th>Niveau d'accès</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@if(count($utilisateurs) != 0)
	                            	@foreach($utilisateurs as $utilisateur)
	                                <tr>
	                                    <td>{{ $utilisateur->id }}</td>
	                                    <td>{{ $utilisateur->name }}</td>
	                                    <td>{{ $utilisateur->telephone }}</td>
	                                    <td>{{ $utilisateur->role }}</td>
	                                    <td>
	                                    	@if($utilisateur->active == 1)
	                                    		<button type="button" class="btn btn-rounded btn-success">
	                                    			Activée
	                                    		</button>
	                                    	@else
	                                    		<button type="button" class="btn btn-rounded btn-warning">
	                                    			Désactivée
	                                    		</button>
	                                    	@endif
	                                    </td>
	                                    <td>
											<div class="d-flex">
												@if($utilisateur->role = "SuperAdmin" || $utilisateur->role = "AdminEtablissement" || $utilisateur->role = "AdminAssurance")
												<a href="#" class="btn btn-primary shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#modifierUtilisateurModal-{{ $utilisateur->id }}">
													<i class="fa fa-pencil"></i>
												</a>
		                                    	@endif
												<a href="#" class="btn btn-info shadow btn-xs sharp mr-1" data-toggle="modal" data-target="#voirDetailsUtilisateurModal-{{ $utilisateur->id }}">
													<i class="fa fa-eye"></i>
												</a>
												@if($utilisateur->active == 1)
													<a href="#" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#desactiverUtilisateurModal-{{ $utilisateur->id }}">
														<i class="fa fa-trash"></i>
													</a>
		                                    	@else
		                                    		<a href="#" class="btn btn-warning shadow btn-xs sharp" data-toggle="modal" data-target="#activerUtilisateurModal-{{ $utilisateur->id }}">
														<i class="fa fa-check"></i>
													</a>
		                                    	@endif
											</div>												
										</td>												
	                                </tr>


									<!-- Voir Utilisateur -->
									<div class="modal fade" id="voirDetailsUtilisateurModal-{{ $utilisateur->id }}">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Détails Utilisateur</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="card">
														<div class="card-header border-0 pb-0">
															<h2 class="card-title">{{ $utilisateur->name }}</h2>
														</div>
														<div class="card-body pb-0">
															<ul class="list-group list-group-flush">
																<li class="list-group-item d-flex px-0 justify-content-between">
																	<strong>Email</strong>
																	<span class="mb-0">{{ $utilisateur->email }}</span>
																</li>
																<li class="list-group-item d-flex px-0 justify-content-between">
																	<strong>Téléphone</strong>
																	<span class="mb-0">{{ $utilisateur->telephone }}</span>
																</li>
																<li class="list-group-item d-flex px-0 justify-content-between">
																	<strong>Niveau d'accès</strong>
																	<span class="mb-0">{{ $utilisateur->role }}</span>
																</li>
																<li class="list-group-item d-flex px-0 justify-content-between">
																	<strong>Adresse</strong>
																	<span class="mb-0">{{ $utilisateur->adresse }}</span>
																</li>
															</ul>
							                            </div>
													</div>
												</div>
											</div>
										</div>
									</div>


									<!-- Modifier Utilisateur -->
									<div class="modal fade" id="modifierUtilisateurModal-{{ $utilisateur->id }}">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Modifier Utilisateur</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form method="POST" action="{{ route('modifierProfilSuperAdmin') }}">
														@csrf
														<input type="hidden" name="id" value="{{ $utilisateur->id }}">

														<div class="form-row">
															<div class="form-group col-md-6">
																<label class="text-black font-w500">Nom complet</label>
																<input type="text" name="name" class="form-control" value="{{ $utilisateur->name }}">
															</div>
															<div class="form-group col-md-6">
																<label class="text-black font-w500">Email</label>
																<input type="email" name="email" value="{{ $utilisateur->email }}" class="form-control">
															</div>
														</div>

														<div class="form-row">
															<div class="form-group col-md-4">
																<label class="text-black font-w500">Téléphone</label>
																<input type="phone" name="telephone" value="{{ $utilisateur->telephone }}" class="form-control">
															</div>
															<div class="form-group col-md-4">
																<label class="text-black font-w500">Niveau d'accès</label>
																<select name="role" class="form-control">
																	@if($utilisateur->role == "SuperAdmin")
																	<option value="SuperAdmin" selected=>Super Admin</option>
																	<option value="AdminAssurance">Admin Assurance</option>
																	<option value="AdminEtablissement">Admin Etablissement</option>

																	@elseif($utilisateur->role == "AdminAssurance")
																	<option value="SuperAdmin">Super Admin</option>
																	<option value="AdminAssurance" selected=>Admin Assurance</option>
																	<option value="AdminEtablissement">Admin Etablissement</option>

																	@elseif($utilisateur->role == "AdminEtablissement")
																	<option value="SuperAdmin">Super Admin</option>
																	<option value="AdminAssurance">Admin Assurance</option>
																	<option value="AdminEtablissement" selected=>Admin Etablissement</option>

																	@else
																	<option value="SuperAdmin">Super Admin</option>
																	<option value="AdminAssurance">Admin Assurance</option>
																	<option value="AdminEtablissement">Admin Etablissement</option>
																	@endif
																</select>
															</div>
														</div>
														
														<div class="form-row">
															<div class="form-group col-md-6">
																<label class="text-black font-w500">Mot de passe</label>
																<input type="password" name="password" class="form-control">
															</div>
															<div class="form-group col-md-6">
																<label class="text-black font-w500">Confirmez mot de passe</label>
																<input type="password" name="confirm_password" class="form-control">
															</div>
														</div>	

														<div class="form-group">
															<label class="text-black font-w500">Adresse</label>
															<textarea class="form-control" name="adresse" placeholder="Votre description...">
																{{ $utilisateur->adresse }}
															</textarea>
														</div>

														<div class="form-group">
															<button type="submit" class="btn btn-primary">SOUMETTRE</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>


									<!-- Désactiver Utilisateur -->
									<div class="modal fade" id="desactiverUtilisateurModal-{{ $utilisateur->id }}">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Désactiver Utilisateur</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Souhaitez-vous vraiment désactiver cet utilisateur ?
												</div>
							                    <div class="modal-footer">
							                        <button type="button" class="btn btn-primary light" data-dismiss="modal">
							                            Non
							                        </button>
							                        <form method="post" action="{{ route('desactiveRootUtilisateur') }}">
							                            @csrf
							                            <input type="hidden" name="id" value="{{ $utilisateur->id }}">
							                            <button type="submit" class="btn btn-danger">
							                                Oui
							                            </button>
							                        </form>
							                    </div>
											</div>
										</div>
									</div>


									<!-- Activer Utilisateur -->
									<div class="modal fade" id="activerUtilisateurModal-{{ $utilisateur->id }}">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Activer Utilisateur</h5>
													<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
													</button>
												</div>
												<div class="modal-body">
													Souhaitez-vous vraiment activer cet utilisateur ?
												</div>
							                    <div class="modal-footer">
							                        <button type="button" class="btn btn-primary light" data-dismiss="modal">
							                            Non
							                        </button>
							                        <form method="post" action="{{ route('activeSuperAdminUtilisateur') }}">
							                            @csrf
							                            <input type="hidden" name="id" value="{{ $utilisateur->id }}">
							                            <button type="submit" class="btn btn-danger">
							                                Oui
							                            </button>
							                        </form>
							                    </div>
											</div>
										</div>
									</div>


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
                            <tfoot>
                                <tr>
                                    <th>N#</th>
                                    <th>Nom complet</th>
                                    <th>Téléphone</th>
                                    <th>Niveau d'accès</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>



                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

	<!--/User Dashboard-->


@endsection