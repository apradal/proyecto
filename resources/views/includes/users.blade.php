<div class="container">
    <div class="users">
        <ul>
            <h2 class="title">Participantes</h2>
            <div class="row">
                <div class="col-sm-6">
                    @if ($creator->id === $activity->id_creator)
                        <h3 class="title-md">Creador:</h3>
                        <li><span>Nombre: </span>{{$creator->nombre}} <span>Apellidos: </span>{{$creator->apellidos}} <span>Provincia: </span>{{$creator->provincia}}</li>
                    @endif
                </div>
                <div class="col-sm-6">
                    <h3 class="title-md">Participantes:</h3>
                    @foreach($users as $user)
                        <li><span>Nombre: </span>{{$user->nombre}} <span>Apellidos: </span>{{$user->apellidos}} <span>Provincia: </span>{{$user->provincia}}</li>
                    @endforeach
                </div>
            </div>
        </ul>
    </div>
</div>