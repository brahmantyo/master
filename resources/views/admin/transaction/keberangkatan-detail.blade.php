@extends('app-modal')

@section('style')
<link href="{{ asset('/plugins/datatables/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.responsive.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="{{ asset('/plugins/datatables/jquery.dataTables-1.10.6.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
@endsection

@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li><a href="/admin/keberangkatan"><i class="fa fa-truck"></i>Daftar Order Trucking</a></li>
    <li class="active">Detail</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1><i class='fa fa-truck'></i> Surat Jalan Trucking</h1>
                <hr>
            </div>
            <div class="box-body">
            <table class="table table-condensed">
                <tr>
                    <td>
                    <table class="table table-condensed  table-bordered table-striped table-hover no-margin">
                        <tr><th width="150px">No.SJT</th><td style="font-weight: bold">{{$berangkat->idberangkat}}</td></tr>
                        <tr><th>No.Polisi</th><td>{{$berangkat->nopolisi}}</td></tr>
                        <tr>
                            <th>Supir</th>
                            <td class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-sm btn-info">Klik di sini</a>
                                <ul class="dropdown-menu">
                                    <table class="table table-responsive table-striped table-hover">
                                        <tr><th></th><th>Nama</th><th>Telp</th></tr>
                                        <tr><th>Supir 1</th><td>{{$berangkat->supir1}}</td><td>{{$berangkat->telpsup1}}</td></tr>
                                        <tr><th>Supir 2</th><td>{{$berangkat->supir2}}</td><td>{{$berangkat->telpsup2}}</td></tr>
                                    </table>
                                </ul>
                            </td>
                        </tr>
                        <tr><th>Keterangan</th><td>{{$berangkat->ket}}</td></tr>
                    </table>
                    </td>
                    <td>
                    <table class="table table-condensed table-bordered table-striped table-hover no-margin">
                        <tr><th>Cabang Asal</th>
                            @if($berangkat->asal)
                            <td>{{$berangkat->asal->nama}}</td>
                            @else
                            <td class="text-danger">Cabang {{$berangkat->idasal}} tidak ditemukan</td>
                            @endif
                        </tr>
                        <tr><th>Cabang Tujuan</th>
                            @if($berangkat->tujuan)
                            <td>{{$berangkat->tujuan->nama}}</td></tr>
                            @else
                            <td class="text-danger">Cabang {{$berangkat->idtujuan}} tidak ditemukan</td>
                            @endif
                        <tr><th>Tgl.Berangkat</th><td>{{\App\Helpers::dateFromMySqlSystem($berangkat->tglberangkat)}}</td></tr>
                        <tr><th>Tgl.Tiba</th><td>{!! $berangkat->tgltiba?(\App\Helpers::dateFromMySqlSystem($berangkat->tgltiba)):'<i class="text-danger">-- belum tiba --</i>' !!}</td></tr>                    
                    </table>
                    </td>
                    <td>
                        <table class="table table-condensed table-bordered table-striped table-hover no-margin">
                        <tr><th>Total Ongkos</th><td align="right">{{\App\Helpers::currency($berangkat->totongkos)}}</td></tr>
                        <tr><th>Uang Jalan</th><td align="right">{{\App\Helpers::currency($berangkat->ujln)}}</td></tr>
                        <tr><th>Biaya Operasional</th><td align="right">{{\App\Helpers::currency($berangkat->biayaopr)}}</td></tr>
                        <tr><th>Sisa Biaya Berangkat</th><td align="right">{{\App\Helpers::currency($berangkat->sisabb)}}</td></tr>
                        </table>
                    </td>
                </tr>
            </table>
            @if($berangkat->resi)
            <table id="tbresi" class="display responsive no-wrap" width="100%">
                <tbody>
                    @foreach($berangkat->resi as $resi)
                    <tr>
                        <td>{{$resi->noresi}}</td>
                        <td>{{\App\Helpers::dateFromMySqlSystem($resi->tglresi)}}</td>
                        <td>
                            @if($resi->cabang)
                            {{$resi->cabang->nama}}
                            @else
                            <span class="text-danger">cabang {{$resi->idcab}} blm terdaftar</span>
                            @endif
                        </td>
                        <td>
                            @if($resi->pengirim)
                            {{$resi->pengirim->cp}}
                            @else
                            <span class="text-danger">konsumen pengirim {{$resi->idkonsumen}} blm terdaftar</span>
                            @endif
                        </td>
                        <td>
                            @if($resi->penerima)
                            {{$resi->penerima->cp}}
                            @else
                            <span class="text-danger">konsumen penerima {{$resi->idpenerima}} blm terdaftar</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/admin/resi/{{$resi->noresi}}/?back=true">View Resi</a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
                <thead>
                    <tr>
                        <th>No.Resi</th>
                        <th>Tanggal</th>
                        <th>Cab.Pengirim</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            @else
            <div class="alert alert-danger">Daftar resi kosong. Silahkan hubungi programer!</div>
            @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#tbresi').dataTable({
        "iDisplayLength": 5,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        "responsive":true
    });
</script>
@endsection