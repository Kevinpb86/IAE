<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    /**
     * Display the user's settings form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('settings');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'string', Rule::in(['male', 'female'])],
            'date_of_birth' => ['nullable', 'date'],
        ]);

        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;

        $user->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
} 