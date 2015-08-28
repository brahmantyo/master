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
                        @if($resi->pengirim)
                        <td class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->pengirim->nama)&&($resi->pengirim->nama!='-')?$resi->pengirim->nama:$resi->pengirim->cp}}</a>
                            <ul class="dropdown-menu">
                                <table class="table table-responsive table-bordered table-striped table-hover">
                                    <tr><td>Contact Person</td><td>{{$resi->pengirim->cp}}</td></tr>
                                    <tr><td>No.Telp</td><td>{{$resi->pengirim->notelp}}</td></tr>
                                    <tr><td>Alamat</td><td>{{$resi->pengirim->alamat}}</td></tr>
                                    <tr><td>Kota</td><td>{{$resi->pengirim->dtkota?$resi->pengirim->dtkota->nmkota:'-'}}</td></tr>
                                </table>
                            </ul>
                        </td>
                        @else
                        <td>
                            <span class="text-danger">konsumen pengirim {{$resi->idkonsumen}} blm terdaftar</span>
                        </td>
                        @endif
                        @if($resi->penerima)
                        <td class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-info">{{($resi->penerima->nama)&&($resi->penerima->nama!='-')?$resi->penerima->nama:$resi->penerima->cp}}</a>
                            <ul class="dropdown-menu">
                                <table class="table table-responsive table-bordered table-striped table-hover ">
                                    <tr><td>Contact Person</td><td>{{$resi->penerima->cp}}</td></tr>
                                    <tr><td>No.Telp</td><td>{{$resi->penerima->notelp}}</td></tr>
                                    <tr><td>Alamat</td><td>{{$resi->penerima->alamat}}</td></tr>
                                    <tr><td>Kota</td><td>{{$resi->penerima->dtkota?$resi->penerima->dtkota->nmkota:'-'}}</td></tr>
                                </table>
                            </ul>
                        </td>
                        @else
                        <td>
                            <span class="text-danger">konsumen penerima {{$resi->idpenerima}} blm terdaftar</span>    
                        </td>
                        @endif
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
        "responsive":true,
        "language": {
            "sProcessing":   "Sedang memproses...",
            "sLengthMenu":   "Tampilkan _MENU_ entri",
            "sZeroRecords":  "Tidak ditemukan data yang sesuai",
            "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix":  "",
            "sSearch":       "Cari:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext":     "Selanjutnya",
                "sLast":     "Terakhir"
            
            }
        }
    });
</script>
@endsection