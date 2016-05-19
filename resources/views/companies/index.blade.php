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
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <table class="table-hover table">
                            <tr>
                                <th>Nazwa</th>
                                <th>Liczba pracowników</th>
                            </tr>

                            @foreach($items as $item)
                                <tr>
                                    <td>{!! $item -> name !!}</td>
                                    <td>{!! $item -> users() -> count() !!}</td>
                                    <td><a href={{action('companyController@show', $item -> id)}} class="btn-info">Pokaż pracowników</a> </td>
                                    {{--<td><a  href={{action('companyController@destroy', $item -> id)}}--}}
                                            {{--class="btn-info">--}}
                                                {{--Usuń--}}
                                        {{--</a>--}}
                                    {{--</td>--}}
                                    <td>
                                        {!! Form::open(array('url' => action('companyController@destroy', $item -> id), 'method' => 'delete', 'id' => 'delete'.$item -> id)) !!}
                                        <button type="button" id="delete" onclick="myFunction({!! $item -> id !!})">Skasuj</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
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