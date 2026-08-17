<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
            @else
                <i class="fa-solid fa-circle-user d-block text-center icon-lg" style="color: rgb(252, 200, 228);"></i>
            
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0" style="color: rgb(70, 46, 15);">{{ $user->name}}</h2>
            </div>
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-none btn-sm fw-bold" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15);">Edit Profile</a>
                @else
                <div class="d-flex gap-2">
                @if ($user->isFollowed())
                     <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                </form>
                @else
                <form action="{{ route('follow.store', $user->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                </form>

                @endif
                <a href="{{ route('message.show', $user->id) }}" class="btn btn-outline-secondary btn-sm fw-bold">Message</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none" style="color: rgb(70, 46, 15)">
                    <strong>{{$user->posts->count() }}</strong>{{ $user->posts->count() == 1 ? 'post' : 'posts' }}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none" style="color: rgb(70, 46, 15)">
                    <strong>{{ $user->followers->count() }}</strong> {{ $user->followers->count() == 1 ? 'follower' : 'followers' }}
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none" style="color: rgb(70, 46, 15)">
                    <strong>{{ $user->following->count() }}</strong> following
                </a>
            </div>
        </div>

        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>