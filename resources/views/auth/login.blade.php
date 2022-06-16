@extends('layouts.master')
@section('title', 'Thrift & Loan MS')
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">BIJLI</h1>
            </div>
            <h4>Welcome to Bijli</h4>
             @if ($errors->any())
                 <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
            <form method="POST" action="{{route("login")}}">
                @csrf
                <div class="form-group">
                   <label class="small mb-1" for="inputUsername">Username</label>
                    <input class="form-control py-4" id="username" type="username" name="username" placeholder="Username" />
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="inputPassword">Password</label>
                    <input class="form-control py-4" id="password" name ="password" type="password" placeholder="Enter password" />
                </div>
                <div class="form-group">
                    <label class="small mb-1" for="inputFinancialyear">Financial Year</label>
                    <select class="form-control m-bot15" name="finyear" required>
                                @foreach($finyr as $fy)
                                    <option value="{{ $fy->id }}" >{{ $fy->finyear }}</option>
                                @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="#"><small>Forgot password?</small></a>
                {{-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> --}}
            </form>

        </div>
    </div>
        {{-- <main>
                    <div class="middle-box text-center loginscreen animated fadeInDown">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login-Thrift & Loan Management</h3></div>

                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form method="POST" action="{{route("login")}}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control py-4" id="username" type="username" name="username" placeholder="Username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="password" name ="password" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFinancialyear">Financial Year</label>
                                                <select class="form-control m-bot15" name="finyear" required>
                                                            @foreach($finyr as $fy)
                                                                <option value="{{ $fy->id }}" >{{ $fy->finyear }}</option>
                                                            @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="small" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="small" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                                                <button class="btn btn-primary">Login</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main> --}}
@endsection


