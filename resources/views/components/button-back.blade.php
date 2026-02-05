@props([
    'label' => '',
    'url' => null
])

<a href="{{ $url ?? url()->previous() }}" class="inline-flex items-center text-gray-600 hover:text-primary-600 mb-4">
    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    {{ $label ?? 'Back' }}
</a>
