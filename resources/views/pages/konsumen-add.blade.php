@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/user"><i class="fa fa-users"></i>Master Konsumen</a></li>
    <li class="active">Add</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-user'></i>Add Konsumen</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/konsumen/create']) !!}

                <div class='form-group'>
                    {!! Form::label('first_name', 'First Name') !!}
                    {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('last_name', 'Last Name') !!}
                    {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection