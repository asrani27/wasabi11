<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>V-PLAYER Register</title>
    <!-- CSS files -->
    <link href="/nf/dist/css/tabler.min.css?1725820908" rel="stylesheet">
    <link href="/nf/dist/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link href="/nf/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
    <link href="/nf/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
    <link href="/nf/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
    
  </head>
  <body  class=" d-flex flex-column bg-white">
    {{-- <script src="./dist/js/demo-theme.min.js?1692870487"></script> --}}
    <div class="row g-0 flex-fill">
      <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
        <div class="container container-tight my-5 px-lg-5">
          <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark"><img src="/icon/logo.png" height="36" alt=""></a>
          </div>
          <h2 class="h3 text-center mb-3">
            Create new free Account
          </h2>
          <form action="/register" method="post" autocomplete="off" novalidate class="form-register">
            @csrf
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control @error ('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}"  placeholder="your full name" autocomplete="new-password" required>

              @error ('nama')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control @error ('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="your@email.com" autocomplete="off">
              @error ('email')
                <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control @error ('username') is-invalid @enderror" name="username" value="{{old('username')}}"  placeholder="username" autocomplete="new-password" required>

              @error ('username')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
                <input type="password" class="form-control @error ('password') is-invalid @enderror" name="password" placeholder="Your password"  autocomplete="new-password" required>
                @error ('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Repeat Password</label>
              
              <input type="password" class="form-control @error ('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Repeat your password"  autocomplete="off" required >
              @error ('password_confirmation')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
                
            </div>
            
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100 button-register">Register</button>
            </div>
          </form>
          <div class="text-center text-secondary mt-3">
            Already have an account ? <a href="/login" tabindex="-1"><strong>Sign in instead</strong></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
        <!-- Photo -->
        <div class="bg-cover h-100 min-vh-100" style="background-image: url('/icon/cloud5.png')">
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/nf/dist/js/tabler.min.js?1692870487" defer></script>
    <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
    <script type='text/javascript'>
      $(function () {
          $('.form-register').on('submit', function(){
            $('.button-register').attr('disabled', 'true');
          });
      });
          
  </script>
  </body>
</html>