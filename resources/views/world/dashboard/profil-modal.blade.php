@extends('app-modal')

@section('content')
<style type="text/css">
    .form-group.required .control-label:after { 
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: 8px;
        top:7px;
        font-family: 'FontAwesome';
        font-weight: normal;
        font-size: 10px;
        content: "\f069";
    }    
</style>
<div class="row">
    <div class="">
        <div class="box col-xs-12 col-sm-12">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Profil Konsumen</h1>
                <hr>
            </div>
            <div class="box-body">
                <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h3><strong>Mohon melengkapi data profil</strong></h3>
                </div>

            {!! Form::open(['role' => 'form', 'url' => '/save','class'=>'form-horizontal']) !!}
                {!! Form::hidden('id',$user->id) !!}
                {!! Form::hidden('contact',$user->first_name.' '.$user->last_name) !!}
                <div class="form-group">
                    {!! Form::label('login_id', 'Login ID',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10 form-control-static bg-success">{{ $user->name }}</div>
                </div>
                <div class="form-group">
                    {!! Form::label('contact', 'Contact',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10 form-control-static bg-success">{{ $user->first_name.' '.$user->last_name }}</div>
                </div>
                <div class="form-group {{ $errors->has('nmperusahaan') ? 'has-error' : '' }}">
                    {!! Form::label('nmperusahaan', 'Nama Perusahaan',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('nmperusahaan', old('nmperusahaan'), ['placeholder' => 'Nama Perusahaan', 'class' => 'form-control']) !!}
                    {!! $errors->first('nmperusahaan', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }} required">
                    {!! Form::label('alamat', 'Alamat',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('alamat', old('alamat'), ['placeholder' => 'Alamat', 'class' => 'form-control','required']) !!}
                    {!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('kota') ? 'has-error' : '' }} required">
                    {!! Form::label('kota','Kota',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::select('kota',array_merge(['--Pilih Kota--'],$kota),old('kota'),['class'=>'form-control','required']) !!}
                    {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('telp') ? 'has-error' : '' }} required">
                    {!! Form::label('telp', 'Telp',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::text('telp', old('telp'), ['placeholder' => 'Telp', 'class' => 'form-control','required']) !!}
                    {!! $errors->first('telp', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} required">
                    {!! Form::label('email', 'Email',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                    {!! Form::email('email', old('email'), ['placeholder' => 'Email', 'class' => 'form-control','required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    {!! Form::button('Cancel', ['class' => 'btn btn-info','onclick'=>'parent.$.fancybox.close()']) !!}
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection