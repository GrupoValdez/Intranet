@extends('layouts.Template-home')

@section('content')
  <div class="container continerWithSite contCalnedar">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mesCalendars">

        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 DaysCalendars">
          {{-- BLOQUE CALENDAR --}}
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="captionCalendar">
                <div class="dayMonth">
                  <p class="gasper">{{ $dateCarbon = new \Carbon\Carbon() }}</p>
                  <p class="gasper">{{ $DayStringActual = $dateCarbon->now()->format('l') }}</p>
                  <p class="gasper">{{ $DayMesActual = $dateCarbon->now()->format('m') }}</p>
                  <p class="gasper">{{ $DayNumberActual = $dateCarbon->now()->format('j') }}</p>
                  <p class="fontMiriamProSemiBold dyaGeneralClanedar">{{ $DayStringActual }}</p>
                  <h1 class="DayNumberAgenda">{{ $DayNumberActual }}</h1>
               </div>
            </div>

            {{-- SECTION ADD EVENT CALENDAR --}}

            <div class="captionAddEvento addEventeGenral">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profile" class="fontMiriamProRegular" aria-controls="profile" role="tab" data-toggle="tab">Agregar evento a calendario</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content tabconteAddComent">
                <div role="tabpanel" class="tab-pane fade active in" id="profile">
                  <form action="postCreateEvento" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                    <textarea cols="30" rows="10" name="evento_descript" placeholder="Escribe el evento" required></textarea>
                    <div id='sandbox-container'>                    
                      <div class="input-daterange input-group" id="datepicker">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 captioNFehcIni">     
                          <input type="text" class="input-sm form-control" name="fecha_start_evento" required />
                        </div>                 
                      </div>
                      <h4 class="colorGrisMediumSuave fontMiriamProRegular">Seleccionar fecha</h4>
                      <input type="hidden" name="id_user_evento" value="{{ Auth::user()->id }}">
                      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 captioNFehcFina">
                        <input type="submit" class="form-control Submit" value='Aceptar'/>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

          {{-- calendario carousel --}}
          <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 CarouselDataCalendar">
            @include('usuarios.partials.fields-calendar-general')
          </div>
      </div>

      

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 EventsCalendars">
        @include('usuarios.partials.fields-meses-calendar-eventos')
      </div>
    </div>
  </div>

  {{-- Mensajes entrada salida --}}
  @include('usuarios.partials.fields-entrada-salida-mensajes')
@endsection
