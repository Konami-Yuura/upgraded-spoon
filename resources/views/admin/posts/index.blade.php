@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <table class="table hover align-middle bg-white border text-secondary">
        <thead class="table-primary text-secondary small">
            <th></th>
            <th></th>
            <th>CATEGORY</th>
            <th>OWNER</th>
            <th>CREATED AT</th>
            <th>STATUS</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($all_posts as $post)
                <tr>
                    {{-- id --}}
                    <td class="text-end">{{$post->id}}</td>
                    {{-- image --}}
                    <td>
                        <a href="{{route('post.show', $post->id)}}">
                            <img src="{{$post->image}}" alt="post id {{$post->id}}" class="d-block ms-auto image-lg">
                        </a>
                    </td>
                    {{-- category --}}
                    <td>
                        @foreach ($post->categoryPost as $category_post)
                            <div class="badge bg-secondary bg-opacity-50">
                                {{$category_post->category->name}}
                            </div>
                        @endforeach
                    </td>
                    {{-- owner --}}
                    <td>{{$post->user->name}}</td>
                    {{-- created at --}}
                    <td>{{$post->created_at}}</td>
                    {{-- status --}}
                    <td>
                        {{-- @if ($post->trashed())
                        <i class="fa-regular fa-circle text-secondary"></i>&nbsp; Unvisible
                    @else --}}
                        <i class="fa-solid fa-circle text-success"></i>&nbsp; Visible
                    {{-- @endif --}}
                    </td>
                    {{-- dropdown menu/ellipsis --}}
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                {{-- @if ($post->trashed()) --}}
                                    {{-- <button class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#activate-user-{{$user->id}}">
                                        <i class="fa-solid fa-user-check"></i> Activete {{$post->id}}
                                    </button>
                                @else --}}
                                    {{-- <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deactivate-user-{{$user->id}}">
                                        <i class="fa-solid fa-user-slash"></i> Hide {{$post->id}}
                                    </button> --}}
                                {{-- @endif --}}
                            </div>
                        </div>
                        {{-- include the modal here--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="lead text-muted text-center">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{$all_posts->links()}}
@endsection