<div class="calendarDatas">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
    <!-- Wrapper for slides -->
    <div class="carousel-inner carouselWithMeses" role="listbox">
      <div class="item @if($DayMesActual == '01') active @endif nameMonth">
         <h3>Enero</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>

          {{-- Creamos for que permitan descomponer le total de dias del mes y asi mmismo verifica si ese dia existe algun evento --}}
           @for($c = 1; $c <= $DayMothsYear[0];  $c++)
            @if(count($eventsEnero) > 0)
              @if($c == 1 or $c == 8 or $c == 15 or $c == 22 or $c == 29)
              <p class="gasper">{{ $enerodayDomin = 0}}</p>
               @foreach($eventsEnero as $KeyEvent => $enero)
                 @if($enero['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $enero['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach   
               @if($enerodayDomin != $c)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @endif          
              @else
                <p class="gasper">{{ $eneroday = 0}}</p>
                @foreach($eventsEnero as $KeyEvent => $enero)
                  @if($enero['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $enero['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach       
                @if($eneroday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif           
              @endif
            @else
              @if($c == 1 or $c == 8 or $c == 15 or $c == 22 or $c == 29)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>
      {{-- MES FEBREO --}}
      <div class="item @if($DayMesActual == '02') active @endif nameMonth">
         <h3>Febrero</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>

           @for($c = 1; $c <= $DayMothsYear[1];  $c++)
            @if(count($eventsFebrero) > 0)
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26)
               <p class="gasper">{{ $febrerodayDomin = 0}}</p>
               @foreach($eventsFebrero as $KeyEvent => $febrero)
                 @if($febrero['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $febrero['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach
               @if($febrerodayDomin != $c)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @endif              
              @else
                <p class="gasper">{{ $febreroday = 0}}</p>
                @foreach($eventsFebrero as $KeyEvent => $febrero)
                  @if($febrero['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $febrero['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach
                @if($febreroday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif                   
              @endif
            @else
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}

           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES MARZO --}}
      <div class="item @if($DayMesActual == '03') active @endif nameMonth">
         <h3>Marzo</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>

           @for($c = 1; $c <= $DayMothsYear[2];  $c++)
            @if(count($eventsMarzo) > 0)
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26)
               <p class="gasper">{{ $marzodayDomin = 0}}</p>
               @foreach($eventsMarzo as $KeyEvent => $marzo)
                 @if($marzo['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $marzo['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach 
               @if($marzodayDomin != $c)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @endif                           
              @else
                <p class="gasper">{{ $marzoday = 0}}</p>
                @foreach($eventsMarzo as $KeyEvent => $marzo)
                  @if($marzo['dia'] == $c)
                   <p class="gasper">{{ $marzoday = $c }}</p>
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $marzo['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach 
                @if($marzoday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif                
              @endif
            @else
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES ABRIL --}}
      <div class="item @if($DayMesActual == '04') active @endif nameMonth">
         <h3>Abril</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           <div class="dataDays">                         
           </div>
           @for($c = 1; $c <= $DayMothsYear[3];  $c++)
            @if(count($eventsAbril) > 0)
              @if($c == 2 or $c == 9 or $c == 16 or $c == 23 or $c == 30)
               <p class="gasper">{{ $abrildayDomin = 0}}</p>
               @foreach($eventsAbril as $KeyEvent => $abril)
                 @if($abril['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $abril['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach  
               @if($abrildayDomin != $c)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @endif           
              @else
                <p class="gasper">{{ $abrilday = 0}}</p>
                @foreach($eventsAbril as $KeyEvent => $abril)
                  @if($abril['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $abril['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach    
                @if($abrilday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif               
              @endif
            @else
              @if($c == 2 or $c == 9 or $c == 16 or $c == 23 or $c == 30)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div> 
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES MAYO --}}
      <div class="item @if($DayMesActual == '05') active @endif nameMonth">
         <h3>Mayo</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[4];  $c++)
            @if(count($eventsMayo) > 0)
              @if($c == 7 or $c == 14 or $c == 21 or $c == 28)
               <p class="gasper">{{ $mayodayDomin = 0}}</p>
               @foreach($eventsMayo as $KeyEvent => $mayo)
                 @if($mayo['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $mayo['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach             
               @if($mayodayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif
              @else
                <p class="gasper">{{ $mayoday = 0}}</p>
                @foreach($eventsMayo as $KeyEvent => $mayo)
                  @if($mayo['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $mayo['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach      
                @if($mayoday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif            
              @endif
            @else
              @if($c == 7 or $c == 14 or $c == 21 or $c == 28)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES JUNIO --}}
      <div class="item @if($DayMesActual == '06') active @endif nameMonth">
         <h3>Junio</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[5];  $c++)
            @if(count($eventsJunio) > 0)
              @if($c == 4 or $c == 11 or $c == 18 or $c == 25)
               <p class="gasper">{{ $juniodayDomin = 0}}</p>
               @foreach($eventsJunio as $KeyEvent => $junio)
                 @if($junio['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $junio['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach          
               @if($juniodayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif   
              @else
                <p class="gasper">{{ $junioday = 0}}</p>
                @foreach($eventsJunio as $KeyEvent => $junio)
                  @if($junio['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $junio['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach
                @if($junioday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif                   
              @endif
            @else
              @if($c == 4 or $c == 11 or $c == 18 or $c == 25)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES JULIO --}}
      <div class="item @if($DayMesActual == '07') active @endif nameMonth">
         <h3>Julio</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[6];  $c++)
            @if(count($eventsJulio) > 0)
              @if($c == 2 or $c == 9 or $c == 16 or $c == 23 or $c == 30)
               <p class="gasper">{{ $juliodayDomin = 0}}</p>
               @foreach($eventsJulio as $KeyEvent => $julio)
                 @if($julio['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $julio['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @else
                   <div class="dataDays dayDomingo">{{ $c }}</div>
                 @endif
               @endforeach   
               @if($juliodayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif          
              @else
                <p class="gasper">{{ $julioday = 0}}</p>
                @foreach($eventsJulio as $KeyEvent => $julio)
                  @if($julio['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $julio['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach   
                @if($julioday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif               
              @endif
            @else
              @if($c == 2 or $c == 9 or $c == 16 or $c == 23 or $c == 30)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES AGOSTO --}}
      <div class="item @if($DayMesActual == '08') active @endif nameMonth">
         <h3>Agosto</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[7];  $c++)
            @if(count($eventsAgosto) > 0)
              @if($c == 6 or $c == 13 or $c == 20 or $c == 27)
               <p class="gasper">{{ $agostodayDomin = 0}}</p>
               @foreach($eventsAgosto as $KeyEvent => $agosto)
                 @if($agosto['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $agosto['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach   
               @if($agostodayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif          
              @else
                <p class="gasper">{{ $agostoday = 0}}</p>
                @foreach($eventsAgosto as $KeyEvent => $agosto)
                  @if($agosto['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $agosto['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach  
                @if($agostoday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif                 
              @endif
            @else
              @if($c == 6 or $c == 13 or $c == 20 or $c == 27)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays">
           </div>
           <div class="dataDays">
           </div>
         </div>
      </div>

      {{-- MES SEPTIEMBRE --}}
      <div class="item @if($DayMesActual == '09') active @endif nameMonth">
         <h3>Septiembre</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[8];  $c++)
            @if(count($eventsSeptiembre) > 0)
              @if($c == 3 or $c == 10 or $c == 17 or $c == 24)
               <p class="gasper">{{ $septiembredayDomin = 0}}</p>
               @foreach($eventsSeptiembre as $KeyEvent => $septiembre)
                 @if($septiembre['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $septiembre['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach     
               @if($septiembredayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif        
              @else
                <p class="gasper">{{ $septiembreday = 0}}</p>
                @foreach($eventsSeptiembre as $KeyEvent => $septiembre)
                  @if($septiembre['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $septiembre['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach   
                @if($septiembreday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif               
              @endif
            @else
              @if($c == 3 or $c == 10 or $c == 17 or $c == 24)
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
         </div>
      </div>

      {{-- MES OCTUBRE --}}
      <div class="item @if($DayMesActual == '10') active @endif nameMonth">
         <h3>Octubre</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[9];  $c++)
            @if(count($eventsOctubre) > 0)
              @if($c == 1 or $c == 8 or $c == 15 or $c == 22 or $c == 29 )
               <p class="gasper">{{ $octubredayDomin = 0}}</p>
               @foreach($eventsOctubre as $KeyEvent => $octubre)
                 @if($octubre['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $octubre['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach   
               @if($octubredayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif           
              @else
                <p class="gasper">{{ $octubreday = 0}}</p>
                @foreach($eventsOctubre as $KeyEvent => $octubre)
                  @if($octubre['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $octubre['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach         
                @if($octubreday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif         
              @endif
            @else
              @if($c == 1 or $c == 8 or $c == 15 or $c == 22 or $c == 29 )
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
         </div>
      </div>

      {{-- MES NOVIEMBRE --}}
      <div class="item @if($DayMesActual == '11') active @endif nameMonth">
         <h3>Noviembre</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[10];  $c++)
            @if(count($eventsNoviembre) > 0)
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26 )
               <p class="gasper">{{ $noviembredayDomin = 0}}</p>
               @foreach($eventsNoviembre as $KeyEvent => $noviembre)
                 @if($noviembre['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $noviembre['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach       
               @if($noviembredayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif      
              @else
                <p class="gasper">{{ $noviembreday = 0}}</p>
                @foreach($eventsNoviembre as $KeyEvent => $noviembre)
                  @if($noviembre['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $noviembre['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach   
                @if($noviembreday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif               
              @endif
            @else
              @if($c == 5 or $c == 12 or $c == 19 or $c == 26 )
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays"></div>
           <div class="dataDays"></div>
         </div>
      </div>

      {{-- MES DICIEMBRE --}}
      <div class="item @if($DayMesActual == '12') active @endif nameMonth">
         <h3>Diciembre</h3>
         <div class="daysCalendar">
           <div class="dataDays">d</div>
           <div class="dataDays">l</div>
           <div class="dataDays">m</div>
           <div class="dataDays">m</div>
           <div class="dataDays">j</div>
           <div class="dataDays">v</div>
           <div class="dataDays">s</div>
         </div>
         <div class="daysNumberCalendar">
           <div class="dataDays dayDomingo">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           <div class="dataDays">    
           </div>
           @for($c = 1; $c <= $DayMothsYear[11];  $c++)
            @if(count($eventsDiciembre) > 0)
              @if($c == 3 or $c == 10 or $c == 17 or $c == 24 or $c == 31 )
               <p class="gasper">{{ $diciembredayDomin = 0}}</p>
               @foreach($eventsDiciembre as $KeyEvent => $diciembre)
                 @if($diciembre['dia'] == $c)
                   <div class="dataDays dayEvento">                        
                     <div class="ui button">$c</div>
                       <div class="ui special popup">
                       <div class="header">{{ $diciembre['descripcion_evento'] }}</div>
                     </div>
                   </div>
                 @endif
               @endforeach           
               @if($diciembredayDomin != $c)
                 <div class="dataDays">{{ $c }}</div>
               @endif  
              @else
                <p class="gasper">{{ $diciembreday = 0}}</p>
                @foreach($eventsDiciembre as $KeyEvent => $diciembre)
                  @if($diciembre['dia'] == $c)
                    <div class="dataDays dayEvento">                        
                      <div class="ui button">{{ $c }}</div>
                        <div class="ui special popup">
                        <div class="header">{{ $diciembre['descripcion_evento'] }}</div>
                      </div>
                    </div>
                  @endif
                @endforeach      
                @if($diciembreday != $c)
                  <div class="dataDays">{{ $c }}</div>
                @endif            
              @endif
            @else
              @if($c == 3 or $c == 10 or $c == 17 or $c == 24 or $c == 31 )
                 <div class="dataDays dayDomingo">{{ $c }}</div>
               @else
                 <div class="dataDays">{{ $c }}</div>
              @endif
            @endif             
           @endfor  
           {{-- end for --}}
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
           <div class="dataDays"></div>
         </div>
      </div>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>