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
                <tr>
                    <th width="100">Tanggal</th><td>: {{$quote->tglquote}}</td>
                    <th width="100">Tgl.Jemput</th><td>: {{$quote->tgljemput}}</td>
                </tr>
                <tr>

                    <th>Pengirim</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($quote->pengirim->nama)&&($quote->pengirim->nama!='-')?$quote->pengirim->nama:$quote->pengirim->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover">
                                <tr><td>Contact Person</td><td>{{$quote->pengirim->cp}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$quote->pengirim->notelp}}</td></tr>
                                <tr><td>Alamat</td><td>{{$quote->pengirim->alamat}}</td></tr>
                                <tr><td>Kota</td><td>{{$quote->pengirim->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                    </td>
                    <th>Tgl.Kirim</th><td>: {{$quote->tglkirim}}</td>
                </tr>
                <tr><th>Penerima</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($quote->penerima->nama)&&($quote->penerima->nama!='-')?$quote->penerima->nama:$quote->penerima->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover ">
                                <tr><td>Contact Person</td><td>{{$quote->penerima->cp}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$quote->penerima->notelp}}</td></tr>
                                <tr><td>Alamat</td><td>{{$quote->penerima->alamat}}</td></tr>
                                <tr><td>Kota</td><td>{{$quote->penerima->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                        
                    </td>
                    <th>Tipe Kiriman</th><td>: {{$quote->tipe}}</td>
                </tr>
                <tr>
                    <th>Status</th><td>: {{$quote->status?'Sedang diproses':'Menunggu di proses'}}</td>
                    <th>Penagihan</th><td>: {{$quote->tagihan}}</td>
                </tr>
                <tr>
                    <th>Alamat Asal Pengiriman</th><td>: {{$quote->almtasal}}, {{$quote->kota->nmkota}}</td>
                </tr>
            </table>
            <table id="detail" class="display responsive no-wrap" width="100%">
                <tbody><?php $i=1;?>
                    @foreach($dquotes as $dquote)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$dquote->barang}}</td>
                        <td>{{\App\Helpers::number_parser($dquote->qty,'en_US')}}</td>
                        <td>{{$dquote->sat->namasatuan}}</td>
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