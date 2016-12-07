<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SKRIPSWEET @yield('title')</title>

    <!-- Bootstrap Core CSS -->

{{ Html::style('vendor/bootstrap/css/bootstrap.min.css') }}
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">


    {{ Html::style('vendor/font-awesome/css/font-awesome.min.css') }}

{{ Html::style('vendor/simple-line-icons/css/simple-line-icons.css') }}

{{ Html::style('vendor/device-mockups/device-mockups.min.css') }}

{{ Html::style('css/new-age.min.css') }}

    @yield('stylesheets')