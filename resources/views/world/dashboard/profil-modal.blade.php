@extends('app-modal')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Profil Konsumen</h1>
                <hr>
            </div>
            <div class="box-body">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => 'profil/save','class'=>'form-horizontal']) !!}

                <div class='form-group'>
                    {!! Form::label('login_id', 'Login ID',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10"><p class="form-control-static">{{ $user->name }}</p></div>
                </div>
                <div class='form-group'>
                    {!! Form::label('contact', 'Contact',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10"><p class="form-control-static">{{ $user->first_name.' '.$user->last_name }}</p></div>
                </div>
                <div class='form-group'>
                    {!! Form::label('nmperusahaan', 'Nama Perusahaan',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10">
                    {!! Form::text('nmperusahaan', old('nmperusahaan'), ['placeholder' => 'Nama Perusahaan', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('alamat', 'Alamat',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10">
                    {!! Form::text('alamat', old('alamat'), ['placeholder' => 'Alamat', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('kota','Kota',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10">
                    {!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),old('kota'),['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('telp', 'Telp',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10">
                    {!! Form::text('telp', old('telp'), ['placeholder' => 'Telp', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('email', 'Email',['class'=>'control-label col-md-2']) !!}
                    <div class="col-md-10">
                    {!! Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    {!! Form::button('Cancel', ['class' => 'btn btn-info','onclick'=>'parent.$.fancybox.close()']) !!}
                    </div>
                    <div class="col-md-4"></div>
                </div>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection