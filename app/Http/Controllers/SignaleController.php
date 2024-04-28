<?php

namespace App\Http\Controllers;

use App\Models\Signale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SignaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $user = User::find($id);
        $email = $user->email;
        return view('signale.create', ['uid' => $id, 'email' => $email]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ch1 = $request->boolean('sca');
        $ch2 = $request->boolean('ill');
        $ch3 = $request->boolean('pis');
        $ch4 = $request->boolean('pri');

        $text = "";

        if($ch1 == true){
            $text .= " This user is a scammer, ";
        }

        if($ch2 == true){
            $text .= " This user is selling illegal products, ";
        }

        if($ch3 == true){
            $text .= " This user is putting bad pictures , ";
        }

        if($ch4 == true){
            $text .= " This user is putting Bad prices  , ";
        }

        $sin = new Signale();

        $sin->user_id1 = Auth::user()->id;
        $sin->user_id2 = $request->input('uid');
        $sin->problem = $text;
        $sin->email1 = Auth::user()->email;
        $sin->email2 = $request->input('email');

        $sin->save();

        return redirect("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Signale $signale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signale $signale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signale $signale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signale $signale)
    {
        //
    }
}
