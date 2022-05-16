@extends('layouts.layout_superadmin')

@section('page-content')


<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, bon retour à vous!</h4>
                <p class="mb-0">Gérer votre profil ici !</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboardSuperAdmin') }}">Accueil</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">

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


            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
						<div class="profile-details">
							<div class="profile-name px-3 pt-2">
								<h4 class="text-primary mb-0">{{ Auth::user()->name }}</h4>
								<p>{{ Auth::user()->role }}</p>
							</div>
							<div class="profile-email px-2 pt-2">
								<h4 class="text-muted mb-0">{{ Auth::user()->email }}</h4>
								<p>Email</p>
							</div>
							<div class="profile-email px-1 pt-2">
								<h4 class="text-muted mb-0">{{ Auth::user() ? Auth::user()->telephone : 'Aucun numéro' }}</h4>
								<p>Téléphone</p>
							</div>
						</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">
                                	A propos de moi
                                </a>
                                </li>
                                <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">
                                	Mon profil
                                </a>
                                </li>
                                <li class="nav-item"><a href="#my-posts" data-toggle="tab" class="nav-link">
                                	Mot de passe
                                </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="my-posts" class="tab-pane fade">
                                    <br><br>
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Changer mot de passe</h4>
                                            <form method="POST" action="{{ route('modifierMotDePasseSuperAdmin') }}">

                                            	@csrf

                                                <div class="form-group">
                                                    <label>Ancien mot de passe</label>
                                                    <input type="password" name="old_password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nouveau mot de passe</label>
                                                    <input type="password" name="new_password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirmation mot de passe</label>
                                                    <input type="password" name="confirm_password" class="form-control">
                                                </div>
                                                <button class="btn btn-primary" type="submit">
                                                	Soumettre
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="about-me" class="tab-pane fade active show">
                                	<br><br>
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Informations personnelles</h4>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Nom complet <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>
                                            	{{ Auth::user() ? Auth::user()->name : 'Pas de nom' }}
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>
                                            	{{ Auth::user() ? Auth::user()->email : 'Aucun email' }}
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Téléphone <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>
                                            	{{ Auth::user() ? Auth::user()->telephone : 'Aucun numéro' }}
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Profession <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Adresse <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>
                                            	{{ Auth::user() ? Auth::user()->adresse : 'Aucune adresse' }}
                                            </span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-3 col-5">
                                                <h5 class="f-w-500">Niveau d'accès <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-sm-9 col-7"><span>
                                            	{{ Auth::user() ? Auth::user()->role : 'Aucun accès' }}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="profile-settings" class="tab-pane fade">
                                	<br><br>
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Paramètres du compte</h4>
                                            <form method="POST" action="{{ route('modifierProfilSuperAdmin') }}">

                                            	@csrf

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nom complet</label>
                                                        <input type="text" value="{{ Auth::user() ? Auth::user()->name : '' }}" class="form-control" name="name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>E-mail</label>
                                                        <input type="email" value="{{ Auth::user() ? Auth::user()->email : '' }}" class="form-control" name="email">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Téléphone</label>
                                                        <input type="number" value="{{ Auth::user() ? Auth::user()->telephone : '' }}" class="form-control" name="telephone">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Addresse</label>
                                                    <input type="text" value="{{ Auth::user() ? Auth::user()->adresse : '' }}" class="form-control" name="adresse">
                                                </div>
                                                <button class="btn btn-primary" type="submit">
                                                	Soumettre
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


						<!-- Modal -->
						<div class="modal fade" id="replyModal">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Post Reply</h5>
										<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
									</div>
									<div class="modal-body">
										<form>
											<textarea class="form-control" rows="4">Message</textarea>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Reply</button>
									</div>
								</div>
							</div>
						</div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection