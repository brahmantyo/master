@extends('app')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/armada"><i class="fa fa-truck"></i>Master Armada</a></li>
    <li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-truck'></i>Edit Armada</h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{{ $error }}</div>
                @endforeach
            @endif

            {!! Form::open(['role' => 'form', 'url' => '/armada/edit/'.$armada->nopolisi]) !!}

                <div class='form-group'>
                    {!! Form::label('nopol', 'No. Polisi') !!}
                    {!! Form::text('nopol', $armada->nopolisi, ['placeholder' => 'Nomer Polisi', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('jenis', 'Jenis Kendaraan') !!}
                    {!! Form::text('jenis', $armada->jeniskendaraan, ['placeholder' => 'Jenis Kendaraan', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('tahun', 'Tahun Kendaraan') !!}
                    {!! Form::text('tahun', $armada->tahun, ['placeholder' => 'Tahun Keluaran Kendaraan', 'class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('input[name="nopol"]').inputmask({mask: 'a[a][a] 9[9][9][9][9][ ][a][a][a]', greedy: false});
    $('input[name="tahun"]').inputmask("9999");    //   => 123abc ===> 123-ABC
    
</script>
@endsection