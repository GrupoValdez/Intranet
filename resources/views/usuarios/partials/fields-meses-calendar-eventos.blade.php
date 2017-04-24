<div id="carousel-example-generic2" class="carousel slide slide1Even" data-ride="carousel" data-interval="false">
  <!-- Indicators -->
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  {{-- EVENTOS ENERO --}}
    <div class="item @if($DayMesActual == '01') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1 >Enero</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '01')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>

    </div>

    {{-- EVENTOS FEBRERO --}}
    <div class="item @if($DayMesActual == '02') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1 >Febrero</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '02')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS MARZO --}}
    <div class="item @if($DayMesActual == '03') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Marzo</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '03')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS ABRIL --}}
    <div class="item @if($DayMesActual == '04') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Abril</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '04')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS MAYO --}}
    <div class="item @if($DayMesActual == '05') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Mayo</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '05')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS JUNIO --}}
    <div class="item @if($DayMesActual == '06') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Junio</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '06')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS JULIO --}}
    <div class="item @if($DayMesActual == '07') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Julio</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '07')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS AGOSTO --}}
    <div class="item @if($DayMesActual == '08') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Agosto</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '08')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS SEPTIEMBRE --}}
    <div class="item @if($DayMesActual == '09') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Septiembre</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '09')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS OCTUBRE --}}
    <div class="item @if($DayMesActual == '10') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Octubre</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '10')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS NOVIEMBRE --}}
    <div class="item @if($DayMesActual == '11') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Noviembre</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '11')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

    {{-- EVENTOS DICIEMBRE --}}
    <div class="item @if($DayMesActual == '12') active @endif">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 v">
         <h1>Diciembre</h1>                 
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vTypeEvento">
            <h2>Calendario de actividades</h2>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublic">
            <h2>Publicado por:</h2>
         </div>
      </div>

      <div class="captioncalendarMoth">
        @foreach($EventsDayCalendarOrder as $events)
          @foreach($DatosPersonales as $dataPersonal)
            @if($events->id_usuario == $dataPersonal->id_usuario)
              <p class="gasper">{{ $dateEcvent = new \Carbon\Carbon($events->fecha_evento) }}</p>
              <p class="gasper">{{ $dayEventos = $dateEcvent->format('d') }}</p>
              <p class="gasper">{{ $MesEventos = $dateEcvent->format('m') }}</p>
              @if($MesEventos == '12')                        
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sectionCalendarType">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vDataPublicType">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fechasEventos">
                      <span>{{ $dayEventos }}</span>
                      <p class="DayPubliEvent"> {{ $events->descripcion_evento }} </p>
                     </div>             
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ChatWithUserDatas vDataPublicTypeUSer">
                     {{-- <img class="img-responsive" src="http://app-fd8d1fda-4b1b-423f-aa23-358cd43f64b3.leverapps.io/public/assets/images/profile-user-circle.png" alt=""> --}}
                     <div class="dataImhgEvent" style="background-image: url('http://app-7983e06f-f506-428d-aef9-aea82667c6d7.cleverapps.io/public/assets/profiles/{{ $dataPersonal->foto }}')">
                     </div>
                     <p class="colorBlack fontMiriamProSemiBold">{{ $dataPersonal->nombre }} {{ $dataPersonal->apellidos }}</p>
                  </div>
                </div>
              @endif                      
            @endif
           @endforeach
        @endforeach
      </div>
    </div>

  </div>

  <!-- Controls -->
  <a class="left carousel-control leftcalendarEventsDescrip" href=".slide1Even" role="button" data-slide="prev">
    
  </a>
  <a class="right carousel-control RightcalendarEventsDescrip" href=".slide1Even" role="button" data-slide="next">
    
  </a>
</div>