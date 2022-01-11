<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::all()->sortBy('user_must');
        return view('backend.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|Min:6'
        ]);

        if ($request->hasFile('user_file')) {
            $request->validate([
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'), $file_name);
        } else {
            $file_name = null;
        }


        $user = User::insert(
            [
                "name" => $request->name,
                "user_file" => $file_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "user_status" => $request->user_status
            ]
        );

        if ($user) {
            return redirect(route('user.index'))->with('success', 'Insert was successfully');
        }
        return back()->with('error', 'Insert was not successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return view('backend.users.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($request->hasFile('user_file')) {

            $request->validate([
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'), $file_name);

            if (strlen($request->password) > 0) {

                $request->validate([
                    'password' => 'required|Min:6'
                ]);

                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "user_file" => $file_name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "user_status" => $request->user_status
                    ]
                );
            } else {
                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "user_file" => $file_name,
                        "email" => $request->email,
                        "user_status" => $request->user_status
                    ]
                );
            }

            $path = 'images/users/' . $request->old_file;

            if (file_exists($path)) {
                @unlink(public_path($path));
            }

        } else {

            if (strlen($request->password) > 0) {

                $request->validate([
                    'password' => 'required|Min:6'
                ]);

                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "user_status" => $request->user_status
                    ]
                );

            } else {
                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_status" => $request->user_status
                    ]
                );
            }
        }


        if ($user) {
            return back()->with('success', 'Update was successfully');
        }
        return back()->with('error', 'Update was not successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find(intval($id));
        if ($user->delete()) {
            echo 1;
        }
        echo 0;
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value) {
            $users = User::find(intval($value));
            $users->user_must = intval($key);
            $users->save();
        }
        echo true;
    }

}
