@extends('html')

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
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
                            <div class="progress-bar progress-bar-success" style="line-height: 16px; width: {{ $category->current_percentage }}%;" role="progressbar" aria-valuenow="{{ $category->current_total }}" aria-valuemin="0" aria-valuemax="{{ $category->budget }}">
    {{ $category->current_total }}kr
</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="panel-footer clearfix">
                <button class="pull-right btn btn-primary" type="button" data-toggle="modal" data-target="#add-category-modal" style="line-height: 1">Ny kategori</button>
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
<div class="modal fade" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ny kategori</h4>
      </div>
    <form action="/categories" method="post">
      <div class="modal-body">
            <div class="form-group">
                <label for="name">Namn</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="budget">Budget</label>
                <div class="input-group">
                    <input type="number" name="budget" class="form-control">
                    <span class="input-group-addon">kr</span>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
        <input type="submit" value="Spara" class="btn btn-primary">
      </div>
    </form>
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
            $('#progress-' + res.id + ' .progress-bar').text(res.current_total + 'kr');
        });
    });
@stop
