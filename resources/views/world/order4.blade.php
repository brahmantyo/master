<div>&nbsp;</div>



    {!! Form::button('Lanjut',['id'=>'bLanjut','class'=>'btn btn-primary form-control', 'onclick'=>'goToStep5()']) !!}

<script type="text/javascript">
    function goToStep5(){
        // $('a:contains("Selesai")').removeClass('disabled');
        // $('a:contains("Selesai")').click();
        $('a:contains("Selesai")').tab('show');
    }
    $('#Step4').on('submit',function(e){
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
				*/goToStep5();/*
            },
            error: function(a,b,c){
                //var err = a.responseText;
                alert('Ada kesalahan. Mohon dicek kembali.'+a);                 
            }
        },'json');*/
    });

</script>