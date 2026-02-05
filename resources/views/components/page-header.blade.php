@props([
    'title',
    'subtitle' => null,
    'buttonText' => null,
    'buttonUrl' => null,
    'icon' => 'bi-plus'
])

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>{{ $title }}</h1>
        @if($subtitle)
            <div class="text-muted">{{ $subtitle }}</div>
        @endif
    </div>
    @if($buttonText && $buttonUrl)
        <a href="{{ $buttonUrl }}" class="btn btn-primary">
            @if($icon)
                <i class="bi {{ $icon }}"></i>
            @endif
            {{ $buttonText }}
        </a>
    @endif
</div>

