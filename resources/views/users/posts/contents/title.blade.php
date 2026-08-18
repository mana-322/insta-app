<div class="card-header py-3" style="background-color: #fcf8ef;">
    <div class="row  align-items-center">
        <div class="col-auto">
            <a href="{{ route('profile.show', $post->user->id) }}">
                @if ($post->user->avatar)
                <img src="{{ $post->user->avatar }}" alt="{{$post->user->avatar}}" class="rounded-circle avatar-sm">
                    
                @else
                <i class="fa-solid fa-circle-user icon-sm" style="color: rgb(252, 200, 228);"></i>
                    
                @endif
            </a>
        </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15); font-size: 20px;">{{$post->user->name}}</a>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle=dropdown>
                    <i class="fa-solid fa-face-smile" style="color: rgb(252, 200, 228); font-size: 30px;"></i>
                </button>

                {{-- If you are the owner, you can edit or delete post --}}
                @if (Auth::user()->id === $post->user->id)
                <div class="dropdown-menu" style="background-color: #b4dff9;">
                    <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                        <i class="fa-regular fa-pen-to-square" style="color: rgb(70, 46, 15);"></i>Edit
                    </a>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-post-{{$post->id}}" style="color: rgb(253, 119, 173);">
                        <i class="fa-regular fa-trash-can" style="color: rgb(253, 119, 173);"></i>Delete
                    </button>
                </div>
                {{-- include modal here --}}   
                @include('users.posts.contents.modals.delete')

                @else
                {{-- if you are not the owner, show unfollow button --}}
                <div class="dropdown-menu" style="background-color: #b4dff9;">
                    <form action="{{ route('follow.destroy', $post->user->id )}}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="dropdown-item" style="color: rgb(253, 119, 173);">Unfollow</button>
                    </form>
                </div>
                    
                @endif
            </div>
        </div>
    </div>
</div>