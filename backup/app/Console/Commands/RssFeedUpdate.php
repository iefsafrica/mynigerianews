<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostArticle;
use App\Models\RssFeed;
use App\Scopes\LanguageScope;
use App\Scopes\PostDraftScope;
use Arr;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Vedmant\FeedReader\Facades\FeedReader;

class RssFeedUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:rss-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This artisan command is used to Rss Feed auto Update';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('This Rss Feed Commend Start');
        Log::info(Carbon::now());
        $update = RssFeed::with('posts')->where('auto_update', RssFeed::YES)->get();

        foreach ($update as $rss) {
            $feed = FeedReader::read($rss->feed_url);
            $postNo = 1;
            foreach ($feed->get_items() as $postData) {
                if ($postNo > $rss->no_post) {
                    break;
                }
                $data = [];
                $data['title'] = $postData->get_title();
                $data['article_content'] = $postData->get_content();
                $data['link'] = $postData->get_link();
                $data['enclosure'] = $postData->get_enclosure()->link;
                $data['source'] = $postData->get_source();
                $data['slug'] = Str::slug($data['title']);
                $post = Post::withoutGlobalScope(LanguageScope::class)->withoutGlobalScope(PostDraftScope::class)->whereSlug($data['slug'])->first();
                if (! empty($post)) {
                    $post->update([
                        'title' => $data['title'],
                        'slug' => $data['slug'],
                        'description' => $data['title'],
                        'keywords' => $data['title'],
                        'rss_link' => $data['link'],
                        'lang_id' => $rss->language_id,
                        'category_id' => $rss->category_id,
                        'sub_category_id' => $rss->subcategory_id,
                        // 'status' => ! $rss->post_draft,
                        // 'visibility' => ! $rss->post_draft,
                        'scheduled_delete_post_time' => $rss->scheduled_delete_post_time ?? null,
                        'tags' => $rss->tags,
                    ]);
                    $articleInputArray = Arr::only($data, ['article_content']);
                    $article = new PostArticle($articleInputArray);
                    $post->postArticle()->save($article);
                } else {
                    $post = Post::create([
                        'title' => $data['title'],
                        'slug' => $data['slug'],
                        'description' => $data['title'],
                        'keywords' => $data['title'],
                        'visibility' => $rss->post_draft == 0 ? 1 : 0,
                        'post_types' => Post::ARTICLE_TYPE_ACTIVE,
                        'lang_id' => $rss->language_id,
                        'category_id' => $rss->category_id,
                        'sub_category_id' => $rss->subcategory_id,
                        'status' => $rss->post_draft == 0 ? 1 : 0,
                        'created_by' => $rss->user_id,
                        'rss_link' => $data['link'],
                        'is_rss' => true,
                        'rss_id' => $rss->id,
                        'scheduled_delete_post_time' => $rss->scheduled_delete_post_time ?? null,
                        'tags' => $rss->tags,
                    ]);
                    $articleInputArray = Arr::only($data, ['article_content']);
                    $article = new PostArticle($articleInputArray);
                    $post->postArticle()->save($article);
                    try {
                        if(isset($data['enclosure']) && !empty($data['enclosure'])){
                            $post->addMediaFromUrl($data['enclosure'])->toMediaCollection(Post::IMAGE_POST,
                                config('app.media_disc'));
                        }
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }
                }
                $postNo++;
            }
        }
        $this->info('Post schedule update successfully');
        Log::info('This artisan command is used to Rss Feed auto Update');
        Log::info(Carbon::now());
    }
}
