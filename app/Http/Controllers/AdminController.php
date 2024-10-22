<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');  // Make sure this points to the correct view
    }

    // Ensure the user is authenticated as an admin
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard method for the admin
    public function dashboard()
    {
        // Return the admin dashboard view
        return view('admin.dashboard');
    }
    
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->content;
        $page->image = $request->image;
        $page->save();

        return redirect()->route('admin.dashboard');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->image = $request->image;
        $page->save();

        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        Page::destroy($id);
        return redirect()->route('admin.dashboard');
    }
}
