<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'string', 'max:20', 'unique:media,id'],

            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')
                    ->where('type', $this->input('type')),
            ],

            'creator' => ['required', 'string', 'max:255'],
            'release_year' => ['required', 'integer', 'between:1900,2100'],
            'description' => ['required', 'string'],

            'type' => [
                'required',
                Rule::in(['Anime', 'Manga', 'Light Novel']),
            ],

            'episode_count' => [
                'required_if:type,Anime',
                'prohibited_unless:type,Anime',
                'integer',
                'min:1',
            ],

            'studio' => [
                'required_if:type,Anime',
                'prohibited_unless:type,Anime',
                'string',
                'max:255',
            ],

            'volume_count' => [
                'required_if:type,Manga,Light Novel',
                'prohibited_if:type,Anime',
                'integer',
                'min:1',
            ],

            'publisher' => [
                'required_if:type,Manga,Light Novel',
                'prohibited_if:type,Anime',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Kode media wajib diisi.',
            'id.unique' => 'Kode media sudah digunakan.',
            'title.required' => 'Judul media wajib diisi.',
            'title.unique' => 'Judul media dengan jenis yang sama sudah terdaftar.',
            'creator.required' => 'Nama kreator wajib diisi.',
            'release_year.required' => 'Tahun rilis wajib diisi.',
            'description.required' => 'Deskripsi media wajib diisi.',
            'type.required' => 'Jenis media wajib dipilih.',
            'type.in' => 'Jenis media harus Anime, Manga, atau Light Novel.',
            'episode_count.required_if' => 'Jumlah episode wajib diisi untuk Anime.',
            'studio.required_if' => 'Studio wajib diisi untuk Anime.',
            'volume_count.required_if' => 'Jumlah volume wajib diisi untuk Manga atau Light Novel.',
            'publisher.required_if' => 'Penerbit wajib diisi untuk Manga atau Light Novel.',
        ];
    }
}