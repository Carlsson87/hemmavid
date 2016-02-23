@extends('html')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Kategorier
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Namn</th>
                                <th>Månadsbudget</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories->sortByDesc('budget') as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->budget }}kr</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Skapa kategori
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="/categories" method="post">
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
                        <div class="form-group">
                            <input type="submit" value="Spara" class="btn btn-block btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
