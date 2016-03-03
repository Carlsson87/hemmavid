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
          <div class="row" style="margin-top: 20px;">
            <div class="col-xs-8">
                <div class="form-group">
                    <input type="text" id="item-text" class="form-control" placeholder="Ny grej"/>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <button class="btn btn-success" id="create-item">Spara</button>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 item-list">
                @foreach($items as $item)
                <div class="form-group">
                    <div class="checkbox">
                      <label>
                        <input class="item item--{{ $item->id }}" data-id="{{ $item->id }}" type="checkbox" {{ $item->checked ? 'checked' : '' }}> {{ $item->text }}
                      </label>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
        <div class="hidden">
            <div class="form-group template">
                <div class="checkbox">
                  <label>
                    <input class="item" type="checkbox">
                  </label>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.js"></script>
    <script type="text/javascript" charset="utf-8">
        var socket = io({{ url('/') }}':8001');
        socket.emit('joining', '{{ $auth_token }}');
        socket.on('update.item', function(item) {
            $('.item--' + item.id).prop('checked', item.checked);
        });
        socket.on('create.item', function(item) {
            var clone = $('.template').clone();
            clone.removeClass('.template');
            clone.find('input').data('id', item.id).addClass('item--' + item.id);
            clone.find('label').append(' ' + item.text);
            clone.appendTo('.item-list');
            clone.find('input').change(toggleItem);
        });
        $('.item').change(toggleItem);
        function toggleItem() {
            socket.emit('update.item', { id: $(this).data('id'), checked: $(this).prop('checked') });
        }
        $('#create-item').click(function() {
            $.post('/create-item/{{ $auth_token }}', { text: $('#item-text').val() }, function() {
                $('#item-text').val('');
            });
        });
    </script>
    </body>
</html>
