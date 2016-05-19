@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">

                        <a href="{{action('companyController@show', Auth::User() -> company_id)}}">Pracownicy</a>

                        Statystyki

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
