<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تسجيل الدخول | الإدارة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="page-background min-h-screen">

    <div class="flex min-h-screen items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="mb-7 text-center">

                <div
                    class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-sky-100 shadow-lg shadow-sky-100">

                    <svg class="h-10 w-10 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z" />
                    </svg>

                </div>

                <h1 class="text-3xl font-extrabold text-slate-800">
                    تسجيل الدخول
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    لوحة إدارة آل أبو مصطفى
                </p>

            </div>


            <div class="modern-card p-6 sm:p-8">

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-5 rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-700">
                        {{ session('status') }}
                    </div>
                @endif


                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">

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

                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                            البريد الإلكتروني
                        </label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" placeholder="admin@example.com" class="modern-input">

                    </div>


                    {{-- Password --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label for="password" class="text-sm font-bold text-slate-700">
                                كلمة المرور
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs font-bold text-sky-600 transition hover:text-sky-700">
                                    نسيت كلمة المرور؟
                                </a>
                            @endif

                        </div>

                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••" class="modern-input">

                    </div>


                    {{-- Remember --}}
                    <label class="flex cursor-pointer items-center gap-3 text-sm text-slate-600">

                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-slate-300 text-sky-500 focus:ring-sky-200">

                        تذكرني

                    </label>


                    <button type="submit" class="primary-button w-full">

                        تسجيل الدخول

                    </button>

                </form>

            </div>


            <p class="mt-6 text-center text-xs text-slate-400">
                نظام إدارة بيانات آل أبو مصطفى
            </p>

        </div>

    </div>

</body>

</html>
