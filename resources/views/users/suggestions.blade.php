@extends('layouts.app')

@section('title', 'Suggestions')

@section('content')
    <div class="col-lg-6 col-md-10 mx-auto">
        {{-- profile overview --}}
        @if ($suggested_users)
            <div class="row">
                <div class="col-auto">
                    <p class="fw-bold text-secondary">Suggested</p>
                </div>
            </div>
            @foreach ($suggested_users as $user)
                <div class="row align-items-center mb-3">
                    <div class="col-4 col-md-2">
                        <a href="{{ route('profile.show', $user->id) }}">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-md">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col-auto">    
                        {{-- name --}}
                        <div class="d-flex align-items-center">
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $user->name }}
                            </a>
                        </div>
                        {{-- email --}}
                        <div class="col-auto">
                            {{ $user->email }}
                        </div>
                        {{-- number of followers --}}
                        <div class="d-flex align-items-center xsmall">
                            {{ $user->followers->count() }} followers
                        </div>
                    </div>
                    {{-- button --}}
                    <div class="col text-end">
                        <form action="{{ route('follow.store', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-auto">
                    <p class="fw-bold text-secondary">Suggested</p>
                </div>
            </div>
            <p>Nothing to Suggest</p>
        @endif
    </div>  
@endsection