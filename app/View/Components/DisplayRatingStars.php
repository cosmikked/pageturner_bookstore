<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DisplayRatingStars extends Component
{
    /**
     * @var $rating: the actual rating average of all reviews on this book
     * @var $reviewCount: the total number of reviews on this book
     * @var $stars: an array that stores the display state of each star based on the
     */

    public $rating;
    public $reviewCount;
    public $stars = [];


    /**
     * Create a new component instance.
     */
    public function __construct(float $rating, int $reviewCount)
    {
        $this->rating = $rating;
        $this->reviewCount = $reviewCount;
        $this->stars = $this->calculateStars($rating);
    }


    protected function calculateStars(float $rating): array
    {
        $stars = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($rating >= $i) {
                $stars[] = 'full';
            } elseif ($rating >= $i - 0.5) {
                $stars[] = 'half';
            } else {
                $stars[] = 'empty';
            }
        }
        return $stars;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.display-rating-stars');
    }
}
