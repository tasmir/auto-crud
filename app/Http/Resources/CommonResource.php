<?php

namespace App\Http\Resources;

// use Illuminate\Http\Request;
// use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\Resource;

// class CommonResource extends JsonResource
class CommonResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

/**
 * return CommonResource::collection($follow_ups);
 * retutn new CommonResource($params);
 */