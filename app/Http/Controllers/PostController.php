<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Post::latest()->paginate(5);
        return view('admin.index',compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();
        if($request->image->isValid()){
            
            $file = Str::of($request->title)->slug("-"). '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $file);
            $data['image'] = $image;
        }

        Post::create($data);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$post = Post::find($id)){
            return redirect()->route('post.index');
        }

        return view('admin.show', compact('post'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        if(!$post = Post::find($id)){
            return redirect()->route('post.edit');
        }

        return view('admin.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePost $request, $id)
    {
        if(!$post = Post::find($id)){
            return redirect()->route('post.edit');
        }

        $data = $request->all();
        if($request->image && $request->image->isValid()){

            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }
            
            $file = Str::of($request->title)->slug("-"). '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $file);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()->route('post.index')->with('message','Post atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$post = Post::find($id)){
            return redirect()->route('post.index');
        }

        if(Storage::exists($post->image)){
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()->route('post.index')->with('message', 'Post Deletado com sucesso');
    }

    public function search(Request $request){

        $filters = $request->except('_token');

        $dados = Post::where('title','LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate(5);
        
        return view('admin.index', compact('dados', 'filters'));
    }
}
