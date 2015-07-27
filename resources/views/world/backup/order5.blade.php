<div>&nbsp;</div>
<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1>Terima kasih atas kepercayaan Anda</h1>
        <h4>
        <p>Order Anda sudah kami terima. Dalam 24 jam staf kami akan mengkonfirmasi order Anda.</p>
        <p>Apabila dalam 24 jam belum ada konfirmasi dari kami, silahkah menghubungi kami di : </p>
        </h4>
        <div id="cabang"></div>
        <center>
            <a href="/" class="btn btn-info">Kembali ke Home</a>
            <a href="/konsumenpanel" class="btn btn-info">Ke Area Pelanggan untuk pengaturan</a>
        </center>
    </div>
    <div class="col-md-2"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $.getJSON("/getcabang").done(function(data){
            var cabang;
            cabang = "";
            $.each(data,function(k,v){
                cabang+='<table class="table table-striped">';
                cabang+='<tr style="font-weight: bold"><td colspan="3">'+v['nama']+'</td></tr>';
                cabang+='<tr><td width="100px">Alamat</td><td width="1px">:</td><td>'+v['alamat']+'</td></tr>';
                cabang+='<tr><td>No.Telp</td><td>:</td><td>'+v['telp']+'</td></tr>';
                cabang+='<tr><td colspan="3"></td></tr>';
                cabang+='</table>';
            });
            $('div#cabang').append(cabang);
        });
    });
</script>