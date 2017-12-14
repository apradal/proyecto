<div class="container">
        @if(!$activities->isEmpty())
            @foreach($activities as $activity)
            <div class="row">
                <div class="col-sm-12">
                    <?php $datesFormated = \App\Http\Middleware\Utils::changeDateFormat(array($activity->fecha_inicio, $activity->fecha_fin))?>
                    <?php $userIn = false ?>
                    <?php $notFull = true ?>
                    <li class="activity<?php echo ' .' . $activity->estado ?>">
                        <h2 class="title title-activity">{{ $activity->titulo }}</h2>
                        <span class="estado">{{$activity->estado}}</span>
                        <div class="clear"></div>
                        <div class="row data">
                            <div class="col-sm-2">
                                <span class="activity-label">Ubicación:</span>
                            </div>
                            <div class="col-sm-2">
                                {{ $activity->provincia }}
                            </div>
                            <div class="col-sm-4">
                                {{ $activity->poblacion }}
                            </div>
                            <div class="col-sm-4">
                                {{ $activity->direccion }}
                            </div>
                        </div>
                        <div class="row data">
                            <div class="col-sm-3">
                                <span class="activity-label">Fecha inicio:</span> {{ $datesFormated[0] }}
                            </div>
                            <div class="col-sm-3">
                                <span class="activity-label">Fecha fin:</span> {{ $datesFormated[1] }}
                            </div>
                            <div class="col-sm-3">
                                <span class="activity-label">Hora incio:</span> {{ $activity->hora_inicio }}
                            </div>
                            <div class="col-sm-3">
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