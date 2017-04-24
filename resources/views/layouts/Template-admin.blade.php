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
    {{-- ColorPicker --}}
    {!! Html::style('public/assets/css/admin/colorpicker/spectrum.css') !!}

    {{-- Main style --}}
    {!! Html::style('public/assets/css/admin/main.css') !!}
    {!! Html::style('public/assets/css/admin/main_responsive.css') !!}

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
                      <ul>
                          <li id='titleAdmin'><a href="#">Administrador</a></li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/home" class="dashico"> Dashboards</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/chat" class="mensageIco">  Mensajes</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/sugerencias" class="usgerenIco"> Sugerencias</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/emergencias" class="emergenciasIco"> Emergencias</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/solicitud-permisos" class="permisoIco">  Permisos</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/calendario" class="calendarIco"> Calendario</a>
                          </li>
                          <li>
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos" class="documentIco">  Documentos</a>
                          </li>

                          {{-- 2 BLOQUE SUBmENU --}}
                          <li class="lineDivide">
                            <a href="#!"></a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/usuarios" class="EditUseIco"> Editar Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/addUsers" class="AddUseIco"> Agregar Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/usuarios" class="UseIco"> Usuarios</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/ranking" class="rannkingIco"> Ranking</a>
                          </li>
                          <li class="2TwoBlow">
                            <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/evaluaciones-mensuales" class="evalucionIco"> Evaluaciones</a>
                          </li>
                      </ul>
                    </div>
                    <div class="main-content">
                      <a href="#" class="togleAdmin" data-toggle=".container" id="sidebar-toggle">
                          <span class="bar"></span>
                          <span class="bar"></span>
                          <span class="bar"></span>
                      </a>
                      <div id="sidebar3">
                        <ul>
                            <li class="topHome">
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/home">
                               <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/home.png" class="img- responsive" alt="">                  
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/chat">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/message.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/sugerencias">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/sguerencias.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/emergencias">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/emergencias.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/solicitud-permisos">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/permisos.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/calendario">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/calendar.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/documentos">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/documentos.png" class="img- responsive" alt="">      
                              </a>
                            </li>


                            {{-- 2 SECTION --}}
                            <li class="top2Bloque">
                              <a href="#!">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/edit-user.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/usuarios">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/add-user.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/addUsers">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/users.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/usuarios">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/ranking.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            <li>
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/ranking">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/evaluation.png" class="img- responsive" alt="">      
                              </a>
                            </li>

                            <li class="topChangeColor">
                              <a href="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/admin/evaluaciones-mensuales">
                                <img src="http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/images/icons/changeCOlor.png" class="img- responsive" alt="">      
                              </a>
                            </li>
                            
                        </ul>
                      </div>
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

    <span class="lnvmodal lnvmodal-loader" style="opacity: 0.9;">
      <p>
      <span>Cargando...</span>
      </p>
      <aside role="dialog">
       <div>Loading....</div>
      </aside>
    </span>

    <!-- Scripts -->
    {!! Html::script('public/js/app.js') !!}
    <script type="text/javascript">
      $('#myModalSolicitudRespuestCorrect').modal('show');
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

    </script>

    <script>
      $('.button')
        .popup({
          inline: true
        });
        $('.dropdownSemantic')
        .dropdown({
          transition: 'drop'
        });
        $('.accordion')
          .accordion({
            selector: {
              trigger: '.title div .fa-angle-down'
            }
          })
        ;

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

        $('.bloqueActionAddNodui .accordion')
          .accordion({
            selector: {
              trigger: '.title'
            }
          })
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

    {!! Html::script('public/assets/js/admin/colorpicker/spectrum.js') !!}
   <script>
     function printColor(color) {
        var text = "You chose... " + color.toHexString();    
        $(".label").text(text);
         
     }

     $("#showPaletteOnly").spectrum({
         allowEmpty:true,
         showInitial: true,
         showInput: true,   
         showPaletteOnly: true,
         change: function(color) {
             printColor(color);
         },
         palette: [
             ["00a89c", "22b473", "d3145a","ea5b3a"],
             ["ffd249", "e0629a", "89d085", "4caad8"], 
             ["662d90", "d3145a", "faaf3b", "f05a24"], 
             ["d8df21", "39b44a", "c59b6d", "2e3191"], 
             ["0071bb", "ec1e79", "c0272d", "f46851"]
         ]
     });
   </script>

   
   {!! Html::script('public/assets/js/admin/main.js') !!}
</body>
</html>
