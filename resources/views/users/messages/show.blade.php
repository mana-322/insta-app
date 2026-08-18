@extends('layouts.app')

@section('title', $partner->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <p class="h5 mb-4" style="color: rgb(70, 46, 15);">
                <a href="{{ route('message.index') }}" class="text-decoration-none text-muted">
                    <i class="fa-solid fa-arrow-left" style="color: rgb(70, 46, 15);"></i>
                </a>
                {{ $partner->name }}
            </p>

            <div class="mb-3">
                @forelse ($messages as $msg)
                    <div class="mb-2 {{ $msg->sender_id === Auth::user()->id ? 'text-end' : 'text-start' }}">
                        <span class="badge {{ $msg->sender_id === Auth::user()->id ? 'bg-primary' : 'bg-secondary' }} fw-normal p-2" style="color: rgb(70, 46, 15); background-color: rgb(252, 200, 228) !important;">
                            {{ $msg->body }}
                        </span>
                        <div class="text xsmall" style="color: rgb(199, 170, 132);">{{ date('M d, Y H:i', strtotime($msg->created_at)) }}</div>
                    </div>
                @empty
                    <p class="lead text-center" style="color: rgb(70, 46, 15);">No messages yet. Say hi!</p>
                @endforelse
            </div>

            <form action="{{ route('message.store', $partner->id) }}" method="post">
                @csrf

                <div class="input-group">
                    <textarea name="body" cols="30" rows="1" class="form-control form-control-sm" placeholder="Send a message..." style="background-color: rgb(252, 200, 228);">{{ old('body') }}</textarea>
                    <button type="submit" class="btn btn-outline-secondary btn-sm" title="Send" style="background-color: rgb(252, 200, 228);">
                        <i class="fa-regular fa-paper-plane" style="color: rgb(70, 46, 15);"></i>
                    </button>
                </div>
                {{-- Error --}}
                @error('body')
                <div class="text-danger small" style="color: rgb(70, 46, 15);">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
@endsection
