@props([
    'href' => '',
    'color' => ''
])

<a href="{{ $href }}"
   class="btn btn-link p-0 {{ $color ?? '' }}"
   title="Edit">
    <i class="bi bi-pencil"></i>
</a>
