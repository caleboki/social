<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
* 
*/
class PostController extends Controller
{
	public function getDashboard(){

		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboard', ['posts' =>$posts]);
	}
	public function CreatePost(Request $request)
	{
		$this->validate($request, [
			'body'=>'required|max:2000']);
		$message = "There was an error";

		$post = new Post();
		$post->body = $request['body'];
		if ($request->user()->post()->save($post)) 
		{

			$message = "Post successfully created";
		}
		//dd($message);
		return redirect()->route('dashboard')->with(['message' => $message]);
		
	}

	public function getDeletePost($post_id)
	{
		$post = Post::where('id', $post_id)->first();
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
	}
}