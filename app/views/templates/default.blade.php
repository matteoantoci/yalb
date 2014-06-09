<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js no-touch" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <title>@yield('title', 'Laravel PHP Framework')</title>
    @yield('meta')
    @include('common.favicon')
    {{ HTML::style('assets/stylesheets/style.css') }}
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
    <![endif]-->
    <script>
        window.Statics     = window.Statics || {};
        Statics.siteURL    = '{{ URL::to("/") }}';
        Statics.currentURL = '{{ URL::current() }}';
        Statics.fullURL    = '{{ URL::full() }}';
    </script>
</head>

<body>
    @include('common.header')

    @yield('content')

    @include('common.footer')
    {{ HTML::script('assets/javascripts/app.build.js') }}
    @yield('scripts')
</body>
</html>