<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
      <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png"/>
      <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png"/>
    </head>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-danger" style="margin-top: 20px;">
                    Errors
                </div>
                <div class="alert alert-success" style="margin-top: 20px;">
                    Success
                </div>
            </div>
            <div class="col-xs-12">
              <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                      <h3 class="panel-title">
                        Lägg  till utgift
                      </h3>
                </div>
                <div class="panel-body" id="form">
                    <input type="hidden" name="auth_token" value="{{ $auth_token }}">
                    <div class="form-group">
                        <label class="control-label">Beskrivning</label>
                        <input name="description" class="form-control "/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kategori</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kostnad</label>
                        <div class="input-group">
                            <input name="cost" type="number" class="form-control "/>
                            <span class="input-group-addon">kr</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Datum</label>
                        <input name="date" value="{{ date('Y-m-d') }}" type="date" class="form-control "/>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-block btn-success" id="submit">Spara</button> 
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <script type="text/javascript" src="/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        $('.alert').click(function() {
            $(this).toggle();
        });
        $('.alert').hide();
        $('#submit').click(function() {
            $('.alert').hide();
            var $form = $('#form');
            var data = {
                description: $form.find("[name='description']").val(),
                    category_id: $form.find("[name='category_id']").val(),
                cost: $form.find("[name='cost']").val(),
                date: $form.find("[name='date']").val()
            };
            $.ajax('/add', {
                method: 'POST',
                data: data,
                success: function(data) {
                    $form.find("input, select").val("");
                    $(".alert-success").html("Utgiften <strong>" + data.description + " (" + data.cost + "kr)</strong> skapad").show();
                },
                error: function(xhr){
                    var errors = [];
                    for (var key in xhr.responseJSON) {
                        errors.push("<li>" + xhr.responseJSON[key] + "</li>");
                    }
                    $(".alert-danger").html("<ul>" + errors.join("") + "</ul>").show();
                }
            });
        });
    </script>
    </body>
</html>
