@extends('master')

@section('meta-author')
<meta name="author" content="{{ $about->author }}">
@endsection
@section('meta-keywords')
<meta name="keyword" content="{{ $about->keywords }}">
@endsection
@section('meta-description')
<meta name="description" content="{{ $about->description }}">
@endsection


@section('content')
<style type="text/css">
#about {
	background-color: pink;
	position: static;
	display: block;
	top: 100px;	
}
</style>
<div class="col-lg-1"></div>
<div id="about" class="well col-lg-10" style="z-index: 100;">

{!! $about->content !!}
</div>
<div class="col-lg-1"></div>
@endsection