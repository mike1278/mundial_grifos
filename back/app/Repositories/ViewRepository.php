<?php

namespace App\Repositories;

use App\Models\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ViewRepository
{
    public static function get($visitableId, $visitableType){
        return View::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(DAY FROM visit_at),"-",EXTRACT(MONTH FROM visit_at)) AS `date`')
            ->where('visitable_id',$visitableId)
            ->where('visitable_type',$visitableType)
            ->where('visit_at','>', \Carbon\Carbon::now()->subMonths(1))
            ->groupByRaw('`date`')
            ->get();
    }

    public static function store(Model $model){
        if(method_exists($model,'visits')){
            return false;
        }
        $visit = View::whereRaw("ip = INET_ATON('".request()->ip()."')")
            ->where('visit_at','>',Carbon::now()->subMinutes(60))
            ->where('visitable_id',$model->getKeyName())
            ->where('visitable_type', get_class($model))
            ->first();
        if(!(
            Auth()->guard('api')->check() &&
            $visit!='' &&
            (
                Auth()->guard('api')->user()->role_id == 1 ||
                (
                    method_exists($model,'user') &&
                    Auth()->guard('api')->user()->id == $model->user()->first()->id
                )
            )
        )){
            $model->addVisit();
        }
    }
}
