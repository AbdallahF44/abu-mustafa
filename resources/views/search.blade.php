<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>أبو مصطفى | البحث</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-blue-50">

    <div class="flex items-center justify-center min-h-screen px-4 py-10">

        <div class="w-full max-w-xl">

            {{-- Logo --}}
            <div class="mb-8 text-center">

                <div
                    class="flex items-center justify-center w-20 h-20 mx-auto mb-5 text-white shadow-xl rounded-3xl bg-gradient-to-br from-sky-400 to-blue-600 shadow-sky-200">

                    <div
                        class="flex items-center justify-center w-16 h-16 overflow-hidden bg-white shadow-lg rounded-2xl ring-1 ring-slate-200">

                        <img src="{{ asset('images/logo.png') }}" alt="أبو مصطفى" class="object-cover w-full h-full">

                    </div>

                </div>

                <h1 class="text-3xl font-bold text-slate-800 sm:text-4xl">
                    مرحباً بك في عائلة أبو مصطفى
                </h1>

                <p class="mt-3 text-sm leading-6 text-slate-500">
                    أدخل رقم الهوية للبحث عن بياناتك وحالتك.
                </p>

            </div>


            {{-- Search Card --}}
            <div
                class="rounded-[2rem] border border-white bg-white/90 p-5 shadow-2xl shadow-sky-100 backdrop-blur sm:p-8">

                @if (session('error'))
                    <div
                        class="flex items-center gap-3 p-4 mb-5 text-sm font-bold text-red-600 border border-red-200 rounded-2xl bg-red-50">

                        <x-icons.x class="w-5 h-5 shrink-0" />

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>
                @endif


                <form method="POST" action="{{ route('search') }}">

                    @csrf


                    <label for="national_id" class="block mb-2 text-sm font-bold text-slate-700">
                        رقم الهوية
                    </label>


                    <div class="relative">

                        <x-icons.id-card class="absolute w-5 h-5 -translate-y-1/2 right-4 top-1/2 text-slate-400" />

                        <input id="national_id" name="national_id" type="text" inputmode="numeric" autocomplete="off"
                            value="{{ old('national_id') }}" placeholder="أدخل رقم الهوية" required
                            class="w-full py-4 pl-4 pr-12 text-sm font-bold transition duration-300 border outline-none rounded-2xl border-slate-200 bg-slate-50 text-slate-700 placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">

                    </div>


                    <button type="submit"
                        class="flex items-center justify-center w-full gap-2 px-5 py-4 mt-4 text-sm font-bold text-white transition duration-300 shadow-lg cursor-pointer rounded-2xl bg-gradient-to-l from-sky-500 to-blue-600 shadow-sky-100 hover:-translate-y-1 hover:shadow-xl">

                        <x-icons.search class="w-5 h-5" />

                        بحث عن الهوية

                    </button>

                </form>

            </div>


            <div class="mt-8 text-center">

                <p class="text-xs text-slate-400">
                    جميع البيانات المعروضة مخصصة للاستخدام العائلي.
                </p>

                <p class="mt-2 text-xs font-medium text-slate-400">
                    Developed by
                    <span class="font-bold text-sky-500">
                        Abdallah Fawzi
                    </span>
                </p>

            </div>

        </div>

    </div>

</body>

</html>
