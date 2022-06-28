@extends('layouts.layout_praticienetablissement')

@section('page-content')

	<!--User Dashboard-->

	<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
                
            <div class="card-body">
                <h5 class="card-title">Prise en charge</h5>

                <!-- Multi Columns Form -->
                <form class="row g-3">
                    <div class="col-md-12">
                        <label for="nomPatie" class="form-label">Ticket modérateur</label><br>
                        <div class="input-group mb-3">
                            <select id="ticket_moderateur_id" class="form-select">
                                    <option selected="" value="0">-- Ticket modérateur --</option>
                                    @foreach($ticketmoderateurs as $ticketmoderateur)
                                        <option value="{{$ticketmoderateur->id}}">
                                            {{ $ticketmoderateur->libelle }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label for="posologie" class="form-label">Soins liés à la grossesse</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="soins_grossesse">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="soins_grossesse" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Non
                                </label>
                            </div>
                        </div>
                        <label for="nomPatie" class="form-label">Si Oui, date de l'accident</label><br>
                        <input type="date" class="form-control" id="date_accident" value="0">
                        <div class="input-group mb-3">
                            <label for="posologie" class="form-label">Accident causé par un tiers</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="accident_tiers">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="accident_tiers" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Non
                                </label>
                            </div>
                        </div>
                        <label for="nomPatie" class="form-label">Date début de grossesse</label><br>
                            <input type="date" class="form-control" id="date_grossesse" value="0">
                            <label for="nomPatie" class="form-label">Date présumée accouchement</label><br>
                            <input type="date" class="form-control" id="date_accouchement" value="0">
                    </div>
                </form><!-- End Multi Columns Form -->


                <div class="row mb-3 d-none" id="fei">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Numero de Feuille de Soin</label>
                        <input type="text" class="form-control" id="nFeuille" value="0">
                    </div>
                </div>

                <div class="row d-none" id="valid">
                    <div class="col-12">
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" type="button">Ajouter Fiche</button>
                        </div>
                    </div>
                </div>

            </div>
		</div>
    </div>
</div>

	<!--/User Dashboard-->


@endsection
