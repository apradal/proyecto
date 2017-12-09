<h2>Participantes</h2>
<fieldset>
    <ul>
        @if ($creator->id === $activity->id_creator)
            <h3>Creador</h3>
            <li>
                <span>Nombre: {{$creator->nombre}} Apellidos: {{$creator->apellidos}} Provincia: {{$creator->provincia}}</span>
            </li>
        @endif
        <h3>Participantes</h3>
        @foreach($users as $user)
            <li>
                <span>Nombre: {{$user->nombre}} Apellidos: {{$user->apellidos}} Provincia: {{$user->provincia}}</span>
            </li>
        @endforeach
    </ul>
</fieldset>