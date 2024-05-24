@extends('../base')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/landing/homepage.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/global.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/navigation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
@endsection

@section('navbar')
    @include('includes/nav')
@endsection

@section('content')
<div class="main-container">
    <div class="content">
        <div class="container">
            <div class="text">
                <div class="text-content">
                    <h2>
                        C-TECH HOME
                    </h2>
                    <h5>
                        Welcome to the future of home automation, security, and connectivity. Explore our website and discover how we can transform your home into a smarter, safer, and more connected space.
                    </h5>
                </div>
            </div>

            <div class="img-class">
                <div class="img">
                    <img src="{{ asset('img/side-image.png') }}" alt="Image">
                </div>
            </div>
        </div>
    </div>
</div>

         <!-- Footer -->
  <footer class="py-5">
    <div class="container-px-5">
      <p class="centered-text">Copyright © 2023 XYZ Technologies. All rights reserved.</p>
    </div>
  </footer>

@endsection
