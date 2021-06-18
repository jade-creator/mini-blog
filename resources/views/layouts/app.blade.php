<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- Fontawesome-->
    <script src="https://kit.fontawesome.com/499510eba7.js" crossorigin="anonymous" defer></script>

    <!-- Alpine JS-->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ route('articles.index') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav x-data="{ open: false }" class="text-gray-300 text-sm sm:text-base">
                    <div class="hidden lg:block space-x-4">
                        @guest
                            <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <span>{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                            class="no-underline hover:bg-red-600 hover:border-red-500 border border-white rounded-full py-2 px-4"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>

                    <!-- Hamburger -->
                    <div class="block lg:hidden mr-3 flex items-center" title="Toggle menu">
                        <button @click="open = ! open" @click.away="open = false" class="h-full inline-flex items-center justify-center text-white hover:text-opacity-50 focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>  
                        </button>
                    </div>

                    <div x-cloak :class="{'block opacity-100 shadow-lg': open, 'hidden': ! open}" class="opacity-0 relative block lg:hidden">
                        <ul class="bg-white text-gray-600 rounded-md z-50 absolute top-5 right-0 w-40">
                            <li class="p-4"><span class="uppercase text-gray-400 font-bold text-xs" >Article</span></li>
                            <a href="{{ route('articles.create') }}">
                                <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500"><i class="fas fa-plus mr-3"></i> New
                                </li>
                            </a>
                            <a href="{{ route('articles.index') }}">
                                <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500">
                                    <i class="far fa-newspaper mr-3"></i> All
                                </li>
                            </a>
                            <a href="{{ route('articles.index', ['query' => 'this week']) }}">
                                <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500"><i class="fas fa-calendar-week mr-3"></i> This week
                                </li>
                            </a>
                            <li class="p-4"><span class="uppercase text-gray-400 font-bold text-xs" >Account</span></li>
                            @auth
                                <li class="truncate pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500"><i class="far fa-user mr-3"></i> {{ auth()->user()->name }}
                                </li>
                                <a href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-red-100 hover:text-red-500">
                                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                    </li>
                                </a>
                            @else
                                <a href="{{ route('login') }}">
                                    <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500">
                                        <i class="fas fa-sign-out-alt mr-3"></i> Log in
                                    </li>
                                </a>
                                <a href="{{ route('register') }}">
                                    <li class="pl-4 py-3 font-bold cursor-pointer hover:bg-blue-100 hover:text-blue-500">
                                        <i class="fas fa-pencil-alt mr-3"></i> Register
                                    </li>
                                </a>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
