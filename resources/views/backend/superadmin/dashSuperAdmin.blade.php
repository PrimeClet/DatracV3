@extends('layouts.layout_superadmin')

@section('page-content')

	<!--User Dashboard-->
	<!--/User Dashboard-->

	<!-- row -->
<div class="container-fluid">
    <div class="form-head d-flex mb-3 mb-md-5 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h3 class="text-primary font-w600">Bienvenue sur DATRAC 2.0 !</h3>
            <p class="mb-0">Tableau de bord SUPER ADMIN</p>
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
					<div class="widget-stat card bg-danger">
						<div class="card-body  p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-calendar-1"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Administrateurs</p>
									<h3 class="text-white">{{ $count_users }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-danger">
						<div class="card-body  p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-calendar-1"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Etablissements</p>
									<h3 class="text-white">{{ $count_etablissements }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-danger">
						<div class="card-body  p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-calendar-1"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Assurance</p>
									<h3 class="text-white">{{ $count_assurances }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-success">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-diamond"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Actes</p>
									<h3 class="text-white">{{ $count_actes }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-info">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-heart"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Examens</p>
									<h3 class="text-white">{{ $count_examens }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-primary">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-user-7"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Villes</p>
									<h3 class="text-white">{{ $count_villes }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-primary">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-user-7"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Specialites</p>
									<h3 class="text-white">{{ $count_specialites }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-warning">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-user-7"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Appareillages</p>
									<h3 class="text-white">{{ $count_appareillages }}</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-6">
					<div class="widget-stat card bg-danger">
						<div class="card-body p-4">
							<div class="media">
								<span class="mr-3">
									<i class="flaticon-381-user-7"></i>
								</span>
								<div class="media-body text-white text-right">
									<p class="mb-1">Affections</p>
									<h3 class="text-white">{{ $count_affections }}</h3>
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