@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <table>
                            <td>{!! $employee -> name !!}</td>
                            <td>{!! $employee -> email !!}</td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection