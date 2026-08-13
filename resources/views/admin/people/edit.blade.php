<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تعديل بيانات الشخص | أبو مصطفى</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
</head>

<body class="min-h-screen bg-slate-50">

    <div class="min-h-screen">

        {{-- Header --}}
        <header class="border-b border-slate-200 bg-white">

            <div class="mx-auto flex h-20 max-w-3xl items-center px-4 sm:px-6">

                <a href="{{ route('admin.people.index') }}"
                    class="ml-3 flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-lg text-slate-500 transition duration-300 hover:bg-sky-50 hover:text-sky-600">
                    →
                </a>

                <div>
                    <p class="text-xs font-bold text-sky-500">
                        إدارة الأشخاص
                    </p>

                    <h1 class="font-bold text-slate-800">
                        تعديل بيانات الشخص
                    </h1>
                </div>

            </div>

        </header>


        {{-- Content --}}
        <main class="px-4 py-8 sm:py-10">

            <div class="mx-auto max-w-2xl">

                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-600">

                        <div class="mb-2 flex items-center gap-2">

                            <x-icons.x class="h-5 w-5" />

                            <span>
                                يوجد أخطاء في البيانات:
                            </span>

                        </div>

                        <ul class="space-y-1 pr-7">

                            @foreach ($errors->all() as $error)
                                <li>
                                    • {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- Success --}}
                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-bold text-green-600">

                        {{ session('success') }}

                    </div>
                @endif


                {{-- Main Card --}}
                <div class="rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm sm:p-8">

                    {{-- Title --}}
                    <div class="mb-8 flex items-center gap-4">

                        <div
                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-500">

                            <x-icons.edit class="h-7 w-7" />

                        </div>

                        <div>

                            <h2 class="text-xl font-bold text-slate-800">
                                تعديل بيانات الشخص
                            </h2>

                            <p class="mt-1 text-sm text-slate-400">
                                قم بتعديل البيانات المطلوبة ثم اضغط حفظ.
                            </p>

                        </div>

                    </div>


                    {{-- Form --}}
                    <form method="POST" action="{{ route('admin.people.update', $person) }}" class="space-y-6">

                        @csrf

                        @method('PUT')


                        {{-- Name --}}
                        <div>

                            <label for="name" class="mb-2 block text-sm font-bold text-slate-700">
                                الاسم
                            </label>

                            <div class="relative">

                                <x-icons.user
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input id="name" type="text" name="name"
                                    value="{{ old('name', $person->name) }}" required autocomplete="name"
                                    placeholder="أدخل الاسم الكامل"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm font-bold text-slate-700 outline-none transition duration-300 placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">

                            </div>

                            @error('name')
                                <p class="mt-2 text-xs font-bold text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- National ID --}}
                        <div>

                            <label for="national_id" class="mb-2 block text-sm font-bold text-slate-700">
                                رقم الهوية
                            </label>

                            <div class="relative">

                                <x-icons.id-card
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input id="national_id" type="text" name="national_id"
                                    value="{{ old('national_id', $person->national_id) }}" required inputmode="numeric"
                                    autocomplete="off" placeholder="أدخل رقم الهوية"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm font-bold tracking-wide text-slate-700 outline-none transition duration-300 placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">

                            </div>

                            @error('national_id')
                                <p class="mt-2 text-xs font-bold text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div>

                            <label for="phone" class="mb-2 block text-sm font-bold text-slate-700">
                                رقم الجوال
                            </label>

                            <div class="relative">

                                <x-icons.phone
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input id="phone" type="text" name="phone"
                                    value="{{ old('phone', $person->phone) }}" inputmode="tel" autocomplete="tel"
                                    placeholder="أدخل رقم الجوال"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm font-bold text-slate-700 outline-none transition duration-300 placeholder:text-slate-400 focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">

                            </div>

                            @error('phone')
                                <p class="mt-2 text-xs font-bold text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Election Status --}}
                        <div>

                            <p class="mb-3 text-sm font-bold text-slate-700">
                                حالة الانتخاب
                            </p>

                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">


                                {{-- Elected --}}
                                <label class="cursor-pointer">

                                    <input type="radio" name="is_elected" value="1" class="peer sr-only"
                                        {{ old('is_elected', $person->is_elected) == 1 ? 'checked' : '' }}>

                                    <div
                                        class="rounded-2xl border-2 border-slate-100 bg-white p-5 transition duration-300 hover:border-green-200 hover:bg-green-50/50 peer-checked:border-green-400 peer-checked:bg-green-50">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-100 text-green-600">

                                                <x-icons.check class="h-6 w-6" />

                                            </div>

                                            <div>

                                                <p class="font-bold text-slate-700">
                                                    منتخب
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    الشخص مسجل كمنتخب
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </label>


                                {{-- Not Elected --}}
                                <label class="cursor-pointer">

                                    <input type="radio" name="is_elected" value="0" class="peer sr-only"
                                        {{ old('is_elected', $person->is_elected) == 0 ? 'checked' : '' }}>

                                    <div
                                        class="rounded-2xl border-2 border-slate-100 bg-white p-5 transition duration-300 hover:border-red-200 hover:bg-red-50/50 peer-checked:border-red-400 peer-checked:bg-red-50">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

                                                <x-icons.x class="h-6 w-6" />

                                            </div>

                                            <div>

                                                <p class="font-bold text-slate-700">
                                                    غير منتخب
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    الشخص مسجل كغير منتخب
                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </label>

                            </div>

                            @error('is_elected')
                                <p class="mt-2 text-xs font-bold text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Current Info --}}
                        <div class="rounded-2xl bg-slate-50 p-4">

                            <div class="flex items-center justify-between gap-3">

                                <div>

                                    <p class="text-xs font-bold text-slate-400">
                                        آخر تحديث
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-slate-600">
                                        {{ $person->updated_at?->format('Y-m-d H:i') ?? 'غير متوفر' }}
                                    </p>

                                </div>


                                <div>

                                    @if ($person->is_elected)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-600">

                                            <x-icons.check class="h-4 w-4" />

                                            منتخب

                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600">

                                            <x-icons.x class="h-4 w-4" />

                                            غير منتخب

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="flex flex-col gap-3 border-t border-slate-100 pt-6 sm:flex-row">

                            <button type="submit"
                                class="cursor-pointer flex flex-1 items-center justify-center gap-2 rounded-2xl bg-gradient-to-l from-sky-500 to-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-sky-100 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl">

                                <x-icons.check class="h-5 w-5" />

                                حفظ التعديلات

                            </button>


                            <a href="{{ route('admin.people.index') }}"
                                class="flex flex-1 items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-bold text-slate-500 transition duration-300 hover:border-slate-300 hover:bg-slate-50">

                                إلغاء

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>

</body>

</html>
