<?php

namespace App\Http\Controllers\Staffview;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// get all the items
        $blogs = Blog::all();

        // load the view and pass the items        

        return view('staffview.blogs.list')
			->with('blogs', $blogs);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffview.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)	
    {
		$user = auth()->user()->id;
		
		$this->validate($request, [
			'title' => 'required',
			'content' => 'required',
		]);

		$blog = Blog::create([
			'title' =>  $request->input('title'),
			'content' =>  $request->input('content'),
			'id_user' =>  $user,
		]);
	
        return redirect()->route('blogs.index')->with('success', "$blog->title berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $blogs = Blog::findOrFail($id);		
		
			return view('staffview.blogs.delete')
				->with('blogs', $blogs);
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		 try{
            $blogs = Blog::findOrFail($id);		
		
			return view('staffview.blogs.edit')
				->with('blogs', $blogs);
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		try{

			$this->validate($request, [
				'blog_name' => 'required|unique:blogs,blog_name,'.$id,
			]);

            $blogs = Blog::findOrFail($id);	

			$blogs->blog_name = $request->input('blog_name');
            $blogs->save();
		
			return redirect()->route('blogs.index')->with('success', "$blogs->blog_name berhasil diubah.");
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 try{
            $blogs = Blog::findOrFail($id);	

			$blogs->delete();
		
			return redirect()->route('blogs.index')->with('success', "$blogs->blog_name berhasil dihapus");
		}
		catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
