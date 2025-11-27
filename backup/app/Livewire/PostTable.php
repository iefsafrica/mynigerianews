<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Livewire\LivewireTableComponent;
use App\Models\Analytic;
use App\Scopes\AuthoriseUserActivePostScope;
use App\Scopes\LanguageScope;
use App\Scopes\PostDraftScope;
use DB;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PostTable extends LivewireTableComponent
{
         protected $model = Post::class;

         protected $listeners = [
                  'refresh' => '$refresh', 'filterPostType', 'filterCategory', 'filterLangId', 'filterSubCategory', 'resetPage','deleteSelected','changePostFilter','changePostView',
         ];
         public $post = Post::ALL;
         public $view = Post::ALL;
         public $showButtonOnHeader = true;
         public $showFilterOnHeader = true;

         // public $filterPillsStatus = true;

         public $buttonComponent = 'post.components.add_button';
         public array $FilterComponent = ['post.components.filter', Post::POST,Post::VIEWS];

         public $addButtonText = null;

         public array $bulkActions = [
                  'deleteSelected' => 'Delete',
         ];
         public $deleteBtnText = null;

         public $addRouteSection = null;

         public $lang_id = null;

         public $category_id = null;

         public $post_type = null;

         public $sub_category_id = null;

         public function configure(): void
         {
            $this->setPrimaryKey('id');
            $this->setDefaultSort('created_at', 'desc');
            $this->setQueryStringStatus(false);
         }

        public function placeholder()
        {
            return view('livewire_lazy_load.listing-skeleton-tow-botton-filter');
        }

         public function columns(): array
         {
                  return [
                           Column::make("Id", "id")
                                    ->hideIf('id')
                                    ->sortable(),
                           Column::make("Created by", "created_by")
                                    ->hideIf('created_by')
                                    ->sortable(),
                           Column::make(__('messages.common.title'), "title")
                                    ->view('post.components.title')
                                    ->sortable()
                                    ->searchable(),
                           Column::make("Slug", "slug")
                                    ->hideIf('slug')
                                    ->sortable(),
                           Column::make(__('messages.post.show_on_headline'), "show_on_headline")
                                    ->view('post.components.on_headline')
                                    ->sortable(),

                           Column::make(__('messages.post.visibility'), "visibility")
                                    ->view('post.components.visibility')
                                    ->sortable(),
                           Column::make(__('messages.post.featured'), "featured")
                                    ->view('post.components.featured')
                                    ->sortable(),
                           Column::make("Breaking", "breaking")
                                    ->hideIf('breaking')
                                    ->sortable(),
                           Column::make("Slider", "slider")
                                    ->hideIf('slider')
                                    ->sortable(),
                           Column::make("Recommended", "recommended")
                                    ->hideIf('recommended')
                                    ->sortable(),

                           // Column::make("Tags", "tags")
                           //     ->sortable(),
                           // Column::make("Optional url", "optional_url")
                           //     ->sortable(),
                           // Column::make("Additional images ", "additional_images")
                           //     ->sortable(),
                           // Column::make("Files", "files")
                           //     ->sortable(),
                           Column::make("Lang id", "lang_id")
                                    ->hideIf('lang_id')
                                    ->sortable(),
                           Column::make("Category id", "category_id")
                                    ->hideIf('category_id')
                                    ->sortable(),
                           // Column::make("Sub category id", "sub_category_id")
                           //     ->sortable(),
                           // Column::make("Scheduled post", "scheduled_post")
                           //     ->sortable(),
                           // Column::make("Scheduled post time", "scheduled_post_time")
                           //     ->sortable(),
                           Column::make("Status", "status")
                                    ->hideIf('status')
                                    ->sortable(),
                           Column::make("Post types", "post_types")
                                    ->hideIf('category_id')
                                    ->sortable(),
                           // Column::make("Section", "section")
                           //     ->sortable(),

                           // Column::make("Rss link", "rss_link")
                           //     ->sortable(),
                           // Column::make("Is rss", "is_rss")
                           //     ->sortable(),
                           // Column::make("Rss id", "rss_id")
                           //     ->sortable(),
                           // Column::make("Scheduled delete post time", "scheduled_delete_post_time")
                           //     ->sortable(),
                           // Column::make("Scheduled post delete", "scheduled_post_delete")
                           //     ->sortable(),
                           Column::make(__('messages.common.created_at'), "created_at")
                                    ->sortable()
                                    ->searchable()
                                    ->view('post.components.created_at'),
                           Column::make(__('messages.common.action'), 'id')->view('post.components.action'),
                           // Column::make("Updated at", "updated_at")
                           //     ->sortable(),
                  ];
         }

         public function builder(): Builder
         {
                  if (Auth::user()->hasRole('customer')) {
                           $query = Post::withCount('analytics')->withoutGlobalScope(AuthoriseUserActivePostScope::class)->withoutGlobalScope(LanguageScope::class)
                                    ->withoutGlobalScope(PostDraftScope::class)->with(
                                             'language:id,name',
                                             'category:id,name'
                                    )->whereCreatedBy(getLogInUserId());
                  } else {
                           $query = Post::withCount('analytics')->withoutGlobalScope(AuthoriseUserActivePostScope::class)->withoutGlobalScope(LanguageScope::class)
                                    ->withoutGlobalScope(PostDraftScope::class)->with('language:id,name', 'category:id,name');
                  }

                  if (!empty($this->post_type)) {
                           $query->where('post_types', $this->post_type);
                  }
                  if (!empty($this->category_id)) {
                           $query->where('category_id', $this->category_id);
                  }
                  if (!empty($this->sub_category_id)) {
                           $query->where('sub_category_id', $this->sub_category_id);
                  }
                  if (!empty($this->lang_id)) {
                           $query->where('lang_id', $this->lang_id);
                  }
                  if (!empty($this->sta)) {
                           $query->where('post_types', $this->post_type);
                  }
                  $query->when($this->post != Post::ALL, function($q) {
                           $q->where('status', $this->post);
                          });
                   $query->when($this->view != Post::ALL, function($q) {
                           $q->orderBy('analytics_count', $this->view);
                          });

                  return $query;
         }

         // public function filters(): array
         // {

         //          return [
         //                   SelectFilter::make(__('messages.post.posts') . ':')
         //                            ->options(['all' => (__('messages.all')), 'draft' => (__('messages.dashboard_show.drafts')), 'published' => (__('messages.published'))])
         //                            ->filter(function (Builder $builder, string $value) {
         //                                     if ($value === 'all') {
         //                                              $builder;
         //                                     }
         //                                     if ($value === 'draft') {
         //                                              $builder->where('status', '=', '0');
         //                                     }
         //                                     if ($value === 'published') {
         //                                              $builder->where('status', '=', '1');
         //                                     }
         //                            }),
         //                    SelectFilter::make('Views' . ':')
         //                    ->options(['all' => 'All','max' => 'Max', 'min' => 'Min'])
         //                    ->filter(function (Builder $q, string $value) {
         //                            if ($value === 'all') {
         //                                $q;
         //                            }
         //                            if ($value == 'max') {
         //                                $q->orderBy('analytics_count', 'desc');
         //                            }
         //                            if ($value == 'min') {
         //                                $q->orderBy('analytics_count', 'asc');
         //                            }
         //                    }),
         //          ];
         // }

         public function publishPost($postId)
         {
                  $post = Post::withoutGlobalScope(LanguageScope::class)->withoutGlobalScope(PostDraftScope::class)->findOrFail($postId);
                  $post->update([
                           'status' => !$post->status,
                  ]);
                  $this->dispatch('refresh');

                  $message = $post->recommended ? __('messages.placeholder.post_added_to_recommended_successfully') : __('messages.placeholder.post_removed_from_recommended_successfully');
                  $this->dispatch('success', $message);
         }

         public function filterCategory($id)
         {
                  $this->category_id = $id;
                  $this->dispatch('refresh');
         }

         public function filterSubCategory($id)
         {
                  $this->sub_category_id = $id;
                  $this->dispatch('refresh');
         }

         public function filterLangId($id)
         {
                  $this->lang_id = $id;
                  $this->dispatch('refresh');
         }

         public function filterPostType($id)
         {
                  $this->post_type = $id;
                  $this->dispatch('refresh');
         }

         //     public function bulkActions(): array
         //     {
         //         return [
         //             'bulkDelete' => 'Delete',
         //         ];
         //     }

         //     public function bulkDelete()
         //     {
         //         if ($this->selectedRowsQuery->count() > 0) {
         //             $postId = $this->selectedRowsQuery->get()->pluck('id')->toArray();
         //             $this->dispatchBrowserEvent('bulkDelete', $postId);
         //         } else {
         //             $message = __('messages.post.select_post');
         //             $this->dispatchBrowserEvent('error', $message);
         //         }
         //     }

         //     public function bulkPostDelete($data)
         //     {
         //         $data = Post::withoutGlobalScope(LanguageScope::class)->withoutGlobalScope(PostDraftScope::class)->whereIn('id', $data);
         //         $data->delete();
         //         $this->resetAll();
         //         $message = __('messages.placeholder.post_deleted_successfully');
         //         $this->dispatchBrowserEvent('success', $message);
         //     }
         public function deleteSelected()
         {
                  if (!empty($this->selected)) {
                           Post::withoutGlobalScope(LanguageScope::class)
                                    ->withoutGlobalScope(PostDraftScope::class)->with('language:id,name', 'category:id,name')->whereIn('id', $this->selected)->delete();
                           $this->reset('selected');
                           $this->dispatch('refresh');
                           $message = __('messages.placeholder.post_deleted_successfully');
                           $this->dispatch('success', $message);
                  }
                  else{
                           $message = __('messages.select_post');
                           $this->dispatch('error', $message);
                        }
         }

         //post header bulk select with rows bulk
         public function updatedSelected(): void
         {
                  $this->selectAll = count($this->selected) === Post::withoutGlobalScope(LanguageScope::class)
                           ->withoutGlobalScope(PostDraftScope::class)->with('language:id,name', 'category:id,name')->count();
         }
         public function changePostFilter($post){
                  $this->post = $post;
                  $this->setBuilder($this->builder());
         }
         public function changePostView($view){
                  $this->view = $view;
                  $this->setBuilder($this->builder());
         }
}
