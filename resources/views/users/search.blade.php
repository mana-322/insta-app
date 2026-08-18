@extends('layouts.app')

@section('title', 'Explore People')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5">
            <p class="h5 mb-4" style="color: rgb(99, 75, 46)">Search results for "<span class="fw-bold">{{ $search }}</span>"</p>

            @forelse ($users as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user icon-md" style="color: rgb(252, 200, 228);"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        <a href="{{ route('profile.show', $user->id) }}"
                            class="text-decoration-none fwbold" style="color: rgb(99, 75, 46)">{{ $user->name }}</a>
                    </div>
                    <div class="col-auto">
                        @if ($user->id !== Auth::user()->id)
                            @if ($user->isFollowed())
                                <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-outline-none fw-bold btn-ms" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Following</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm fw-bold" style="bacground-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @empty
                <p class="lead text-center" style="color: rgb(99, 75, 46)">No users found.</p>
            @endforelse
        </div>
    </div>

@endsection
