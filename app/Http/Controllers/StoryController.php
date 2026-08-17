<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Story;
use App\Models\StoryLike;
use App\Models\StoryComment;
use Illuminate\Support\Facades\Storage;


class StoryController extends Controller
{
    private $story;

    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    

   
    public function store(Request $request)
    {
        
        $request->validate([
            'media' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov|max:20480',
        ]);

        // 2. check file
        $file = $request->file('media');
        $mimeType = $file->getMimeType();
        $mediaType = str_contains($mimeType, 'video') ? 'video' : 'image';

        // 3. save the story
        $this->story->user_id = Auth::user()->id;
        $this->story->media = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($file));
        $this->story->media_type = $mediaType;
        $this->story->save();

        // 4. go back to homepage
        return redirect()->back()->with('success', 'Story uploaded successfully!');
    }

    // achive
   

    public function archive()
    {
        $stories = Auth::user()->stories()->latest()->get();
        return view('users.stories.archive', compact('stories'));
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        if ($story->user_id !== Auth::id()) {
            return redirect()->back()->with('error', ' Unauthorized access.');
        }

        if ($story->image_path && Storage::exists($story->image_path)) {
            Storage::delete($story->image_path);
        }

        $story->delete();

        return redirect()->back()->with('success', 'Story deleted successfully.');
    }

        public function like($storyId)
        {
            $story = Story::findOrFail($storyId);

            if (!$story->isLiked()) {
                StoryLike::create([
                    'story_id' => $story->id,
                    'user_id'  => Auth::id(),
                ]);
            }

          return redirect()->back()->with('open_modal', $story->user_id);
        }

      
        public function unlike($storyId)
        {
            $story = Story::findOrFail($storyId);

            if ($story->isLiked()) {
                StoryLike::where('story_id', $story->id)
                        ->where('user_id', Auth::id())
                        ->delete();
            }

            return redirect()->back()->with('open_modal', $story->user_id);

        }

   
        public function storeComment(Request $request, $storyId)
        {
            $request->validate([
                'body' => 'required|max:255',
            ]);

            StoryComment::create([
                'story_id' => $storyId,
                'user_id'  => Auth::id(),
                'body'     => $request->body,
            ]);

            return redirect()->back();
        }
}

