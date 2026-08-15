<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تسجيل الدخول | الإدارة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<body class="min-h-screen page-background">

    <div class="flex items-center justify-center min-h-screen px-4 py-10">

        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-7">

                <div
                    class="flex items-center justify-center w-20 h-20 mx-auto mb-5 text-white shadow-xl rounded-3xl bg-gradient-to-br from-sky-400 to-blue-600 shadow-sky-200">

                    <div
                        class="flex items-center justify-center w-16 h-16 overflow-hidden bg-white shadow-lg rounded-2xl ring-1 ring-slate-200">

                        <img src="{{ asset('images/logo.png') }}" alt="أبو مصطفى" class="object-cover w-full h-full">

                    </div>

                </div>

                <h1 class="text-3xl font-extrabold text-slate-800">
                    تسجيل الدخول
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    لوحة إدارة آل أبو مصطفى
                </p>

            </div>


            <div class="p-6 modern-card sm:p-8">

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="p-4 mb-5 text-sm font-semibold text-green-700 rounded-2xl bg-green-50">
                        {{ session('status') }}
                    </div>
                @endif


                {{-- Errors --}}
                @if ($errors->any())

                    <div class="p-4 mb-5 text-sm text-red-700 border border-red-200 rounded-2xl bg-red-50">

                        @foreach ($errors->all() as $error)
                            <p>
                                {{ $error }}
                            </p>
                        @endforeach

                    </div>

                @endif


                <form method="POST" action="{{ route('login') }}" class="space-y-5">

                    @csrf


                    {{-- Email --}}
                    <div>

                        <label for="email" class="block mb-2 text-sm font-bold text-slate-700">
                            البريد الإلكتروني
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="admin@example.com" class="modern-input">

                    </div>


                    {{-- Password --}}
                    <div>

                        <div class="flex items-center justify-between mb-2">

                            <label for="password" class="text-sm font-bold text-slate-700">
                                كلمة المرور
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-bold transition text-sky-600 hover:text-sky-700">
                                    نسيت كلمة المرور؟
                                </a>
                            @endif

                        </div>

                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••" class="modern-input">

                    </div>


                    {{-- Remember --}}
                    <label class="flex items-center gap-3 text-sm cursor-pointer text-slate-600">

                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-sky-500 focus:ring-sky-200">

                        تذكرني

                    </label>


                    <button type="submit" class="w-full primary-button">

                        تسجيل الدخول

                    </button>

                </form>

            </div>


            <p class="mt-6 text-xs text-center text-slate-400">
                نظام إدارة بيانات آل أبو مصطفى
            </p>

        </div>

    </div>

</body>

</html>
