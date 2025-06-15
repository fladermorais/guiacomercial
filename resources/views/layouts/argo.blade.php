@php
// $config = DB::table('site_configs')->first();
$route = Request::route()->getName();
$rota = explode('.', $route);

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('Argo2/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('Argo2/assets/img/favicon.png') }}">
    
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    
    
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('Argo2/assets/css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- Styles -->
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>

    {{-- Summernote --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script> --}}
    
    {{-- Full Calendar --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    {{-- CKEDITOR 5 --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5-premium-features/43.0.0/ckeditor5-premium-features.css" />
    
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-100 bg-dark position-absolute w-100"></div>
    
    @include('layouts/Argo2/sidebar')
    
    <main class="main-content position-relative border-radius-lg ">
        @include('layouts/Argo2/header')
        
        <div class="container-fluid py-4">
            <div class="row mt-4">
                @include('flash::message')
                @yield('content')
            </div>
            
        </div>

        @include('layouts/Argo2/footer')

    </main>
    
    <script src="{{ asset('Argo/vendor/js-cookie/js.cookie.js') }}"></script>
    
    <!--   Core JS Files   -->
    <script src="{{ asset('Argo2/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('Argo2/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Argo2/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('Argo2/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('Argo2/assets/js/plugins/chartjs.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('Argo2/assets/js/argon-dashboard.min.js?v=2.1.0') }}"></script>


    
    {{-- JS Personalizados --}}
    {{-- <script src="{{ asset('js/dropdownSidebar.js') }}"></script>
    <script src="{{ asset('js/dropdownPesquisar.js') }}"></script>
    <script src="{{ asset('js/dropdownFormulario.js') }}"></script>
    <script src="{{ asset('js/permissionGroups.js') }}"></script>
    <script src="{{ asset('js/presencas.js') }}"></script> --}}

    <script src="{{ asset('js/dropdown.js') }}" defer></script>

    {{-- Inserindo script para Gráficos  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    
    
    {{-- CKEDITOR 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    
    {{-- Incluindo Ckeditor --}}
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        var form = document.querySelector( '.ckeditor' );
        if(form){
            ClassicEditor.create( document.querySelector( '.ckeditor' ) )
            .catch( error => {
                console.error( error );
            } );
        }
        
        var form2 = document.querySelector( '.ckeditor2' );
        if(form2){
            ClassicEditor.create( document.querySelector( '.ckeditor2' ) )
            .catch( error => {
                console.error( error );
            } );
        }
        
        var form3 = document.querySelector( '.ckeditor3' );
        if(form3){
            ClassicEditor.create( document.querySelector( '.ckeditor3' ) )
            .catch( error => {
                console.error( error );
            } );
        }
    </script>

</body>
</html>