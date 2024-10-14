<?php

namespace App\Http\Controllers;

use App\Models\OfferItems;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Offer;

class OfferItemController extends Controller
{
    /**
     * Create a newly created resource in storage.
     */
    public function create(Request $request): JsonResponse
    {
        // Request заменяем на OfferItemRequest для валидации
        // не стал тут делать, пример в OfferController

        // есть offer_id?
        if (!$request->has('offer_id')) {
            // нет, ошибка
            return response()->json([ 'error' => "Missing offer" ], 400);
        }

        // а оффер найден
        if (!$offer = Offer::whereUuid($request->offer_id)->first()) {
            // тоже нет, ошибка
            return response()->json([ 'error' => "Offer not found" ], 404);
        }

        if ($offer->status != 'Новая') {
            return response()->json([ 'error' => 'Cannot be added' ], 503);
        }

        // пытаемся
        try {
            // можем добавить?
            $offer_items = OfferItems::create(
                array_merge(
                    [
                        'offer_id' => $offer->id,
                        'images' => $request->images,
                    ],
                    $request->except([ 'images', 'offer_id' ])
                )
            );
        } catch(\Throwable $e) {
            // нет, опять ошибка
            return response()->json([ 'error' => $e->getCode().$e->getMessage() ], 503);
        }

        // всё добавлено, возвращаем id добавленной записи
        return response()->json([ 'error' => 0, 'result' => [ 'id' => $offer_items->id ] ]);
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(string $id): JsonResponse
    {
        if (!$offer_items = OfferItems::find($id)) {
            return response()->json([ 'error' => "Offer item not found" ], 404);
        }

        if (count($offer_items->images)) {
            foreach ($offer_items->images as $v) {
                if ($v) {
                    // тут удаление фоток
                }
            }
        }

        // пытаемся
        try {
            // можем удалить?
            $offer_items->delete();
        } catch(\Throwable $e) {
            // нет, опять ошибка
            return response()->json([ 'error' => $e->getCode() ], 503);
        }

        return response()->json([ 'error' => 0, 'result' => [ 'Deleted' ] ]);
    }
}
