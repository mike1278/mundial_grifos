<?php

namespace App\Actions;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderProduct;
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
        $from = $request->from ?? Carbon::now()->subMonths(6);
        $to = $request->to ?? Carbon::now();
        Cache::forget('new-clients');
        Cache::forget('orders');
        Cache::forget('products-views');
        $newClients = Cache::remember('new-clients', 216000, function () use($from, $to) {
            return Client::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('created_at', '>', $from)
                ->where('created_at', '<', $to)
                ->groupByRaw('date')
                ->get();
        });
        $orders = Cache::remember('orders', 216000, function () use($from, $to) {
            return Order::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('created_at', '>', $from)
                ->where('created_at', '<', $to)
                ->where('complete', true)
                ->groupByRaw('date')
                ->get();
        });
        $productsViews = Cache::remember('products-views', 216000, function () use($from, $to) {
            return View::selectRaw('COUNT(*) as total, CONCAT(EXTRACT(MONTH FROM created_at),"-",EXTRACT(YEAR FROM created_at)) AS `date`')
                ->where('viewable_type', Product::class)
                ->where('created_at', '>', $from)
                ->where('created_at', '<', $to)
                ->groupByRaw('`date`')
                ->get();
        });
        $listProducts = Product::addSelect(['views' => View::selectRaw('count(id)')
            ->whereColumn('viewable_id', 'products.id')
            ->where('viewable_type', Product::class)
            ->where('created_at', '>', $from)
            ->where('created_at', '<', $to)
        ])->orderBy('views','desc')
            ->limit(6)
            ->get();
        $listSells = Product::addSelect(['sells' => OrderProduct::selectRaw('count(order_products.id)')
            ->join('orders','orders.id','=','order_products.order_id')
            ->whereColumn('product_id', 'products.id')
            ->where('orders.created_at', '>', $from)
            ->where('orders.created_at', '<', $to)
        ])->orderBy('sells','desc')
            ->limit(6)
            ->get();

        return Inertia::render('Dashboard',array_merge(
            compact([
                'newClients',
                'productsViews',
                'orders',
                'listProducts',
                'listSells',
            ]),
            [
                'startDate' => $from,
                'endDate' => $to,
            ]
        ));
    }
}
