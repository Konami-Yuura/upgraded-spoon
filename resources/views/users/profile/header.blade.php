<div class="row">
    {{-- 
        Screen Break Points:
        at large screen : image col=4 + details col=8  , 4+8=12
        at midium screen : image col=6 + details col=6  , 6+6=12
         --}}

    {{-- image --}}
    <div class="col-lg-4 col-md-6">
        @if($user->avatar)
            <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    {{-- details --}}
    <div class="col-lg-8 col-md-6">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{$user->name}}</h2>
            </div>
            <div class="col-auto p-2">
                @if(Auth::user()->id === $user->id)
                    <a href="{{route('profile.edit')}}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                        <form action="{{route('follow.destroy', $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{route('follow.store', $user->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        {{-- post/follower/following --}}
        <div class="row mb-3">
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>{{$user->posts->count()}}</strong> posts
                </a>
            </div>

            <div class="col-auto">
                <a href="{{route('profile.followers', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{$user->followers->count()}}</strong> followers
                </a>
            </div>

            <div class="col-auto">
                <a href="{{route('profile.following', $user->id)}}" class="text-decoration-none text-dark">
                    <strong>{{$user->following->count()}}</strong> following
                </a>
            </div>
        </div>
        {{-- introduction --}}
        <p class="fw-bold">{{$user->introduction}}</p>
    </div>
</div>