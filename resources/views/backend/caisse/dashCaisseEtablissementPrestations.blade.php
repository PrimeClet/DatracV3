@extends('layouts.layout_caisse');

@section('page-content')
	<!--User Dashboard-->

        <!-- <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Prestation Caisse</h5>

              <!- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des prestation caisses</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nouvel prestation caisse</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>
						<th scope="col">Date Prestation</th>
						<th scope="col">Prestation</th>
						<th scope="col">Montant</th>
						<th scope="col">Type assure</th>
                        <th scope="col">Assure</th>
                        <th scope="col">assurance</th>
                        <th scope="col">Total</th>
						<th scope="col">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>

	                  @if(count($prestationcaisses) != 0)
                    	@foreach($prestationcaisses as $prestationcaisse)
                        <tr>
                            <td>{{ $prestationcaisse->created_at }}</td>
							<td>{{ $prestationcaisse->prestation_id }}</td>
							<td>{{ $prestationcaisse->montant }}</td>
							<td>{{ $prestationcaisse->type_assure_id }}</td>
                            <td>{{ $prestationcaisse->assure }}</td>
                            <td>{{ $prestationcaisse->assurance_id }}</td>
							<td class="text-center">
								<button class="btn btn-xs btn-primary">
									<a href="{{ URL::to('dashboard/adminAssurance/show-prestationcaisse') }}/{{ $prestationcaisse->id }}">
										Voir
									</a>
								</button>

								<a href="{{ URL::to('dashboard/adminAssurance/show-prestationcaisse') }}/{{ $prestationcaisse->id }}">
									<button type="button" class="btn btn-warning">
										Voir
									</button>
								</a>
								
								<a href="{{ URL::to('dashboard/adminAssurance/edit-prestationcaisse') }}/{{ $prestationcaisse->id }}" class="btn"><i class="bi brush-fillt"></i></a>

								
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
                    </tr>
                    @endif



	                </tbody>
	              </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
					<form method="POST" action="{{ route('newPrestationCaisse') }}">

						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
								<div class="row">
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Prestation</label>
											<select class="form-select" name="prestation_id">
                                                @if(count($prestation_etablissements) !=0)
                                                    @foreach ($prestation_etablissements as $prestation_etablissement)
														<option value="{{ $prestation_etablissement->id}}">
															{{ $prestation_etablissement->libelle }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucun prestation</option>
                                                @endif
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Type Assuré</label>
											<select class="form-select" name="type_assure_id">
                                                @if(count($typeassures) !=0)
                                                    @foreach ($typeassures as $typeassure)
														<option value="{{ $typeassure->id}}">
															{{ $typeassure->libelle }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucun Assuré</option>
                                                @endif
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Assurance</label>
											<select class="form-select" name="assurance_id">
                                                @if(count($assurances) !=0)
                                                    @foreach ($assurances as $assurance)
														<option value="{{ $assurance->id}}">
															{{ $assurance->libelle }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucune Assurance</option>
                                                @endif
                                            </select>
										</div>
									</div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Assuré</label>
											<select class="form-select" name="assure">
                                                @if(count($assures) !=0)
                                                    @foreach ($assures as $assure)
														<option value="{{ $assure->id}}">
															{{ $assure->libelle }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucune Assuré</option>
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