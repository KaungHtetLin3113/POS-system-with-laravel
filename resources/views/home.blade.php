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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f5132, #198754);
            height: 100vh;
            margin: 0;
        }

        .welcome-container {
            height: 85vh;
        }

        .left-side {
            /* background: url('https://images.unsplash.com/photo-1581090700227-1e8a1f87a1c1') no-repeat center; */
            background-size: cover;
            border-radius: 20px 0 0 20px;
        }

        .right-side {
            background: white;
            border-radius: 0 20px 20px 0;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .title {
            font-size: 36px;
            font-weight: 600;
            color: #0f5132;
        }

        .subtitle {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-custom {
            background: #198754;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            border: none;
        }

        .btn-custom:hover {
            background: #146c43;
        }

        .card-box {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .welcome-container {
            height: 100vh;
        }
            .left-side {
                height: 200px;
                border-radius: 20px 20px 0 0;
            }

            .right-side {
                border-radius: 0 0 20px 20px;
            }
        }
        .image{
            width: 100%;
            height: 100%;
        }
         @media (max-width: 425px) {
            .welcome-container {
            height: 120vh;
        }
           
           
        }
    </style>
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