<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CurrencyController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Currencies/Index', [
            'currencies' => Currency::with('rate')->paginate(12)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Currencies/Create');
    }

    public function store(CurrencyRequest $request): RedirectResponse
    {
        $currency = Currency::create($request->all([
            'name',
            'symbol',
            'acronym'
        ]));
        Rate::create([
            'rate' => $request->rate,
            'currency_id' => Currency::first()->id,
            'to_currency_id' => $currency->id,
            'active' => true,
        ]);
        return redirect()->route('currencies.index');
    }

    public function show(Currency $currency)
    {
        //
    }

    public function edit(Currency $currency): Response
    {
        $currency->load('rate');
        return Inertia::render('Currencies/Edit',compact('currency'));
    }

    public function update(CurrencyRequest $request, Currency $currency): RedirectResponse
    {
        $currency->update($request->all([
            'name',
            'symbol',
            'acronym'
        ]));
        $has = Rate::where('to_currency_id', $currency->id)->count();
        if($has > 0){
            Rate::where('to_currency_id', $currency->id)->update([
                'active' => false,
            ]);
            Rate::create([
                'rate' => $request->rate,
                'currency_id' => Currency::first()->id,
                'to_currency_id' => $currency->id,
                'active' => true,
            ]);
        }
        return redirect()->route('currencies.index');
    }

    public function destroy(Currency $currency): RedirectResponse
    {
        $currency->delete();
        return redirect()->route('currencies.index');
    }
}
