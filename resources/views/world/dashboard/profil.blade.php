@extends('app')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Profil Konsumen</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/profil/edit']) !!}

                <div class='form-group'>
                    Login ID : {{ $user->name }}
                </div>

                <div class='form-group'>
                    {!! Form::label('nmperusahaan', 'Nama Perusahaan') !!}
                    {!! Form::text('nmperusahaan', $konsumen->nama, ['placeholder' => 'Nama Perusahaan', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('alamat', 'Alamat') !!}
                    {!! Form::text('alamat', $konsumen->alamat, ['placeholder' => 'Alamat', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('kota','Kota') !!}
                    {!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),$konsumen->kota,['class'=>'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('telp', 'Telp') !!}
                    {!! Form::text('telp', $konsumen->notelp, ['placeholder' => 'Telp', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $konsumen->email, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('contact', 'Contact Person') !!}
                    {!! Form::text('contactfirst', $user->first_name, ['placeholder' => 'Nama Depan', 'class' => 'form-control']) !!}
                    {!! Form::text('contactlast', $user->last_name, ['placeholder' => 'Nama Belakang', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['placeholder' => 'Password :: Kosongan jika tidak berubah', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('kpassword', 'Konfirmasi Password') !!}
                    {!! Form::password('kpassword', ['placeholder' => 'Konfirmasi Password :: Kosongan jika tidak berubah', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    {!! Form::button('Cancel', ['class' => 'btn btn-info','onclick'=>'window.history.back()']) !!}
                </div>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection