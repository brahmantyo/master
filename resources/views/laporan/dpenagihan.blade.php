@extends('app-modal')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/penagihan"><i class="fa fa-truck"></i>Laporan Penagihan Pengiriman</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-truck'></i>No.Resi : {{$header->noresi}} </h1>
                <hr>
            </div>
            <div class="box-body" width="50%">
            @if ($errors->has())
                @foreach ($errors->all() as $error)
                <div class='bg-danger alert'>{!! $error !!}</div>
                @endforeach
            @endif
            <table class="table table-responsive table-condensed table-bordered table-striped table-hover no-margin">
                <tr><th width="20%">SJT</th><td style="font-weight: bold">{{$header->idberangkat}}</td></tr>
                <tr><th>Status Transaksi</th><td style="font-weight: bold">{{\App\Helpers::getResiStatus($header->status)}}</td></tr>
                <tr><th>User</th><td>{{$header->pegawai}}</td></tr>
                <tr><th>Tanggal</th><td>{{\App\Helpers::dateFromMySqlSystem($header->tglresi)}}</td></tr>
                <tr><th>Penagihan Kepada</th><td>{{$header->tagihan}}</td></tr>
                <tr><th>Keterangan</th><td>{{$header->ket}}</td></tr>

                <tr><th>Pengirim</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($header->ppengirim)&&($header->ppengirim!='-')?$header->ppengirim:$header->cppengirim}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover">
                                <tr><td>Contact Person</td><td>{{$header->cppengirim}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$header->telppengirim}}</td></tr>
                                <tr><td>Alamat</td><td>{{$header->alamatpengirim}}</td></tr>
                                <tr><td>Kota</td><td>{{$header->kotapengirim}}</td></tr>
                            </table>
                        </ul>
                    </td>
                </tr>
                <tr><th>Penerima</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($header->ppenerima)&&($header->ppenerima!='-')?$header->ppenerima:$header->cppenerima}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover ">
                                <tr><td>Contact Person</td><td>{{$header->cppenerima}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$header->telppenerima}}</td></tr>
                                <tr><td>Alamat</td><td>{{$header->alamatpenerima}}</td></tr>
                                <tr><td>Kota</td><td>{{$header->kotapenerima}}</td></tr>
                            </table>
                        </ul>
                        
                    </td>
                </tr>
            </table>
            <table class="table table-bordered table-condensed table-striped table-hover">
                <tbody><?php $i=1;?>
                    @foreach($dresis as $dresi)
                    <tr align="right">
                        <td>{{$i}}</td>
                        <td align="left">{{$dresi->barang}}</td>
                        <td>{{\App\Helpers::currency($dresi->hrgsatuan)}}</td>
                        <td>{{$dresi->qty}}</td>
                        <td>{{$dresi->namasatuan}}</td>
                        <td>{{\App\Helpers::currency($dresi->subtotal)}}</td>
                    </tr><?php $i++;?>
                    @endforeach 
                    <tr align="right" style="font-weight: bold"><td colspan="5">Total</td><td>{{\App\Helpers::currency($header->totalbiaya)}}</td></tr>
                    <tr align="right" style="font-weight: bold"><td colspan="5">DP</td><td>{{\App\Helpers::currency($header->dp)}}</td></tr>
                    <tr align="right" style="font-weight: bold"><td colspan="5">Sisa Pembayaran</td><td>{{\App\Helpers::currency($header->sisa)}}</td></tr>
                </tbody>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Deskripsi Barang</th>
                        <th>Ongkir</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
            </table>
            
            </div>
        </div>
    </div>
</div>
@endsection