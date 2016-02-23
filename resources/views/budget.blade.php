@extends('html')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Budget
                </h3>
            </div>
            <div class="panel-body">
                @foreach($categories as $category)
                    <div class="form-group" id="progress-{{ $category->id }}">
                        <label>{{ $category->name }}</label>
                        <label class="pull-right">{{ $category->budget }}kr</label>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $category->current_percentage }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Lägg till utgift
                </h3>
            </div>
            <div class="panel-body">
                <div id="form-add-expense">
                  <div class="form-group">
                    <label class="control-label">Beskrivning</label>
                    <input name="description" class="form-control input-sm"/>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kategori</label>
                    <select name="category_id" class="form-control input-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Kostnad</label>
                    <div class="input-group">
                      <input name="cost" type="number" class="form-control input-sm"/>
                      <span class="input-group-addon">kr</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Datum</label>
                    <input name="date" value="{{ date('Y-m-d') }}" type="date" class="form-control input-sm"/>
                  </div>
                  <div class="form-group text-right">
                    <button class="btn btn-block btn-success">Spara</button> 
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    var categories = {!! $categories !!};    
    // Post the form when the button is clicked.
    $('#form-add-expense button').click(function() {
        var $form = $('#form-add-expense');
        var category_id = $form.find("[name='category_id']").val();
        var data = {
            description: $form.find("[name='description']").val(),
            cost: $form.find("[name='cost']").val(),
            date: $form.find("[name='date']").val()
        };
            
        $.post('/categories/' + category_id + '/expenses', data, function(res) {
            $('#progress-' + res.id + ' .progress-bar').css({ width: res.current_percentage + '%' });
        });
    });
@stop
