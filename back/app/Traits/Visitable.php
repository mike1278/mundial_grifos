<?php

namespace App\Traits;

use App\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

trait Visitable {

    public function scopeAddViews($query,$x){
        return $query->addSelect(['views' => View::selectRaw('count(*)')
            ->whereColumn('viewable_id', $this->getTable().'.'.$this->getKeyName())
            ->where('viewable_type', get_class($this))
        ]);
    }

    /**
     * Get all of the user's registered OAuth clients.
     *
     * @return MorphMany
     */
    public function views(): MorphMany
    {
        return $this->morphMany(View::class,'viewable');
    }

}
