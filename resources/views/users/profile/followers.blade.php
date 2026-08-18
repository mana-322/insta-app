@extends('layouts.app')

@section('title', 'Followers')

@section('content')
    @include('users.profile.header')

    <div style="margin-top: 100px">
        @if ($user->followers->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-4">
                    <h3 class="text-muted text-center">Followers</h3>

                    @foreach ($user->followers as $follower)
                        <div class="row align-items-center mt-3">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $follower->follower->id) }}">
                                    @if ($follower->follower->avatar)
                                        <img src="{{ $follower->follower->avatar }}" alt="{{ $follower->follower->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user icon-sm"  style="color: rgb(252, 200, 228);"></i>
                                    @endif
                                </a>
                            </div>

                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $follower->follower->id) }}"
                                    class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15);">{{ $follower->follower->name }}</a>
                            </div>
                            <div class="col-auto text-end">
                                @if ($follower->follower->id != Auth::user()->id)
                                    @if ($follower->follower->isFollowed())
                                        <form action="{{ route('follow.destroy', $follower->follower->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="border-0 bg-transparent p-0 btn-sm" style="backbround-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Following</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.store', $follower->follower->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="border-0 bg-transparent p-0 btn-sm" style="backbround-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Follow</button>
                                        </form>
                                    @endif
                                @else
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h3 class="text-center" style="color: rgb(70, 46, 15);">No Followers</h3>
        @endif
    </div>

@endsection
