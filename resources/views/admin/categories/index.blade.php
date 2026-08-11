@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')

    <form action="{{ route('admin.categories.store') }}" method="post" class="mb-4">
        @csrf
        <div class="row gx-2">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Add a category" value="{{ old('name') }}" autofocus>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary fw-bold">
                    <i class="fa-solid fa-plus"></i> Add
                </button>
            </div>
        </div>
        @error('name')
            <p class="text-danger small mt-1">{{ $message }}</p>
        @enderror
    </form>

    <div class="col-7">
    <table class="table table-hover align-middle bg-white border text-secondary">
        <thead class="small table-warning text-secondary">
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>COUNT</th>
                <th>LAST UPDATED</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->category_post_count }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    
                    <button class="btn btn-outline-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#edit-category-{{ $category->id }}" title="Edit">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" title="Delete">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>

                    
                    @include('admin.categories.modals.status')
                </td>
            </tr>
            @endforeach


            @if ($uncategorized)
            <tr>
                <td></td> 
                <td class="text-dark fw-bold">{{ $uncategorized->name }}
                    <p class="small text-secondary">Hidden posts are not included</p>
                </td>
                <td>{{ $uncategorized->category_post_count }}</td>
                <td></td>
                <td></td>
            </tr>
            @endif

        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $all_categories->links() }}
    </div>
@endsection