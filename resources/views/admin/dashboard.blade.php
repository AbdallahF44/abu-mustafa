<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>لوحة التحكم | أبو مصطفى</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

</head>

<body class="min-h-screen bg-slate-50">

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

                        <p class="text-xs text-slate-400">
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

                    <p class="mt-1 truncate text-sm font-bold text-slate-700">
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

            {{-- Navigation --}}
            <nav class="flex-1 space-y-2 p-4">


                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-2xl bg-sky-50 px-4 py-3.5 text-sm font-bold text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-sky-100">

                        <x-icons.dashboard class="h-5 w-5" />

                    </span>

                    لوحة التحكم

                </a>


                <a href="{{ route('admin.people.index') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">

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
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">

                        <x-icons.notes class="h-5 w-5" />

                    </span>

                    الملاحظات

                </a>

            </nav>




        </aside>


        {{-- Main --}}
        <main class="min-w-0 flex-1">


            {{-- Header --}}
            <header
                class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6 lg:px-8">

                <div class="flex items-center gap-3">

                    <button onclick="openSidebar()"
                        class="rounded-xl p-2.5 text-slate-600 hover:bg-slate-100 lg:hidden">
                        ☰
                    </button>

                    <div>

                        <p class="text-xs font-bold text-sky-500">
                            الإدارة
                        </p>

                        <h2 class="font-bold text-slate-800">
                            لوحة التحكم
                        </h2>

                    </div>

                </div>

            </header>


            {{-- Content --}}
            <div class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

                <div class="mx-auto max-w-7xl">


                    <div class="mb-8">

                        <p class="text-sm font-bold text-sky-500">
                            مرحباً بك
                        </p>

                        <h1 class="mt-1 text-2xl font-bold text-slate-800 sm:text-3xl">
                            لوحة التحكم
                        </h1>

                    </div>


                    {{-- Statistics --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


                        {{-- Total --}}
                        <a href="{{ route('admin.people.index') }}"
                            class="group block cursor-pointer rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-bold text-slate-400">
                                        إجمالي الأشخاص
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-slate-800">
                                        {{ $totalPeople ?? 0 }}
                                    </p>

                                </div>

                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50 text-sky-500 transition group-hover:scale-110">

                                    <x-icons.users class="h-7 w-7" />

                                </div>

                            </div>

                        </a>


                        {{-- Elected --}}
                        <a href="{{ route('admin.people.index', ['status' => 'elected']) }}"
                            class="group block cursor-pointer rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-bold text-slate-400">
                                        المنتخبون
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-green-600">
                                        {{ $electedPeople ?? 0 }}
                                    </p>

                                </div>

                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-50 text-green-500 transition group-hover:scale-110">

                                    <x-icons.check class="h-7 w-7" />

                                </div>

                            </div>

                        </a>

                        {{-- Not elected --}}
                        <a href="{{ route('admin.people.index', ['status' => 'not_elected']) }}"
                            class="group block cursor-pointer rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-bold text-slate-400">
                                        غير المنتخبين
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-red-500">
                                        {{ $notElectedPeople ?? 0 }}
                                    </p>

                                </div>

                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-red-500 transition group-hover:scale-110">

                                    <x-icons.x class="h-7 w-7" />

                                </div>

                            </div>

                        </a>

                    </div>


                    {{-- Quick Actions --}}
                    <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2">


                        <a href="{{ route('admin.people.index') }}"
                            class="group rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-xl">

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50 text-sky-500 transition group-hover:scale-110">

                                    <x-icons.users class="h-7 w-7" />

                                </div>

                                <div>

                                    <h3 class="font-bold text-slate-800">
                                        إدارة الأشخاص
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-400">
                                        عرض وتعديل وإضافة الأشخاص
                                    </p>

                                </div>

                            </div>

                        </a>


                        <a href="{{ route('admin.notes.index') }}"
                            class="group rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-xl">

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-50 text-sky-500 transition group-hover:scale-110">

                                    <x-icons.notes class="h-7 w-7" />

                                </div>

                                <div>

                                    <h3 class="font-bold text-slate-800">
                                        الملاحظات
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-400">
                                        مراجعة الملاحظات المرسلة
                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                </div>

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

</body>

</html>
