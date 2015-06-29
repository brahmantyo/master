<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lanogan Sumatra Express</title>
  @yield('meta-author')
  @yield('meta-keywords')
  @yield('meta-description')
  <meta name="date" content="2015-06-17T04:26:13+0700" >
  <meta name="copyright" content="niclogic">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
  <meta http-equiv="content-style-type" content="text/css">
  <meta http-equiv="expires" content="0">
  <!-- Bootstrap 3.3.2 -->
  <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

  <script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>    
</head>
<body>
<style type="text/css">
  body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
    background-image: url("{{asset('dist/img/bg.png')}}");
    background-color: #042045;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: top;
    background-attachment: fixed;
  }
  
  .container {
    display:block;
    background:rgba(255, 255, 255,0.5);
    padding: 20px;
  }

  .jumbotron {
    border-radius: 20px !important;
    /*background-image:url('{{asset('dist/img/banner.png')}}');*/
    background-repeat: no-repeat;
    background-size: contain;
    background-position: right;
    max-height: 467px;
  }
  .tab-content {
    background-color: #fff;
  }
  footer {
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 30px;
    color: #fff;
    background-color: #333;
  }
</style>
<!--   Header section -->

      <div class="container">
        <div class="row">
          <div class="well" style="border-radius: 20px">
            <img src="{{asset('dist/img/banner.png')}}" class="img-responsive">
          </div>
        </div>
<!--  End of header section -->

<!--  Content section -->
      <div class="row">
        <div class="panel">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home" >Home</a></li>
            <li><a data-toggle="tab" href="#tracking">Tracking</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tentang Kami<span class="caret"></span></a>
              <ul class="dropdown-menu">
              @foreach($abouts as $about)
                <li><a data-toggle="tab" href="#{{$about->type.'-'.$about->id}}">{{$about->title}}</a></li>
              @endforeach
              </ul>
            </li>
            <div class="dropdown pull-right">
              <a href="#" class="dropdown-toggle btn btn-info btn-sm" data-toggle="dropdown"><i class="fa fa-lock"></i> Login</a>
              <ul class="dropdown-menu"  style="min-width: 200px;">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <fieldset class="form-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Login" name="name" value="{{ old('name') }}">
                  </fieldset>
                  <fieldset class="form-group col-lg-12">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                  </fieldset>
                  <fieldset class="form-group col-lg-12 pull-right">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </fieldset>
                </form>
              </ul>
            </div>
          </ul>
        </div>
        <div class="panel-body">        
        <div class="tab-content">
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
          <div id="tracking" class="tab-pane fade">
            <div class="panel panel-primary">
              <div class="panel-heading">Informasi Status Pengiriman</div>
              <div class="panel-body">
                @include('world.tracking')
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
        </div></div>
      </div>
    </div>
<!-- End Content section -->

<!--  Footer section -->
  <footer>
      <div >
        <div class="col-md-12">
          <b><strong>Copyright &copy; 2014-2015 <a href="#">Niclogic</a>.</strong> All rights reserved.</div>
      </div>
  </footer>
<!--  Footer section -->
@if(isset($trackingreport))
<script type="text/javascript">
    $('*').removeClass('in').removeClass('active');
    $('a:contains("Tracking")').parent().addClass('active');
    $('#tracking').addClass('active').addClass('in');
</script>
@endif
</body>
</html>
