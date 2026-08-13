<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>الأشخاص | لوحة الإدارة</title>

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

            <nav class="flex-1 space-y-2 p-4">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">
                        <x-icons.dashboard class="h-5 w-5" />
                    </span>

                    لوحة التحكم

                </a>


                <a href="{{ route('admin.people.index') }}"
                    class="flex items-center gap-3 rounded-2xl bg-sky-50 px-4 py-3.5 text-sm font-bold text-sky-600">

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
                    class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">

                    <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100">
                        <x-icons.notes class="h-5 w-5" />
                    </span>

                    الملاحظات

                </a>

            </nav>




        </aside>


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
                            إدارة البيانات
                        </p>

                        <h2 class="font-bold text-slate-800">
                            الأشخاص
                        </h2>

                    </div>

                </div>


                <a href="{{ route('admin.people.create') }}"
                    class="flex items-center gap-2 rounded-xl bg-sky-500 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-sky-600">

                    <x-icons.plus class="h-4 w-4" />

                    إضافة

                </a>

            </header>


            <div class="px-4 py-6 sm:px-6 lg:px-8 lg:py-8">

                <div class="mx-auto max-w-7xl">


                    @if (session('success'))
                        <div
                            class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-bold text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif


                    @if (session('error'))
                        <div
                            class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif


                    {{-- Page title --}}
                    <div class="mb-7">

                        <p class="text-sm font-bold text-sky-500">
                            قاعدة البيانات
                        </p>

                        <h1 class="mt-1 text-2xl font-bold text-slate-800 sm:text-3xl">
                            قائمة الأشخاص
                        </h1>

                    </div>


                    {{-- Excel Import Button --}}
                    <div class="mb-6 flex justify-start">

                        <button type="button" onclick="toggleExcelImport()"
                            class="cursor-pointer inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-sky-100 transition duration-300 hover:-translate-y-0.5 hover:bg-sky-600 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>

                            إضافة ملف Excel
                        </button>

                    </div>


                    {{-- Excel Import Section --}}
                    <div id="excelImportBox"
                        class="mb-8 hidden overflow-hidden rounded-3xl border border-sky-100 bg-white shadow-sm">

                        <div class="border-b border-slate-100 bg-sky-50/50 px-6 py-5">

                            <div class="flex items-center justify-between gap-4">

                                <div>

                                    <h2 class="text-lg font-bold text-slate-800">
                                        إضافة الأشخاص من Excel
                                    </h2>

                                    <p class="mt-1 text-sm text-slate-400">
                                        ارفع ملف Excel يحتوي على الاسم، رقم الهوية، ورقم الجوال.
                                    </p>

                                </div>

                                <button type="button" onclick="toggleExcelImport()"
                                    class="cursor-pointer flex h-9 w-9 items-center justify-center rounded-xl bg-white text-slate-400 transition duration-300 hover:bg-red-50 hover:text-red-500">
                                    ✕
                                </button>

                            </div>

                        </div>


                        <div class="p-6">

                            <form action="{{ route('admin.people.import') }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">

                                @csrf


                                {{-- File --}}
                                <div>

                                    <label for="excel_file" class="mb-2 block text-sm font-bold text-slate-700">
                                        ملف Excel
                                    </label>

                                    <div
                                        class="relative flex min-h-[120px] w-full items-center justify-center rounded-2xl border-2 border-dashed border-sky-200 bg-sky-50/50 p-6 text-center transition hover:border-sky-400 hover:bg-sky-50">
                                        <input id="excel_file" type="file" name="file" accept=".xlsx,.xls,.csv"
                                            required
                                            class="absolute inset-0 z-50 h-full w-full cursor-pointer opacity-0"
                                            onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'لم يتم اختيار ملف'">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <x-icons.upload class="h-8 w-8 text-sky-500" />
                                            <p class="text-sm font-semibold text-slate-700">
                                                اضغط هنا لرفع ملف Excel أو اسحبه إلى هنا
                                            </p>
                                            <p class="text-xs text-slate-400">
                                                الصيغ المسموحة: XLSX, XLS, CSV
                                            </p>
                                            <span id="file-name"
                                                class="mt-2 rounded-lg bg-sky-500 px-3 py-1 text-xs font-bold text-white shadow-sm empty:hidden"></span>
                                        </div>
                                    </div>
                                </div>


                                {{-- Election Status --}}
                                <div>

                                    <p class="mb-3 text-sm font-bold text-slate-700">
                                        حالة الأشخاص في الملف
                                    </p>

                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                                        {{-- Selected --}}
                                        <label class="cursor-pointer">

                                            <input type="radio" name="is_elected" value="1"
                                                class="peer sr-only" checked>

                                            <div
                                                class="rounded-2xl border-2 border-slate-100 p-4 transition duration-300 hover:border-green-200 peer-checked:border-green-400 peer-checked:bg-green-50">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-100 text-green-600">

                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>

                                                    </div>

                                                    <div>

                                                        <p class="font-bold text-slate-700">
                                                            منتخب
                                                        </p>

                                                        <p class="text-xs text-slate-400">
                                                            جميع الأشخاص في الملف سيكونون منتخبين
                                                        </p>

                                                    </div>

                                                </div>

                                            </div>

                                        </label>


                                        {{-- Not Selected --}}
                                        <label class="cursor-pointer">

                                            <input type="radio" name="is_elected" value="0"
                                                class="peer sr-only">

                                            <div
                                                class="rounded-2xl border-2 border-slate-100 p-4 transition duration-300 hover:border-red-200 peer-checked:border-red-400 peer-checked:bg-red-50">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-red-100 text-red-600">

                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>

                                                    </div>

                                                    <div>

                                                        <p class="font-bold text-slate-700">
                                                            غير منتخب
                                                        </p>

                                                        <p class="text-xs text-slate-400">
                                                            جميع الأشخاص في الملف سيكونون غير منتخبين
                                                        </p>

                                                    </div>

                                                </div>

                                            </div>

                                        </label>

                                    </div>

                                </div>


                                {{-- Submit --}}
                                <div class="flex justify-end">

                                    <button type="submit"
                                        class="cursor-pointer inline-flex items-center gap-2 rounded-2xl bg-gradient-to-l from-sky-500 to-blue-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-sky-100 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl">

                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>

                                        استيراد الأشخاص

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                    {{-- Search + Filters --}}
                    <div class="mb-6 rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">


                        <form method="GET" action="{{ route('admin.people.index') }}"
                            class="flex flex-col gap-3 sm:flex-row">

                            <div class="relative flex-1">

                                <x-icons.search
                                    class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" />

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="ابحث بالاسم أو رقم الهوية..."
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3.5 pr-11 pl-4 text-sm outline-none transition focus:border-sky-400 focus:bg-white focus:ring-4 focus:ring-sky-100">

                            </div>


                            <button type="submit"
                                class="cursor-pointer rounded-2xl bg-slate-800 px-6 py-3.5 text-sm font-bold text-white transition hover:bg-slate-700">
                                بحث
                            </button>

                        </form>


                        {{-- Status --}}
                        <div class="mt-5 border-t border-slate-100 pt-5">

                            <p class="mb-3 text-sm font-bold text-slate-700">
                                تصفية حسب الحالة
                            </p>


                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">


                                <a href="{{ route('admin.people.index', ['search' => request('search')]) }}"
                                    class="flex items-center justify-center gap-2 rounded-2xl border-2 px-4 py-3 text-sm font-bold transition
                                {{ !request()->has('status')
                                    ? 'border-sky-400 bg-sky-50 text-sky-600'
                                    : 'border-slate-100 text-slate-500 hover:border-sky-200' }}">

                                    <x-icons.users class="h-5 w-5" />

                                    الكل

                                </a>


                                <a href="{{ route('admin.people.index', ['status' => 'elected', 'search' => request('search')]) }}"
                                    class="flex items-center justify-center gap-2 rounded-2xl border-2 px-4 py-3 text-sm font-bold transition
                                {{ request('status') === 'elected'
                                    ? 'border-green-400 bg-green-50 text-green-600'
                                    : 'border-slate-100 text-slate-500 hover:border-green-200' }}">

                                    <x-icons.check class="h-5 w-5" />

                                    المنتخبون

                                </a>


                                <a href="{{ route('admin.people.index', ['status' => 'not_elected', 'search' => request('search')]) }}"
                                    class="flex items-center justify-center gap-2 rounded-2xl border-2 px-4 py-3 text-sm font-bold transition
                                {{ request('status') === 'not_elected'
                                    ? 'border-red-400 bg-red-50 text-red-600'
                                    : 'border-slate-100 text-slate-500 hover:border-red-200' }}">

                                    <x-icons.x class="h-5 w-5" />

                                    غير المنتخبين

                                </a>

                            </div>

                        </div>

                    </div>


                    {{-- Table --}}
                    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm">

                        <div class="overflow-x-auto">

                            <table class="w-full min-w-[850px] text-right">

                                <thead class="bg-slate-50">

                                    <tr class="text-xs font-bold text-slate-500">

                                        <th class="px-5 py-4">
                                            الاسم
                                        </th>

                                        <th class="px-5 py-4">
                                            الهوية
                                        </th>

                                        <th class="px-5 py-4">
                                            الجوال
                                        </th>

                                        <th class="px-5 py-4">
                                            الحالة
                                        </th>

                                        <th class="px-5 py-4">
                                            الإجراءات
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-slate-100">

                                    @forelse($people as $person)
                                        <tr class="transition duration-200 hover:bg-sky-50/40">


                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-500">

                                                        <x-icons.user class="h-5 w-5" />

                                                    </div>

                                                    <span class="font-bold text-slate-700">
                                                        {{ $person->name }}
                                                    </span>

                                                </div>

                                            </td>


                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-2 font-bold text-slate-600">

                                                    <x-icons.id-card class="h-4 w-4 text-sky-500" />

                                                    {{ $person->national_id }}

                                                </div>

                                            </td>


                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-2 text-sm text-slate-500">

                                                    <x-icons.phone class="h-4 w-4 text-slate-400" />

                                                    {{ $person->phone ?: 'غير متوفر' }}

                                                </div>

                                            </td>


                                            <td class="px-5 py-4">

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

                                            </td>


                                            <td class="px-5 py-4">

                                                <div class="flex items-center gap-2">


                                                    <a href="{{ route('admin.people.edit', $person) }}"
                                                        class="flex items-center gap-1.5 rounded-xl bg-sky-50 px-3 py-2 text-xs font-bold text-sky-600 transition hover:bg-sky-100">

                                                        <x-icons.edit class="h-4 w-4" />

                                                        تعديل

                                                    </a>


                                                    <form method="POST"
                                                        action="{{ route('admin.people.destroy', $person) }}"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟')">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="flex items-center gap-1.5 rounded-xl bg-red-50 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-100">

                                                            <x-icons.trash class="h-4 w-4" />

                                                            حذف

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="px-6 py-16 text-center">

                                                <div
                                                    class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 text-slate-400">

                                                    <x-icons.users class="h-8 w-8" />

                                                </div>

                                                <h3 class="font-bold text-slate-700">
                                                    لا يوجد أشخاص
                                                </h3>

                                                <p class="mt-1 text-sm text-slate-400">
                                                    لم يتم العثور على بيانات مطابقة.
                                                </p>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>


                        @if ($people->hasPages())
                            <div class="border-t border-slate-100 p-5">

                                {{ $people->withQueryString()->links() }}

                            </div>
                        @endif

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
