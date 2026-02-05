@props([
    'placeholder' => 'Search...',
])

<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="{{ $placeholder ?? 'Search...' }}">
        {{ $slot }} <!-- For extra filters/dropdowns -->
    </div>
</form>

