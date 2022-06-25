@extends('layouts.layout_adminets');

@section('page-content')
	<!--User Dashboard-->

        <!-- <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Medicaments</h5>

              <!- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des Medicaments</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nouveau Medicament</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col">Id</th>
						<th scope="col">Tarif structure</th>
						<th scope="col">Quantité</th>
						<th scope="col">Medicament</th>
						<th scope="col">Etablissement</th>
						<th scope="col">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>

	                  @if(count($medicamentEtablissements) != 0)
                    	@foreach($medicamentEtablissements as $medicamentEtablissement)
                        <tr>
							<td>{{ $medicamentEtablissement->id }}</td>
							<td>{{ $medicamentEtablissement->tarif_structure }}</td>
							<td>{{ $medicamentEtablissement->quantite }}</td>
                            <td>{{ $medicamentEtablissement->medicament_id }}</td>
							<td>{{ $medicamentEtablissement->etablissement_id }}</td>
							<td class="text-center">
								<button class="btn btn-xs btn-primary">
									<a href="{{ URL::to('dashboard/adminetablissement/show-medicament') }}/{{ $medicamentEtablissement->id }}">
										Voir
									</a>
								</button>

								<a href="{{ URL::to('dashboard/adminetablissement/show-medicament') }}/{{ $medicamentEtablissement->id }}">
									<button type="button" class="btn btn-warning">
										Voir
									</button>
								</a>
								
								<a href="{{ URL::to('dashboard/adminetablissement/edit-medicament') }}/{{ $medicamentEtablissement->id }}" class="btn"><i class="bi brush-fillt"></i></a>

								
							</td>
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
					<form method="POST" action="{{ route('newMedicamentAdminEtablissement') }}">

						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Tarif structure</label>
											<input type="text" class="form-control" placeholder="Tarif structure" name="tarif_structure">
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Quantité</label>
											<input type="number" class="form-control" placeholder="Quantité" name="quantite">
										</div>
									</div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Medicament</label>
											<select class="form-control" name="medicament_id">
                                                @if(count($medicaments) !=0)
                                                    @foreach ($medicaments as $medicament)
														<option value="{{ $medicament->id}}">
															{{ $medicament->nom_commercial }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucune Medicament</option>
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