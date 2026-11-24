<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserCollectionController extends Controller
{
    public function index(User $user): UserResource
    {
        return new UserResource(
            $user->load('media')
        );
    }

    public function store(User $user, Media $media): JsonResponse
    {
        if ($user->media()->whereKey($media->getKey())->exists()) {
            return response()->json([
                'message' => 'Media tersebut sudah ada di koleksi pengguna.',
            ], 409);
        }

        $user->media()->attach($media->getKey());

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi pengguna.',
            'data' => new UserResource(
                $user->fresh()->load('media')
            ),
        ], 201);
    }

    public function destroy(User $user, Media $media): JsonResponse
    {
        if (!$user->media()->whereKey($media->getKey())->exists()) {
            return response()->json([
                'message' => 'Media tidak ditemukan dalam koleksi pengguna.',
            ], 404);
        }

        $user->media()->detach($media->getKey());

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi pengguna.',
            'data' => new UserResource(
                $user->fresh()->load('media')
            ),
        ]);
    }
}