        <div class="panel panel-primary">
	        <div class="panel-heading">
	        <b>{{ strtoupper($dnews->title) }}</b>
			<h6><i><b>{{ ucfirst($dnews->first_name) }} {{ ucfirst($dnews->last_name) }}</b>, {{ date_format($dnews->created_at,'d-m Y h:m:s') }}</i>  </h6>
	        </div>
	        <div class="panel-body">
	          <h4></h4>
	          
	          <p>{!! $dnews->content !!}</p>
	        </div>
        </div>