@extends('layout.master')
@section('content')
    <div class="container">
        <div id="content">
            <form method="POST" action="{{ route('login') }}" class="beta-form-checkout">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    @if (session('message'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>
                                    {{ session('message') }}
                                </li>
                            </ul>
                        </div>
                    @endif
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">

                        @if (Session::has('thongbao'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li> {{ Session::get('thongbao') }}</li>
                                </ul>
                            </div>
                        @endif
                        <h4>Đăng nhập</h4>
                        <div class="space20">&nbsp;</div>
                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="email" id="email" name='email'>
                        </div>
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input type="password" id="phone" name="password">
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <div class="form-block">
                            <a href="{{ route('getInputEmail') }}">Quên mật khẩu</a>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
