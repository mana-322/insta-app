@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.update') }}" method="post" class="shadow rounded-3 p-5" enctype="multipart/form-data" style="background-color: #fcf8ef;">
            @csrf
            @method('PATCH')
                
            <h2 class="h3 mb-3 fw-light" style="color: rgb(70, 46, 15);">Update Profile</h2>

            <div class="row mb-3">
                <div class="col-4">
                    @if ($user->avatar)
                    <img src="{{ $user->avatar}}" alt="" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                        
                    @else
                    <i class="fa-solid fa-circle-user d-block text-center icon-lg" style="color: rgb(252, 200, 228);"></i>
                    @endif
                </div>


                    <div class="col-auto align-self-end">
                        <input type="file" name="avatar" id="avatar" class="form-control form-control-sm mt-1" aria-describedby="avatar-info" style="background-color: rgb(252, 200, 228);">
                        <div class="form-text avatar-info" style="color: rgb(199, 170, 132)">
                            Acceptable formats: jpeg, jpg, png, gif only. <br>
                            Max file size is 1048KB.
                        </div>
                        {{-- Error --}}
                    </div>
                </div>    
               
                
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold" style="color: rgb(70, 46, 15);">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name)}}" autofocus style="background-color: rgb(252, 200, 228);">
                    {{-- Error --}}
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold" style="color: rgb(70, 46, 15);">E-Mail Address</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email)}}" style="background-color: rgb(252, 200, 228);">
                    {{-- Error --}}
                </div>

                <div class="mb-3">
                    <label for="introduction" class="form-label fw-bold" style="color: rgb(70, 46, 15);">Introduction</label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe yourself" style="background-color: rgb(252, 200, 228);">{{ old('introduction', $user->introduction )}}</textarea>
                    {{-- Error --}}
                </div>

                <button type="submit" class="btn px-5" style="color: rgb(70, 46, 15); background-color: rgb(252, 200, 228);">Save</button>
            </form>
        </div>
        </div>
    
    
@endsection