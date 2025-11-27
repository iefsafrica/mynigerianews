@extends('front_new.layouts.app')
@section('title')
    {!! $user->full_name !!}
@endsection
@section('content')

    <img src="{{ $user->cover_image }}" width="100%" height="320px">
    <div class="container">
        <div class="mb-5 row position-relative">
            <div class="col-lg-4 main-admin-card ">
                <div class="admin-card">
                    <div class="card mb-4">
                        <img src="{{ $user->profile_image }}" class="admin-img  me-4">
                        <div class="admin-card-body ">
                            <h5 class="card-title fs-20">{{ $user->full_name }}</h5>
                        </div>
                    </div>
                    @if (getLogInUser() && getLogInUserId() != $user->id)
                        @if (empty(checkLoginUserFollow($user->id)))
                            <div class="text-center mb-4">
                                <a href="{{ route('followUser', $user->id) }}" class="btn btn-primary text-white"><i
                                        class="fa-solid fa-user me-3"></i>Follow</a>
                            </div>
                        @else
                            <div class="text-center mb-4">
                                <a href="{{ route('UnFollowUser', $user->id) }}" class="btn btn-primary text-white">
                                    <i class="fa-solid fa-user me-3"></i> UnFollow</a>
                            </div>
                        @endif
                    @endif
                    <p class="fs-14" style="color: #666666">{{ $user->about_us }}</p>
                    <p class="fs-14 mb-2">Member
                        Since {{ ucfirst(__('messages.common.' . strtolower($user->created_at->format('M')))) }}
                        {{ $user->created_at->format('d, Y') }}</p>
                    <div class="mb-4">
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:{{ $user->email }}" class="fs-14 text-dark">{{ $user->email }}</a>
                    </div>
                    @if ($following->count() || $followers->count())
                        <div class="follow-card">
                            @if ($following->count())
                                <div class="following mb-4">
                                    <h6 class="mb-3">Following ({{ $following->count() }})</h6>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($following as $follow)
                                            <div class="follow-tooltip position-relative me-2 mb-2">
                                                <div class="follow-image ">
                                                    <img src="{{ $follow->follower->profile_image }}" class="follow-image">
                                                </div>
                                                <div class="img-tooltip">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="tooltip-img">
                                                            <img src="{{ $follow->follower->profile_image }}"
                                                                class="follow-image">
                                                        </div>
                                                        {{--                                                <button class="btn btn-primary px-2 py-0 fs-14">Follow</button> --}}
                                                    </div>
                                                    <a href="{{ route('userDetails', $follow->follower->username ?? $follow->follower->id) }}"
                                                        class="text-dark">{{ $follow->follower->full_name }}</a>
                                                    <div class="fs-12">{{ $follow->follower->about_us }}</div>
                                                    <div class="after-arrow">
                                                        <i class="fa-solid fa-caret-down"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if ($followers->count())
                                <div class="followers">
                                    <h6 class="mb-3">Followers ({{ $followers->count() }})</h6>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($followers as $follow)
                                            <div class="follow-tooltip position-relative me-2 mb-2">
                                                <div class="follow-image ">
                                                    <img src="{{ $follow->follow->profile_image }}" class="follow-image">
                                                </div>
                                                <div class="img-tooltip">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <div class="tooltip-img">
                                                            <img src="{{ $follow->follow->profile_image }}"
                                                                class="follow-image">
                                                        </div>

                                                        {{--                                                <button class="btn btn-primary px-2 py-0 fs-14">Follow</button> --}}
                                                    </div>

                                                    <a href="{{ route('userDetails', $follow->follow->username ?? $follow->follow->id) }}"
                                                        class="text-dark">{{ $follow->follow->full_name }}</a>
                                                    <div class="fs-12">{{ $follow->follow->about_us }}</div>
                                                    <div class="after-arrow">
                                                        <i class="fa-solid fa-caret-down"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8 mt-lg-5 mt-60">
                <div class="row">
                    <div class="col-12">
                        @livewire('front-user-table', ['user' => $user->id])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
