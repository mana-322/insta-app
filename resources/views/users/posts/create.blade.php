@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="category" class="form-label d-block fw-bold" style="color: rgb(70, 46, 15);">
            Category <span class="text-muted fw-normal">(up to 3)</span>
        </label>

        @foreach ($all_categories as $category)
        <div class="form-check form-check-inline" style="color: rgb(70, 46, 15);">
            <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{$category->id}}" class="form-check-input" style="background-color: rgb(252, 200, 228);">
            <label for="{{$category->name}}" class="form-check-label">{{ $category->name}}</label>
        </div>
            
        @endforeach
        {{-- Error --}}
        @error('category')
        <div class="text-danger small">{{ $message }}</div>
            
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label fw-bold" style="color: rgb(70, 46, 15);">Description</label>
        <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind" style="background-color: rgb(252, 200, 228);">{{old('description')}}</textarea>
        {{-- Error --}}
        @error('description')
        <div class="text-danger small">{{$message}}</div>
            
        @enderror
    </div>

    <div class="mb-4">
        <label for="image" class="form-label fw-bold" style="color: rgb(70, 46, 15);">Image</label>
        <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info" style="background-color: rgb(252, 200, 228);">
        <div class="form-text" id="image-info">
            The acceptable formats are jpeg, jpg, png, and gif only. <br>
            Max file size is 1048KB.
        </div>
       {{-- Error --}}
       @error('image')
       <div class="text-danger small">{{$message}}</div>
           
       @enderror
    </div>

        <button type="submit" class="btn px-5" style="background-color: rgb(252, 200, 228); color: rgb(70, 46, 15)">Post</button>

</form>


    
@endsection