@extends('app')

<script>
    function myFunction(id) {
        var r = confirm("Czy jesteś pewien");
        if (r == true) {
            document.getElementById('delete' + id).submit();
        }
    }
</script>

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><a class="btn btn-info" href="{!! action('companyController@index') !!}">Cofnij</a> </div>

                    <div class="panel-body">
                        <table class="table-hover table">
                            <tr>
                                <th>Nazwa</th>
                                <th>Liczba pracowników</th>
                                <th></th>
                            </tr>

                            @foreach($items as $item)
                                <tr>
                                    <td>{!! $item -> name !!}</td>
                                    <td>{!! $item -> email !!}</td>
                                    <td>{!! $company -> name !!}</td>
                                    <td><input type="color" name="" id="" value="{!! $item -> color !!}" disabled></td>



                                    <td>
                                        {!! Form::open(array('url' => action('userController@destroy', $item -> id, $company -> id),
                                                             'method' => 'delete', 'id' => 'delete'.$item -> id)) !!}
                                            <button type="button" id="delete" onclick="myFunction({!! $item -> id !!})">Skasuj</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            <td>
                                {!! Form::open(array('url' => action('userController@create'),
                                                     'method' => 'get',
                                                     'id' => 'create'))!!}

                                <input type="hidden" name="company_id" value="{!! $company -> id !!}">
                                <button type="submit" class="btn btn-primary" id="createBtn">Dodaj pracownika</button>
                                {!! Form::close() !!}
                            </td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>