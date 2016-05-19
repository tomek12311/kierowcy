<div class="row">
    <div class="col-md-4 col-md-offset-1">
        <div class="form-group">
            <label class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">E-Mail Address</label>
            <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <select name="permission" id="permission">
            <option value="3">dyspozytor</option>
            <option value="4">kierowca</option>
        </select>

        <input type="hidden" name="company_id" value="{!! $company_id !!}">


        <input type="color" name="color" id="color">
    </div>
</div>


<div class="row">
    <div class="col-md-3 col-lg-offset-4">
        {!! Form::submit($submitButtonText,['class' => 'form-control btn-success']) !!}
    </div>
</div>

<br>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

