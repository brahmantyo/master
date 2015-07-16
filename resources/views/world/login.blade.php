@extends('vendor.applogin')

@section('content')
	<div class='col-md-12'>
		Belum terdaftar? Silahkan isi form pendaftaran di bawah ini :
        <div class="box-body" width="50%">
        @if ($errors->has())
            @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{!! $error !!}</div>
            @endforeach
        @endif
        {!! Form::open(['role' => 'form', 'url' => '/order']) !!}
            <div class='form-group'>
                {!! Form::text('userid', old('userid'), ['placeholder' => 'User ID', 'class' => 'form-control']) !!}
            </div>
            <div class='form-group'>
                {!! Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
				{!! Form::password('password',['placeholder'=>'Password']) !!}
				{!! Form::password('kpassword',['placeholder'=>'Konfirmasi Password']) !!}
            </div>
            <div class='form-group'>
                {!! Form::submit('Daftar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        </div>
	</div>
@endsection