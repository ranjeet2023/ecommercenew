@extends('admin.layouts.app')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            @include('admin.message')
            <div class="card-header text-center">
                <a href="#" class="h3">Administrative Panel</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ url('admin/admin-login') }}" method="Post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name ="email" class="form-control @error('email') is-invaild @enderror"
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        {{ $message }}
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invaild @enderror"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        {{ $message }}
                    @enderror
                    <div class="row">
                        <!-- <div class="col-8">
                               <div class="icheck-primary">
                               <input type="checkbox" id="remember">
                               <label for="remember">
                                 Remember Me
                               </label>
                               </div>
                             </div> -->
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1 mt-3">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
