<div class="modal fade" id="delete-post-{{$post->id}}">
    <div class="modal-dialog">
        <div class="modal-content border">
            <div class="modal-header" style="background-color: #fcf8ef;">
                <h3 class="h5 modal-title" style="color: rgb(253, 119, 173);">
                    <i class="fa-solid fa-circle-exclamation" style="color: rgb(253, 119, 173);"></i>Delete Post
                </h3>
            </div>
            <div class="modal-body" style="background-color: #fcf8ef;">
                <p style="color: rgb(70, 46, 15);">Are you sure you want to delete this post?</p>
                <div class="mt-3">
                    <img src="{{$post->image}}" alt="post id {{$post->id}}" class="image-lg">
                    <p class="mt-1 text-muted">{{$post->description}}</p>
                </div>
            </div>
            <div class="modal-footer border-0" style="background-color: #fcf8ef;">
                <form action="{{ route('post.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline btn-sm" data-bs-dismiss="modal" style="color: rgb(253, 119, 173);">Cancel</button>
                    <button type="submit" class="btn btn-sm" style="color: rgb(253, 119, 173); background-color:  #cde8f8;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>