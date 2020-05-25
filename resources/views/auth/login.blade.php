@extends('layouts.home')

@section('content')

<div class="card col-xl-8 col-lg-10 col-md-12 col-sm-10 mx-auto mt-5">
    <div class="card-header">
        <div class="card-title col-md-8 m-auto text-center">
            <h2>LOGIN</h2> 
        </div>
    </div>

    <div class="card-body">
        <form method="POST" class="col-md-8 m-auto" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><svg class="bi bi-envelope" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 3H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                    <path d="M.05 3.555C.017 3.698 0 3.847 0 4v.697l5.803 3.546L0 11.801V12c0 .306.069.596.192.856l6.57-4.027L8 9.586l1.239-.757 6.57 4.027c.122-.26.191-.55.191-.856v-.2l-5.803-3.557L16 4.697V4c0-.153-.017-.302-.05-.445L8 8.414.05 3.555z"/>
                    </svg></span>
                </div>
                <input type="text" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><svg class="bi bi-lock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.5 8h-7a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1zm-7-1a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-7zm0-3a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                    </svg></span>
                </div>
                <input type="text" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password" required autocomplete="current-password">
            </div>

            <div class="form-group  justify-content-between d-flex">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                    <label class="custom-control-label" for="customCheck">Remember</label>
                </div>

                <a class="" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary col-md-12">
                    {{ __('Login') }}
                </button>
            </div>
            <label class="text-muted col-md-12 text-center mt-2">Or</label>
            <hr class="mt-0 mb-0" />
            <div class="form-group row mb-0">          
                <a href="{{ url('/redirect') }}"  class="btn col-md-12"  ><img id="google" style="max-height:52px" src="/btn_normal.png" ></a>
            </div>
        </form>
    </div>
</div>

@endsection
