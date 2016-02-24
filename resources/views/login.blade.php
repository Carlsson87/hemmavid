<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-offset-4">
                    <div class="panel" style="margin-top: 50px;">
                        <div class="panel-body">
                            <h1 class="text-center">Häj!</h1>
                            <p>
                                Här funkar det såhär.
                                När du skapar ett konto så får du en länk som bu besöker för att logga in.
                                Spara den länken någonstans. Länken kan användas av vem som helst, så dela gärna länken
                                med dem du vill dela kontot med.
                            </p>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" id="create-account-btn">Skapa ett konto</button>
                            </div>
                            <div id="feedback" class="well hidden">
                                <label for="">Länken du bör spara</label>
                                <input class="account-link input-lg form-control" type="text" readonly>
                                <div class="checkbox">
                                    <label>
                                        <input id="check" type="checkbox"> Jag har sparat länken.
                                    </label>
                                </div>
                                <a class="btn btn-success btn-block disabled" id="login-link" href="#">Logga in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $("#create-account-btn").click(function() {
                $.post('/account', {}, function (response) {
                    var link = "{{ url('auth') }}" + "/" + response.token;
                    $("#feedback .account-link").val(link);
                    $("#login-link").attr('href', link);
                    $("#feedback").toggleClass("hidden");
                });
            });
            $("#check").change(function() {
                $("#login-link").toggleClass("disabled");
            });
        });
    </script>
    </body>
</html>
