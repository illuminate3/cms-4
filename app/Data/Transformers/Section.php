<?php

namespace App\Data\Transformers;

use App\Models\Section;
use League\Fractal\TransformerAbstract;

class Section extends TransformerAbstract
{
    /**
     * Transform a formatted array for a given section
     *
     * @param App\Models\Section $section
     * @return array
     */
    public function transform(Section $section): array
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