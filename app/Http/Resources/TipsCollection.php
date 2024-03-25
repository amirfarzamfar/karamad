<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TipsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $path = $this->currentPage();

        return [

            'data' => $this->collection,
        ];
    }

    public static function collection($resource)
    {


        //این مپ که در اینجا وارد شده برای استخراج یوزر نیم از هر ارایه کالکشین ریسورس
        return [
            'Tip_path' => $resource->path(),
            'Tip_currentPage' => $resource->currentPage() ,
            'Tip_lastPage' => $resource->lastPage(),
            $resource->map(function ($item) {
            return [
                'Tip_id' => $item->id,
                'Tip_title' => $item->title,
                'Tip_description'=> $item->description,
            ];
        })
        ];
    }
}
