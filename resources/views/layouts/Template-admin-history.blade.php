<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {!! Html::style('public/css/app.css') !!}
    <!-- Bootstrap CSS-->
    {!! Html::style('public/assets/css/bootstrap.css') !!}
    {{-- Style Menu Desplace --}}
    {!! Html::style('public/assets/css/menu/component.css') !!}
    <!-- Semantic Ui CSS -->
    {!! Html::style('public/assets/css/semantic.css') !!}
    <!-- STYLE FONT AWESOME -->
    {!! Html::style('public/assets/css/font-awesome.css') !!}

    <!-- Datepicker Files -->
    {!! Html::style('public/assets/css/datePicker/bootstrap-datepicker3.css') !!}
    {!! Html::style('public/assets/css/bootstrap-datetimepicker.min.css') !!}

    {{-- Main style --}}
    {!! Html::style('public/assets/css/admin/main.css') !!}

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="bgUser">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbarHome bgAdmins">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    {{-- <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a> --}}
                </div>

                <div class="collapse navbar-collapse collapseMenuUser menuAdmin" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <div id="sidebar">
                      <ul class="BgHistiry">
                          <li id='titleAdmin'><a href="#">Administrador</a></li>
                          <li>
                            <a href="#" class="dashico"> Dashboards</a>
                          </li>
                          <li>
                            <a href="#" class="mensageIco">  Mensajes</a>
                          </li>
                          <li>
                            <a href="#" class="usgerenIco"> Sugerencias</a>
                          </li>
                          <li>
                            <a href="#" class="emergenciasIco"> Emergencias</a>
                          </li>
                          <li>
                            <a href="#" class="permisoIco">  Permisos</a>
                          </li>
                          <li>
                            <a href="#" class="calendarIco"> Calendario</a>
                          </li>
                          <li>
                            <a href="#" class="documentIco">  Documentos</a>
                          </li>

                          {{-- 2 BLOQUE SUBmENU --}}
                          <li class="lineDivide">
                            <a href="#"></a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="#" class="EditUseIco"> Editar Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="#" class="AddUseIco"> Agregar Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="#" class="UseIco"> Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="#" class="rannkingIco"> Ranking</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="#" class="evalucionIco"> Evaluaciones</a>
                          </li>
                      </ul>
                    </div>
                    <div class="main-content BgHistiry">
                      <a href="#" class="togleAdmin" data-toggle=".container" id="sidebar-toggle">
                          <span class="bar"></span>
                          <span class="bar"></span>
                          <span class="bar"></span>
                      </a>
                    </div>

                    <!-- Right Side Of Navbar -->
                    {{-- <ul class="nav navbar-nav navbar-right navulRIght">
                      <!-- Authentication Links -->
                      @if (Auth::guest())
                          <li><a href="{{ url('/login') }}">Login</a></li>
                          <li><a href="{{ url('/register') }}">Register</a></li>
                      @else
                          <li class="dropdown uSerLogue colorBlackSuave fontMiriamProRegular">
                              <a href="#" class="dropdown-toggle colorBlackSuave" data-toggle="dropdown" role="button" aria-expanded="false">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ url('/logout') }}"
                                          onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                          Logout
                                      </a>

                                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                      </form>
                                  </li>
                              </ul>
                          </li>
                      @endif
                    </ul> --}}
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {!! Html::script('public/js/app.js') !!}
    
    <script type="text/javascript">
          $('.carousel').each(function(){
              $(this).carousel({
                  interval: false
              });
          });
    </script>
    {!! Html::script('public/assets/js/menu/classie.js') !!}
    {!! Html::script('public/assets/js/menu/gnmenu.js') !!}

    <script>
        new gnMenu( document.getElementById( 'gn-menu' ) );
    </script>

    <script>
      $(window).bind("beforeunload", function() { 
          // return confirm("deseas cerrar la ventana?"); 
      });
    </script>

    <!-- Semantic Ui CSS -->
    {!! Html::script('public/assets/js/semantic.js') !!}

    <script>
        $('.dropdownSemantic')
          .dropdown({
            transition: 'drop'
          });

        $('.max.example .ui.fluid.dropdown')
          .dropdown({
            maxSelections: 15
          })
        ;
        $('.dataClicDEsplace .accordion')
          .accordion({
            selector: {
              trigger: '.title .fa-angle-down'
            }
          })
        ;
        $('.rating')
          .rating({
            maxRating: 5,
            disable: false,
          });
        $('.rating')
         .rating('disable')
        ;

   </script>

   {!! Html::script('public/assets/js/jquery-1.11.1.min.js') !!}

   
   {!! Html::script('public/assets/js/moment.js') !!}
   {!! Html::script('public/assets/js/bootstrap-datetimepicker.min.js') !!}
   <script type="text/javascript">
       $(function () {
           $('#datetimepicker12').datetimepicker({
               inline: true,
               sideBySide: true
           });
       });
   </script>

   {!! Html::script('public/assets/js/datePicker/bootstrap-datepicker.js') !!}
   <script type="text/javascript">
      $('#sandbox-container .input-daterange').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
      });
   </script>

   <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script type="text/javascript">
   //<![CDATA[ 
     $(window).load(function(){
       $(".togleAdmin").click(function() {
         $('#sidebar3').toggleClass('sidebar3Hiden');
         var toggle_el = $(this).data("toggle");
         $(toggle_el).toggleClass("open-sidebar");
         // $('.container.continerWithSite').toggleClass("widthFull");  
       });
     });//]]>  
   
   </script>
   {!! Html::script('public/assets/js/admin/main.js') !!}
</body>
</html>
