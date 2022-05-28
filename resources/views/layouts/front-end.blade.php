<!DOCTYPE html>
<html>
<head>
    <title>Laravel Add To Cart Function - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <div class="dropdown">
                <button type="button" class="btn btn-info" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img src="{{ $details['image'] }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<br/>
<div class="container">
  
    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div> 
    @endif
    <!-- @if(session('flash_message') || session('error'))
                <div class="toast col-12 mr-4 rounded-0 animated fadeInDown shadow @if(session('error')) bg-danger @else bg-success @endif text-white w-100 mt-3" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; right: 0; z-index: 10">                       
                    <div class="toast-body">
                        <i class="fa @if(session('error')) fa-exclamation-triangle @else fa-check-circle @endif" style="font-size:20px"></i>
                         @if(session('flash_message')) {{session('flash_message')}} @else {{session('error')}} @endif 
                        <button type="button" class="toastclose close" data-dismiss="toast" style="outline: none;border:none"><span aria-hidden="true">&times;</span></button>
                   </div>
                </div>
             @endif -->
    @yield('content')
</div>
  
@yield('scripts')
<script>
        $(document).ready(function(){
            setTimeout(function() { $(".toast").addClass('fadeOutUp'); }, 10000);
        //            $('.toast').toast({delay: 10000});
            
         $('.toastclose').on('click',function(){
             $(".toast").addClass('fadeOutUp');
         });
        });    
    </script>   
</body>
</html>