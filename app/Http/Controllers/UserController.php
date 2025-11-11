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
                        <a href="' . route('user.edit', ['id' => $row->id]) . '" class="btn btn-sm"><i class="fa-solid fa-pen fa-lg" style="color: #ffc800;"></i></a>
                    ';
                    if (Auth::user()->role_id != $row->role_id) {
                        $html .= '
                        <a href="#" style="margin-left:10px;" onclick="nonactiveUser(\''.$row->id.'\')" title="'.($row->status == 1 ? 'Nonaktifkan Pengguna' : 'Aktifkan Pengguna').'">'.($row->status == 1 ? '<i class="fa-solid fa-user-slash fa-lg" style="color:#dc3545;"></i>' : '<i class="fa-solid fa-user-check fa-lg" style="color:#198754;"></i>').'</a>                        
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
        $user = Auth::user()->load('unit'); // Load relasi unit
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

    // Tambahkan method private untuk validasi ukuran file
    private function validateFileSize($file, $type = 'document')
    {
        if (!$file) {
            return true;
        }
        
        $maxSize = $type === 'image' ? 500 : 2048; // 500KB untuk image, 2MB untuk document
        $fileSizeKB = $file->getSize() / 1024;
        
        return $fileSizeKB <= $maxSize;
    }

    public function create()
    {
        $roles = Role::all();
        $units = Unit::all();  // Mengambil semua unit
        return view('user.create', [
            'roles' => $roles,
            'units' => $units, // Mengirim data unit ke form
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
                'role' => 'required|exists:App\Models\Role,id', // Validasi role yang dipilih
            ]
        );
    
        $role = $request->role;  // Ambil role_id dari input
        $unit = $request->unit_id;  // Ambil unit_id dari input
        $redirect = 'user.index';
        $data = [];
    
        if ($unit) {
            $redirect = 'unit.detail';
            $data["id"] = $unit;
        }
    
        // Create user with selected role and unit_id
        $user = User::forceCreate([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role,  // Menggunakan role_id yang dipilih di form
            'unit_id' => $unit,  // Menggunakan unit_id yang dipilih di form
            'email_verified_at' => Carbon::now(),
            'status' => 1,
        ]);
    
        if ($user) {
            if ($unit) {
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
        $user = User::find($id);
        $roles = Role::all();
        $units = Unit::all();  // Mengambil semua unit
    
        return view('user.edit', [
            'data' => $user,
            'roles' => $roles,
            'units' => $units,  // Kirim data unit ke view
        ]);
    }

    public function updateUser(Request $request)
{
    // Validasi
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required|exists:roles,id',
    ]);

    // Ambil data user yang ingin diubah
    $user = User::findOrFail($request->id);

    // Persiapkan data untuk diupdate
    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role,
    ];


    // Tambahkan password jika ada
    if ($request->password) {
        $request->validate([
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
        ]);
        $updateData['password'] = Hash::make($request->password);
    }

    // Update data user
    $update = $user->update($updateData);

    // Kembali ke halaman dengan pesan sukses/gagal
    if ($update) {
        return redirect()->route('user.index')->with('success', 'Berhasil diubah');
    } else {
        return redirect()->route('user.index')->with('error', 'Gagal diubah');
    }
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
