@extends('layouts.layout_adminassu');

@section('page-content')
	<!--User Dashboard-->

        <!-- <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Gestion des prestations</h5>

              <!- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Listing des prestations</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nouvel prestation</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <table class="table datatable">
	                <thead>
	                  <tr>

	                    <th scope="col">Id</th>
						<th scope="col">prestation</th>
                        <th scope="col">Ticket Moderateur</th>
						<th scope="col">Actions</th>

	                  </tr>
	                </thead>
	                <tbody>

	                  @if(count($prestationAssurances) != 0)
                    	@foreach($prestationAssurances as $prestationAssurance)
                        <tr>
							<td>{{ $prestationAssurance->id }}</td>
							<td>{{ $prestationAssurance->tarif_conventionne }}</td>
                            <td>{{ $prestationAssurance->prestation_id }}</td>
                            <td>{{ $prestationAssurance->ticketModerateur }}</td>
							<td class="text-center">
								<button class="btn btn-xs btn-primary">
									<a href="{{ URL::to('dashboard/adminAssurance/show-prestation') }}/{{ $prestationAssurance->id }}">
										Voir
									</a>
								</button>

								<a href="{{ URL::to('dashboard/adminAssurance/show-prestation') }}/{{ $prestationAssurance->id }}">
									<button type="button" class="btn btn-warning">
										Voir
									</button>
								</a>
								
								<a href="{{ URL::to('dashboard/adminAssurance/edit-prestation') }}/{{ $prestationAssurance->id }}" class="btn"><i class="bi brush-fillt"></i></a>

								
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
					<form method="POST" action="{{ route('newPrestationAdminAssurance') }}">

						@csrf
						<div class="card border-0 shadow-none mb-0">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Tarif conventionne</label>
											<input type="text" class="form-control" placeholder="Tarif conventionne" name="tarif_conventionne">
										</div>
									</div>
                                    <div class="col-sm-6 col-md-6">
										<div class="form-group">
											<label class="form-label">Prestation</label>
											<select class="form-control" name="prestation_id">
                                                @if(count($prestations) !=0)
                                                    @foreach ($prestations as $prestation)
														<option value="{{ $prestation->id}}">
															{{ $prestation->libelle }}
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
											<label class="form-label">Ticket Moderateur</label>
											<input type="text" class="form-control" placeholder="Ticket Moderateur" name="ticketModerateur">
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