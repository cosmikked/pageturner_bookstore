@props([
    'user' => null
])

<div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 32px; height: 32px; font-weight: bold; font-size: 1rem; user-select: none;">
    @if($user?->avatar)
        <img src="{{ $user->avatar }}" alt="profile" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;" />
    @else
        {{ strtoupper(substr($user?->name ?? 'U', 0, 1)) }}
    @endif
</div>
