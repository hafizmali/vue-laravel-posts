<?php

namespace newLife\Http\Controllers;

use Illuminate\Http\Request;
use newLife\Http\Resources\PostCollection;
use newLife\Post;

class PostController extends Controller
{
   public function store(Request $request)
    {
      $post = new Post([
        'title' => $request->get('title'),
        'body' => $request->get('body')
      ]);

      $post->save();

      return response()->json('successfully added');
    }

    public function index()
    {
        $posts = Post::all();
        
        $activeposts = $posts->where('is_deleted', 0);
        
        $activeposts->all();
        
        return new PostCollection($activeposts);
    }
    
    public function deletedposts()
    {
       
        $posts = Post::all();
        
        $deletedposts = $posts->where('is_deleted', 1);
        
        $deletedposts->all();
        
        return new PostCollection($deletedposts);
    }

    public function edit($id)
    {
    	    //  var_dump($id);
      $post = Post::find($id);
     // var_dump($post);
      return response()->json($post);
    }

    public function update($id, Request $request)
    {
      $post = Post::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->update(array('is_deleted' => 1));
      return response()->json('successfully deleted');
    }
    public function restoreposts($id)
    {
        $post = Post::find($id);
        $post->update(array('is_deleted' => 0));
        
        return response()->json('successfully Restore');
    }
    
    
}
