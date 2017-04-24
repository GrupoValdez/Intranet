<div class="col-xs-12 col-sm-12 col-md-12 BuzonSgenerencias DayDisponibles">
  <p>Usted tiene</p>
  <div class="col-xs-12 col-sm-12 col-md-12 sectionSelectDay">
  @if($Bguser == '#d9e021') 
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasGreenSuave dt">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasGreenSuave dt">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
  @elseif($Bguser == '#b2b2b2')
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasGris dt">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasGris dt">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
  @elseif($Bguser == '#ffcd00')
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasYellow dt">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasYellow dt">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
  @elseif($Bguser == '#ff8a00')
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasOrange dt">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasOrange">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
  @elseif($Bguser == '#e54e53')
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasRojoSuave">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasRojoSuave">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
  @elseif($Bguser == '#1abc9c')
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasVerdeAcua">
      <p>{{ $PrimerNumerDay }}</p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasVerdeAcua">
      <p>{{ $SegundoNumerDay }}</p>
    </div>
    @elseif($Bguser == '#1abac8')
      <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasCeleste">
        <p>{{ $PrimerNumerDay }}</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasCeleste">
        <p>{{ $SegundoNumerDay }}</p>
      </div>
    @elseif($Bguser == '#1a1a1a')
      <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasBlack">
        <p>{{ $PrimerNumerDay }}</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 bgWrapDas bgWrapDasBlack">
        <p>{{ $SegundoNumerDay }}</p>
      </div>
  @endif
    
  </div>
  <p>de vacaciones pendientes</p>
</div>