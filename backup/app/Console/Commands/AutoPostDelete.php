<?php

namespace App\Console\Commands;

use App\Models\Analytic;
use App\Models\Post;
use App\Scopes\AuthoriseUserActivePostScope;
use App\Scopes\LanguageScope;
use App\Scopes\PostDraftScope;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class AutoPostDelete
 */
class AutoPostDelete extends Command
{
    protected $signature = 'post:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::withoutGlobalScope(AuthoriseUserActivePostScope::class)
            ->withoutGlobalScope(LanguageScope::class)
            ->withoutGlobalScope(PostDraftScope::class)
            ->where('scheduled_delete_post_time', '!=', null)
            ->get();

        foreach ($posts as $scheduleTime) {
            dump(Carbon::now()->format('d/m/y'));
            dump(Carbon::parse($scheduleTime->scheduled_delete_post_time)->format('d/m/y'));
            dump(Carbon::parse($scheduleTime->scheduled_delete_post_time) <= Carbon::now());
            if (Carbon::parse($scheduleTime->scheduled_delete_post_time) <= Carbon::now()) {
                $analytic = Analytic::wherePostId($scheduleTime->id)->first();
                if ($analytic != null) {

                    Analytic::wherePostId($scheduleTime->id)->delete();
                }
                Post::whereId($scheduleTime->id)->withoutGlobalScope(AuthoriseUserActivePostScope::class)
                    ->withoutGlobalScope(LanguageScope::class)
                    ->withoutGlobalScope(PostDraftScope::class)->delete();

            }
        }
    }
}
