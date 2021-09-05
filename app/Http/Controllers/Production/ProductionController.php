<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Production\Hold;
use App\Models\Production\Product;
use App\Models\Production\Car;
use App\Http\Requests\BackRequest;
use App\Http\Requests\TransferRequest;

class ProductionController extends Controller
{

    public function getCars()
    {

        $all = Car::with(['holds.car', 'products.car'])->get();

        return response()->json(['all' => $all]);
    }

    public function transfer(TransferRequest $request)
    {

        $trasferData = [];

        foreach ($request->data as $key => $value) {
            Hold::create(
                [

                    'car_id' => $value['car_id'],

                    'vin' => $value['vin']

                ]
            );

            Product::find($value['id'])->delete();


            array_push(
                $trasferData,
                [
                    'result' => $value
                ]
            );
        }

        return response()->json(['data' => $trasferData]);
    }

    public function backTransfer(BackRequest $request)
    {
        $holdData = [];

        foreach ($request->data as $key => $value) {
            Product::create(
                [

                    'car_id' => $value['car_id'],
                    'vin' => $value['vin']

                ]
            );

            Hold::find($value['id'])->delete();

            array_push($holdData, [

                'result' => $value
            ]);
        }

        return response()->json(['data' => $holdData]);
    }

    public function getProducts($name)
    {
        $productsId = Product::query()->select('product_detail.vin', 'product_detail.id', 'product_detail.car_id')
            ->leftJoin('cars', function ($join) {
                $join->on('product_detail.car_id', '=', 'cars.id');
            })
            ->where('cars.name', $name)->with('car')->get();

        return response()->json(['productsId' => $productsId]);
    }

    public function getHolds($name)
    {
        $holdsId = Hold::query()->select('hold.vin', 'hold.id', 'hold.car_id')
            ->leftJoin('cars', function ($join) {
                $join->on('hold.car_id', '=', 'cars.id');
            })
            ->where('cars.name', $name)->with('car')->get();

        return response()->json(['holdsId' => $holdsId]);
    }
}
