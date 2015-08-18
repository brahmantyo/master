@extends('app-modal')

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/resi"><i class="fa fa-truck"></i>Daftar Resi Pengiriman</a></li>
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
            <table class="table table-responsive table-condensed table-bordered table-striped table-hover no-margin">
                <tr><th width="20%">SJT</th><td style="font-weight: bold">{{$resi->idberangkat}}</td></tr>
                <tr><th>Status Transaksi</th><td style="font-weight: bold">{{\App\Helpers::getResiStatus($resi->status)}}</td></tr>
                <tr><th>User</th><td>{{$resi->pegawai}}</td></tr>
                <tr><th>Tanggal</th><td>{{\App\Helpers::dateFromMySqlSystem($resi->tglresi)}}</td></tr>
                <tr><th>Penagihan Kepada</th><td>{{$resi->tagihan}}</td></tr>
                <tr><th>Keterangan</th><td>{{$resi->ket}}</td></tr>

                <tr><th>Pengirim</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->pengirim->nama)&&($resi->pengirim->nama!='-')?$resi->pengirim->nama:$resi->pengirim->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover">
                                <tr><td>Contact Person</td><td>{{$resi->pengirim->cp}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$resi->pengirim->notelp}}</td></tr>
                                <tr><td>Alamat</td><td>{{$resi->pengirim->alamat}}</td></tr>
                                <tr><td>Kota</td><td>{{$resi->pengirim->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                    </td>
                </tr>
                <tr><th>Penerima</th>
                    <td class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->penerima->nama)&&($resi->penerima->nama!='-')?$resi->penerima->nama:$resi->penerima->cp}}</a>
                        <ul class="dropdown-menu">
                            <table class="table table-responsive table-bordered table-striped table-hover ">
                                <tr><td>Contact Person</td><td>{{$resi->penerima->cp}}</td></tr>
                                <tr><td>No.Telp</td><td>{{$resi->penerima->notelp}}</td></tr>
                                <tr><td>Alamat</td><td>{{$resi->penerima->alamat}}</td></tr>
                                <tr><td>Kota</td><td>{{$resi->penerima->dtkota->nmkota}}</td></tr>
                            </table>
                        </ul>
                        
                    </td>
                </tr>
            </table>
            <table class="table table-bordered table-condensed table-striped table-hover">
                <tbody><?php $i=1;?>
                    @foreach($resi->detail as $dresi)
                    <tr align="right">
                        <td>{{$i}}</td>
                        <td align="left">{{$dresi->barang}}</td>
                        <td>{{\App\Helpers::currency($dresi->hrgsatuan)}}</td>
                        <td>{{$dresi->qty}}</td>
                        <td>{{$dresi->namasatuan}}</td>
                        <td>{{\App\Helpers::currency($dresi->subtotal)}}</td>
                    </tr><?php $i++;?>
                    @endforeach 
                    <tr align="right" style="font-weight: bold"><td colspan="5">Total</td><td>{{\App\Helpers::currency($resi->totalbiaya)}}</td></tr>
                    <tr align="right" style="font-weight: bold"><td colspan="5">DP</td><td>{{\App\Helpers::currency($resi->dp)}}</td></tr>
                    <tr align="right" style="font-weight: bold"><td colspan="5">Sisa Pembayaran</td><td>{{\App\Helpers::currency($resi->sisa)}}</td></tr>
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
            @if($back)
            <button class="btn btn-success" onclick="window.history.back()">Kembali</a>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection