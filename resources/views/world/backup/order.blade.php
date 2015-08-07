<style type="text/css">
    .info-header {
        padding: 20px 10px;
        background-color: #E7F2F6;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1) inset;
        border-bottom: 1px solid #DDD;
    }
</style>

<div class="tab-content">
<div class="info-header">
    <p>
        Cara Order :<br/>


    </p>
    <div id="error"></div>
</div>
    <div id="steps" class="col-md-12 panel-heading">
		<a href="#step1" data-toggle="tab" class="btn btn-warning">Order </a> <i class="fa fa-chevron-right"></i>
		<a href="#step2" data-toggle="tab" class="btn btn-info disable">Daftar <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
		<a href="#step3" data-toggle="tab" class="btn btn-info disable">Resume <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
		<a href="#step4" data-toggle="tab" class="btn btn-info disable">Konfirmasi <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
		<a href="#step5" data-toggle="tab" class="btn btn-info disable">Selesai <i class="fa fa-chevron-right"></i></a>
    </div>
	<div id="step1" class="tab-pane fade in active panel panel-primary">
	    <div class="panel-body">
			@include('world.order1')
	    </div>
	</div>
	<div id="step2" class="tab-pane fade panel panel-primary">
<!-- 	    <div class="col-md-12 panel-heading">
			<a href="#step1" data-toggle="tab" class="btn btn-warning">Order <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step2" data-toggle="tab" class="btn btn-warning">Daftar <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step3" data-toggle="tab" class="btn btn-info disable">Resume <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step4" data-toggle="tab" class="btn btn-info disable">Konfirmasi <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step5" data-toggle="tab" class="btn btn-info disable">Selesai <i class="fa fa-chevron-right"></i></a>
	    </div> -->
	    <div class="panel-body">
			@include('world.order2')
	    </div>
	</div>
	<div id="step3" class="tab-pane fade panel panel-primary">
<!-- 	    <div class="col-md-12 panel-heading">
			<a href="#step1" data-toggle="tab" class="btn btn-warning">Order <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step2" data-toggle="tab" class="btn btn-warning">Daftar <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step3" data-toggle="tab" class="btn btn-warning">Resume <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step4" data-toggle="tab" class="btn btn-info disable">Konfirmasi <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step5" data-toggle="tab" class="btn btn-info disable">Selesai <i class="fa fa-chevron-right"></i></a>
	    </div> -->
	    <div class="panel-body">
			@include('world.order3')
	    </div>
	</div>
	<div id="step4" class="tab-pane fade panel panel-primary">
<!-- 	    <div class="col-md-12 panel-heading">
			<a href="#step1" data-toggle="tab" class="btn btn-warning">Order <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step2" data-toggle="tab" class="btn btn-warning">Daftar <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step3" data-toggle="tab" class="btn btn-warning">Resume <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step4" data-toggle="tab" class="btn btn-warning">Konfirmasi <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step5" data-toggle="tab" class="btn btn-info disable">Selesai <i class="fa fa-chevron-right"></i></a>
	    </div> -->
	    <div class="panel-body">
			@include('world.order4')
	    </div>
	</div>
	<div id="step5" class="tab-pane fade panel panel-primary">
<!-- 	    <div class="col-md-12 panel-heading">
			<a href="#step1" data-toggle="tab" class="btn btn-warning">Order <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step2" data-toggle="tab" class="btn btn-warning">Daftar <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step3" data-toggle="tab" class="btn btn-warning">Resume <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step4" data-toggle="tab" class="btn btn-warning">Konfirmasi <i class="fa fa-chevron-right"></i></a> <i class="fa fa-chevron-right"></i>
			<a href="#step5" data-toggle="tab" class="btn btn-danger">Selesai <i class="fa fa-chevron-right"></i></a>
	    </div> -->
	    <div class="panel-body">
   			@include('world.order5')
	    </div>
	</div>
</div>

<script type="text/javascript">
	function getUrlParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	            return sParameterName[1];
	        }
	    }
	}

	$('#steps a[data-toggle="tab"]').on('shown.bs.tab',function(e){
		target = $(e.target);
		step = target.attr('href');
		switch(step){
			case '#step1' : ;break;
			case '#step2' : target.removeClass('btn-info');target.addClass('btn-warning');break;
			case '#step3' : getOrderan();target.removeClass('btn-info');target.addClass('btn-warning');break;
			case '#step4' : target.removeClass('btn-info');target.addClass('btn-warning');break;
			case '#step5' : target.removeClass('btn-info');target.addClass('btn-warning');break;			
		}
	});

	$(document).ready(function(){
		step = getUrlParameter('go');
		if(step=='2'){
			$('a:contains("Order")').tab('show');
			goToStep2();
		}
	});

</script>