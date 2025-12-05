<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Middleware\AdminMiddleware;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    function __construct() {
        $this->middleware(AdminMiddleware::class);
        //$this->middleware('admin');
    }

    function create(): View {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.create', compact('rols'));
    }

    function destroy(User $user): RedirectResponse {
        try {
            $result = $user->delete();
            $message = 'The user has been deleted.';
        } catch(\Exception $e) {
            $result = false;
            $message = 'The user has not been deleted.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('user.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    function edit(User $user): View {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.edit', [
            'user' => $user,
            'rols' => $rols,
        ]);
    }

    function index(): View {
        return view('user.index', ['users' => User::all()]);
    }

    function show(User $user): View {
        return view('user.show', ['user' => $user]);
    }

    function store(Request $request): RedirectResponse {
        $result = false;
        $user = new User($request->all());
        $user->password = Hash::make($user->password);
        $user->email_verified_at = Carbon::now();
        try {
            $result = $user->save();
            $message = 'The user has been added.';
        } catch(\Exception $e) {
            $message = 'The user has bnot been added.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('user.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }

    function update(Request $request, User $user): RedirectResponse {
        $result = false;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        if($request->verified != null) {
            if($user->email_verified_at == null) {
                $user->email_verified_at = Carbon::now();
            }
        } else {
            $user->email_verified_at = null;
        }
        if($request->password != null) {
            $user->password = Hash::make($user->password);
        }
        try {
            $result = $user->save();
            $message = 'The user has been edited.';
        } catch(\Exception $e) {
            $message = 'The user has not been edited.';
        }
        $messageArray = [
            'general' => $message
        ];
        if($result) {
            return redirect()->route('user.index')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
}