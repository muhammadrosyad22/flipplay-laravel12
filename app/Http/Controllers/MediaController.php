<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MediaController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Media::query()->with('users');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . trim($request->query('search')) . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->query('type'));
        }

        return MediaResource::collection(
            $query->orderBy('title')->paginate(10)
        );
    }

    public function store(StoreMediaRequest $request): JsonResponse
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media->load('users')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Media $media): MediaResource
    {
        return new MediaResource($media->load('users'));
    }

    public function update(
        UpdateMediaRequest $request,
        Media $media
    ): MediaResource {
        $data = $request->validated();
        $newType = $data['type'] ?? $media->type;

        if ($newType === 'Anime') {
            $data['volume_count'] = null;
            $data['publisher'] = null;
        } else {
            $data['episode_count'] = null;
            $data['studio'] = null;
        }

        $media->update($data);

        return new MediaResource(
            $media->fresh()->load('users')
        );
    }

    public function destroy(Media $media): JsonResponse
    {
        $media->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus dari FlipPlay.',
        ]);
    }
}