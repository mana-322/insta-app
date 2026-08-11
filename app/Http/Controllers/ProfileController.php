<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnSelf;


class ProfileController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
       $this->user = $user;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')->with('user',$user);
    }

    #edit profile
    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        // $user = $this->user->findOrFail(Auth::user()->id)
        $this->user = Auth::user();

       
        $request->validate([
            'name'         => 'required|min:1|max:50',
            'email'        => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'introduction' => 'nullable|max:100',
            'avatar'       => 'mimes:jpeg,jpg,png,gif|max:1048'
        ]);

        
        $this->user->name         = $request->name;
        $this->user->email        = $request->email;
        $this->user->introduction = $request->introduction;

        
        if ($request->avatar) {
            $this->user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        $this->user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')->with('user',$user);
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.following')->with('user', $user);
    }
    
}

     

