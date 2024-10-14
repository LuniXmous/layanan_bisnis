<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApplicationExport;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\Document;
use App\Models\ExtraApplication;
use App\Models\ExtraApplicationDocument;
use App\Models\ApplicationStatusLog;
use Illuminate\Support\Facades\Storage;
use App\Models\Unit;
use DataTables;
use Auth;
use Carbon\Carbon;
use Exception;
use Psy\Readline\Hoa\FileException;

class ApplicationController extends Controller
{
    private function comment($application): bool
    {
        $comment = false;
        if ($application) {
            if ($application->status == 1) {
                if ($application->approve_status == 0 && Auth::user()->role_id == 2 && $application->note == null) {
                    $comment = true;
                } else if ($application->approve_status == 1 && Auth::user()->role_id == 0) {
                    $comment = true;
                } else if ($application->approve_status == 2 && Auth::user()->role_id == 4) {
                    $comment = true;
                } else if ($application->approve_status == 3 && Auth::user()->role_id == 5) {
                    $comment = true;
                }
            } else {
                if ($application->approve_status == 1 && Auth::user()->role_id == 4) {
                    $comment = true;
                } else if ($application->approve_status == 2 && Auth::user()->role_id == 3) {
                    $comment = true;
                }
            }
        }
        return $comment;
    }
    public function export(Request $request)
    {
        if (Auth::user()->role_id == 0 || Auth::user()->role_id == 2 || Auth::user()->role_id == 4 || Auth::user()->role_id == 3 || Auth::user()->role_id == 5) {
            return Excel::download(new ApplicationExport(), 'application.xlsx');
        } else {
            return redirect()->back();
        }
    }

    

    public function index(Request $request)
{
    if ($request->ajax()) {
        $applications = Application::query();

        // Jika ada approve_status, lakukan filter
        if ($request->has('approve_status') && $request->approve_status !== '') {
            // Periksa apakah approve_status adalah gabungan beberapa status
            if ($request->approve_status === '1,2,3') {
                $applications->whereIn('approve_status', [1, 2, 3]); // Filter untuk status 1, 2, dan 3
            } else {
                $applications->where('approve_status', $request->approve_status);
            }
        }

        // Kembalikan data ke DataTables
        return DataTables::of($applications->get())
            ->addIndexColumn()
            ->addColumn('title', function($row){
                return '<a href="' . route('application.detail', ['identifier' => $row->id]) . '">' . $row->title . '</a>';
            })
            ->addColumn('applicant_name', function($row){
                return $row->user->name;
            })
            ->addColumn('unit_name', function($row){
                return $row->activity->unit->name;
            })
            ->addColumn('category_name', function($row){
                return $row->activity->category->name;
            })
            ->addColumn('status_applicant', function($row){
                return '<span class="badge ' . $row->statusAlias()['class'] . '">' . $row->statusAlias()['status'] . '</span>';
            })
            ->addColumn('created_at', function($row){
                return Carbon::parse($row->created_at)->format('d-m-Y H:i');
            })
            ->rawColumns(['title', 'status_applicant'])
            ->make(true);
    }

    // Jika bukan AJAX, kembalikan tampilan
    return view('application.index');
}

    

    // public function updateStatus(Request $request, $id)
    // {
    //     $application = Application::findOrFail($id);
        
    //     $oldStatus = $application->status; // Ambil status lama
    //     $newStatus = $request->input('status'); // Ambil status baru dari request
    
    //     // Update status aplikasi
    //     $application->status = $newStatus;
    //     $application->save();
    
    //     // Simpan log status
    //     ApplicationStatusLog::create([
    //         'application_id' => $application->id,
    //         'old_status' => $oldStatus,
    //         'new_status' => $newStatus,
    //     ]);
    
    //     return redirect()->back()->with('success', 'Status updated successfully.');
    // }
    

        public function generateStatusTimeline($submissionLogs, $application)
    {
        $html = '<div style="display: flex; justify-content: flex-start; align-items: flex-start; position: relative; margin: 20px auto; padding: 0; width: 100%; max-width: 900px;">';

        foreach ($submissionLogs as $log) {
            $statusText = '';

            // Tentukan status text berdasarkan status log
            if ($log->status == 1) {
                $statusText = 'Setelah Direview Admin';
            } elseif ($log->status == 2) {
                $statusText = 'Telah di res';
            } elseif ($log->status == 3) {
                $statusText = 'Direview Oleh ' . $log->user->name;
            } elseif ($log->status == 4) {
                $statusText = 'Telah di review Wakil Direktur 4';
            } elseif ($log->status == 5) {
                $statusText = 'Telah di review blalalalal';
            }

            // Append HTML untuk setiap status
            $html .= '
                <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;">
                    <div style="width: 30px; height: 30px; border-radius: 50%; background-color: #4caf50; margin-bottom: 10px;"></div>
                    <p style="font-size: 14px; text-align: center;">' . $statusText . '</p>
                </div>';
        }

        // Tambahkan waktu update dari aplikasi
        $html .= '<p style="font-size: 14px; text-align: center;">' . $application->updated_at . '</p>';

        $html .= '</div>';

        return $html;
    }


    public function showSubmissionLog($id)
    {
        $application = Application::findOrFail($id);
        $submissionLogs = ApplicationStatusLog::where('application_id', $id)
                                ->orderBy('created_at', 'desc')
                                ->get();
    
        // Generate HTML untuk status timeline
        $statusTimelineHtml = $this->generateStatusTimeline($submissionLogs, $application);
    
        // Kembalikan ke view dengan status timeline HTML
        return view('application.detail', compact('application', 'submissionLogs', 'statusTimelineHtml'));
    }
    


//     public function reviewAdmin(Request $request)
// {
//     if ($request->ajax()) {
//         $data = Application::where('status', 'Menunggu Review Admin')->get();
//         $json = DataTables::collection($data)
//             ->addIndexColumn()
//             ->addColumn('action', function($row){
//                 // action buttons
//                 return '<a href="'.route('application.show', $row->id).'" class="btn btn-sm btn-info">Detail</a>';
//             })
//             ->toJson();
//         return $json;
//     }
//     return view('application.index');
// }

// public function reviewWadir4(Request $request)
// {
//     if ($request->ajax()) {
//         $data = Application::where('status', 'Menunggu Review Wakil Direktur 4')->get();
//         $json = DataTables::collection($data)
//             ->addIndexColumn()
//             ->addColumn('action', function($row){
//                 // action buttons
//                 return '<a href="'.route('application.show', $row->id).'" class="btn btn-sm btn-info">Detail</a>';
//             })
//             ->toJson();
//         return $json;
//     }
//     return view('application.index');
// }



    public function indexTebusan(Request $request)
    {
        if (Auth::user()->role->id != 3) {
            return redirect()->route("application.index")->with(["error" => "Akses Tidak Diizinkan"]);
        }
        if ($request->ajax()) {
            $applications = Application::where("status", 1)->where("approve_status", 4)->orWhere("status", ">=", 2)->orderBy('updated_at', 'desc')->get();
            $json = DataTables::collection($applications)
                ->addIndexColumn()
                ->addColumn('title', function ($row) {
                    $html = '
                        <a href="' . route('application.detail', ['identifier' => $row->id]) . '"> ' . $row->title . ' </a>
                    ';
                    return $html;
                })
                ->addColumn('updated_at', function ($row) {
                    $html = Carbon::parse($row->updated_at)->translatedFormat('d F Y, H:i');
                    return $html;
                })
                ->addColumn('applicant_name', function ($row) {
                    if (Auth::user()->role_id == 0) {
                        return $row->user->name . ' (' . $row->user->email . ')';
                    } else {
                        return $row->user->name;
                    }
                })
                ->addColumn('unit_name', function ($row) {
                    return $row->activity->unit->name;
                })
                ->addColumn('category_name', function ($row) {
                    return $row->activity->category->name;
                })
                ->addColumn('activity_name', function ($row) {
                    return $row->activity->name;
                })
                ->addColumn('status_applicant', function ($row) {
                    return '<span class="badge ' . $row->statusAlias()['class'] . '"> ' . $row->statusAlias()['status'] . ' </span>';
                })
                // ->addColumn('action', function ($row) {
                //     $html = '
                //         <a class="btn btn-primary" href="' . route('application.detail', ['identifier' => $row->id]) . '"> Detail </a>
                //     ';
                //     return $html;
                // })
                ->rawColumns(['title', 'applicant_name', 'unit_name', 'category_name', 'status_applicant', 'activity_name', 'action'])
                ->toJson();
            return $json;
        }

        return view('application.index');
    }

    public function show(Request $request)
    {
        if (Auth::user()->role->id != 1) {
            $application = Application::find($request->identifier);
            if (!in_array(Auth::user()->role_id, $application->statusAlias()['must_role'])) {
                return redirect()->route("application.index")->with(["error" => "Akses Tidak Diizinkan"]);
            }
        } else {
            $application = Auth::user()->application->find($request->identifier);
        }

        //checking logic
        $comment = $this->comment($application);

        $extraType = "";
        if ($application->status > 1 && $application->status != 4) {
            $extraType = ExtraApplication::where("application_id", $application->id)->latest()->first()?->typeAlias();
        }
        $extraApp = "";
        if ($application->activity->category_id == 1) {
            if ($application->approve_status == 4) {
                $extraApp = "Pencairan Dana";
            }
        } else {
            if ($application->status == 1 && $application->approve_status == 4) {
                $extraApp = "Pencairan Dana Operasional";
            } else if ($application->status == 2 && $application->approve_status == 3) {
                $extraApp = "Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan";
            }
        }
        $submissionLogs = ApplicationStatusLog::where('application_id', $application->id)
        ->orderBy('created_at', 'desc')->get();

    // Generate HTML for status timeline
    $statusTimelineHtml = $this->generateStatusTimeline($submissionLogs, $application);

    // Return view with all necessary data
    return view('application.detail', [
        "submissionLogs" => $submissionLogs,
        "application" => $application,
        "extraType" => $extraType,
        "extraApp" => $extraApp,
        "comment" => $comment,
        "statusTimelineHtml" => $statusTimelineHtml,
    ]);
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);
        if ($application->approve_status != 0) {
            return redirect()->route("application.index")->with(["error" => "Akses Tidak Diizinkan"]);
        }
        if (Auth::user()->role->id != 1 && $application->status != 0) {
            return redirect()->route("application.index")->with(["error" => "Akses Tidak Diizinkan"]);
        }
        if ($application) {
            $unit = Unit::all();
            return view('application.edit', [
                'unit' => $unit,
                'application' => $application,
                'latestExtra' => $application->latestExtra->count() > 0 ? $application->latestExtra->first() : null,
            ]);
        } else {
            return redirect()->route('application.index')->with(["error" => "Pengajuan tidak ditemukan"]);
        }
    }

    // public function editExtra($id)
    // {
    //     $application = Application::findOrFail($id);
    //     $latestExtra = $this->getLatestExtra($id);
    //     if ($application) {
    //         return view('application.edit', [
    //             'application' => $application,
    //             'extraApp' => $latestExtra,
    //             'step' => $application->extra->count(),
    //         ]);
    //     } else {
    //         return redirect()->route('application.index')->with(["error" => "Pengajuan tidak ditemukan"]);
    //     }
    // }

    public function done($id)
    {
        $application = Auth::user()->application->find($id);
        if (!$application) {
            return redirect()->back()->with(["error" => "invalid action"]);
        }

        $application->update([
            "status" => 4,
        ]);
        return redirect()->back()->with(["success" => "Status Pengajuan Berhasil Diubah"]);
    }

    public function applyExtra(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        //check if exist?
        if ($application->activity->category_id == 1) {
            $request->validate([
                "title" => "required",
                "description" => "required",
                "lampiran.transfer" => "required",
            ]);
            $extraApplication = ExtraApplication::create(
                [
                    'application_id' => $application->id,
                    'type' => "dana",
                    'title' => $request->title,
                    'description' => $request->description,
                ]
            );
            if ($extraApplication) {
                $lampiran = $request->lampiran["transfer"];
                $name = time() . "_" . $lampiran->getClientOriginalName();
                Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                $doc = ExtraApplicationDocument::create([
                    'extra_application_id' => $extraApplication->id,
                    'title' => "bukti transfer",
                    'type' => "transfer",
                    'ext' => "img",
                    'file' => $name,
                ]);
                $application->update([
                    "status" => $application->status + 1,
                    "approve_status" => 1,
                ]);
            } else {
                return redirect()->back()->with(["error" => "gagal memasukan data, silahkan coba lagi"]);
            }
        } else {
            if ($application->status == 1) {
                $request->validate([
                    "title" => "required",
                    "lampiran.transfer" => "required",
                ]);

                $extraApplication = ExtraApplication::create(
                    [
                        'application_id' => $application->id,
                        'type' => "operasional",
                        'title' => $request->title,
                        'description' => $request->description,
                    ]
                );
                if ($extraApplication) {
                    $lampiran = $request->lampiran["transfer"];
                    $name = time() . "_" . $lampiran->getClientOriginalName();
                    Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                    $doc = ExtraApplicationDocument::create([
                        'extra_application_id' => $extraApplication->id,
                        'title' => "bukti transfer",
                        'type' => "transfer",
                        'ext' => "img",
                        'file' => $name,
                    ]);
                    if (isset($request->lampiran["pks"])) {
                        $lampiran = $request->lampiran["pks"];
                        $name = time() . "_" . $lampiran->getClientOriginalName();
                        Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                        $doc = ExtraApplicationDocument::create([
                            'extra_application_id' => $extraApplication->id,
                            'title' => "pks",
                            'type' => "pks",
                            'ext' => "doc",
                            'file' => $name,
                        ]);
                    }
                    $application->update([
                        "status" => $application->status + 1,
                        "approve_status" => 1,
                    ]);
                } else {
                    return redirect()->back()->with(["error" => "gagal memasukan data, silahkan coba lagi"]);
                }
            } else if ($application->status == 2) {
                $request->validate([
                    "title" => "required",
                    "lampiran.transfer" => "required",
                ]);

                $extraApplication = ExtraApplication::create(
                    [
                        'application_id' => $application->id,
                        'type' => "kegiatan",
                        'title' => $request->title,
                        'description' => $request->description,
                    ]
                );

                if ($extraApplication) {
                    $lampiran = $request->lampiran["transfer"];
                    $name = time() . "_" . $lampiran->getClientOriginalName();
                    Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                    $doc = ExtraApplicationDocument::create([
                        'extra_application_id' => $extraApplication->id,
                        'title' => "bukti transfer",
                        'type' => "transfer",
                        'ext' => "img",
                        'file' => $name,
                    ]);

                    if (isset($request->lampiran["lpj"])) {
                        $lampiran = $request->lampiran["lpj"];
                        $name = time() . "_" . $lampiran->getClientOriginalName();
                        Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                        $doc = ExtraApplicationDocument::create([
                            'extra_application_id' => $extraApplication->id,
                            'title' => "lpj",
                            'type' => "lpj",
                            'ext' => "doc",
                            'file' => $name,
                        ]);
                    }
                    $application->update([
                        "status" => $application->status + 1,
                        "approve_status" => 1,
                    ]);
                } else {
                    return redirect()->back()->with(["error" => "gagal memasukan data, silahkan coba lagi"]);
                }
            } else {
                return redirect()->back()->with(["error" => "invalid action"]);
            }
        }

        $extraApp = "";
        if ($application->activity->category_id == 1) {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana";
            }
        } else {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana Operasional";
            } else if ($application->status == 3) {
                $extraApp = "Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan";
            }
        }

        $users = User::where("role_id", 4)->get();
        foreach ($users as $user) {
            \Mail::to($user->email)->send(new \App\Mail\reviewMail($application, $extraApp));
        }
        return redirect()->back()->with(["success" => "Permohonan berhasil diajukan"]);
    }

    public function approve(Request $request, $id)
    {
        $application = Application::find($id);

        //checking logic
        $comment = $this->comment($application);

        if (!$comment) {
            return redirect()->back()->with(["error" => "invalid action"]);
        }
        $application->update([
            "approve_status" => $application->approve_status + 1,
            "note" => null,
        ]);

        // Simpan status lama sebelum diperbarui
        $status = $application->approve_status;

        // Update status persetujuan
        $application->update([
            "approve_status" => $application->approve_status + 1,
            "note" => null,
        ]);

        // Simpan log perubahan status
        ApplicationStatusLog::create([
            'application_id' => $application->id,
            'status' => $status,
            'user_id'=> Auth::User()->id,
            'role_id'=> Auth::User()->role_id,
        ]);

        $extraApp = "";
        if ($application->activity->category_id == 1) {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana";
            }
        } else {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana Operasional";
            } else if ($application->status == 3) {
                $extraApp = "Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan";
            }
        }

        //kirim email
        $users = [];
        //kirim email tebusan
        $users2 = [];
        if ($application->status == 1) {
            if ($application->approve_status == 1) {
                $users = User::where("role_id", 0)->get();
            } else if ($application->approve_status == 2) {
                $users = User::where("role_id", 4)->get();
            } else if ($application->approve_status == 3) {
                $users = User::where("role_id", 5)->get();
            } else if ($application->approve_status == 4) {
                $users2 = User::where("role_id", 3)->get();
                \Mail::to($application->user->email)->send(new \App\Mail\approveApplicationMail($application));
            }
        } else {
            if ($application->approve_status == 2) {
                $users = User::where("role_id", 3)->get();
            } else if ($application->approve_status == 3) {
                \Mail::to($application->user->email)->send(new \App\Mail\approveExtraApplicationMail($application, ExtraApplication::where("application_id", $application->id)->latest("created_at")->first()));
            }
        }

        foreach ($users as $user) {
            \Mail::to($user->email)->send(new \App\Mail\reviewMail($application, $extraApp));
        }
        if (count($users2)) {
            foreach ($users2 as $user) {
                \Mail::to($user->email)->send(new \App\Mail\tebusanMail($application));
            }
        }

        return redirect()->route('application.index')->with(["success" => "Permintaan telah disetujui"]);
    }

    public function approveWithFile(Request $request, $id)
    {
        $application = Application::find($id);

        if(Auth::user()->role_id != 5){
            if(Auth::user()->role_id != 0){
            return redirect()->back()->with(["error" => "invalid action"]);
            
            } 
        }
        //checking logic
        $comment = $this->comment($application);

        if (!$comment) {
            return redirect()->back()->with(["error" => "invalid action"]);
        }
        $application->update([
            "approve_status" => $application->approve_status + 1,
            "note" => null,
        ]);
        //kirim email
        $users = [];
        //kirim email tebusan
        $users2 = [];
        if ($application->status == 1) {
            if ($application->approve_status == 1) {
                $users = User::where("role_id", 0)->get();
            } else if ($application->approve_status == 2) {
                $users = User::where("role_id", 4)->get();
            } else if ($application->approve_status == 3) {
                $users = User::where("role_id", 5)->get();
            } else if ($application->approve_status == 4) {
                $users2 = User::where("role_id", 3)->get();
                \Mail::to($application->user->email)->send(new \App\Mail\approveApplicationMail($application));
            }
        } else {
            if ($application->approve_status == 2) {
                $users = User::where("role_id", 3)->get();
            } else if ($application->approve_status == 3) {
                \Mail::to($application->user->email)->send(new \App\Mail\approveExtraApplicationMail($application, ExtraApplication::where("application_id", $application->id)->latest("created_at")->first()));
            }
        }

        if (isset($request->lampiran)) {
            foreach ($request->lampiran as $key2 => $lampiran2) {
                if ($lampiran2['document'] != null && $lampiran2['title'] != null) {
                    $name = time() . "_" . $lampiran2['document']->getClientOriginalName();
                    Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran2['document']));
                    Document::create([
                        'application_id' => $application->id,
                        'type' => "extra",
                        'ext' => 'doc',
                        'title' => $lampiran2["title"],
                        'file' => $name,
                    ]);
                }
            }
        }

        foreach ($users as $user) {
            \Mail::to($user->email)->send(new \App\Mail\reviewMail($application));
        }
        if ($users2) {
            foreach ($users2 as $user) {
                \Mail::to($user->email)->send(new \App\Mail\tebusanMail($application));
            }
        }

        return redirect()->route('application.index')->with(["success" => "Permintaan telah disetujui"]);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required'
        ]);
        $application = Application::find($id);

        //checking logic
        $comment = $this->comment($application);
        if (!$comment) {
            return redirect()->back()->with(["error" => "invalid action"]);
        }
        $status = $application->status;
        if ($status == 1) {
            $status = 0;
        }

        $extraApp = "";
        if ($application->activity->category_id == 1) {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana";
            }
        } else {
            if ($application->status == 2) {
                $extraApp = "Pencairan Dana Operasional";
            } else if ($application->status == 3) {
                $extraApp = "Pemberitahuan Kegiatan Selesai Dilaksanakan";
            }
        }

        $application->update([
            "approve_status" => 0,
            "checkpoint" => $application->approve_status,
            "status" => $status,
            "note" => $request->note,
        ]);

        \Mail::to($application->user->email)->send(new \App\Mail\rejectApplicationMail($application, $extraApp));

        return redirect()->route('application.index')->with(["success" => "Permintaan telah ditolak"]);
    }

    public function create()
    {
        $unit = Unit::all();
        return view('application.create', [
            'unit' => $unit,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'unit' => 'required|exists:App\Models\Unit,id',
                'category' => 'required|exists:App\Models\Category,id',
                'activity' => 'required|exists:App\Models\Activity,id',
                'title' => 'required',
                'desc' => 'required',
                'lampiran.permohonan ijin kegiatan' => 'required',
                'lampiran.tor' => 'required',
            ],
            ['telp_industri.regex' => 'format nomor telpon tidak valid']
        );

        $application = Application::create([
            'activity_id' => $request->activity,
            'category_id' => $request->category,
            'unit_id' => $request->unit,
            'approve_status' => 1,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->desc,
        ]);

        foreach ($request->lampiran as $key => $lampiran) {
            if (!is_array($lampiran)) {
                $name = time() . "_" . $lampiran->getClientOriginalName();
                Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                Document::create([
                    'application_id' => $application->id,
                    'type' => $key,
                    'ext' => 'doc',
                    'title' => $key,
                    'file' => $name,
                ]);
            } else {
                foreach ($lampiran as $key2 => $lampiran2) {
                    if ($lampiran2['document'] != null && $lampiran2['title'] != null) {
                        $name = time() . "_" . $lampiran2['document']->getClientOriginalName();
                        Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran2['document']));
                        Document::create([
                            'application_id' => $application->id,
                            'type' => "lainnya",
                            'ext' => 'doc',
                            'title' => $lampiran2["title"],
                            'file' => $name,
                        ]);
                    }
                }
            }
        }

        if ($application) {
            $users = User::where("role_id", 0)->get();
            foreach ($users as $user) {
                \Mail::to($user->email)->send(new \App\Mail\reviewMail($application));
            }

            return redirect()->route('application.index')->with('success', 'Berhasil membuat pengajuan');
        } else {
            return redirect()->back()->with('fail', 'Gagal membuat pengajuan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'desc' => 'required',
            ],
        );

        $application = Application::findOrFail($id);
        $extraApp = "";
        if ($application->latestExtra->count() > 0) {
            if ($application->activity->category_id == 1) {
                if ($application->status == 2) {
                    $extraApp = "Pencairan Dana";
                }
            } else {
                if ($application->status == 2) {
                    $extraApp = "Pencairan Dana Operasional";
                } else if ($application->status == 3) {
                    $extraApp = "Pengajuan Pemberitahuan Kegiatan Selesai Dilaksanakan";
                }
            }

            $latestExtra = $application->latestExtra->first();
            $latestExtra->update([
                'title' => $request->title,
                'description' => $request->desc,
            ]);
            $application->update([
                'approve_status' => $application->checkpoint,
            ]);

            if ($request->lampiran) {
                foreach ($request->lampiran as $key => $lampiran) {
                    if (!is_array($lampiran)) {
                        $oldDocument = ExtraApplicationDocument::where('extra_application_id', $latestExtra->id)->where('type', $key)->first();
                        if ($oldDocument && file_exists(asset('dokumen_bisnis/' . $oldDocument->file))) {
                            Storage::disk('dokumen_bisnis')->delete($oldDocument->file);
                        }
                        $name = time() . "_" . $lampiran->getClientOriginalName();
                        Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                        ExtraApplicationDocument::updateOrCreate([
                            'extra_application_id' => $latestExtra->id,
                            'title' => $key,
                            'ext' => 'doc',
                            'type' => $key,
                        ], [
                            'file' => $name,
                        ]);
                    } else {
                        $tempId = [];
                        foreach ($lampiran as $lampiranLainnya) {
                            if (isset($lampiranLainnya['i'])) {
                                $oldDocumentLainnya = ExtraApplicationDocument::where('extra_application_id', $latestExtra->id)->where('id', $lampiranLainnya['i'])->where('type', 'lainnya')->first();
                                $tempId[] = $oldDocumentLainnya->id;
                                $filename = $oldDocumentLainnya->file;

                                if (isset($lampiranLainnya['document'])) {
                                    Storage::disk('dokumen_bisnis')->delete($oldDocumentLainnya->file);
                                    $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
                                    Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
                                }

                                $oldDocumentLainnya->update([
                                    'title' => $lampiranLainnya["title"],
                                    'file' => $filename,
                                ]);
                            } else {
                                $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
                                Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
                                $createDocument = ExtraApplicationDocument::create([
                                    'file' => $filename,
                                    'extra_application_id' => $latestExtra->id,
                                    'title' => $lampiranLainnya["title"],
                                    'ext' => 'doc',
                                    'type' => "lainnya",
                                ]);
                                $tempId[] = $createDocument->id;
                            }
                        }
                        $currentDocuments = ExtraApplicationDocument::whereNotIn('id', $tempId)->where('extra_application_id', $latestExtra->id)->where('type', 'lainnya')->get();
                        foreach ($currentDocuments as $document) {
                            Storage::disk('dokumen_bisnis')->delete($document->file);
                            $document->delete();
                        }
                    }
                }
            }
        } else {
            $application->update([
                'title' => $request->title,
                'description' => $request->desc,
                'status' => 1,
                'approve_status' => $application->checkpoint,
            ]);
            if ($request->lampiran) {
                foreach ($request->lampiran as $key => $lampiran) {
                    if (!is_array($lampiran)) {
                        $oldDocument = Document::where('application_id', $application->id)->where('type', $key)->first();
                        try {
                            Storage::disk('dokumen_bisnis')->delete($oldDocument->file);
                        } catch (Exception $e) {
                        }
                        $name = time() . "_" . $lampiran->getClientOriginalName();
                        Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
                        Document::updateOrCreate(
                            [
                                'application_id' => $application->id,
                                'type' => $key,
                            ],
                            [
                                'application_id' => $application->id,
                                'type' => $key,
                                'title' => $key,
                                'ext' => 'doc',
                                'file' => $name,
                            ]
                        );
                    } else {
                        $tempId = [];
                        foreach ($lampiran as $lampiranLainnya) {
                            if (isset($lampiranLainnya['i'])) {
                                $oldDocumentLainnya = Document::where('application_id', $application->id)->where('id', $lampiranLainnya['i'])->where('type', 'lainnya')->first();
                                $tempId[] = $oldDocumentLainnya->id;
                                $filename = $oldDocumentLainnya->file;

                                if (isset($lampiranLainnya['document'])) {
                                    Storage::disk('dokumen_bisnis')->delete($oldDocumentLainnya->file);
                                    $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
                                    Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
                                }

                                $oldDocumentLainnya->update([
                                    'title' => $lampiranLainnya["title"],
                                    'file' => $filename,
                                ]);
                            } else {
                                $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
                                Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
                                $createDocument = Document::create([
                                    'file' => $filename,
                                    'application_id' => $application->id,
                                    'title' => $lampiranLainnya["title"],
                                    'ext' => 'doc',
                                    'type' => "lainnya",
                                ]);
                                $tempId[] = $createDocument->id;
                            }
                        }
                        $currentDocuments = Document::whereNotIn('id', $tempId)->where('application_id', $application->id)->where('type', 'lainnya')->get();
                        foreach ($currentDocuments as $document) {
                            Storage::disk('dokumen_bisnis')->delete($document->file);
                            $document->delete();
                        }
                    }
                }
            }
        }

        if ($application) {
            foreach ($application->statusAlias()['users'] as $user) {
                \Mail::to($user)->send(new \App\Mail\reviewMail($application, $extraApp));
            }
            return redirect()->route('application.detail', ['identifier' => $id])->with('success', 'Berhasil memperbaiki pengajuan');
        } else {
            return redirect()->back()->with('fail', 'Gagal memperbaiki pengajuan');
        }
    }

    public function updateExtra(Request $request, $id)
    {
        // $request->validate(
        //     [
        //         'title' => 'required',
        //         'desc' => 'required',
        //     ],
        // );
        // $application = Application::findOrFail($id);
        // $extraApp = $this->getLatestExtra($id);
        // $extraApp->update([
        //     'title' => $request->title,
        //     'description' => $request->desc,
        // ]);
        // $application->update([
        //     'approve_status' => 1,
        //     'note' => null,
        // ]);
        // if ($request->lampiran) {
        //     foreach ($request->lampiran as $key => $lampiran) {
        //         if (!is_array($lampiran)) {
        //             $oldDocument = ExtraApplicationDocument::where('extra_application_id', $extraApp->id)->where('type', $key)->first();
        //             Storage::disk('dokumen_bisnis')->delete($oldDocument->file);
        //             $name = time() . "_" . $lampiran->getClientOriginalName();
        //             Storage::disk('dokumen_bisnis')->put($name, file_get_contents($lampiran));
        //             $oldDocument->update([
        //                 'file' => $name,
        //             ]);
        //         } else {
        //             $tempId = [];
        //             foreach ($lampiran as $lampiranLainnya) {
        //                 if (isset($lampiranLainnya['i'])) {
        //                     $oldDocumentLainnya = ExtraApplicationDocument::where('extra_application_id', $application->id)->where('id', $lampiranLainnya['i'])->where('type', 'lainnya')->first();
        //                     $tempId[] = $oldDocumentLainnya->id;
        //                     $filename = $oldDocumentLainnya->file;

        //                     if (isset($lampiranLainnya['document'])) {
        //                         Storage::disk('dokumen_bisnis')->delete($oldDocumentLainnya->file);
        //                         $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
        //                         Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
        //                     }

        //                     $oldDocumentLainnya->update([
        //                         'title' => $lampiranLainnya["title"],
        //                         'file' => $filename,
        //                     ]);
        //                 } else {
        //                     $filename = time() . "_" . $lampiranLainnya['document']->getClientOriginalName();
        //                     Storage::disk('dokumen_bisnis')->put($filename, file_get_contents($lampiranLainnya['document']));
        //                     $createDocument = Document::create([
        //                         'file' => $filename,
        //                         'application_id' => $application->id,
        //                         'title' => $lampiranLainnya["title"],
        //                         'ext' => 'doc',
        //                         'type' => "lainnya",
        //                     ]);
        //                     $tempId[] = $createDocument->id;
        //                 }
        //             }
        //             $currentDocuments = ExtraApplicationDocument::whereNotIn('id', $tempId)->where('extra_application_id', $application->id)->where('type', 'lainnya')->get();
        //             foreach ($currentDocuments as $document) {
        //                 Storage::disk('dokumen_bisnis')->delete($document->file);
        //                 $document->delete();
        //             }
        //         }
        //     }
        // }

        // if ($application) {
        //     // \Mail::to($application->activity->unit->admin->email)->send(new \App\Mail\reviewMail($application->activity->unit->admin, $application));
        //     return redirect()->route('application.detail', ['identifier' => $id])->with('success', 'Berhasil memperbaiki pengajuan');
        // } else {
        //     return redirect()->back()->with('fail', 'Gagal memperbaiki pengajuan');
        // }
    }
}
