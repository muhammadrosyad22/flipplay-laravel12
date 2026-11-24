<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $media = $this->route('media');
        $type = $this->input('type', $media->type);
        $changingType = $type !== $media->type;

        $rules = [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')
                    ->where('type', $type)
                    ->ignore($media->id, 'id'),
            ],

            'creator' => ['sometimes', 'required', 'string', 'max:255'],
            'release_year' => ['sometimes', 'required', 'integer', 'between:1900,2100'],
            'description' => ['sometimes', 'required', 'string'],

            'type' => [
                'sometimes',
                'required',
                Rule::in(['Anime', 'Manga', 'Light Novel']),
            ],
        ];

        if ($type === 'Anime') {
            $rules['episode_count'] = [
                $changingType ? 'required' : 'sometimes',
                'integer',
                'min:1',
            ];

            $rules['studio'] = [
                $changingType ? 'required' : 'sometimes',
                'string',
                'max:255',
            ];

            $rules['volume_count'] = ['prohibited'];
            $rules['publisher'] = ['prohibited'];
        } else {
            $rules['volume_count'] = [
                $changingType ? 'required' : 'sometimes',
                'integer',
                'min:1',
            ];

            $rules['publisher'] = [
                $changingType ? 'required' : 'sometimes',
                'string',
                'max:255',
            ];

            $rules['episode_count'] = ['prohibited'];
            $rules['studio'] = ['prohibited'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi.',
            'title.unique' => 'Judul media dengan jenis yang sama sudah terdaftar.',
            'creator.required' => 'Nama kreator wajib diisi.',
            'release_year.required' => 'Tahun rilis wajib diisi.',
            'description.required' => 'Deskripsi media wajib diisi.',
            'type.in' => 'Jenis media harus Anime, Manga, atau Light Novel.',
            'episode_count.required' => 'Jumlah episode wajib diisi untuk Anime.',
            'studio.required' => 'Studio wajib diisi untuk Anime.',
            'volume_count.required' => 'Jumlah volume wajib diisi untuk Manga atau Light Novel.',
            'publisher.required' => 'Penerbit wajib diisi untuk Manga atau Light Novel.',
        ];
    }
}