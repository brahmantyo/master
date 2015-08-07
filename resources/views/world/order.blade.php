<div class="row">
<div class="col-md-12">
    <div class="panel">
        @foreach($memo as $m)
    	@if($m->tags=='order')
        <div class="panel-heading">
	        <b>{{ strtoupper($m->title) }}</b>
	    </div>
        <div class="panel-body">
			<p>{!! $m->content !!}</p>
        </div>
        <div class="panel-footer"><span class="text text-primary small"><i>{{ ucfirst($m->first_name) }} {{ ucfirst($m->last_name) }}</i></span></div>
        @endif
        @endforeach
    </div>
</div>
</div>