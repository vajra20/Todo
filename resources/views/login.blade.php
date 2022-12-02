@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div class="box"> 
        <img src="{{("https://cdn-icons-png.flaticon.com/512/295/295128.png")}}" class="avatar ">
        <form method="POST" action="/login/auth">
            @csrf
            <div class="container mb-5 ">
                <div class="row justify-content-center mt-5 d-flex justify-content-center align-items-center" >
                    <div class="col-4">
                        <div class="mt-5 ">
                            <div class= "shadow p-3">
                            @if (session('notAllowed'))
                            <div class="alert alert-danger">
                                {{ session('notAllowed') }}
                             </div>
                            @endif
                            
                            <div class="mt-5">
                            @if ($errors->any())
                                <div class="alert alert-danger p-2 ">
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                            </div>
                        @endif
                    </div>
    
                        <div class="mt-5">
                        @if (session('success'))
                            <div class="alert alert-success">
                               {{ session('success') }}
                            </div>
                        @endif
                    </div>
    
                        <div class="mt-5">
                        @if (session("error"))
                            <div class="alert-alert danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                    <div class="header">
                        <h2> LOGIN HERE! </h2>
                    </div>
                    <div class="card-body text-white">
                        <div class="mb-3">
                            <label for="exampleInputEmail1"  class="form-label">Username</label>
                            <input type="text" name="username" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input name="password" type="password" id="exampleInputPassword1">
                        </div>
                        <div class="d-flex flex-column">
                            <button id="button" name="" type="submit" class="btn btn-primary mb-3">Login</button>
                            <div class="text-center">
                                <p class="mb-0"> Don't have account? </p>
                                <a id="sign" class="text-center mt-2" style="text-decoration:none" href="{{route('register.page')}}">Sign up now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>   
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></scrip>
</body>
</html>

@endsection