<span class="flex items-center" id="review-stars">
    @for ($i = 1; $i <= 5; $i++)
        <svg class="w-5 h-5 cursor-pointer {{ $selected >= $i ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" data-value="{{ $i }}" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.966c.3.921-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.197-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118L2.049 9.394c-.783-.57-.38-1.81.588-1.81h4.175a1 1 0 00.95-.69l1.286-3.967z"/>
        </svg>
    @endfor
</span>

<input type="hidden" name="rating" id="rating-value" value="{{ $selected }}">
<script>
    document.querySelectorAll('#review-stars svg').forEach(star => {
        star.addEventListener('click', function() {
            let value = this.getAttribute('data-value');
            document.getElementById('rating-value').value = value;
            document.querySelectorAll('#review-stars svg').forEach((s, idx) => {
                s.classList.toggle('text-yellow-400', idx < value);
                s.classList.toggle('text-gray-300', idx >= value);
            });
        });
    });
</script>
