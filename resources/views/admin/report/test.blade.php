@extends('app')

@section('style')
<link href="{{ asset('/plugins/daterangepicker2/daterangepicker.css') }}" rel="stylesheet" type="text/css" /> 

<link href="{{ asset('/plugins/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ asset('/plugins/jqwidgets/styles/jqx.bootstrap.css') }}" rel="stylesheet" type="text/css" /> 

<style type="text/css">
.new {
 		background-color: #F5A9A9 !important;
 	}
</style>
@endsection

@section('script')
<script src="{{ asset('/plugins/daterangepicker2/moment.js') }}"></script>
<script src="{{ asset('/plugins/daterangepicker2/daterangepicker.js') }}"></script>

<script src="{{ asset('/plugins/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.selection.js') }}"></script> 
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.columnsresize.js') }}"></script> 
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.filter.js') }}"></script> 
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.sort.js') }}"></script> 
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.pager.js') }}"></script> 
<script src="{{ asset('/plugins/jqwidgets/jqxgrid.grouping.js') }}"></script>
@endsection
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <!-- put another before link if exist here -->
    <li class="active">Laporan Biaya Operasional</li>
</ol>
@endsection

@section('content')
<script type="text/javascript">

	$(document).ready(function(){


		var getLocalization = function () {
		    var localizationobj = {};
		    localizationobj.pagerGoToPageString = "Ke halaman :";
		    localizationobj.pagerShowRowsString = "Jml Baris :";
		    localizationobj.pagerRangeString = " dari ";
		    localizationobj.pagerNextButtonString = "berikutnya";
		    localizationobj.pagerFirstButtonString = "awal";
		    localizationobj.pagerLastButtonString = "akhir";
		    localizationobj.pagerPreviousButtonString = "sebelumnya";
		    localizationobj.sortAscendingString = "Urutkan dr terkecil";
		    localizationobj.sortDescendingString = "Urutkan dr terbesar";
		    localizationobj.sortRemoveString = "Hapus Pengurutan";
		    localizationobj.firstDay = 1;
		    localizationobj.percentSymbol = "%";
		    localizationobj.currencySymbol = "Rp";
		    localizationobj.currencySymbolPosition = "before";
		    localizationobj.decimalSeparator = ",";
		    localizationobj.thousandsSeparator = ".";
		    var days = {
				names: ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"],
				namesAbbr: ["Ming","Sen","Sel","Rab","Kam","Jum","Sab"],
				namesShort: ["M","S","S","R","K","J","S"]
		    };
		    localizationobj.days = days;
		    var months = {
				names: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember",""],
				namesAbbr: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nop","Des",""]
		    };
		    var patterns = {
				d: "dd/MM/yyyy",
				D: "dddd, dd MMMM yyyy",
				t: "H:mm",
				T: "H:mm:ss",
				f: "ddd, dd MMMM yyyy H:mm",
				F: "dddd, dd MMMM yyyy H:mm:ss",
				M: "dd MMMM",
				Y: "MMMM yyyy"
		    }
		    localizationobj.patterns = patterns;
		    localizationobj.months = months;
		    return localizationobj;
		
		}

		var source = 
		{
			dataType : "jsonp",
			dataFields : [
				{name: 'idtransaksi', type:'string'},
				{name: 'nilai', type: 'float'},
				{name: 'tanggal', type: 'date', format: 'yyyy-MM-dd'},
				{name: 'keterangan', type: 'text'}
			],
			url: '/admin/operasional/data',
			async: true,
		};
		var dataAdapter = new $.jqx.dataAdapter(source,{
			loadComplete: function (data){alert('sukses');},
			loadError: function (xhr,status,error){alert('xhr='+xhr+' status='+status+' error='+error);},
            formatData: function (data) {
                data.ket = $("#searchField").val();
                return data;
            }

		});

		$('#dataTable').jqxGrid({
			theme: 'bootstrap',
			width: '100%',
		    source: dataAdapter,
		    pageable: true,
		    autoheight: true,
		    sortable: true,
		    showtoolbar: true,

            rendertoolbar: function (toolbar) {

                var me = this;
                var container = $("<div style='margin: 5px;'></div>");
                var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'>Cari: </span>");
                var input = $("<input class='jqx-input jqx-widget-content jqx-rc-all' id='searchField' type='text' style='height: 23px; float: left; width: 223px;' />");
       			var theme = this.theme;

                toolbar.append(container);
                container.append(span);
                container.append(input);

                if (theme != "") {
                    input.addClass('jqx-widget-content-' + theme);
                    input.addClass('jqx-rc-all-' + theme);
                }
       
                var oldVal = "";
       			
                input.on('keydown', function (event) {
                	
                    if (input.val().length >= 2) {
                        if (me.timer) {
                            clearTimeout(me.timer);
                        }
                        if (oldVal != input.val()) {
                            me.timer = setTimeout(function () {
                                $("#dataTable").jqxGrid('updatebounddata');
                            }, 500);
                            oldVal = input.val();
                        }
                    }
                    else {
                        $("#dataTable").jqxGrid('updatebounddata');
                    }
                });
            },


		    ready: function () {

		        $("#dataTable").jqxGrid('hideColumn','idtransaksi');
		    },

		    localization: getLocalization(),
		    columns: [
			    { text: 'Tanggal', dataField: 'tanggal', width: 200, cellsFormat: 'D' },
		        { text: 'Keterangan', dataField: 'keterangan' },
				{ text: 'Nilai', dataField: 'nilai', width: 200, align: 'right', cellsAlign:'right', cellsFormat: 'f2'},
		    ]
		});
	});
</script>

<div id="dataTable"></div>

<script type="text/javascript">
    //Date range picker
    $('.date').daterangepicker();

	$('a:contains("Detail")').fancybox({
		type : 'iframe',
		href : this.value,
		autoSize: false,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
	});

</script>
@endsection

@section('help')
<p><b>Shortcut For Laporan Biaya</b></p>
<hr>
<p>Tekan tombol ... untuk melakukan ...</p>

@endsection
