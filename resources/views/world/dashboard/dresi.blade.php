@extends('app-modal')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/konsumenpanel"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/resi"><i class="fa fa-truck"></i>Daftar Resi</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-truck'></i>No.Resi : {{$resi->noresi}} </h1>
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
                    <th width="100">Tanggal</th><td>: {{\App\Helpers::dateFromMySqlSystem($resi->tglresi)}}</td>
                    <th width="100">Tagihan</th><td>: {{$resi->tagihan}}</td>
                </tr>
                <tr>
                    <th>Pengirim</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->pengirim->nama)&&($resi->pengirim->nama!='-')?$resi->pengirim->nama:$resi->pengirim->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover">
                                <tr><th>Contact Person</th><td>{{$resi->pengirim->cp}}</td></tr>
                                <tr><th>No.Telp</th><td>{{$resi->pengirim->notelp}}</td></tr>
                                <tr><th>Alamat</th><td>{{$resi->pengirim->alamat}}</td></tr>
                                <tr><th>Kota</th><td>{{$resi->pengirim->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                    </td>
                    <th>Tipe</th><td>: {{$resi->tipe}}</td>
                </tr>
                <tr>
                    <th>Penerima</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->penerima->nama)&&($resi->penerima->nama!='-')?$resi->penerima->nama:$resi->penerima->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover">
                                <tr><th>Contact Person</th><td>{{$resi->penerima->cp}}</td></tr>
                                <tr><th>No.Telp</th><td>{{$resi->penerima->notelp}}</td></tr>
                                <tr><th>Alamat</th><td>{{$resi->penerima->alamat}}</td></tr>
                                <tr><th>Kota</th><td>{{$resi->penerima->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                    </td>
                    <th>Keterangan</th><td>: {{$resi->ket}}</td>
                </tr>
                <tr>
                    <th>Status</th><td>: {{\App\Helpers::getResiStatus($resi->status)}}</td>
                    <th>Tgl.Tiba</th><td>: {{$resi->tgltiba?\App\Helpers::dateFromMySqlSystem($resi->tgltiba):''}}</td>
                </tr>
            </table>
            <table id="detail" class="display responsive no-wrap" width="100%">
                <tbody><?php $i=1;?>
                    @foreach($resi->detail as $dresi)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$dresi->barang}}</td>
                        <td align="right">{{\App\Helpers::number_parser($dresi->qty)}}</td>
                        <td>{{$dresi->sat->namasatuan}}</td>
                        <td align="right">{{\App\Helpers::currency($dresi->hrgsatuan)}}</td>
                        <td align="right">{{\App\Helpers::currency($dresi->subtotal)}}</td>
                    </tr><?php $i++;?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr><th colspan="5">Total</th><td align="right">{{\App\Helpers::currency($resi->totalbiaya)}}</td></tr>
                    <tr><th colspan="5">DP</th><td align="right">{{\App\Helpers::currency($resi->dp)}}</td></tr>
                    <tr><th colspan="5">Sisa</th><td align="right">{{\App\Helpers::currency($resi->sisa)}}</td></tr>
                </tfoot>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Deskripsi Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
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