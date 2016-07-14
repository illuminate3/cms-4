<?php

namespace App\Data\Transformers;

use League\Fractal\Resource\{
    Item,
    Collection
};

use App\Models\Terms;
use App\Models\TermSection;
use League\Fractal\TransformerAbstract;

class Term extends TransformerAbstract
{
    /**
     * Return a formatted array of terms
     *
     * @param App\Models\Term $term
     * @return array
     */
    public function transform(Terms $term): array
    {
        $sections = $this->getTermsSections($term->pattern);

        return [
            'id' => $term->id,
            'active' => $term->active,
            'type' => $term->type()->first()->type,
            'typeId' => $term->type,
            'pattern' => $term->pattern,
            'description' => $term->description,
            'sections' => $sections,
            'created' => $term->created_at->diffForHumans(),
            'updated' => $term->updated_at->diffForHumans()
        ];
    }

    /**
     * Return an array of all terms and conditions sections
     *
     * @param string $pattern
     * @return array
     */
    private function getTermsSections($pattern): array
    {
        if (strpos($pattern, '-') === false) {
            return [];
        }

        $pieces = explode('-', $pattern);

        return collect($pieces)->map(function($piece) {
            return TermSection::find($piece)->content;
        });
    }
}