<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [

            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'news_content' => $this->news_content,
            'author_id' => $this->author,
            'writer' => $this->whenLoaded('writer'),
            'comment_total' => $this->whenLoaded('comments', function(){
                return count($this->comments);
            }),
            'comments' => $this->whenLoaded('comments', function(){
                return collect($this->comments)->each(function($comment){
                    $comment->commentator;
                    return $comment;
                });
            }),
            // 'created_at' => $this->created_at,
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}
