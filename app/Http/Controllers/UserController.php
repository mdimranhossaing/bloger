<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('auth')->except([
            'register',
            'store',
            'login',
            'authenticate'
        ]);
    }

    /**
     * Display a registration form.
     */
    public function register()
    {

        return view('admin.auth.register');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:250|unique:users',
            'photo' => 'required|mimes:png,jpg',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->extension();
            $photo->move(public_path('upload'), $photo_name);
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'photo' => $photo_name,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     */
    public function login()
    {
        return view('admin.auth.login');
    }

    /**
     * Authenticate the user.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    /**
     * Display a dashboard to authenticated users.
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $data['title'] = 'Dashboard';
            return view('admin.auth.dashboard',$data);
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }

    public function profile()
    {
        if (Auth::check()) {
            $data['user'] = auth()->user();
            $data['title'] = 'Profile';
            return view('admin.user.profile', $data);
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $user_id = auth()->user()->id;
            $user = User::where('id', $user_id)->get()->first();

            $request->validate([
                'name' => 'string|max:250',
                'photo' => 'mimes:png,jpg',
            ]);

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo_name = time() . '.' . $photo->extension();
                $photo->move(public_path('upload'), $photo_name);

                $old_photo = public_path('upload/'. $user->photo);

                if (\File::exists($old_photo)) {
                    \File::delete($old_photo);
                }
            } else {
                $photo_name = $user->photo;
            }



            $user->update([
                'name' => $request->name,
                'photo' => $photo_name
            ]);

            return redirect()->route('user.profile')
                ->withSuccess('Profile updated!');
        }
    }

    /**
     * Log out the user from application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login')
            ->withSuccess('You have logged out successfully!');
        ;
    }

    // All users
    public function index()
    {
        $data['users'] = User::orderBy('id', 'DESC')->get();
        $data['title'] = 'All Users';
        return view('admin.user.index',$data);
    }

    public function create()
    {
        $data['users'] = User::orderBy('id', 'DESC')->get();
        $data['title'] = 'All Users';
        return view('admin.user.create',$data);
    }

    /**
     * Store a new user.
     */
    public function create_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:250|unique:users',
            'photo' => 'required|mimes:png,jpg',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->extension();
            $photo->move(public_path('upload'), $photo_name);
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'photo' => $photo_name,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('all.users')
            ->withSuccess('User added successfully!');
    }
}
