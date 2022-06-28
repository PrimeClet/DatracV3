
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
      <a href="{{ route('dashCaisseEtablissement') }}" class="logo d-flex align-items-center">
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
        <a class="nav-link " href="{{ route('dashCaisseEtablissement') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard - Caisse</span>
        </a>
      </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-cash-coin"></i>
                <span>Paiements - Journalier</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-calendar-week"></i>
                <span>Rendez-Vous</span>
            </a>
        </li>
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
      Designed by <a href="https://tinsid.com/">LICABO</a>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <!-- Template Main JS File -->
  <script src="{{ URL::to('assets/js/main.js') }}"></script>
  <script language="JavaScript">
      function choix(choix){
          document.getElementById('choice').value = choix;
          $('#prestationI').removeClass('d-none');
      };

      $(document).ready(function () {

          $('#paid_box').change(function(){
              let selected_value = $("input[name='paid']:checked").val()
              if (selected_value == 2)
                  $('#carteCred').removeClass('d-none');
              if (selected_value == 1)
                  $('#carteCred').addClass('d-none');
              if (selected_value == 3)
                  $('#carteCred').addClass('d-none');

          });


          $(document).on('click', '#searchAss', function (e) {
              e.preventDefault();

              // alert('ok')
              // var branchid = $(this).data('branch');
              let data =  $('#searchValue').val();

              if(!data)
                  alert("Empty Value");
              else {
                  $.ajax({
                      'url': '/assures/search?name='+data,
                      'type': 'GET',
                      'data': {},
                      'dataType': 'json',

                      success: function(response){ // What to do if we
                          let htmlView = '';
                          if(response.assures.length <= 0){
                              htmlView += `<tr><td colspan="6" class="text-center text-18">No data.</td></tr>`
                          } else {

                          }
                          for(let i = 0; i < response.assures.length; i++){
                              htmlView += `<tr><td>`+ response.assures[i].id + `</td><td>`
                                  +response.assures[i].name+`</td><td>`
                                  +response.assures[i].email+`</td><td>`
                                  +response.assures[i].telephone+`</td><td>`
                                  +response.assures[i].adresse+`</td><td>`
                                  +`<a href="/dashboard/assure/`+response.assures[i].id+`">
                                                    <button type="button" class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i> Voir Profil</button>
                                                </a><button type="button" class="btn btn-sm pl-2 btn-success" data-value="`+response.assures[i].id+`" id="`+response.assures[i].id+`" onclick="choix(`+response.assures[i].id+`);"> Choisir</button>
                                              </td></tr>`;
                          }
                          $('#assureTrouve').html(htmlView);
                          // $('#typePatient').val('0');
                      },
                      error: function(response){
                          alert('Error'+response);
                      }
                  });
              }
          });

          $(document).on('change', '#presId', function (e) {
              e.preventDefault();
              $(this).find(':selected').data('value')

              $('#price').val($(this).find(':selected').data('value'))
          });

          $(document).on('click', '#addPaiement', function (e) {
              e.preventDefault();
              $('#paiements').removeClass('d-none');
              $('#nFeuille').val("CNAMGS"+ $('#choice').val());
              $('#valid').removeClass('d-none');
              $('#fei').removeClass('d-none');
          });

          $(document).on('click', '#valid', function (e) {
              e.preventDefault();

              let data = {
                  "_token": "{{ csrf_token() }}",
                  'n_feuille' : $("#nFeuille").val(),
                  'assure_id' : $("#choice").val(),
                  'assurance_id': $("#inputState").find(':selected').val()
              }
              $.ajax({
                  'url': '/assures/creer-fiche-soin',
                  'type': 'POST',
                  'data': data,
                  'dataType': 'json',

                  success: function(response){ // What to do if we
                      location.reload();
                  },
                  error: function(response){
                      alert('Error'+response);
                  }
          });

      })
      });
  </script>


</body>

</html>
