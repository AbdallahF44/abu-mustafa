<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إضافة شخص | أبو مصطفى</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-slate-50">

    <div class="min-h-screen">


        <header class="border-b border-slate-200 bg-white">

            <div class="mx-auto flex h-20 max-w-3xl items-center px-4 sm:px-6">

                <a href="{{ route('admin.people.index') }}"
                    class="ml-3 flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-sky-50 hover:text-sky-600">
                    ←
                </a>

                <div>

                    <p class="text-xs font-bold text-sky-500">
                        إدارة الأشخاص
                    </p>

                    <h1 class="font-black text-slate-800">
                        إضافة شخص
                    </h1>

                </div>

            </div>

        </header>


        <main class="px-4 py-8">

            <div class="mx-auto max-w-2xl">

                @if ($errors->any())

                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-600">

                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                    </div>

                @endif


                <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm sm:p-8">

                    <div class="mb-7">

                        <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50 text-sky-500">

                            <x-icons.user class="h-7 w-7" />

                        </div>

                        <h2 class="text-xl font-black text-slate-800">
                            بيانات الشخص
                        </h2>

                    </div>


                    <form method="POST" action="{{ route('admin.people.store') }}" class="space-y-5">

                        @csrf


                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                الاسم
                            </label>

                            <div class="relative">

                                <x-icons.user
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                    placeholder="أدخل الاسم">

                            </div>

                        </div>


                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                رقم الهوية
                            </label>

                            <div class="relative">

                                <x-icons.id-card
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input type="text" name="national_id" value="{{ old('national_id') }}" required
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                    placeholder="رقم الهوية">

                            </div>

                        </div>


                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                رقم الجوال
                            </label>

                            <div class="relative">

                                <x-icons.phone
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-12 pl-4 text-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100"
                                    placeholder="رقم الجوال">

                            </div>

                        </div>


                        <div>

                            <p class="mb-3 text-sm font-bold text-slate-700">
                                حالة الانتخاب
                            </p>

                            <div class="grid grid-cols-2 gap-3">


                                <label class="cursor-pointer">

                                    <input type="radio" name="is_elected" value="1" class="peer sr-only"
                                        {{ old('is_elected') === '1' ? 'checked' : '' }}>

                                    <div
                                        class="rounded-2xl border-2 border-slate-100 p-4 text-center transition peer-checked:border-green-400 peer-checked:bg-green-50">

                                        <x-icons.check class="mx-auto h-6 w-6 text-green-500" />

                                        <p class="mt-1 text-sm font-black text-green-600">
                                            منتخب
                                        </p>

                                    </div>

                                </label>


                                <label class="cursor-pointer">

                                    <input type="radio" name="is_elected" value="0" class="peer sr-only"
                                        {{ old('is_elected', '0') === '0' ? 'checked' : '' }}>

                                    <div
                                        class="rounded-2xl border-2 border-slate-100 p-4 text-center transition peer-checked:border-red-400 peer-checked:bg-red-50">

                                        <x-icons.x class="mx-auto h-6 w-6 text-red-500" />

                                        <p class="mt-1 text-sm font-black text-red-600">
                                            غير منتخب
                                        </p>

                                    </div>

                                </label>

                            </div>

                        </div>


                        <div class="flex flex-col gap-3 pt-3 sm:flex-row">

                            <button type="submit"
                                class="flex-1 rounded-2xl bg-gradient-to-l from-sky-500 to-blue-600 px-5 py-3.5 text-sm font-black text-white transition hover:-translate-y-0.5 hover:shadow-lg">
                                حفظ الشخص
                            </button>

                            <a href="{{ route('admin.people.index') }}"
                                class="flex-1 rounded-2xl border border-slate-200 px-5 py-3.5 text-center text-sm font-bold text-slate-500 transition hover:bg-slate-50">
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
