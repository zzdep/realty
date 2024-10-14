<?php

namespace App\Http\Controllers;

use App\Models\OfferItems;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $offer = Offer::first();

        return view('offer', compact('offer'));
    }

    /**
     * Create a newly created resource in storage.
     */
    public function create(Request $request): JsonResponse
    {
        $uuid = Str::uuid();

        if (Offer::create(array_merge([ 'uuid' => $uuid ], $request->all()))) {
            return response()->json([ 'error' => 0, 'result' => [ 'uuid' => $uuid ] ]);
        }

        return response()->json([ 'error' => '!Adding' ], 503);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferRequest $request, string $id): JsonResponse
    {
        // валидация дана для примера, в боевом проекте она будет другая

        if (!$offer = Offer::whereUuid($id)->first()){
            return response()->json([ 'error' => 'Not found' ], 404);
        }

        try {
            $offer->update(
                $request->only([
                    'b24_manager_id',
                    'manager',
                    'position',
                    'avatar',
                    'status',
                    'date_end'
                ])
            );
        } catch(\Throwable $e) {
            return response()->json([ 'error' => $e->getCode() ], 503);
        }

        return response()->json([ 'error' => 0, 'result' => 'Updated' ]);
    }
}
