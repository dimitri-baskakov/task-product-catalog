<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Каталог товаров на Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
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
                font-size: 25px;
            }

            .links a {
                color: #636b6f;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > li > a {
                color: blue;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .product-card {
                text-align: center;
                border: 1px solid blue;
            }
            .product-card__image {
                display: inline-block;
                /* outline: 1px solid red; */
                max-width: 49vw;
                min-width: 49vw;
                /* float: left; */
            }
            .product-card__text {
                display: inline-block;
                /* outline: 1px solid red; */
                max-width: 49vw;
                min-width: 49vw;
                /* float: right; */
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Каталог товаров на Laravel
                    {{-- {{ $categories[0]['title'] }} --}}
                </div>
            </div>
        </div>
        <nav>
            <ul class="links">
                @foreach($categories as $category)
                    @if($category->children->count() > 0)
                        <li>
                            <a
                                href="/categories/{{ $category->alias }}"
                            >
                                {{ $category->title }}
                            </a>
                            <ul>
                                @foreach($category->children as $subcategory)
                                    <li>
                                        <a href="/categories/{{ $category->alias }}/{{ $subcategory->alias }}">
                                            {{ $subcategory->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        {{-- <li>
                            <a href="/{{ $category->alias }}">
                                {{ $category->title }}
                            </a>
                        </li> --}}
                    @endif
                @endforeach
            </ul>
        </nav>
        <main>
            <h4 class="content">
                20 популярных товаров
            </h4>
            <div>
                @foreach($topProducts as $topProduct)
                    <div
                        class="product-card"
                    >
                        <div
                            class="product-card__image"
                        >
                            <img
                                src="{{ $topProduct->image }}"
                                alt=""
                            >
                        </div>
                        <div
                            class="product-card__text"
                        >
                            <h3>
                                {{ $topProduct->title }} = {{ $topProduct->price }} p.
                            </h3>
                            <h5>
                                {{ $topProduct->description }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </body>
</html>
