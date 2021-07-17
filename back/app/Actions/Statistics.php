<?php

namespace App\Actions;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\View;
use Cache;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;

class Statistics
{
    use AsAction;

    public function handle(Request $request): Response
    {
//        Visit::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(DAY FROM visit_at),"-",EXTRACT(MONTH FROM visit_at)) AS `date`')
//            ->where('visitable_id',$visitableId)
//            ->where('visitable_type',$visitableType)
//            ->where('visit_at','>', \Carbon\Carbon::now()->subMonths(1))
//            ->groupByRaw('`date`')
//            ->get();
//        Cache::forget('new-clients');
//        Cache::forget('orders');
//        Cache::forget('products-views');
        $newClients = Cache::remember('new-clients', 216000, function () {
            return Client::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('created_at', '>', Carbon::now()->subMonths(6))
                ->groupByRaw('date')
                ->get();
        });
        $orders = Cache::remember('orders', 216000, function () {
            return Order::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('created_at', '>', Carbon::now()->subMonths(6))
                ->where('complete', true)
                ->groupByRaw('date')
                ->get();
        });
        $productsViews = Cache::remember('products-views', 216000, function () {
            return View::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('viewable_type', Product::class)
                ->where('created_at', '>', Carbon::now()->subMonths(6))
                ->groupByRaw('`date`')
                ->get();
        });
        $listProducts = Product::addSelect(['views' => View::selectRaw('count(id)')
            ->whereColumn('viewable_id', 'products.id')
            ->where('viewable_type', Product::class)
            ->where('created_at', '>', Carbon::now()->subMonths(6))
        ])->orderBy('views','desc')
            ->limit(6)
            ->get();
        return Inertia::render('Dashboard',compact([
            'newClients',
            'productsViews',
            'orders',
            'listProducts',
        ]));
    }
}
