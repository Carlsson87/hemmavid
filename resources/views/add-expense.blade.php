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
              <div class="panel panel-default" style="margin-top: 20px;">
                <div class="panel-heading">
                      <h3 class="panel-title">
                        Lägg  till utgift
                      </h3>
                </div>
                <div class="panel-body">
                    <form action="/add" method="post">
                        <input type="hidden" name="auth_token" value="{{ $auth_token }}">
                      <div class="form-group">
                        <label class="control-label">Beskrivning</label>
                        <input name="description" class="form-control "/>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Kategori</label>
                        <select name="category_id" class="form-control ">
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
                        <input type="submit" class="btn btn-block btn-success" value="Spara"/>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    <script type="text/javascript" src="/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/bootstrap.min.js"></script>
    </body>
</html>
