<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }

    public static function collection($resource)
    {

        //این مپ که در اینجا وارد شده برای استخراج یوزر نیم از هر ارایه کالکشین ریسورس
        return $resource->map(function ($item) {
            return [
                'Question&Answer_id' => $item->id,
                'question' => $item->question,
                'answer'=> $item->answer,
            ];
        });
    }
}
