@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

        <div class="mb-3">
            <label for="category" class="form-label d-block fw-bold">
                Category <span class="text-muted fw-normal">(Up to 3)</span>
            </label>

            @foreach ($all_categories as $category)
                <div class="form-check form-check-inline">
                    {{-- <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input"> --}}

                    {{-- 
                        1st itr: 1, check if the id = 1 is inside the array [1,2]
                        2nd itr: 2, check if the id = 2 is inside the array [1,2]
                        3rd itr: 3, check if the id = 3 is NOT inside the array [1,2]
                        --}}
                    @if(in_array($category->id, $selected_categories))
                        <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input" checked>
                    @else
                        <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input">
                    @endif
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
            {{-- ERROR --}}
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror


        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control" placeholder="What's on your mind">{{ old('description', $post->description)}}</textarea>
        </div>
        {{-- ERROR --}}
        @error('description')
         <div class="text-danger small">{{ $message }}</div>
        @enderror

        <div class="row mb-3">
            <div class="col-6">
                <label for="image" class="form-label fw-bold">Image</label>
                <img src="{{$post->image}}" alt="post id  {{$post->id}}" class="img-thumbnail w-100">
                <input type="file" name="image" id="image" class="form-control mt-1" aria-describedby="image-info">
                <div id="image-info" class="form-text">
                    The acceptable formats are jpeg, jpg, png, and gif only. <br>
                    Max File size is 1048kb.
                </div>
                {{-- ERROR --}}
                @error('image')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-warning px-5">Save</button>
    </form>
@endsection