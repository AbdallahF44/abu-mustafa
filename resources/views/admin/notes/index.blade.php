<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الملاحظات | لوحة الإدارة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-slate-50">

    <div class="min-h-screen">


        <header class="border-b border-slate-200 bg-white">

            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    <a href="{{ route('admin.dashboard') }}"
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-sky-50 hover:text-sky-600">
                        ←
                    </a>

                    <div>

                        <p class="text-xs font-bold text-sky-500">
                            لوحة الإدارة
                        </p>

                        <h1 class="font-black text-slate-800">
                            الملاحظات
                        </h1>

                    </div>

                </div>


                <a href="{{ route('admin.people.index') }}"
                    class="flex items-center gap-2 rounded-xl bg-sky-50 px-4 py-2.5 text-sm font-black text-sky-600 transition hover:bg-sky-100">

                    <x-icons.users class="h-4 w-4" />

                    الأشخاص

                </a>

            </div>

        </header>


        <main class="px-4 py-8 sm:px-6 lg:px-8">

            <div class="mx-auto max-w-5xl">


                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-bold text-green-600">
                        {{ session('success') }}
                    </div>
                @endif


                <div class="mb-7">

                    <p class="text-sm font-bold text-sky-500">
                        تواصل المستخدمين
                    </p>

                    <h2 class="mt-1 text-2xl font-black text-slate-800">
                        الملاحظات المرسلة
                    </h2>

                </div>


                <div class="space-y-4">

                    @forelse($notes as $note)
                        <div
                            class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg">

                            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">


                                <div class="flex gap-4">

                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-500">

                                        <x-icons.notes class="h-6 w-6" />

                                    </div>


                                    <div>

                                        <h3 class="font-black text-slate-800">
                                            {{ $note->person->name ?? 'شخص محذوف' }}
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $note->created_at->format('Y-m-d H:i') }}
                                        </p>

                                    </div>

                                </div>


                                @if ($note->reviewed)
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-black text-green-600">

                                        <x-icons.check class="h-4 w-4" />

                                        تمت المراجعة

                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-xs font-black text-amber-600">
                                        جديدة
                                    </span>
                                @endif

                            </div>


                            <div class="mt-5 rounded-2xl bg-slate-50 p-4">

                                <p class="text-sm leading-7 text-slate-600">
                                    {{ $note->note }}
                                </p>

                            </div>


                            <div class="mt-4 flex flex-wrap gap-2">


                                @if (!$note->reviewed)
                                    <form method="POST" action="{{ route('admin.notes.review', $note) }}">

                                        @csrf

                                        @method('PATCH')

                                        <button type="submit"
                                            class="flex items-center gap-2 rounded-xl bg-green-50 px-4 py-2.5 text-xs font-black text-green-600 transition hover:bg-green-100">

                                            <x-icons.check class="h-4 w-4" />

                                            تمت المراجعة

                                        </button>

                                    </form>
                                @endif


                                <form method="POST" action="{{ route('admin.notes.destroy', $note) }}"
                                    onsubmit="return confirm('هل أنت متأكد من حذف الملاحظة؟')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                        class="flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-xs font-black text-red-500 transition hover:bg-red-100">

                                        <x-icons.trash class="h-4 w-4" />

                                        حذف

                                    </button>

                                </form>

                            </div>

                        </div>

                    @empty

                        <div class="rounded-3xl border border-slate-100 bg-white px-6 py-16 text-center shadow-sm">

                            <div
                                class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-slate-400">

                                <x-icons.notes class="h-8 w-8" />

                            </div>

                            <h3 class="font-black text-slate-700">
                                لا توجد ملاحظات
                            </h3>

                            <p class="mt-1 text-sm text-slate-400">
                                لم يتم إرسال أي ملاحظات حتى الآن.
                            </p>

                        </div>
                    @endforelse

                </div>


                @if ($notes->hasPages())
                    <div class="mt-6">

                        {{ $notes->links() }}

                    </div>
                @endif

            </div>

        </main>

    </div>

</body>

</html>
