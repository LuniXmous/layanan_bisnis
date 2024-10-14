<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function loginSSO()
    {
        return Socialite::driver('pnj')->redirect();
    }

    public function callbackSSO()
    {
        $user = Socialite::driver('pnj')->user();
        if ($user) {
            $data = $user->user;
            $userDb = User::where("email", $data['email'])->first();
            if ($userDb) {
                Auth::login($userDb);
                return redirect()->route("login");
            } else {
                return view("auth.sso", [
                    "data" => $data,
                ]);
            }
        } else {
            return redirect("/login");
        }
    }
    public function registerSSO(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:8',
            ]
        );
        if (strlen($request->password) < 8) {
            return redirect()->route("login")->with('error', 'Password minimal 8 karakter, silahkan coba lagi');
        }
        if ($request->password != $request->repassword) {
            return redirect()->route("login")->with('error', 'Password tidak sama, silahkan coba lagi');
        }

        $user = User::forceCreate([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'email_verified_at' => Carbon::now(),
            'status' => 1,
        ]);
        if ($user) {
            Auth::login($user);
            return redirect()->route("login");
        } else {
            return redirect()->route("login")->with('error', 'Gagal membuat user, silahkan coba lagi');
        }
    }

    public function forceLogin($id)
    {
        if (Auth::loginUsingId($id)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email', 'status', 'role_id'])
                ->whereHas('role', function ($role) {
                    $role->where('alias', '!=', 'unit');
                })->get();
            $json = DataTables::collection($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return '<span class="badge bg-' . ($row->status == 1 ? 'success' : 'danger') . '">' . ($row->status == 1 ? 'Aktif' : 'Dinonaktifkan') . '</span>';
                })
                ->addColumn('role', function ($row) {
                    return $row->role->name;
                })
                ->addColumn('action', function ($row) {
                    $html = '
                        <a href="' . route('user.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                    ';
                    if (Auth::user()->role_id != $row->role_id) {
                        $html .= '
                            <a href="#" onclick="nonactiveUser(\'' . $row->id . '\')" class="btn btn-sm btn-' . ($row->status == 1 ? 'danger' : 'success') . '">' . ($row->status == 1 ? 'Nonaktifkan' : 'Aktifkan') . '</a>
                        ';
                    }

                    if (env('GOD_MODE') && Auth::user()->id != $row->id) {
                        $html .= '
                            <a class="btn btn-sm btn-outline-dark mt-2" href="' . route('god_mode.forcelogin', ['id' => $row->id]) . '">Login as ' . $row->name . '</a>
                        ';
                    }
                    return $html;
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
            return $json;
        }
        return view('user.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', [
            'data' => $user,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ]
        );
        $update = 0;
        if ($request->password) {
            $request->validate(
                [
                    'password' => 'required|min:8',
                    're_password' => 'required|same:password',
                ]
            );
            $update = User::findOrFail(Auth::user()->id)->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $update = User::findOrFail(Auth::user()->id)->update([
                'name' => $request->name,
            ]);
        }
        if ($update) {
            return redirect('/profile')->with('success', 'Profile Berhasil diubah');
        } else {
            return redirect('/profile')->with('error', 'Profile Gagal diubah');
        }
    }

    public function create()
    {
        $roles = Role::where('alias', '!=', 'unit')->get();
        return view('user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'unique:users,email',
                'password' => 'required|min:8',
                're_password' => 'required|same:password',
            ]
        );
        $unit = null;
        $role = '38b79570-06d5-4b16-ae74-313ed3879bb6'; // admin unit
        $redirect = 'user.index';
        $data = [];
        if ($request->unit) {
            $request->validate([
                'unit' => 'required|exists:App\Models\Unit,id',
            ]);
            $unit = $request->unit;
            $redirect = 'unit.detail';
            $data["id"] = $request->unit;
        } else {
            $request->validate([
                'role' => 'required|exists:App\Models\Role,id',
            ]);
            $role = $request->role;
        }
        $user = User::forceCreate([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role,
            'unit_id' => $unit,
            'email_verified_at' => Carbon::now(),
            'status' => 1,
        ]);
        if ($user) {
            if ($unit != null) {
                Unit::find($unit)->update([
                    "admin_id" => $user->id,
                ]);
            }
            \Mail::to($user->email)->send(new \App\Mail\userMail($user, $request->password));
            return redirect()->route($redirect, $data)->with('success', 'Berhasil ditambah');
        } else {
            return redirect()->route($redirect, $data)->with('error', 'Gagal ditambah');
        }
    }

    public function edit($id)
    {
        $roles = Role::where('alias', '!=', 'unit')->get();
        $user = User::find($id);
        return view('user.edit', [
            'roles' => $roles,
            'data' => $user,
        ]);
    }

    public function updateUser(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
            ]
        );
        $update = 0;
        if ($request->password) {
            $request->validate(
                [
                    'password' => 'required|min:8',
                    're_password' => 'required|same:password',
                ]
            );
            $update = User::findOrFail($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $update = User::findOrFail($request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role,
            ]);
        }
        if ($update) {
            return redirect()->back()->with('success', 'Berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Gagal diubah');
        }
        dd($request->input(), $update);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $update = $user->update([
                'status' => 0,
            ]);
        } else {
            $update = $user->update([
                'status' => 1,
            ]);
        }
        if ($update) {
            return response(['status' => 'ok'], 200);
        } else {
            return response(['status' => 'fail'], 422);
        }
    }
}
