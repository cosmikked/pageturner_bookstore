@props([
    'action' => null,
    'color' => ''
])

<form action="{{ $action }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="btn btn-link p-0 {{ $color ?? 'text-danger' }}"
            title="Delete"
            onclick="return confirm('Are you sure?')">
        <i class="bi bi-trash"></i>
    </button>
</form>
