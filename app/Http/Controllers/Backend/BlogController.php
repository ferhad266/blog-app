<?php

namespace App\Http\Controllers\Backend;

use App\Blogs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $data['blog'] = Blogs::all()->sortBy('blog_must');

        return view('backend.blogs.index', compact('data'));
    }


    public function create()
    {
        return view('backend.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_title' => 'required',
            'blog_content' => 'required'
        ]);

        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);
        }

        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_file' => 'required|image|mimes:jpeg,png,png|max:2048'
            ]);

            $fileName = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $fileName);
        } else {
            $fileName = null;
        }

        $blog = Blogs::insert(
            [
                "blog_title" => $request->blog_title,
                "blog_slug" => $slug,
                "blog_file" => $fileName,
                "blog_content" => $request->blog_content,
                "blog_status" => $request->blog_status
            ]
        );

        if ($blog) {
            return redirect(route('blog.index'))->with('success', 'Insert was successfully!');
        }
        return redirect(route('blog.index'))->with('error', 'Insert was successfully!');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $blogs = Blogs::where('id', $id)->first();

        return view('backend.blogs.edit')->with('blogs', $blogs);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'blog_title' => 'required',
            'blog_content' => 'required'
        ]);

        if (strlen($request->blog_slug) > 3) {
            $slug = Str::slug($request->blog_slug);
        } else {
            $slug = Str::slug($request->blog_title);
        }

        if ($request->hasFile('blog_file')) {
            $request->validate([
                'blog_file' => 'required|image|mimes:jpeg,png,png|max:2048'
            ]);

            $fileName = uniqid() . '.' . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path('images/blogs'), $fileName);

            $blog = Blogs::Where('id', $id)->update(
                [
                    "blog_title" => $request->blog_title,
                    "blog_slug" => $slug,
                    "blog_file" => $fileName,
                    "blog_content" => $request->blog_content,
                    "blog_status" => $request->blog_status
                ]
            );

            $path = 'images/blogs/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }

        } else {

            $blog = Blogs::Where('id', $id)->update(
                [
                    "blog_title" => $request->blog_title,
                    "blog_slug" => $slug,
                    "blog_content" => $request->blog_content,
                    "blog_status" => $request->blog_status
                ]
            );

        }


        if ($blog) {
//            return redirect(route('blog.index'))->with('success', 'Update was successfully!');
            return back()->with('success', 'Update was successfully!');
        }
//        return redirect(route('blog.index'))->with('error', 'Update was not successfully!');
        return back()->with('error', 'Update was not successfully!');
    }

    public function destroy($id)
    {
        $blog = Blogs::find(intval($id));
        if ($blog->delete()) {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
        // value = id , key = must
        foreach ($_POST['item'] as $key => $value) {
            $blog = Blogs::find(intval($value));
            $blog->blog_must = intval($key);
            $blog->save();
        }

        echo true;
    }
}
