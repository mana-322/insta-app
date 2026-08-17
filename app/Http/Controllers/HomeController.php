<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;

    private $user;

    public function __construct(Post $post, User $user)
    {
       $this->post = $post;
       $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        #retrieve all posts
        // $all_posts = $this->post->latest()->get();
        $home_posts = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();

        $user = Auth::user();

        $myActiveStories = $user->stories()->active()->get();
        $followingIds = $user->following->pluck('following_id');

        $userStories = Story::active()
            ->whereIn('user_id', $followingIds)
            ->with('user')
            ->get()
            ->groupBy('user_id');


        return view('users.home')
                ->with('home_posts',$home_posts)
                ->with('suggested_users', $suggested_users)
                ->with('myActiveStories', $myActiveStories)
                ->with('userStories', $userStories);
    }

    #Get the posts pf the users that the AUTH user is following
    public function getHomePosts(){
        $all_posts = $this->post->latest()->get(); //retrieve all posts
        $home_posts = []; //array for the filtered posts

        foreach($all_posts as $post){ //loop throufh all posts
            if($post->user->isFollowed() || $post->user->id ===Auth::user()->id){
                // check if the user is following that user (please check is Followed method for reference)
                //QE check if the owner of the post is the AUTH USER
                $home_posts[] = $post;//if TRUE filtered posts should be in $home_posts array
            }
        }
        
        return $home_posts; //return array
    }

    #Get the users that the AUTH USER doesn't follow
    public function getSuggestedUsers(){
        $all_users = $this->user->all()->except(Auth::user()->id);//retrieve all users EXCEPT the AUTH USER
        $suggested_users =[]; //array for the not followed users

        foreach($all_users as $user){//loop through all users
        if(!$user->isFollowed()){//if that user is NOT followed by AUTH USER
            $suggested_users[] = $user;//move data inside array
         }

        }

        return $suggested_users;
    }

    public function search(Request $request){
        $users = $this->user->where('name', 'like', '%'.$request->search.'%')->get();
        return view('users.search')->with('users',$users)->with('search', $request->search);
    }

}
