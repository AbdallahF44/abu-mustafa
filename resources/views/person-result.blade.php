<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $person->name }} | أبو مصطفى</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<body class="min-h-screen bg-gradient-to-br from-sky-50 via-white to-blue-50">

    <div class="min-h-screen px-4 py-8 sm:py-12">

        <div class="mx-auto max-w-2xl">


            {{-- Header --}}
            <div class="mb-6 flex items-center justify-between">

                <a href="{{ route('home') }}"
                    class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-bold text-slate-500 transition hover:bg-white hover:text-sky-600">

                    <span>→</span>

                    بحث جديد

                </a>

            </div>


            {{-- Profile Card --}}
            <div class="overflow-hidden rounded-[2rem] border border-white bg-white shadow-2xl shadow-sky-100">


                {{-- Top --}}
                <div class="bg-gradient-to-l from-sky-500 to-blue-600 px-6 py-8 text-white sm:px-8">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/20 backdrop-blur">

                            <x-icons.user class="h-8 w-8" />

                        </div>


                        <div>

                            <p class="text-sm font-medium text-sky-100">
                                أهلاً بك
                            </p>

                            <h1 class="mt-1 text-2xl font-bold">
                                {{ $person->name }}
                            </h1>

                        </div>

                    </div>

                </div>


                {{-- Information --}}
                <div class="space-y-4 p-5 sm:p-8">


                    {{-- ID --}}
                    <div class="flex items-center gap-4 rounded-2xl bg-slate-50 p-4 transition hover:bg-sky-50">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">

                            <x-icons.id-card class="h-5 w-5" />

                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400">
                                رقم الهوية
                            </p>

                            <p class="mt-1 font-bold tracking-wide text-slate-700">
                                {{ $person->national_id }}
                            </p>

                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="flex items-center gap-4 rounded-2xl bg-slate-50 p-4 transition hover:bg-sky-50">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-600">

                            <x-icons.phone class="h-5 w-5" />

                        </div>

                        <div>

                            <p class="text-xs font-bold text-slate-400">
                                رقم الجوال
                            </p>

                            <p class="mt-1 font-bold tracking-wide text-slate-700">
                                {{ $person->phone ?: 'غير متوفر' }}
                            </p>

                        </div>

                    </div>


                    {{-- Status --}}
                    <div
                        class="
                        flex items-center gap-4 rounded-2xl p-4
                        {{ $person->is_elected ? 'bg-green-50' : 'bg-red-50' }}
                    ">

                        <div
                            class="
                            flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                            {{ $person->is_elected ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}
                        ">

                            @if ($person->is_elected)
                                <x-icons.check class="h-6 w-6" />
                            @else
                                <x-icons.x class="h-6 w-6" />
                            @endif

                        </div>


                        <div>

                            <p class="text-xs font-bold text-slate-400">
                                الحالة
                            </p>

                            <p
                                class="
                                mt-1 font-bold
                                {{ $person->is_elected ? 'text-green-600' : 'text-red-600' }}
                            ">
                                {{ $person->is_elected ? 'منتخب' : 'غير منتخب' }}
                            </p>

                        </div>

                    </div>


                    {{-- Note --}}
                    <div class="border-t border-slate-100 pt-6">

                        <h2 class="mb-3 text-sm font-bold text-slate-700">
                            إرسال ملاحظة
                        </h2>

                        <form method="POST" action="{{ route('person.note.store', $person) }}">

                            @csrf


                            <textarea name="message" rows="4" required placeholder="اكتب ملاحظتك هنا..."
                                class="w-full resize-none rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-medium outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">{{ old('message') }}</textarea>


                            @error('message')
                                <p class="mt-2 text-xs font-bold text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror


                            <button type="submit"
                                class="cursor-pointer mt-3 flex w-full items-center justify-center gap-2 rounded-2xl bg-sky-500 px-5 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-sky-600">

                                <x-icons.notes class="h-5 w-5" />

                                إرسال الملاحظة

                            </button>

                        </form>

                    </div>


                    @if (session('note_success'))
                        <div
                            class="rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-bold text-green-600">

                            ✓ {{ session('note_success') }}

                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

</body>

</html>
