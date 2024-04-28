<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pro = $request['pro'];
        $comments = Comment::where('product_id', $pro);
        return view('pro', ['comm'=>$comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = $request['comm'];
        $userid = $request['usri'];
        $username = $request['usrn'];
        $proid = $request['pro'];

        $comm = new Comment();

        $comm->name = $username;
        $comm->user_id = $userid;
        $comm->product_id = $proid;
        $comm->comment = $comment;

        $comm->save();

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
