@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!

					{!! Form::open(['method' => 'POST', 'action' => 'HomeController@test']) !!}
						{!! Form::input('user_id', '1') !!}
						{!! Form::input('order_id', '2') !!}
						{!! Form::submit() !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
