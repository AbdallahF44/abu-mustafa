<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الأشخاص | لوحة الإدارة</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<body class="min-h-screen bg-slate-50 ">

    <div class="flex min-h-screen">


        {{-- Overlay --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-slate-900/40 backdrop-blur-sm lg:hidden"
            onclick="closeSidebar()"></div>


        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 right-0 z-50 flex w-72 translate-x-full flex-col border-l border-slate-200 bg-white shadow-xl transition-transform duration-300 lg:static lg:translate-x-0 lg:shadow-none">

            <div class="flex h-20 items-center justify-between border-b border-slate-100 px-6">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-400 to-blue-600 text-white shadow-lg shadow-sky-200">

                        <div
                            class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-slate-200">

                            <img src="{{ asset('images/logo.png') }}" alt="أبو مصطفى"
                                class="h-full w-full object-cover">

                        </div>

                    </div>

                    <div>

                        <h1 class="font-bold text-slate-800">
                            أبو مصطفى
                        </h1>

                        <p class="text-xs font-bold text-slate-400">
                            لوحة الإدارة
                        </p>

                    </div>

                </div>

                <button onclick="closeSidebar()" class="rounded-xl p-2 text-slate-400 hover:bg-slate-100 lg:hidden">
                    ✕
                </button>

            </div>

            <div class="border-t border-slate-100 p-4">

                <div class="mb-3 rounded-2xl bg-sky-50 p-4">

                    <p class="text-xs font-bold text-sky-600">
                        المسؤول
                    </p>

                    <p class="mt-1 truncate text-sm font-black text-slate-700">
                        {{ auth()->user()->name }}
                    </p>

                </div>


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                        class="cursor-pointer flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold text-red-500 transition hover:bg-red-50">

                        <x-icons.logout class="h-5 w-5" />

                        تسجيل الخروج

                    </button>

                </form>

            </div>

            <nav class="flex-1 space-y-2 p-4">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">
                        <x-icons.dashboard class="h-5 w-5" />
                    </span>

                    لوحة التحكم

                </a>


                <a href="{{ route('admin.people.index') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-100">
                        <x-icons.users class="h-5 w-5" />
                    </span>

                    الأشخاص

                </a>


                <a href="{{ route('admin.people.create') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">
                        <x-icons.plus class="h-5 w-5" />
                    </span>

                    إضافة شخص

                </a>


                <a href="{{ route('admin.notes.index') }}"
                    class="flex items-center gap-3 rounded-2xl bg-sky-50 px-4 py-3.5 text-sm font-bold text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">
                        <x-icons.notes class="h-5 w-5" />
                    </span>

                    الملاحظات

                </a>

            </nav>




        </aside>


        <main class="min-w-0 flex-1">
            <header
                class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    <button onclick="openSidebar()"
                        class="rounded-xl p-2.5 text-slate-600 hover:bg-slate-100 lg:hidden">
                        ☰
                    </button>

                    <div>

                        <p class="text-xs font-bold text-sky-500">
                            إدارة البيانات
                        </p>

                        <h2 class="font-bold text-slate-800">
                            الملاحظات
                        </h2>

                    </div>

                </div>




            </header>

            <div class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">





                <div class="mb-7">

                    <p class="text-sm font-bold text-sky-500">
                        تواصل المستخدمين
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-slate-800">
                        الملاحظات المرسلة
                    </h2>

                </div>

                @if (session('success'))
                    <div
                        class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-bold text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
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

                                        <h3 class="font-bold text-slate-800">
                                            {{ $note->person->name ?? 'شخص محذوف' }}
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $note->created_at->format('Y-m-d H:i') }}
                                        </p>

                                    </div>

                                </div>


                                @if ($note->status == 'reviewed')
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-bold text-green-600">

                                        <x-icons.check class="h-4 w-4" />

                                        تمت المراجعة

                                    </span>
                                @else
                                    <span
                                        class="inline-flex rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-600">
                                        جديدة
                                    </span>
                                @endif

                            </div>


                            <div class="mt-5 rounded-2xl bg-slate-50 p-4">

                                <p class="text-sm leading-7 text-slate-600">
                                    {{ $note->message }}
                                </p>

                            </div>


                            <div class="mt-4 flex flex-wrap gap-2">


                                @if (!$note->status == 'reviewed')
                                    <form method="POST" action="{{ route('admin.notes.review', $note) }}">

                                        @csrf

                                        @method('PATCH')

                                        <button type="submit"
                                            class="flex items-center gap-2 rounded-xl bg-green-50 px-4 py-2.5 text-xs font-bold text-green-600 transition hover:bg-green-100">

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
                                        class="flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-xs font-bold text-red-500 transition hover:bg-red-100">

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

                            <h3 class="font-bold text-slate-700">
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


    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
    <script>
        function toggleExcelImport() {

            const box = document.getElementById('excelImportBox');

            if (box.classList.contains('hidden')) {

                box.classList.remove('hidden');

                box.style.opacity = '0';
                box.style.transform = 'translateY(-10px)';

                requestAnimationFrame(() => {

                    box.style.transition = 'all 0.3s ease';

                    box.style.opacity = '1';
                    box.style.transform = 'translateY(0)';

                });

            } else {

                box.style.transition = 'all 0.25s ease';

                box.style.opacity = '0';
                box.style.transform = 'translateY(-10px)';

                setTimeout(() => {
                    box.classList.add('hidden');
                }, 250);

            }

        }
    </script>
</body>

</html>
