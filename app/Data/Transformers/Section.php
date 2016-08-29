<?php

namespace App\Data\Transformers;

use League\Fractal\TransformerAbstract;

class Section extends TransformerAbstract
{
    /**
     * Transform a formatted array for a given section
     *
     * @param App\Models\Section $section
     * @return array
     */
    public function transform(\App\Models\Section $section): array
    {
        return [
            'id' => $section->id,
            'name' => $section->name,
            'description' => $section->description,
            'content' => $section->content,
            'created' => $section->created_at->diffForHumans(),
            'updated' => $section->updated_at->diffForHumans()
        ];
    }
}