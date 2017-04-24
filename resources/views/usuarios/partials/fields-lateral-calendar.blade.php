<div class="captionCalendar">
  <div class="dayMonth" @if($Bguser != '') style="background: {{ $Bguser }} !important; @endif">
    <p class="fontMiriamProSemiBold">Agenda</p>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 fechaData">
      <p class="gasper">{{ $dateCarbon = new \Carbon\Carbon() }}</p>
      <p class="gasper">{{ $DayStringActual = $dateCarbon->now()->format('l') }}</p>
      <p class="gasper">{{ $DayMesActual = $dateCarbon->now()->format('m') }}</p>
      <p class="gasper">{{ $DayNumberActual = $dateCarbon->now()->format('j') }}</p>
      <p class="DayAgenda">{{ $DayStringActual }}</p>
      <p class="DayNumberAgenda">{{ $DayNumberActual }}</p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 fechaData fechType">
      <p class="gasper">{{ $carbon = new \Carbon\Carbon() }}</p>
      <p class="gasper">{{ $fechaActual = $carbon->now()->format('Y-m-d') }}</p>
      <p class="gasper">{{ $validaEvent = '' }}</p>
      @foreach($EventsDayCalendar as $Events)
        @if($fechaActual == $Events->fecha_evento)
          <p class="gasper">{{ $validaEvent = 1 }}</p>
          <p class="typEEvento">Hoy {{ $Events->descripcion_evento }}</p>
        @endif
      @endforeach
      @if($validaEvent == '')
        <p class="typEEvento">Este día </br> no hay eventos</p>
      @endif
      
    </div>
  </div>
  @include('usuarios.partials.fields-calendar')
</div>

<div class="captionAddEvento">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" @if($Bguser != '') style="background: {{ $Bguser }} !important; @endif"><a href="#profile" class="fontMiriamProRegular" aria-controls="profile" role="tab" data-toggle="tab" @if($Bguser != '') style="background: {{ $Bguser }} !important; @endif">Agregar evento a calendario</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content tabconteAddComent">
    <div role="tabpanel" class="tab-pane fade" id="profile">
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