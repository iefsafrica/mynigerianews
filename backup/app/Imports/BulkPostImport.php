<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BulkPostImport implements ToCollection
{
    private $errors = [];
    public function collection(Collection $collection)
    {
        $collections = $collection->toArray();

        foreach (array_slice($collections, 1) as $col) {
            $data = [];
            $data[$collections[0][0]] = $col[0];
            $data[$collections[0][1]] = $col[1];
            $data[$collections[0][2]] = $col[2];
            $data[$collections[0][3]] = $col[3];
            $data[$collections[0][4]] = $col[4];
            $data[$collections[0][5]] = $col[5];
            $data[$collections[0][6]] = $col[6];
            $data[$collections[0][7]] = $col[7];
            $data[$collections[0][8]] = $col[8];
            $data[$collections[0][8]] = $col[8];
            $data['slug'] = strtolower(Str::slug($data['title']));
            $data['visibility'] = (isset($data['visibility'])) ? $data['visibility'] : Post::VISIBILITY_DEACTIVE;
            $data['featured'] = Post::FEATURED_DEACTIVE;
            $data['breaking'] = Post::BREAKING_DEACTIVE;
            $data['slider'] = Post::SLIDER_DEACTIVE;
            $data['recommended'] = Post::RECOMMENDED_DEACTIVE;
            $data['show_on_headline'] = Post::HEADLINE_DEACTIVE;
            $data['show_registered_user'] = Post::SHOW_REGISTRED_USER_DEACTIVE;
            $data['post_types'] = Post::ARTICLE_TYPE_ACTIVE;
            $data['created_by'] = getLogInUserId();
            $data['status'] = Post::STATUS_ACTIVE;

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $isAllowed = in_array(pathinfo(parse_url($data['image'], PHP_URL_PATH), PATHINFO_EXTENSION), $allowedExtensions);

            if (isset($data['image']) && preg_match('/\.(jpg|jpeg|png|webp)$/i', $data['image']) || $isAllowed) {
                $validation = Validator::make($data, [
                    'title' => 'required|max:190|unique:posts,title',
                    'description' => 'required',
                    'keywords' => 'required|max:190',
                    'tags' => 'required',
                    'lang_id' => 'required',
                    'category_id' => 'required',
                    'visibility' => 'required'
                ], [
                    'title.required' => __('messages.bulk_post.title_required'),
                    'title.max' => __('messages.bulk_post.title_max'),
                    'title.unique' => __('messages.bulk_post.title_unique'),
                    'description.required' => __('messages.bulk_post.description_required'),
                    'keywords.required' => __('messages.bulk_post.keywords_required'),
                    'keywords.max' => __('messages.bulk_post.keywords_max'),
                    'tags.required' => __('messages.bulk_post.tags_required'),
                    'lang_id.required' => __('messages.bulk_post.lang_id_required'),
                    'category_id.required' => __('messages.bulk_post.category_id_required'),
                    'visibility' => __('messages.bulk_post.visibility_required')
                ]);

                if ($validation->passes()) {
                    if (!Language::find($data['lang_id'])) {
                        return $this->errors[] = ['lang_id' => __('messages.bulk_post.lang_id')];
                    }
                    if (!Category::find($data['category_id'])) {
                        return $this->errors[] = ['category_id' => __('messages.bulk_post.category_id')];
                    }
                    if (!empty($data['sub_category_id'])) {
                        if (!SubCategory::find($data['sub_category_id'])) {
                            return $this->errors[] = ['sub_category_id' => __('messages.bulk_post.subcategory_id')];
                        }
                    }

                    try {
                        $post = Post::create($data);
                        $post->addMediaFromUrl($data['image'])->toMediaCollection(Post::IMAGE_POST, config('app.media_disc'));
                    } catch (\Exception $e) {
                        DB::rollBack();
                        Log::info($e);
                        throw new UnprocessableEntityHttpException($e->getMessage());
                    }
                } else {
                    return $this->errors[] = $validation->messages();
                }
            }else{
                return $this->errors[] = ['image' => __('messages.bulk_post.we_could_not_fb_id')];
            }


        }
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
