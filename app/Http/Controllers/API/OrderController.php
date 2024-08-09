<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\InvoiceEmail;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $orders = Order::all();
        $orders = Order::with('burger')->get();

        return $this->sendResponse(OrderResource::collection($orders), 'Orders, fetched successfully. ');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'burger_id' => 'required',
            'client_firstname' => 'required',
            'client_lastname' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $order = Order::create($input);

        return $this->sendResponse(new OrderResource($order), 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $order = Order::find($id);
        $order = Order::with('burger')->findOrFail($id);
        if (is_null($order)) {
            return $this->sendError('Order not found.');
        }

        return $this->sendResponse(new OrderResource($order), 'Order fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return $this->sendError('Order not found.');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'burger_id' => 'required',
            'client_firstname' => 'required',
            'client_lastname' => 'required',
            'client_phone' => 'required',
            'client_address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($request->status === "Terminer") {
            Mail::to('seydinag023@gmail.com')->send(new InvoiceEmail([
                'client_firstname' => $request->client_firstname,
                'client_lastname' => $request->client_lasttname,
                'status' => $request->status,
                'burger' => "Burger Kat cheese",
                'price' => 2000
            ]));
        }

        $order->update($input);

        return $this->sendResponse(new OrderResource($order), 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        if (is_null($order)) {
            return $this->sendError('Order not found.');
        }

        $order->delete();
        return $this->sendResponse([], 'Burger deleted successfully.');
    }
}
