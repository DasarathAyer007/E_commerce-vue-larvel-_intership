<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItemResource;


class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'total_price'   => $this->total_price,
            'status'        => $this->status,
            'payment_status'=> $this->payment_status,
            'created_at'    => $this->created_at
                    ->timezone('Asia/Kathmandu')
                    ->format('d M Y, h:i A'),

            'order_items'   => OrderItemResource::collection($this->whenLoaded('orderItems')),

            'shipping_address' => $this->whenLoaded('shippingAddress', function () {
                return [
                    'phone'       => $this->shippingAddress->phone,
                    'address'     => $this->shippingAddress->address,
                    'city'        => $this->shippingAddress->city,
                    'postal_code' => $this->shippingAddress->postal_code,
                ];
            }),
        ];
    }
}
