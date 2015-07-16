<div>&nbsp;</div>
	<div>Berikut ini adalah orderan Anda :</div>
	<div id="orderan"></div>
	resume
    {!! Form::button('Lanjut',['id'=>'bLanjut','class'=>'btn btn-primary form-control', 'onclick'=>'goToStep4()']) !!}

<script type="text/javascript">
    function goToStep4(){
        //$('a:contains("Konfirmasi")').removeClass('disabled');
        //$('a:contains("Konfirmasi")').click();
        $('a:contains("Konfirmasi")').tab('show');
    }
    function getOrderan(){
    	$.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $.getJSON('/getorderan',function(data){
            var orderan='';
            var items='';
            var borongan='';
            n=1;


            $.each(data,function(k,v){
            	bor = v.borongan?'Ya':'Tidak';
                items+='<tr><td>'+v.idorder+'</td><td>'+v.nmbarang+'</td><td>'+v.qty+'</td><td>'+v.satuan+'</td><td width="10px"><input name="" type="checkbox"/></td></tr>';
                borongan='<tr><td colspan="5">Borongan ? <b>'+bor+'</b></td></tr>';
                n++;
            });

            tblstart='<table class="table table-bordered">';
            tblend='</table>';
            orderan = tblstart+borongan+items+tblend;


            $('div#orderan').replaceWith('<div id="orderan">'+orderan+'</div>');
        });
    }

    $('#Step3').on('submit',function(e){
		e.preventDefault();

        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        var form = $(this);
        var dataString = form.serialize();

        var formAction = form.attr('action');

        alert(dataString);

/*        $.ajax({
            url: formAction,
            type: 'POST',
            data: dataString,
            success: function(data){
				*/goToStep4();/*
            },
            error: function(a,b,c){
                //var err = a.responseText;
                alert('Ada kesalahan. Mohon dicek kembali.'+a);                 
            }
        },'json');*/
    });

</script>