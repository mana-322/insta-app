<div class="mt-3">
    {{-- Show all comments here --}}
    @if ($post->comments->isNotEmpty())
    <hr>
        <ul class="list-group">
            @foreach ($post->comments->take(3) as $comment)
                <li class="list-group-item border-0 p-0 mb-2" style="background-color: #fcf8ef;">
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none fw-bold" style="color:  rgb(70, 46, 15);">{{$comment->user->name}}</a>
                    &nbsp;
                    <p class="d-inline fw-light" style="color: rgb(99, 75, 46)">{{$comment->body}}</p>

                    <form action="{{route('comment.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method('DELETE')

                        <span class="text-uppercase xsmall" style="color: rgb(199, 170, 132)">{{ date('M d, Y', strtotime($comment->created_at))}}</span>

                        {{-- if the AUTH user is the uwner, show delete btn --}}
                        @if (Auth::user()->id === $comment->user->id)
                        &middot;
                        <button type="submit" class="border-0 bg-transparent p-0 xsmall" style="color: rgb(253, 119, 173);">Delete</button>        
                        @endif
                    </form>
                </li>
            @endforeach

            @if ($post->comments->count() > 3)
            <li class="list-group-item border-0 px-0 pt-0">
                <a href="{{route('post.show', $post->id)}}" class="text-decoration-none small">
                    View all {{ $post->comments->count() }} comments
                </a>
            </li>
            @endif
        </ul>
            
        @endif


    <form action="{{route('comment.store', $post->id)}}" method="post">
        @csrf

        <div class="input-group">
            <textarea name="comment_body{{$post->id}}" cols="30" rows="1" class="form-control form-control-sm" style="background-color: rgb(252, 200, 228);" placeholder="Add a comment...">{{old('coment_body' . $post->id)}}</textarea>
            <button type="submit" class="btn btn-outline-secondary btn-sm" style="background-color: #fcc8e4; border: none;" title="Post">
                <i class="fa-regular fa-paper-plane" style="background-color: #fcc8e4; border: none; color:  rgb(70, 46, 15);"></i>
            </button>
        </div>
        {{-- Error --}}
        @error('comment_body' . $post->id)
        <div class="text-danger small">{{$message}}</div>  
        @enderror
    </form>
</div>