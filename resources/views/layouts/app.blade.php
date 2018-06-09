<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ URL::asset('favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

      <!-- particles.js container -->
      <div id="particles-js"></div>

      <div style="position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index:99; margin-top:5%;">
        @yield('content')
      </div>

      <!-- scripts -->
      <script src="{{asset('js/particles.js')}}"></script>
      <script src="{{asset('js/app.js')}}"></script>

      <!-- stats.js -->

      <script>
        var count_particles, stats, update;
        stats = new Stats;
        stats.setMode(0);
        stats.domElement.style.position = 'absolute';
        stats.domElement.style.left = '0px';
        stats.domElement.style.top = '0px';
        document.body.appendChild(stats.domElement);
        count_particles = document.querySelector('.js-count-particles');
        update = function() {
          stats.begin();
          stats.end();
          if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
          }
          requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
      </script>


    </div>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/apps.js') }}"></script> -->
    @yield('script')
</body>
</html>
