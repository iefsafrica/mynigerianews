<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 */
class GalleryRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Gallery::class;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();

            $gallery = Gallery::create($input);
            if (isset($input['images']) && ! empty($input['images'])) {
                foreach ($input['images'] as $image) {
                    $gallery->addMedia($image)->toMediaCollection(Gallery::GALLERY_IMAGE, config('app.media_disc'));
                }
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateGallery($input, $id): bool
    {
        try {
            DB::beginTransaction();
            $gallery = Gallery::whereId($id)->firstorFail();
            $gallery->update($input);
            if (isset($input['images']) && ! empty($input['images'])) {
                $gallery->clearMediaCollection(Gallery::GALLERY_IMAGE);
                foreach ($input['images'] as $image) {
                    $gallery->addMedia($image)->toMediaCollection(Gallery::GALLERY_IMAGE,
                        config('app.media_disc'));
                }
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
