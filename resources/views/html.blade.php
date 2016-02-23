<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">
                Budget
              </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="/">
                    Budget
                  </a>
                </li>
                <li>
                    <a href="/categories">
                        Kategorier
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    <script type="text/javascript" src="/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            @yield('scripts')
        });
    </script>
    </body>
</html>
