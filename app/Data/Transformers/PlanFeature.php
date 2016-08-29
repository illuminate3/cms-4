<?php

namespace App\Data\Transformers;

use League\Fractal\TransformerAbstract;

class PlanFeature extends TransformerAbstract
{
    /**
     * Transform a collection or single plan feature
     *
     * @param \App\Models\PlanFeature
     * @return array
     */
    public function transform(\App\Models\PlanFeature $feature): array
    {
        return [
            'id' => $feature->id,
            'active' => $feature->active,
            'name' => $feature->name,
            'content' => $feature->content,
            'created' => $feature->created_at->diffForHumans(),
            'updated' => $feature->updated_at->diffForHumans()
        ];
    }
}