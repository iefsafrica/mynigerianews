@extends('layouts.app')
@section('title')
    {{__('messages.ad_space.post_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            @if(Auth::user()->hasRole('customer'))
                <a class="btn btn-outline-primary float-end" href="{{ route('customer-posts.index')}}">
                    {{ __('messages.common.back') }}
                </a>
            @endif
            @if(!Auth::user()->hasRole('customer'))
                <a class="btn btn-outline-primary float-end" href="{{ route('posts.index')}}">
                    {{ __('messages.common.back') }}
                </a>
            @endif
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1>{{$post->title}}</h1>
                <p>{{$post->description}}</p>

                <div class="row">
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.visibility')}}</h5>
                        <span class="badge bg-{{($post->visibility == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->visibility == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.common.on') : __('messages.common.off')}}
             </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.status')}}</h5>
                        <span class="badge bg-{{($post->status == \App\Models\Post::STATUS_ACTIVE) ? 'success' : 'danger'}}  fs-7 m-1 ">
                   {{($post->status == \App\Models\Post::STATUS_ACTIVE) ? __('messages.post.publish') : __('messages.post.draft_post')}}
                    </span>
                </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.category')}}</h5>
                        <p>{{$post->category->name}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.sub_category')}}</h5>
                        <p>{{ $post->subCategory->name ?? __('messages.menu.n_a')}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.common.created_by')}}</h5>
                        <p>{{$post->user->full_name}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.common.language')}}</h5>
                        <p>{{$post->language->name}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.rss-feed')}}</h5>
                        <span class="badge bg-{{($post->is_rss == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->is_rss == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.featured')}}</h5>
                        <span class="badge bg-{{($post->featured == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->featured == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.details.breaking')}}</h5>
                        <span class="badge bg-{{($post->breaking == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->breaking == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.add_to_slider')}}</h5>
                        <span class="badge bg-{{($post->slider == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->slider == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.details.recommended_post')}}</h5>
                        <span class="badge bg-{{($post->recommended == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->recommended == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.show_registered_user')}}</h5>
                        <span class="badge bg-{{($post->show_registered_user == \App\Models\Post::VISIBILITY_ACTIVE) ? 'primary' : 'danger'}}  fs-7 m-1 ">
                {{($post->show_registered_user == \App\Models\Post::VISIBILITY_ACTIVE) ? __('messages.page.yes') : __('messages.page.no')}}
                    </span>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.keywords')}}</h5>
                        <p>{{ str_replace(' ', ', ', $post->keywords) }}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.tag')}}</h5>
                        <p>{{ str_replace(',', ', ', $post->tags) }}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.publish').' '. __('messages.post.scheduled_post')}}</h5>
                        <p>{{ !empty($post->scheduled_post_time) ? Carbon\Carbon::parse($post->scheduled_post_time)->format('Y-m-d') : __('messages.menu.n_a')}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.delete').' '. __('messages.post.scheduled_post')}}</h5>
                        <p>{{ !empty($post->scheduled_post_time) ? Carbon\Carbon::parse($post->scheduled_delete_post_time)->format('Y-m-d') : __('messages.menu.n_a')}}</p>
                    </div>
                    <div class="col-6 mt-3">
                        <h5>{{__('messages.post.optional_url')}}</h5>
                        <p>{{ $post->optional_url ?? __('messages.menu.n_a')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="post-reaction">
                            <h4 class="title-reactions mt-3 mb-3">{{__('messages.post_reaction')}}</h4>
                            <div class="post-reaction-div mt-10">
                                <div class="row">
                                    <div class="post-reaction">
                                        @foreach($emojis as $emoji)
                                            <div class="emoji">
                                                <div>
                                                    <div class="d-block position-relative text-center float-left">
                                                        <span class="emoji-id" data-emoji="{{$emoji->id}}">
                                                            {{ html_entity_decode($emoji->emoji) }}
                                                        </span>
                                                        <label class="post-reaction-count  like-reaction" id="{{$emoji->id}}">
                                                            {{isset($countEmoji[$emoji->id]) ? count($countEmoji[$emoji->id]) : 0}}
                                                        </label>
                                                        <p class="fs-12 mb-0 mt-3">{{ __('messages.reaction.'.$emoji->name) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
