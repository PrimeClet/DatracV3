@extends('layouts.layout_adminets');

@section('page-content')
	<!--User Dashboard-->

        <!-- <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des prestation soins</h5>

              <!- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des prestations de soins</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nouvelle prestation de soins</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col">Date</th>
						<th scope="col">Visite à domicile</th>
						<th scope="col">Code affection</th>
                        <th scope="col">Code acte</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Ticket modérateur</th>
                        <th scope="col">Assuré</th>
                        <th scope="col">Forfait déplacement</th>
						<th scope="col">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>

	                  @if(count($prestationsoins) != 0)
                    	@foreach($prestationsoins as $prestationsoin)
                        <tr>
							<td>{{ $prestationsoin->created_at }}</td>
							<td>{{ $prestationsoin->visite_domicile }}</td>
                            <td>{{ $prestationsoin->affection_assurance_id }}</td>
                            <td>{{ $prestationsoin->acte_assurance_id }}</td>
                            <td>{{ $prestationsoin->montant }}</td>
                            <td>{{ $prestationsoin->ticket_moderateur_id }}</td>
                            <td>{{ $prestationsoin->assure }}</td>
                            <td>{{ $prestationsoin->forfait_deplacement }}</td>
							<td class="text-center">
								<button class="btn btn-xs btn-primary">
									<a href="{{ URL::to('dashboard/adminetablissement/show-prestationsoin') }}/{{ $prestationsoin->id }}">
										Voir
									</a>
								</button>

								<a href="{{ URL::to('dashboard/adminetablissement/show-prestationsoin') }}/{{ $prestationsoin->id }}">
									<button type="button" class="btn btn-warning">
										Voir
									</button>
								</a>
								
								<a href="{{ URL::to('dashboard/adminetablissement/edit-prestationsoin') }}/{{ $prestationsoin->id }}" class="btn"><i class="bi brush-fillt"></i></a>

								
							</td>
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
                        <td>Aucune donnée</td>												
                    </tr>
                    @endif



	                </tbody>
	              </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" action="{{ route('newprestationsoinAdminEtablissement') }}">

						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
								<div class="row">
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
                                            <div class="col-md-6 d-flex flex-column align-content-between">
                                                <label class="form-label fw-bolder">Date prestation</label>
                                                <input type="date" name="created_at" class="form-control mb-1">
                                            </div>
                                            <label class="form-label">Visite à domicile</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="0" id="inlineRadio1" name="visite_domicile">
                                                <label class="form-check-label" for="inlineRadio1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="1" id="inlineRadio2" name="visite_domicile" checked>
                                                <label class="form-check-label" for="inlineRadio2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
									</div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Code affection</label>
                                                <select class="form-select" name="affection_assurance_id">
                                                    @if(count($affectionassurances) !=0)
                                                        @foreach ($affectionassurances as $affectionassurance)
                                                            <option value="{{ $affectionassurance->id}}">
                                                                {{ $affectionassurance->affection_id->titre }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Aucune affection</option>
                                                    @endif
                                                </select>
                                            </div>
									    </div>
									</div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Ticket modérateur</label>
                                                <select class="form-select" name="ticket_moderateur_id">
                                                    @if(count($ticketmoderateurs) !=0)
                                                        @foreach ($ticketmoderateurs as $ticketmoderateur)
                                                            <option value="{{ $ticketmoderateur->id}}">
                                                                {{ $ticketmoderateur->libelle }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Aucun ticket modérateur</option>
                                                    @endif
                                                </select>
                                            </div>
									    </div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
                                            <label class="form-label">Accident causé par un tiers</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="0" id="inlineRadio1" name="accident_tiers">
                                                <label class="form-check-label" for="inlineRadio1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="1" id="inlineRadio2" name="accident_tiers" checked>
                                                <label class="form-check-label" for="inlineRadio2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
									</div>
                                    <div class="col-md-6 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Si oui, date de l'accident</label>
                                        <input type="date" name="date_accident" class="form-control mb-1">
                                    </div>
                                    <div class="form-group">
                                            <label class="form-label">Soins liés à la grossesse</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="0" id="inlineRadio1" name="soins_grossesse">
                                                <label class="form-check-label" for="inlineRadio1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="1" id="inlineRadio2" name="soins_grossesse" checked>
                                                <label class="form-check-label" for="inlineRadio2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
									</div>
                                    <div class="col-md-6 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Date présumée de début de grossesse</label>
                                        <input type="date" name="debut_grossesse" class="form-control mb-1">
                                    </div>
                                    <div class="col-md-6 d-flex flex-column align-content-between">
                                        <label class="form-label fw-bolder">Date présumée de l'accouchement</label>
                                        <input type="date" name="date_accouchement" class="form-control mb-1">
                                    </div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Assuré</label>
											<select class="form-select" name="assure_id">
                                                @if(count($assures) !=0)
                                                    @foreach ($assures as $assure)
														<option value="{{ $assure->id}}">
															{{ $assure->name }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucune assure</option>
                                                @endif
                                            </select>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer border-top-0">
								<button type="submit" class="btn btn-primary">Soumettre</button>
							</div>
						</div>
						
					</form>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>


        </div> -->

	<!--/User Dashboard-->


@endsection