<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Product\ProductResource;

class ProductCollection extends ProductResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name' => $this->name,
            'totalPrice' => round((1 - ($this->discount/100)) * $this->price, 1),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No rating yet',
            'discount' => $this->discount,
            'href' => [
                'link' => route('products.show', $this->id)
            ]
            ];
    }
}
