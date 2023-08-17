<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // get all the post of the login user and the user that is being followed by the login user

    private function getHomePosts()
    {
        $all_posts = $this->post->latest()->get();
        $home_posts = [];

        foreach($all_posts as $post)
        {
            if($post->user->isFollowed() || $post->user->id === Auth::user()->id)
            {
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    private function getSuggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);

        $suggested_users = [];
        
        foreach($all_users as $user) 
        {
            // (!) !(F) = T
            // !(T) = F exit the if condition
            // !(F) = T enter the condition statement
            /* 
             * following
             * u1 = none (login)
             * u2 = u1, u3
             * u3 = u2 
            */
            /* 
             * itr1 = u2 = !F = T
             * itr2 = u3 = !F = T
            */

            if(!$user->isFollowed())
            {   
                // i++
                // $suggested_users = $suggested_users + user
                $suggested_users[] = $user; // [u2,u3]
            }
        }

        return $suggested_users;
        /*
         * array_slice(x, y, z)
         * x = array variable
         * y = starting index
         * z = total count
        */ 
        // return array_slice($suggested_users, 0, 5);
    }

    public function suggestions()
    {
        $suggested_users = $this->getSuggestedUsers();

        return view('users.suggestions')->with('suggested_users', $suggested_users);
    }

    public function index()
    {
        // return view('users.home');
        // $all_posts = $this->post->latest()->get();
        $all_posts       = $this->getHomePosts();
        $suggested_users = array_slice($this->getSuggestedUsers(), 0, 5);

        return view('users.home')
            ->with('all_posts', $all_posts)
            ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request){
        // john
        // mrjohn
        
        $users = $this->user->where('name', 'like', '%' . $request->search . '%')->get();
        return view('users.search')->with('users', $users)->with('search', $request->search);
    }
}
