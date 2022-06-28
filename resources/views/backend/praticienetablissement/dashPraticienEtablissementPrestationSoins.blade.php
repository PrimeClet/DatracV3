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
                        <label for="nomPatie" class="form-label">Affection</label><br>
                        <div class="input-group mb-3">
                            <select id="affection_id" class="form-select">
                                    <option selected="" value="0">-- Code Affection --</option>
                                    @foreach($affections as $affection)
                                        <option value="{{$affection->id}}">
                                            {{ $affection->code }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label for="posologie" class="form-label">Visite à domicile </label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="visite_domicile">
                                <label class="form-check-label" value="oui">
                                    Oui
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="visite_domicile" checked>
                                <label class="form-check-label" value="non">
                                    Non
                                </label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label for="nomPatie" class="form-label">Acte</label><br>
                            <select id="acte_assurance_id" class="form-select">
                                    <option selected="" value="0">-- Code Acte --</option>
                                    @foreach($acteassurances as $acteassurance)
                                        <option value="{{$acteassurance->id}}">
                                            {{ $acteassurance->cotation }}
                                        </option>
                                    @endforeach
                            </select>
                            <div class="d-flex flex-row align-content-end justify-content-end mt-2">
                            <button class="btn btn-sm" id="addPaiement">+ Add acte</button>
                        </div>
                        </div>
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
