<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Work List</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="h-main">
    <div class="h-login-sid">
        <div class="h-login-body">
            <div class="h-login-head">
                <div style="color: #f7f7f7">
                    <h5><a href="{{route('lang' , ['locale'=>'en'])}}"> EN </a></h5>
                    <h5><a href="{{route('lang' , ['locale'=>'fa'])}}"> FA </a></h5>
                </div>
            @guest
                <h3>ورود به حساب کاربری</h3>
                <h6>هم اکنون وارد پروفایل خود شوید</h6></div>
            <div class="h-login-box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="h-login-box-input">
                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="h-login-box-input">
                    <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="h-login-box-log">

                    <button type="submit" class="h-login-log">
                        {{ __('auth.Login') }}
                    </button>

                    <div class="h-login-sign"><a href="{{route('register')}}" title="ثبت نام در مجموعه"><h6>{{__('Register')}}</h6></a></div>
                    <div class="h-login-forgot"><a href="#" title="رمز عبور خود را فراموش کردم"><h6>فراموشی رمز عبور !</h6></a></div>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                </form>

            </div>
            @endguest
            @auth
            <h3>{{__('Hello')}} {{Auth::user()->name}} {{__('Dear')}}</h3>
           
            <h6>{{__('You are loged in')}}</h6></div>
        <div class="h-login-box">
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="h-login-box-input">
                <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror
            </div>
            <div class="h-login-box-input">
                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                @enderror
            </div>
            <div class="h-login-box-log">

                <button type="submit" class="h-login-log">
                    {{ __('auth.Login') }}
                </button>

                <div class="h-login-sign"><a href="{{route('register')}}" title="ثبت نام در مجموعه"><h6>{{__('Register')}}</h6></a></div>
                <div class="h-login-forgot"><a href="#" title="رمز عبور خود را فراموش کردم"><h6>فراموشی رمز عبور !</h6></a></div>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            </form>

        </div>   
            @endauth
        </div>
    </div>


    <div class="h-dis-sid">

        <div class="h-dis-body">
            <div class="h-dis-logo"><img src="logo.png" alt="ورک لیست من" title="myworklist" width="100" height="100" ></div>
            <div class="h-dis-head"><h4>ورک لیست من</h4><h6>کمی با "ورک لیست من " و نحوه کارکرد آن آشنا شوید</h6></div>
            <div class="h-dis-content">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut totam earum quibusdam unde. Quasi hic facilis quisquam recusandae provident fugiat saepe cum cumque commodi quidem, similique aspernatur odit, soluta doloribus nesciunt perspiciatis sunt eaque nulla voluptate! Voluptatem ad autem nam earum, iusto et expedita maiores voluptatibus debitis quaerat repellendus numquam.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae quae rerum delectus. Delectus veritatis animi magni, ab molestias perspiciatis aperiam.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis quibusdam quisquam officiis? Id quis magni, obcaecati atque incidunt esse aliquam unde tenetur distinctio officiis magnam soluta laudantium dignissimos molestiae enim?</p>
            </div>
        </div>

    </div>




</div>

</body>
</html>
