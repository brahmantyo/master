	<script type="text/javascript">
	$.fancybox({
		type : 'iframe',
		href : this.value,
		autoSize: false,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		closeBtn: false,
		keys : {
		    close  : null
		},
		ajax : {
			dataType : 'html',
		},
		afterClose : function(){ window.location.replace('/order') },
		helpers:{
			overlay:{
				closeClick: false,

			},
		}
	});
	</script>