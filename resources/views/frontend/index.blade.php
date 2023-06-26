<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @stack('after-styles')
    </head>
    <body>
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('includes.partials.announcements')

        <div id="app" class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    @if ($logged_in_user->isUser())
                        <a href="{{ route('frontend.user.dashboard') }}">@lang('Dashboard')</a>
                    @endif

                    <a href="{{ route('frontend.user.account') }}">@lang('Account')</a>
                @else
                    <a href="{{ route('frontend.auth.login') }}">@lang('Login')</a>

                    @if (config('boilerplate.access.user.registration'))
                        <a href="{{ route('frontend.auth.register') }}">@lang('Register')</a>
                    @endif
                @endauth
            </div><!--top-right-->

            <div class="content">
                @include('includes.partials.messages')

                <div class="title m-b-md">
                    <example-component></example-component>
                </div><!--title-->
                @auth
                    @if ($logged_in_user->isUser())
                <div class='temp-content'>

                <ul class="nav justify-content-center">
                    @foreach($category as $key => $value)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">{{$value}}</a>
                    </li>
                    @endforeach
                    <!-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
                </ul>
                    @foreach($product as $prod)
                    <div class="card" style="width: 16rem;">
                        <img src="{{ asset('storage/images/'.$prod->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$prod->name}}</h5>
                            <p class="card-text">{{$prod->description}} and Its Category is {{$prod->category->cat_name}}</p>
                            
                          <span> <strong>inStock:</strong>{{$prod->inStock}} &nbsp; | &nbsp; <strong>Price:</strong>{{$prod->price}}</span>
                        </div>
                      
                        </ul>
                        <div class="card-body">
                            <a href="{{ route('frontend.auth.porder', $prod->id) }}" class="card-link" onclick="event.preventDefault(); document.getElementById('place-order-{{$prod->id}}').submit(); ">Place Order</a>
                            <form id="place-order-{{ $prod->id }}" action="{{ route('frontend.auth.porder', $prod->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="product" value="{{ $prod->id }}">
                            </form>

                            @foreach($userCart as $ascart)
                         
                            @if(!empty($ascart->cart))
                            @if($ascart->cart->product_id === $prod->id)
                              <a href="{{route('frontend.user.dashboard')}}" class="form-control">Go To Cart</a>
                            
                            
                           @else
                            <a href="{{ route('frontend.auth.pcart', $prod->id) }}" class="card-link" onclick="event.preventDefault(); document.getElementById('add-cart-{{$prod->id}}').submit(); ">Add To Cart</a>
                            <form id="add-cart-{{ $prod->id }}" action="{{ route('frontend.auth.pcart', $prod->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="product" value="{{ $prod->id }}">
                            </form>
                            @endif
                            @else
                            <a href="{{ route('frontend.auth.pcart', $prod->id) }}" class="card-link" onclick="event.preventDefault(); document.getElementById('add-cart-{{$prod->id}}').submit(); ">Add To Cart</a>
                            <form id="add-cart-{{ $prod->id }}" action="{{ route('frontend.auth.pcart', $prod->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="product" value="{{ $prod->id }}">
                            </form>
                            @endif
                            @endforeach
                        </div>
                        </div>
                    @endforeach
                </div>
                @endif
                @endauth
                <!-- <div class="links">
                    <a href="http://laravel-boilerplate.com" target="_blank"><i class="fa fa-book"></i> @lang('Docs')</a>
                    <a href="https://github.com/rappasoft/laravel-boilerplate" target="_blank"><i class="fab fa-github"></i> GitHub</a>
                </div> -->
                
                <!--links-->
            </div><!--content-->
        </div><!--app-->

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
