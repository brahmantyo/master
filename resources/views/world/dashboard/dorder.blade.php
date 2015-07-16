@extends('app-modal')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/quotation"><i class="fa fa-truck"></i>Daftar Permintaan Kirim (Quotation)</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-truck'></i>Quotation No. {{$header->id}} </h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
            <table class="table table-striped">
                <tr><th width="100">Tanggal</th><td>: {{$header->tglquote}}</td></tr>
                <tr><th>Pengirim</th><td>: {{$header->ppengirim?$header->ppengirim:$header->cppengirim}}</td></tr>
                <tr><th>Penerima</th><td>: {{$header->ppenerima?$header->ppenerima:$header->cppenerima}}</td></tr>
                <tr><th>Status</th><td>: {{$header->status?'':'Sudah diterima'}}</td></tr>
            </table>
            <table class="table table-bordered table-condensed table-striped table-hover">
                <tbody>
                    @foreach($dquotes as $dquote)
                    <tr>
                        <td></td>
                        <td>{{$dquote->nmbarang}}</td>
                        <td>{{$dquote->qty}}</td>
                        <td>{{$dquote->satuan}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Deskripsi Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
            </table>
            {!! $dquotes->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection