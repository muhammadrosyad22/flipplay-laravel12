<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'creator' => $this->creator,
            'release_year' => $this->release_year,
            'description' => $this->description,
            'type' => $this->type,
            'specific_information' => $this->when($this->type === 'Anime', [
                'episode_count' => $this->episode_count,
                'studio' => $this->studio,
            ], $this->when(in_array($this->type, ['Manga', 'Light Novel'], true), [
                'volume_count' => $this->volume_count,
                'publisher' => $this->publisher,
            ])),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
