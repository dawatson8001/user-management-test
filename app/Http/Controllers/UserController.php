<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'emailAddress' => ['required', 'unique:users,email', 'max:255', 'email'],
            'forename' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'password' => ['required', 'min:8', 'max:20', RulesPassword::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ];
    }

    /**
     * Validation for updating records
     * @return array
     */
    private function _validationUpdate()
    {
        return [
            'emailAddress' => ['unique', 'max:255', 'email'],
            'forename' => ['max:255'],
            'surname' => ['max:255'],
            'password' => ['min:8', 'max:20', RulesPassword::min(8)->mixedCase()->letters()->numbers()->symbols()]
        ];
    }

    /**
     * Validation messages
     * @return array
     */
    private function _validation_message($new = false)
    {
        return [
                'forename.required' => 'Please enter a forename',
                'surname.required' => 'Please enter a surname',
                'emailAddress.required' => 'Please enter an email address',
                'emailAddress.unique:users' => 'Email address already in use',
                'password.required' => 'Please enter a password.',
                'password.min:8' => 'Min length is 8 characters.',
                'password.min:20' => 'Max length is 20 characters.'
            ];
    }

    /**
     * Show all Users
     * Uses livewire template and controller to display and filter page
     *
     * @return View
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show User
     *
     * @param Request $request
     * @param Int $userId
     *
     * @return JSON
     */
    public function show(int $userId)
    {
        $status = 400;
        $response = [];

        //check db for user
        $user = User::find($userId);

        if( isset($user) ) {
            //return user data
            $status = 201;
            $response = [
                "status" => "success",
                "message" => "User found",
                "data" => $user->getCleanUserData()
            ];
        } else {
            //return no user found
            $status = 404;
            $response = [
                "status" => "fail",
                "message" => "User not found."
            ];
        }

        return response()->JSON($response, $status);
    }

    /**
     * Create User
     *
     * @param Request $request
     *
     * @return JSON
     */
    public function create(Request $request)
    {
        $status = 400;
        $response = [];
        //validate data
        $validator = Validator::make($request->all(), $this->_validation(), $this->_validation_message());
        
        if( $validator->fails() ) {
            //data invalid
            $status = 400;
            $response = [
                "status" => "fail",
                "message" => $validator->errors(),
            ];
        } else {
            //data valid
            $user = $this->_store($request);
            $status = 201;
            $response = [
                "status" => "success",
                "message" => "A new user has been created.",
                "data" => $user
            ];
        }

        return response()->json($response, $status);
    }

    /**
     * Update User
     *
     * @param Request $request
     *
     * @return JSON 
     */
    public function update(Request $request)
    {
        $status = 400;
        //validate data
        $validator = Validator::make($request->all(), $this->_validationUpdate(), $this->_validation_message());

        //check userid
        if( $request->has('userId') ) {
            $userId = $request->input('userId');
            $user = User::find($userId);
        }

        if( !isset($user) ) {
            //user not found
            $status = 404;
            $response = [
                "status" => "fail",
                "message" => "User not found."
            ];
        } else {
            if( $validator->fails() ) {
                //data invalid
                $status = 400;
                $response = [
                    "status" => "fail",
                    "message" => $validator->errors(),
                ];  
            } else {                
                //data correct
                $this->_store($request, $user);
                $status = 201;
                $response = [
                    "status" => "success",
                    "message" => "User has been updated."
                ];
 
            }
        }

        return response()->json($response, $status);
    }

    /**
     * Store User
     *
     * @param Request $request
     * @param int $userId
     *
     */
    private function _store(Request $request, User $user = new User())
    {

        if( $request->has('forename') ) {
            $user->first_name = $request->input('forename');
        }

        if( $request->has('surname') ) {
            $user->last_name = $request->input('surname');
        }

        if( $request->has('emailAddress') ) {
            $user->email = $request->input('emailAddress');
        }

        if( $request->has('userLevel') ) {
            $user->user_type = $request->input('userLevel', 'USER_LEVEL_1');
        } elseif( !isset($user->id) ) {
            $user->user_type = $request->input('userLevel', 'USER_LEVEL_1');
        }

        if( $request->has('password') ) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();

        return $user;
    }
}
