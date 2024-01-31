<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="web template" />
  <meta name="keywords" content="web, template" />

  <title>Viewer</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('/dist/css/font.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">

  <link rel="icon" href="{{asset('/dist/img/logo.ico')}}" type="image/x-icon" />
</head>

<body class="hold-transition layout-top-nav accent-primary">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center bg-white">
    <img class="animation__shake elevation-3 p-1 bg-light" src="{{asset('/dist/img/logo.png')}}" alt="Web Template" height="60" width="60">
    <noscript>
      <br>
      <span>We are facing <strong>Script</strong> issues. Kindly enable <strong>JavaScript</strong>!!!</span>
      <br>
      <span>Call IT Personnel Immediately!!! They will fix it right away.</span>
    </noscript>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark bg-gray-dark text-light border-bottom-0">
    <a href="" class="navbar-brand ml-2">
      <img src="{{asset('/dist/img/logo.png')}}" alt="Web Template Logo" class="brand-image elevation-3 bg-light p-1" style="opacity: .8">
      <span class="brand-text font-weight-light text-light"><b>WEB</b> Template</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="" class="nav-link active"><i class="fas fa-home"></i> Homepage</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link"><i class="fas fa-plus"></i> Menu</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('/') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
      </ul>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->