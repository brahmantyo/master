@extends('master')

@section('content')
<div id="home" class="tab-pane fade in active">
  @if(\Request::get('detail'))
    @include('world.news')                
  @else
  @foreach($news as $n)
    <div class="panel panel-primary">
      <div class="panel-heading"><h4><b>{{ strtoupper($n->title) }}</b></h4></div>
      <div class="panel-body">
      <h6><i><b>{{ ucfirst($n->first_name) }} {{ ucfirst($n->last_name) }}</b>, {{ date_format($n->created_at,'d-m Y h:m:s') }}</i>  </h6>
      <p class="lead">{!! $n->scontent !!} (<a href="/news/{{ $n->id }}/?detail=1">More</a>)</p>
      </div>
    </div>
  @endforeach
  @endif
</div>
<div id="order" class="tab-pane fade">
<div class="panel panel-primary">
  <div class="panel-heading">Halaman Order</div>
  <div class="panel-body">
    @if(isset($errorsorder))
      @include('world.order',['errorsorder'=>$errorsorder])
    @else
      @include('world.order')
    @endif
   </div>
</div>
</div>          
<div id="tracking" class="tab-pane fade">
<div class="panel panel-primary">
  <div class="panel-heading">Informasi Status Pengiriman</div>
  <div class="panel-body">
  @if(isset($errorstracking))
    @include('world.tracking',['errorstracking'=>$errorstracking])
  @else
    @include('world.tracking')
  @endif
   </div>
</div>
</div>
@foreach($abouts as $about)
<div id="{{$about->type.'-'.$about->id}}" class="tab-pane fade">
<div class="panel panel-primary">
<div class="panel-heading"><h4><b>{!! strtoupper($about->title) !!}</b></h4></div>
<div class="panel-body">
<p class="lead">{!! $about->content !!}</p>
</div>
</div>
</div>
@endforeach
</div>
@endsection