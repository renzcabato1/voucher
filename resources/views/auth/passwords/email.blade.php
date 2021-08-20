@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image" class="rounded-circle" src="{{asset('images/front-logo.png')}}" style='width:135px;'>
        </div>
        <h3>{{ config('app.name', 'Laravel') }}</h3>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="form-group">
                <input type="email" name='email' value="{{ old('email') }}" class="form-control" placeholder="Email" required="">
                             
            </div>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
            @if($errors->any())
            <div class="form-group alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>{{$errors->first()}}</strong>
            </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <button type="submit" class="btn btn-primary block full-width m-b" onclick='show()'> {{ __('Send Password Reset Link') }}</button>
          <a onclick='show()' class="btn btn-primary block full-width m-b"  style='color:white;' href="{{  url('/login') }}"  onclick='show()'>Back to Login Page</a>
            {{-- <a href='{{ asset('/Budget Request Portal User Guide V1.5.pdf') }}' target='_' class="btn btn-warning block full-width m-b">View User Guide</a> --}}
            {{-- <a href="{{ route('password.request') }}" onclick='show()'><small>Forgot password?</small></a> --}}
        </form>
        {{-- <p class="m-t"> <small>Copyright &copy; {{date('Y')}}</small> </p> --}}
    </div>
</div>

@endsection
