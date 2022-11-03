@extends('layout.master')
@section('content')
    <div class="container">
        <div id="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <h4>Đăng kí</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="your_last_name">Fullname*</label>
                            <input type="text" name="name" id="your_last_name">
                        </div>
                        <div class="form-block">
                            <label for="email">Email address*</label>
                            <input type="text" name="email" id="email">
                        </div>



                        <div class="form-block">
                            <label for="adress">Address*</label>
                            <input type="text" name="address" id="adress" value="">
                        </div>


                        <div class="form-block">
                            <label for="phone">Phone*</label>
                            <input type="text" name="phone" id="phone">
                        </div>
                        <div class="form-block">
                            <label for="phone">Password*</label>
                            <input type="password" name="password" id="phone">
                        </div>
                        <div class="form-block">
                            <label for="phone">Re password*</label>
                            <input type="password" name="password_confirmation" id="phone">
                        </div>
                        <div class="form-block">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection
