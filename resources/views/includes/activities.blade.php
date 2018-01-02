<div class="container-fluid">
    <h1 class="title activity-title">Actividades Recientes</h1>
        @if(!$activities->isEmpty())
            @foreach($activities as $activity)
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
                    <?php $userIn = false ?>
                    <?php $notFull = true ?>
                    <li class="activity<?php echo ' ' . $activity->estado . ' ' . $activity->tipo ?>">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h2 class="title title-activity activityid{{$activity->id}}">{{ $activity->titulo }}</h2>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="estado">{{$activity->estado}}</span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="row data">
                                    <div class="col-sm-2">
                                        <span class="activity-label">Ubicación:</span>
                                    </div>
                                    <div class="col-sm-10">
                                        <span>{{ $activity->provincia }},</span>
                                        <span>{{ $activity->poblacion }},</span>
                                        <span>{{ $activity->direccion }}</span>
                                    </div>
                                </div>
                                <div class="row data">
                                    <div class="col-sm-6">
                                        <span class="activity-label">Fecha inicio:</span> {{ $datesFormated[0] }}
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="activity-label">Fecha fin:</span> {{ $datesFormated[1] }}
                                    </div>
                                </div>
                                <div class="row data">
                                    <div class="col-sm-6">
                                        <span class="activity-label">Hora incio:</span> {{ $activity->hora_inicio }}
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="activity-label">Hora fin:</span> {{ $activity->hora_fin }}
                                    </div>
                                </div>
                                <div class="row data">
                                    <div class="col-sm-6">
                                        <span class="activity-label">Número de inscritos:</span> {{$activity->num_participantes}}
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="activity-label">Número máximo de participantes:</span> {{$activity->max_participantes}}
                                    </div>
                                </div>
                                <div class="row data">
                                    <div class="col-sm-3">
                                        <span class="activity-label">Descripción:</span>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="description-activity">{{ $activity->descripcion }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                @if ($activity->lat != null)
                                <div class="map" id="map{{ $activity->id }}"></div>
                                <script>
                                    APL.map{{$activity->id}} = function () {
                                        var coordinates = {lat: {{ $activity->lat }}, lng: {{ $activity->lng }}};
                                        var map{{$activity->id}} = new google.maps.Map(document.getElementById('map{{ $activity->id }}'), {
                                            center: coordinates,
                                            zoom: 16
                                        });
                                        var marker = new google.maps.Marker({
                                            position: coordinates,
                                            map: map{{$activity->id}}
                                        });
                                    }
                                </script>
                                @else
                                    <div class="map-no"></div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            @if(Auth::check())
                                <?php /* compruebo todos los usuarios unidos a esta actividad, para permitirles o no unirse */ ?>
                                @foreach($activity->users as $user)
                                    @if ($user->id == Auth::user()->id)
                                        <?php $userIn = true ?>
                                    @endif
                                    @if ($activity->num_participantes >= $activity->max_participantes)
                                        <?php $notFull = false ?>
                                    @endif
                                @endforeach
                                @if($activity->estado === 'activa')
                                    @if($notFull == true)
                                        @if ($activity->id_creator != Auth::user()->id && $userIn == false)
                                            <button class="joinButton btn-form filled btn-activity-join" id="{{ $activity->id }}">Unirse</button>
                                        @endif
                                        @if ($activity->id_creator != Auth::user()->id && $userIn == true)
                                            <button class="leaveButton btn-form filled btn-activity-exit" id="{{ $activity->id }}">Salir</button>
                                        @endif
                                    @else
                                        @if ($activity->id_creator != Auth::user()->id && $userIn == true)
                                            <button class="leaveButton btn-form filled btn-activity-exit" id="{{ $activity->id }}">Salir</button>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        </div>
                    </li>
                </div>
            </div>
            @endforeach
        @else
        <div class="row">
            <div class="col-sm-12">
                <h1 class="title no-activities">Ops!!! No existen actividades con estos filtros</h1>
            </div>
        </div>
        @endif
</div>
<script>
    function initMap() {
        var maps = Object.getOwnPropertyNames(APL).filter(function (p) {
            return typeof APL[p] === 'function';
        });
        maps.forEach(function (e) {
            APL[e]();
        })
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjN5v5-pvZjkbwqLD8NRp3UuODrsqOLD4&callback=initMap" async defer></script>