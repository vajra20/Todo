@extends('layout')

@section('content')
<div class="box" id="register-box">
    <img src="{{("https://cdn-icons-png.flaticon.com/512/1057/1057240.png")}}" class="avatar" id="avatar-register">
    <form method="POST" action="{{route('register.input')}}">
        @csrf
            <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="mt-5">
                    <div class="shadow p-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mt-5">
                        <div class="header">
                            <h2> REGISTER HERE! </h2>
                        </div>
                <div class="card-body text-white">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" name="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Email Address</label>
                        <input type="text" name="email"
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="exampleInputPassword1" class="form-label">Username</label>
                        <input type="text" name="username"
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password"
                    </div>
                    <div class="d-flex flex-column align-items-start mt-3">
                        <button id="button" type="text" class="btn btn-primary" >Sign-Up </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</form>
@endsection