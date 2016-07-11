<?php

namespace App\Data\Transformers;

use App\Models\Rebuttal;
use League\Fractal\TransformerAbstract;

class Rebuttal extends TransformerAbstract
{
    public function transform(Rebuttal $rebuttal)
    {
        return [
            'id' => $rebuttal->id,
            'active' => $rebuttal->active,
            'name' => $rebuttal->name,
            'body' => $rebuttal->body,
            'created' => $rebuttal->created_at->diffForHumans(),
            'updated' => $rebuttal->updated_at->diffForHumans()
        ];
    }
}