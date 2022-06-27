
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>DATRAC 2.0</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ URL::to('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ URL::to('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="{{ URL::to('https://fonts.gstatic.com') }}" rel="preconnect">
  <link href="{{ URL::to('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') }}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ URL::to('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ URL::to('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.1.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('dashPraticien') }}" class="logo d-flex align-items-center">
        <img src="{{ URL::to('assets/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">DATRAC</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            @if(!empty(Auth::user()->photo_url) || Auth::user()->photo_url != NULL)
            <img src="{{ Auth::user()->photo_url }}" alt="Profile" class="rounded-circle">
            @else
            <img src="{{ URL::to('assets/photos/avatar.png') }}" alt="Profile" class="rounded-circle">
            @endif

            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->role }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mon Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Notifications</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center"href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

    <!-- Modal -->
    <div class="modal fade" id="basicModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DATRAC</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Souhaitez-vous fermer votre session ?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">
                        Non
                    </button>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Oui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('dashPraticienEtablissement') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Prestations</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('dashPraticienEtablissementPrestationSoins') }}">
                <i class="bi bi-tag-fill"></i><span> Prestations de soins</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashPraticienEtablissementPriseCharges') }}">
                <i class="bi bi-tags"></i><span> Conditions Prise en Charge </span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashPraticienEtablissementPrescriptionMedicales') }}">
                <i class="bi bi-shift"></i><span> Prescriptions médicales </span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashPraticienEtablissementPrestationExamens') }}">
                <i class="bi bi-circle"></i><span> Prescriptions examens </span>
                </a>
            </li>

            <li>
                <a href="{{ route('dashPraticienEtablissementPrestationHospitalisations') }}">
                <i class="bi bi-signpost"></i><span> Prestations hospitalisations </span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="">
                <i class="bi bi-calendar"></i>
                <span>Emploi du Temps</span>
                </a>
            </li><!-- End Profile Page Nav -->

      </li><!-- End Register Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="">Accueil</a></li>
          <li class="breadcrumb-item active">{{ $page_title }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        @yield('page-content')
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>DATRAC</span></strong>. Tous droits réservés
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://tinsid.com/">TINSID</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ URL::to('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ URL::to('assets/vendor/echarts/echarts.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ URL::to('assets/js/main.js') }}"></script>

</body>

</html>