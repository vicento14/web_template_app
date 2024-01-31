<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use App\Http\Controllers\Controller;
use DB;
// use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function signIn(Request $request) {
        $credentials = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($credentials->fails()) {
            return implode(",",$validator->errors()->all());
        }

        if ($credentials->passes()) {
            $username = $request->input('username');
            $password = $request->input('password');

            $user_accounts = UserAccounts::where([[DB::raw('BINARY username'), $username], [DB::raw('BINARY password'), $password]])->get();

            if ($user_accounts->isNotEmpty()) {
                $request->session()->regenerate();
                foreach ($user_accounts as $row) {
                    $role = $row->role;
                    $request->session()->put('username', $username);
                    $request->session()->put('name', $row->full_name);
                    $request->session()->put('section', $row->section);
                    $request->session()->put('role', $row->role);
                }
                if ($role == 'admin') {
                    return redirect()->intended('admin/dashboard');
                } elseif ($role == 'user') {
                    return redirect()->intended('user/pagination');
                }
            } else {
                return redirect('login/sign-in-failed');
            }

            /*try {
                // SQL SERVER
                //$sql = "SELECT full_name, section, role FROM user_accounts WHERE username = :username COLLATE SQL_Latin1_General_CP1_CS_AS AND password = :password COLLATE SQL_Latin1_General_CP1_CS_AS";
                // MySQL
                $sql = "SELECT full_name, section, role FROM user_accounts WHERE BINARY username = :username AND BINARY password = :password";
                $results = DB::connection('mysql')->select($sql, ['username' => $username, 'password' => $password]);
                if (count($results) > 0) {
                    $request->session()->regenerate();
                    foreach ($results as $row) {
                        $role = $row->role;
                        $request->session()->put('username', $username);
                        $request->session()->put('name', $row->full_name);
                        $request->session()->put('section', $row->section);
                        $request->session()->put('role', $row->role);
                    }
                    if ($role == 'admin') {
                        return redirect()->intended('admin/dashboard');
                    } elseif ($role == 'user') {
                        return redirect()->intended('user/pagination');
                    }
                    //return 'success';
                    //return redirect()->intended('dashboard');
                    //return json_encode($results);
                } else {
                    return redirect('login/sign-in-failed');
                    //return 'failed';
                }
            } catch (QueryException $e) {
                //Log::error('QueryException: ' . $e->getMessage());
                return 'QueryException: '.$e->getMessage();
            }*/
        }
    }

    function signOut(Request $request) {
        $request->session()->forget('username');
        $request->session()->forget('name');
        $request->session()->forget('section');
        $request->session()->forget('role');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
