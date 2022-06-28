@extends('layouts.layout_praticienetablissement')

@section('page-content')

	<!--User Dashboard-->

	<div class="container-fluid">
    <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h5 class="text-primary font-w600">Bienvenue sur DATRAC 2.0 !</h5>
            <p class="mb-0">PRATICIEN : <b>{{ $praticienetablissement->nom_etablissement }}</b></p>
        </div>

        <div class="input-group search-area ml-auto d-inline-flex">
            <!--input type="text" class="form-control" placeholder="Search here">
            <div class="input-group-append">
                <a href="javascript:void(0)" class="input-group-text"><i class="flaticon-381-search-2"></i></a>
            </div-->
        </div>
        <a class="btn btn-primary ml-3 btn-sm">
            <?php
                \Carbon\Carbon::setLocale('fr');
                echo \Carbon\Carbon::now()->translatedFormat('l jS F Y');
            ?>
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
			<div class="row">
                <div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-dark-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Examens</p>
                                        <h3 class="">{{ $count_prestationexamens }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-dark-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Hospitalisation</p>
                                        <h3 class="">{{ $count_prestationhospitalisations }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-dark-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Prescription médicales</p>
                                        <h3 class="">{{ $count_prescriptionmedicales }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-sm-4">
                        <div class="widget-stat card bg-dark-light">
                            <div class="card-body p-4">
                                <div class="media">
                                    <span class="mr-3">
                                        <i class="flaticon-381-heart"></i>
                                    </span>
                                    <div class="media-body text-right">
                                        <p class="mb-1">Prise en charge</p>
                                        <h3 class="">{{ $count_prisecharges }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
    </div>
</div>

	<!--/User Dashboard-->


@endsection
