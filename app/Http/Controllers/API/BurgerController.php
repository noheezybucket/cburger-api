<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BurgerResource;
use App\Models\Burger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BurgerController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $burgers = Burger::all();

        return $this->sendResponse(BurgerResource::collection($burgers), 'Burgers fetched successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $burger = Burger::create($input);

        return $this->sendResponse(new BurgerResource($burger), 'Burger created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $burger = Burger::find($id);
        if (is_null($burger)) {
            return $this->sendError('Burger not found.');
        }

        return $this->sendResponse(new BurgerResource($burger), 'Burger fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $burger = Burger::find($id);

        if (is_null($burger)) {
            return $this->sendError('Burger not found.');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $burger->update($input);

        return $this->sendResponse(new BurgerResource($burger), 'Burger updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $burger = Burger::find($id);

        if (is_null($burger)) {
            return $this->sendError('Burger not found.');
        }

        $burger->delete();

        return $this->sendResponse([], 'Burger deleted successfully.');
    }
}
