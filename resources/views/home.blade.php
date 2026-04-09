@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P.P POS</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/home.css">
   
</head>
<body>

<div class="container welcome-container d-flex align-items-center justify-content-center">
    <div class="row w-100 card-box">

        <!-- Left Image -->
        <div class="col-md-6 left-side">
         <img class="image" src="{{ asset('storage/images/welcome/pos_wallpaper.png') }}" alt="">
        </div>

        <!-- Right Text -->
        <div class="col-md-6 right-side">
            <h1 class="title">Welcome to P.P POS</h1>
            <p class="subtitle">
                Smart and modern Point of Sale system for managing your electronic and commodity business efficiently.
            </p>

            <button class="btn btn-custom mt-3">Get Started</button>
        </div>

    </div>
</div>

</body>
</html>

@endsection