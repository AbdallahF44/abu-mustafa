<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>أبو مصطفى | البحث</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-blue-50">

<div class="flex min-h-screen items-center justify-center px-4 py-10">

    <div class="w-full max-w-xl">

        {{-- Logo --}}
        <div class="mb-8 text-center">

            <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-sky-400 to-blue-600 text-white shadow-xl shadow-sky-200">

                <x-icons.users class="h-10 w-10" />

            </div>

            <h1 class="text-3xl font-black text-slate-800 sm:text-4xl">
                مرحباً بك في عائلة أبو مصطفى
            </h1>

            <p class="mt-3 text-sm leading-6 text-slate-500">
                أدخل رقم الهوية للبحث عن بياناتك وحالتك.
            </p>

        </div>


        {{-- Search Card --}}
        <div class="rounded-[2rem] border border-white bg-white/90 p-5 shadow-2xl shadow-sky-100 backdrop-blur sm:p-8">

            @if(session('error'))

                <div class="mb-5 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-600">

                    <x-icons.x class="h-5 w-5 shrink-0" />

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('search') }}"
            >

                @csrf


                <label
                    for="national_id"
                    class="mb-2 block text-sm font-black text-slate-700"
                >
                    رقم الهوية
                </label>


                <div class="relative">

                    <x-icons.id-card
                        class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                    />

                    <input
                        id="national_id"
                        name="national_id"
                        type="text"
                        inputmode="numeric"
                        autocomplete="off"
                        value="{{ old('national_id') }}"
                        placeholder="أدخل رقم الهوية"
                        required
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 pr-12 pl-4 text-sm font-bold text-slate-700 outline-none transition duration-300 placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100"
                    >

                </div>


                <button
                    type="submit"
                    class="mt-4 flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-l from-sky-500 to-blue-600 px-5 py-4 text-sm font-black text-white shadow-lg shadow-sky-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                >

                    <x-icons.search class="h-5 w-5" />

                    بحث عن الهوية

                </button>

            </form>

        </div>


        <p class="mt-6 text-center text-xs text-slate-400">
            جميع البيانات المعروضة مخصصة للاستخدام العائلي.
        </p>

    </div>

</div>

</body>
</html>
