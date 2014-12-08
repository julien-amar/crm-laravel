<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Authentication App With Laravel 4</title>

  {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
  {{ HTML::style('packages/bootstrap/css/bootstrap.sidebar.css') }}
  {{ HTML::style('packages/bootstrap/css/bootstrap.datepicker.css') }}
  {{ HTML::style('css/main.css')}}
</head>

<body>

  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
   <div class="container-fluid">
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>

       <a class="navbar-brand" href="#" title="Gestion de la relation client">Cross Immobilier</a>
     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
        @if(Auth::check())
        <li>{{ HTML::link('clients/list', trans('main.menu.client')) }}</li>

        <li>{{ HTML::link('import/data', trans('main.menu.import')) }}</li>

        @if(Session::get('user.original')->admin)
        <li>{{ HTML::link('profile/profiles', trans('main.menu.profile')) }}</li>
        @else
        <li>{{ HTML::link('profile/profile', trans('main.menu.profile')) }}</li>
        @endif
        
        @endif
      </ul>


      <ul class="nav navbar-nav navbar-right">
        @if(!Auth::check())
        <li>{{ HTML::link('users/register', trans('main.menu.register')) }}</li>
        <li>{{ HTML::link('users/login', trans('main.menu.login')) }}</li>
        @else
        <li>{{ HTML::link('users/logout', trans('main.menu.logout')) }}</li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




<div class="page-container">
  @if(Session::has('message'))
  <p class="alert alert-warning">{{ Session::get('message') }}</p>
  @endif

  {{ $content }}
</div>

{{ HTML::script('packages/jquery/js/jquery.min.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('packages/bootstrap/js/bootstrap.datepicker.js') }}
{{ HTML::script('js/bootstrap.ext.js') }}

<!-- Menu Toggle Script -->
<script>
$("#advanced-search").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>

</body>
</html>
