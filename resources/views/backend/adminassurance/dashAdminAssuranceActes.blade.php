@extends('layouts.layout_adminassu');

@section('page-content')
	<!--User Dashboard-->

        <!-- <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des Actes</h5>

              <!- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des Actes</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nouvel Acte</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>
						<th scope="col">Type Acte</th>
						<th scope="col">Désignation</th>
						<th scope="col">Cotation</th>
						<th scope="col">Tarif</th>
						<th scope="col">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>

	                  @if(count($acteAssurances) != 0)
                    	@foreach($acteAssurances as $acteAssurance)
                        <tr>
                            <td>{{ $acteAssurance->type_acte_id }}</td>
							<td>{{ $acteAssurance->designation }}</td>
							<td>{{ $acteAssurance->cotation }}</td>
							<td>{{ $acteAssurance->tarif_conventionne }}</td>
							<td class="text-center">
								<button class="btn btn-xs btn-primary">
									<a href="{{ URL::to('dashboard/adminAssurance/show-acte') }}/{{ $acteAssurance->id }}">
										Voir
									</a>
								</button>

								<a href="{{ URL::to('dashboard/adminAssurance/show-acte') }}/{{ $acteAssurance->id }}">
									<button type="button" class="btn btn-warning">
										Voir
									</button>
								</a>
								
								<a href="{{ URL::to('dashboard/adminAssurance/edit-acte') }}/{{ $acteAssurance->id }}" class="btn"><i class="bi brush-fillt"></i></a>

								
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
					<form method="POST" action="{{ route('newActeAdminAssurance') }}">

						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
								<div class="row">
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Type Acte</label>
											<select class="form-select" name="type_acte_id">
                                                @if(count($typeactes) !=0)
                                                    @foreach ($typeactes as $typeacte)
														<option value="{{ $typeacte->id}}">
															{{ $typeacte->libelle }}
														</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Aucun Acte</option>
                                                @endif
                                            </select>
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Désignation</label>
											<input type="text" class="form-control" placeholder="Désignation" name="designation">
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Cotation de l'acte</label>
											<input type="text" class="form-control" placeholder="Cotation" name="cotation">
										</div>
									</div>
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Tarif Conventionné</label>
											<input type="number" class="form-control" placeholder="Tarif" name="tarif_conventionne">
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