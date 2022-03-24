<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'book' =>  [
                    'id'         => $this->id,
                    'title'      => $this->title,
                    'author'     => $this->author->author_name,
                    'category'   => $this->category->category_name,
                    'publisher'  => $this->publisher->publisher_name,
                    'image'      => image_path().$this->image->image,
                    'pdf'        => pdf_path().$this->pdf->pdf,
                    'created_at' => $this->created_at->toDateTimeString()
                ]
            ]
        ];
    }

    public function with($request)
    {
        return [
            'isSuccess' => true,
            'message' => 'Book created successfully!'
        ];
    }
}
