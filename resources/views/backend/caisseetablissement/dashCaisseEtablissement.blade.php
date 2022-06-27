@extends('layouts.layout_caisse')

@section('page-content')

	<!--User Dashboard-->

	<div class="container-fluid">
    <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h3 class="text-primary font-w600">Bienvenue sur DATRAC 2.0 !</h3>
            <p class="mb-0">CAISSE : <b>{{ $caisseetablissement->nom_etablissement }}</b></p>
        </div>
        
        <div class="input-group search-area ml-auto d-inline-flex">
            <!--input type="text" class="form-control" placeholder="Search here">
            <div class="input-group-append">
                <a href="javascript:void(0)" class="input-group-text"><i class="flaticon-381-search-2"></i></a>
            </div-->
        </div>
        <a class="btn btn-primary ml-3">
            <?php 
                \Carbon\Carbon::setLocale('fr'); 
                echo \Carbon\Carbon::now()->translatedFormat('l jS F Y'); 
            ?>
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
			<div class="row">	
			<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-info">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-heart"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Prestation</p>
									<h3 class="text-white">{{ $count_prestations }}</h3>
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