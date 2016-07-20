<?php

namespace App\Data\Transformers;

use App\Models\Terms;
use League\Fractal\TransformerAbstract;

class Terms extends TransformerAbstract
{
    /**
     * Terms transformer
     *
     * @param App\Models\Terms $terms
     * @return array
     */
    public function transform(Terms $terms): array
    {
        $sections = $this->getSectionsByPattern($terms->pattern);

        return [
            'id' => $terms->id,
            'active' => $terms->active,
            'type' => $terms->type,
            'name' => $terms->name,
            'description' => $terms->description,
            'sections' => $sections,
            'created' => $terms->created_at->diffForHumans(),
            'updated' => $terms->updated_at->diffForHumans()
        ];
    }

    /**
     * Return an array of all the terms and condition sections
     *
     * @param string $pattenr
     * @return array
     */
    private function getSectionsByPattern($pattern): array
    {
        if (is_null($pattern)) {
            return [];
        }

        $pieces = explode('-', $pattern);

        return $this->buildSectionsFromPieces($pieces);
    }

    /**
     * Return an array of sections from the pieces
     *
     * @param array $pieces
     * @return array
     */
    private function buildSectionsFromPieces(array $pieces): array
    {
        $collection = collect($pieces);

        $sections = $collection->map(function($piece) {
            $section = \App\Models\Section::find($piece);

            return [
                'id' => $section->id,
                'name' => $section->name,
                'content' => $section->content
            ];
        })->toArray();

        return $sections;
    }
}