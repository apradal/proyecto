<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>userpanel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
     <div id="header"  class="container-fluid">
         <nav id="userPanel">
             <a class="logo" href="{{ url('/')}}"><img src="{{ URL::to('/images/logo-mini.png') }}" alt="logo"></a>
             <span class="title">Activeko</span>
             <div id="user-options">
                 @if (Auth::check())
                     {!! Form::open(['url' => '/logoutuser', 'id' => 'logoutUserForm']) !!}
                     <input type="submit" name="Log Out" class="btn-form filled" id="Log Out" value="Log Out">
                     {!! Form::close() !!}
             </div>
             <div class="clear"></div>
         </nav>
     </div>
     <div id="container" class="font">
         <div class="row">
             <div id="izq" class="col-sm-2">
                 <ul class="userpaneloptions">
                     <li id="dataOption">Datos Personales</li>
                     <li id="activitiesOption">Registro de Actividades</li>
                 </ul>
             </div>
             <div id="content" class="col-sm-10">
                 @if(session('message'))
                     <div id="message" class="alert alert-success">{{session('message')}}</div>
                 @endif
                 @include('includes.personalData')
                 @include('includes.activitiesUser')
                 @include('includes.leaveActivity')
             </div>
             @else
                 <h1>Ops! no deberías de estar aquí!!!</h1>
             @endif
         </div>
     </div>
        <script src="{{ asset('js/userJs.js') }}"></script>
    </body>
    @include('includes/footer')
</html>