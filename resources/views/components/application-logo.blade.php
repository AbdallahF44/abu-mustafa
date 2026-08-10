@props(['class' => ''])

<div {{ $attributes->merge(['class' => $class]) }}>
    <div class="flex items-center justify-center">
        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-500 shadow-lg shadow-sky-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0116 0" />
            </svg>
        </div>
    </div>
</div>
