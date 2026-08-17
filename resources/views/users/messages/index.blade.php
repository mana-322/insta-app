@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <div class="row justify-content-center">
        <div class="col-5">
            <p class="h5 text-muted mb-4">Messages</p>

            @forelse ($partners as $partner)
                <a href="{{ route('message.show', $partner->id) }}" class="text-decoration-none text-dark">
                    <div class="row align-items-center mb-3">
                        <div class="col-auto">
                            @if ($partner->avatar)
                                <img src="{{ $partner->avatar }}" alt="{{ $partner->name }}" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                            @endif
                        </div>
                        <div class="col ps-0 text-truncate fw-bold">
                            {{ $partner->name }}
                        </div>
                    </div>
                </a>
            @empty
                <p class="lead text-muted text-center">No messages yet.</p>
            @endforelse
        </div>
    </div>
@endsection
