<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UserController extends Controller
{
    /**
     * Validation
     * @return array
     */
    private function _validation()
    {
        return [
            'email' => ['required', 'unique', 'max:255', 'email'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'password' => ['required', 'min:8', 'max:20', RulesPassword::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ];
    }

    /**
     * Validation messages
     * @return array
     */
    private function _validation_message($new = false)
    {
        return [
                'first_name.required' => 'Please enter a forename',
                'last_name.required' => 'Please enter a surname',
                'email.required' => 'Please enter an email address',
                'email.unique:users' => 'Email address already in use',
                'password.required' => 'Please enter a password.',
                'password.min:8' => 'Min length is 8 characters.',
                'password.min:20' => 'Max length is 20 characters.'
            ];
    }

    /**
     * Show all Users
     *
     * @return View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Create User
     *
     * @param Request $request
     *
     * @return View
     */
    public function create(Request $request)
    {

    }

    /**
     * Update User
     *
     * @param Request $request
     * @param int $userId
     *
     * @return View
     * @throws AuthorizationException
     */
    public function update(Request $request, $userId)
    {

    }

    /**
     * Store User
     *
     * @param Request $request
     * @param int $userId
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request, int $userId)
    {
        $request->validate($this->_validation(), $this->_validation_message());

        $user = User::findOrFail($userId);
    
        if( !isset($user) ) {
            $user = new User();
            $user->password = Hash::make(Str::random(12));
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->user_type = $request->input('user_type', 'USER_LEVEL_1');

        $user->save();

        return redirect(Route('user.index'));
    }
}
