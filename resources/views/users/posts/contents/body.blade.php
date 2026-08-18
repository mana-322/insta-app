{{-- Clickable image --}}
<div class="container p-0">
    <a href="{{ route('post.show', $post->id) }}">
        <img src="{{$post->image}}" alt="post id {{$post->id}}" class="w-100">
    </a>
    <div class="card-body" style="background-color: #fcf8ef;">
        {{-- heart button + no. of linkes + categories --}}
        <div class="row align-items-center">
            <div class="col-auto">
                @if ($post->isLiked())
                     <form action="{{ route('like.destroy', $post->id )}}" method="post" class="like-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid fa-heart scale-down-center" style="color: rgb(253, 119, 173);"></i>
                    </button>
                </form>
                    
                @else
                <form action="{{ route('like.store', $post->id )}}" method="post" class="like-form">
                    @csrf
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart" style="color: rgb(70, 46, 15);"></i>
                    </button>
                </form>
                    
                @endif
                
            </div>
            <div class="col-auto px-0" style="color: rgb(99, 75, 46)">
                <span>{{ $post->likes->count() }}</span>

            </div>
            <div class="col text-end">
                @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-opacity-50"  style="background-color: rgb(199, 170, 132); color: white;">
                    {{$category_post->category->name}}
                </div>
                @endforeach
            </div>
        </div>

        {{-- owner + description --}}
        <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none fw-bold" style="color: rgb(70, 46, 15);">{{$post->user->name}}</a>
        &nbsp;
        <p class="d-line fw-light" style="color: rgb(99, 75, 46)">{{$post->description}}</p>
        <p class="text-uppercase xsmall" style="color: rgb(199, 170, 132)">{{date('M d, Y', strtotime($post->created_at))}}</p>

        {{-- include comments here --}}
        @include('users.posts.contents.comments')
    </div>

</div>
<script>
document.querySelectorAll('.like-form').forEach(form => {
    form.addEventListener('submit', function () {
        sessionStorage.setItem('scrollY', window.scrollY);
    });
});

window.addEventListener('load', function () {
    const scrollY = sessionStorage.getItem('scrollY');

    if (scrollY !== null) {
        window.scrollTo(0, Number(scrollY));
        sessionStorage.removeItem('scrollY');
    }
});
</script>