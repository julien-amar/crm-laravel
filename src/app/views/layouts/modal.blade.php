
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ trans('main.menu.brand') }}</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('packages/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}

    <!-- MetisMenu CSS -->
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    {{ HTML::style('css/sb-admin-2.css')}} {{ HTML::style('css/main.css')}}

    <!-- Custom Fonts -->
    {{ HTML::style('font-awesome/css/font-awesome.min.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">
        @include('layouts.alerts')

        @yield('content')
    </div>

    <!-- jQuery -->
    {{ HTML::script('packages/jquery/jquery.min.js') }}
    {{ HTML::script('packages/jquery-loader/jquery-loader.js') }}

    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}

    <!-- Bootstrap Datepicker -->
    {{ HTML::script('packages/moment/moment.js') }}

    {{ HTML::script('packages/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    {{ HTML::script('js/bootstrap.ext.js') }}
    {{ HTML::script('js/sb-admin-2.js') }}
</body>

</html>
