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
                <h1><i class='fa fa-truck'></i>Quotation No. {{$quote->id}} </h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
            <table class="table table-striped">
                <tr><th width="100">Tanggal</th><td>: {{$quote->tglquote}}</td></tr>
                <tr><th>Pengirim</th><td>: {{($quote->pengirim->nama)&&($quote->pengirim->nama!='-')?$quote->pengirim->nama:$quote->pengirim->cp}}</td></tr>
                <tr><th>Penerima</th><td>: {{($quote->penerima->nama)&&($quote->penerima->nama!='-')?$quote->penerima->nama:$quote->penerima->cp}}</td></tr>
                <tr><th>Status</th><td>: {{$quote->status?$quote->status:'Menunggu di proses'}}</td></tr>
            </table>
            <table id="detail" class="display responsive no-wrap" width="100%">
                <tbody><?php $i=1;?>
                    @foreach($dquotes as $dquote)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$dquote->barang}}</td>
                        <td>{{$dquote->qty}}</td>
                        <td>{{$dquote->satuan}}</td>
                    </tr><?php $i++;?>
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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#detail').dataTable({
        "order" : [0,"asc"],
        "searching" : false,
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "responsive" : true,
        "pagingType" : "full_numbers",
    });    
</script>
@endsection
@section('script')
<script src="{{ asset('/plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
@endsection

@section('style')
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" /> 
@endsection