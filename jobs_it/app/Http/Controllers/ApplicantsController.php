<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\JobsSearch;
use App\Models\Message;
use App\Models\MyJobs;
use App\Models\History;
use App\Models\SaveApplicants;
use Illuminate\Support\Facades\Hash;
use Elasticsearch\ClientBuilder;

class ApplicantsController extends Controller
{
    public function applicants_login()
    {
        return view('auth.applicants_login');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_register()
    {
        return view('auth.applicants_register');
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_save(Request $request)
    {
        // register
        // validate requests
        $request->validate([
            'app_name' => 'required',
            'app_email' => 'required|email|unique:applicants',
            'app_password' => 'required|min:5|max:12',
        ]);

        // insert data into database
        $app = new Applicants;
        $app->app_name = $request->app_name;
        $app->app_email = $request->app_email;
        $app->app_password = Hash::make($request->app_password);
        $save = $app->save();

        if ($save) {
            return back()->with('success', 'เพิ่มบัญชีใหม่เรียบร้อยแล้ว');
        } else {
            return back()->with('fail', 'เกิดข้อผิดพลาด ลองอีกครั้ง');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    public function applicants_check(Request $request)
    {
        // return $request->input();

        // login
        //validate request
        $request->validate([
            'app_email' => 'required|email',
            'app_password' => 'required|min:5|max:12'
        ]);

        $appInfo = Applicants::where('app_email', '=', $request->app_email)->first();

        if (!$appInfo) {
            return back()->with('fail', 'ไม่รู้จักบัญชีนี้');
        } else {
            // check password
            if (Hash::check($request->app_password, $appInfo->app_password)) {
                $request->session()->put('LoggedApp', $appInfo->app_name);
                $request->session()->put('UserEmail', $appInfo->app_email);
                $request->session()->put('UserId', $appInfo->app_id);
                $request->session()->put('UserPassword', $appInfo->app_password);

                // dd($request->app_password);
                // return redirect('applicants/applicants_home');
                return redirect()->route('applicants_show_history');
            } else {
                return back()->with('fail', 'รหัสผ่านผิด');
            }
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // logout
    public function applicants_logout()
    {
        if (session()->has('LoggedApp')) {
            session()->pull('LoggedApp');
            return redirect('/applicants/applicants_home2');
        }
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display index page
    public function applicants_index()
    {
        $data = ['LoggedAppInfo' => Applicants::where('app_id', '=', session('LoggedApp'))->first()];
        return view('applicants.applicants_index', $data);
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // display my jobs page
    public function applicants_myjobs(Request $request)
    {
        // $all = MyJobs::all()->where('history_id', 'LIKE', session()->get("UserId"));

        // =====================================================================================================================================
        // =====================================================================================================================================

        if ($request->input('type') == 'all') {

            $all = MyJobs::all()->where('history_id', 'LIKE', session()->get("UserId"));
            // $query_user = session()->get("UserId");

            //     // dd($query_user);

            //     $hosts = ["http://127.0.0.1:9200"];

            //     $client = ClientBuilder::create()
            //         ->setHosts($hosts)
            //         ->build();

            //     // ============ get advance query index =============
            //     if ($request->get('query')) {
            //         $query = $request->get('query');
            //         // $user_query = $query->session()->get("UserId");

            //         $params = [
            //             'index' => 'my_jobs_1633942706',
            //             'body' => [
            //                 // =============================================================
            //                 // fuzzy
            //                 'query' => [
            //                     'bool' => [
            //                         'must' => [
            //                             'multi_match' => [
            //                                 'fields' => [
            //                                     'action_type',
            //                                     'myjobs_name_company',
            //                                     'myjobs_name',
            //                                     'myjobs_quantity',
            //                                     'myjobs_salary',
            //                                     'myjobs_type',
            //                                     'myjobs_location_work',
            //                                     'myjobs_detail',
            //                                     'myjobs_contact',
            //                                     'myjobs_address',
            //                                 ],
            //                                 'query' => "*" . $query . "*",
            //                                 'fuzziness' => 'AUTO'
            //                             ]
            //                         ],
            //                         'filter' => [
            //                             'match' => [
            //                                 'history_id' => $query_user
            //                             ]
            //                         ]
            //                     ],
            //                 ]
            //             ]
            //         ];

            //         $all = $client->search($params);
            //     } else {
            //         $query = "";
            //         $params = [
            //             'index' => 'my_jobs_1633942706',
            //             'body' => [
            //                 'size' => 10,
            //                 'query' => [
            //                     'bool' => [
            //                         'filter' => [
            //                             'term' => [
            //                                 'history_id' => $query_user
            //                             ]
            //                         ],
            //                     ]
            //                 ]
            //             ]
            //         ];

            //         $all = $client->search($params);
            //         // dd($all);
            //     }

            $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
            $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->count();
            $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->get();

            $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
            $noti_count_box->values()->all();
            // dd($all);
            return view('applicants.applicants_myjobs', compact('all', 'count', 'noti_count', 'noti_count_box'));
        } elseif ($request->input('type') == 'FavoriteJobs') {

            $fav = MyJobs::query()->where('action_type', 'LIKE', 'FavoriteJobs')->where('history_id', 'LIKE', session()->get("UserId"))->get();
            $query_user = session()->get("UserId");

            // $hosts = ["http://127.0.0.1:9200"];

            // $client = ClientBuilder::create()
            //     ->setHosts($hosts)
            //     ->build();

            // // ============ get advance query index =============
            // if ($request->get('query')) {
            //     $query = $request->get('query');
            //     $params = [
            //         'index' => 'my_jobs_1633942706',
            //         'body' => [
            //             // =============================================================
            //             // fuzzy
            //             'query' => [
            //                 'bool' => [
            //                     'must' => [
            //                         'multi_match' => [
            //                             'fields' => [
            //                                 'action_type',
            //                                 'myjobs_name_company',
            //                                 'myjobs_name',
            //                                 'myjobs_quantity',
            //                                 'myjobs_salary',
            //                                 'myjobs_type',
            //                                 'myjobs_location_work',
            //                                 'myjobs_detail',
            //                                 'myjobs_contact',
            //                                 'myjobs_address',
            //                             ],
            //                             'query' => "*" . $query . "*",
            //                             'fuzziness' => 'AUTO'
            //                         ]
            //                     ],
            //                     'filter' => [
            //                         [
            //                             'match' => [
            //                                 'history_id' => $query_user
            //                             ]
            //                         ],
            //                         [
            //                             'match' => [
            //                                 'action_type' => 'FavoriteJobs'
            //                             ]
            //                         ]
            //                     ]
            //                 ],
            //             ]

            //         ]
            //     ];

            //     $fav = $client->search($params);
            // } else {
            //     $query = "";
            //     $params = [
            //         'index' => 'my_jobs_1633942706',
            //         'body' => [
            //             'size' => 10,
            //             'query' => [
            //                 'bool' => [
            //                     'must' => [
            //                         'match' => [
            //                             'action_type' => 'FavoriteJobs'
            //                         ]
            //                     ],
            //                     'filter' => [
            //                         'term' => [
            //                             'history_id' => $query_user
            //                         ]
            //                     ],
            //                 ]
            //             ]

            //         ]
            //     ];

            //     $fav = $client->search($params);
            //     // dd($all);
            // }

            $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
            $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->count();
            $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->get();

            $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
            $noti_count_box->values()->all();
            return view('applicants.applicants_myjobs', compact('fav', 'count', 'noti_count', 'noti_count_box'));
        } elseif ($request->input('type') == 'AppliForm') {
            $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();

            $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->count();
            $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->get();

            $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
            $noti_count_box->values()->all();

            $row = MyJobs::query()->where('action_type', 'LIKE', 'AppliForm')->where('history_id', 'LIKE', session()->get("UserId"))
                // ->orWhere('action_type', 'LIKE', 'ApproveForm')
                // ->orWhere('action_type', 'LIKE', 'RejectForm')
                ->get();
            $rove = MyJobs::query()->where('a_id', 'LIKE', '4')->where('history_id', 'LIKE', session()->get("UserId"))->get();
            $rej = MyJobs::query()->where('a_id', 'LIKE', '5')->where('history_id', 'LIKE', session()->get("UserId"))->get();


            return view('applicants.applicants_myjobs', compact('row', 'rove', 'rej', 'count', 'noti_count', 'noti_count_box'));
        } else {
            $all = MyJobs::all();

            $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();

            $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->count();
            $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
                ->where(function ($query) {
                    $query->where('a_id', 'LIKE', '4')
                        ->orWhere('a_id', 'LIKE', '5');
                })->get();

            $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
            $noti_count_box->values()->all();
            return view('applicants.applicants_myjobs', compact('all', 'count', 'noti_count'));
        }

        return view('applicants.applicants_myjobs', compact('all', 'count', 'noti_count', 'noti_count_box'));
    }

    public function applicants_delete_myjobs($myjobs_id)
    {
        $myjobs = MyJobs::find($myjobs_id);

        $myjobs->delete();

        return redirect('/applicants/applicants_myjobs?type=all');
        // return redirect()->back()->with('success_delete', 'ลบข้อมูลผู้สมัครเรียบร้อย');
    }

    // delete fav
    public function applicants_delete_myjobs_fav($myjobs_id)
    {
        $myjobs = MyJobs::find($myjobs_id);

        $myjobs->delete();

        // return view('/applicants/applicants_myjobs?type=FavoriteJobs');
        // return redirect('/applicants/applicants_myjobs?type=FavoriteJobs');
        return redirect()->back();
    }

    // delete apply
    public function applicants_delete_myjobs_apply($myjobs_id)
    {
        $myjobs = MyJobs::find($myjobs_id);

        $myjobs->delete();

        return redirect('/applicants/applicants_myjobs?type=AppliForm');
        // return redirect()->back()->with('success_delete', 'ลบข้อมูลผู้สมัครเรียบร้อย');
    }

    // delete approve
    public function applicants_delete_myjobs_approve($myjobs_id)
    {
        $myjobs = MyJobs::find($myjobs_id);

        $myjobs->delete();

        return redirect('/applicants/applicants_myjobs?type=AppliForm');
        // return redirect()->back()->with('success_delete', 'ลบข้อมูลผู้สมัครเรียบร้อย');
    }

    // delete reject
    public function applicants_delete_myjobs_reject($myjobs_id)
    {
        $myjobs = MyJobs::find($myjobs_id);

        $myjobs->delete();

        return redirect('/applicants/applicants_myjobs?type=AppliForm');
        // return redirect()->back()->with('success_delete', 'ลบข้อมูลผู้สมัครเรียบร้อย');
    }
    // ============================================================================================
    // ============================================================================================ 

    public function ent_check_app()
    {
        // approv
        $mamber = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();

        // save into file
        $file_save = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '3')
            ->get();

        // approv
        $rove = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '4')
            ->get();

        // save app
        $save_app = SaveApplicants::all();

        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();

        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        return view('ent.ent_check_app', compact('mamber', 'file_save', 'rove', 'save_app', 'count', 'noti_count', 'noti_count_box'));
    }

    // add message
    public function store_inter(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'history_id' => 'required',
            'message' => 'required'
        ]);


        $data = new Message();
        $data->job_id = $request->job_id;
        $data->history_id = $request->history_id;
        $data->message = $request->message;


        $data->save();

        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        // return redirect()->route('ent_check_app');
        return view('ent.ent_approve', compact('count', 'noti_count', 'noti_count_box'));
    }
    // ============================================================================================
    // ============================================================================================ 
    // approv
    public function ent_approve($myjobs_id)
    {
        $mamber = MyJobs::find($myjobs_id);

        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        return view('ent.ent_approve', compact('mamber', 'count', 'noti_count', 'noti_count_box'));
    }

    // update approv
    public function ent_update_approve(Request $request)
    {
        // return $request->input();
        $data = MyJobs::find($request->myjobs_id);
        $data->action_type = $request->action_type;
        $data->message = $request->message;
        $data->a_id = $request->a_id;

        // dd($data->message);
        $data->save();

        return redirect('ent/ent_check_app');
        // return redirect()->route('see_detail_inter');
    }

    // form message
    // public function see_detail_inter($myjobs_id)
    // {
    //     $jobs = MyJobs::find($myjobs_id);
    //     return view('ent.ent_interview', compact('jobs'));
    // }
    public function see_detail_inter()
    {
        // $jobs = MyJobs::find($myjobs_id);
        return view('ent.ent_interview');
    }

    // update form mesaage
    public function ent_interview(Request $request)
    {
        //   $mamber = MyJobs::find($myjobs_id);

        $request->validate([
            'job_id' => 'required',
            'history_id' => 'required',
            'message' => 'required'
        ]);


        $data = new Message();
        $data->job_id = $request->job_id;
        $data->history_id = $request->history_id;
        $data->message = $request->message;


        $data->save();

        $count = MyJobs::query()->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        return view('ent.ent_interview', compact('data', 'count', 'noti_count', 'noti_count_box'));
    }
    // ============================================================================================
    // ============================================================================================ 
    // reject
    public function ent_reject($myjobs_id)
    {
        $data = MyJobs::find($myjobs_id);

        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        return view('ent.ent_reject', compact('count', 'noti_count', 'noti_count_box', 'data'));
    }

    // uodate reject
    public function ent_update_reject(Request $request)
    {
        // return $request->input();
        $data = MyJobs::find($request->myjobs_id);
        $data->action_type = $request->action_type;
        // $data->message = $request->message;
        $data->a_id = $request->a_id;

        // dd($data->message);
        $data->save();
        return redirect('ent/ent_check_app');
    }

    // ============================================================================================
    // ============================================================================================ 
    // save file
    public function ent_save_file($myjobs_id)
    {
        $data = MyJobs::find($myjobs_id);

        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        return view('ent.ent_save_file', compact('count', 'noti_count', 'noti_count_box', 'data'));
    }

    // update save file
    public function ent_update_save_file(Request $request)
    {
        // return $request->input();
        $data = MyJobs::find($request->myjobs_id);
        $data->a_id = $request->a_id;
        $data->save();
        return redirect('ent/ent_check_app');
    }
    // ============================================================================================
    // ============================================================================================ 

    public function ent_delete_apply($myjobs_id)
    {
        $datas = MyJobs::find($myjobs_id);

        $datas->delete();

        return redirect()->route('ent_check_app')->with('success', 'ลบข้อมูลผู้สมัครเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 
    // ยกเลิกสมัคร

    public function edit_cancel($id)
    {
        // return jobsmy::find($id);
        $row = MyJobs::find($id);
        return view('ent.ent_cancel', ['row' => $row]);
    }

    public function update_edit_cancel(Request $request)
    {
        // return $request->input();
        $row = MyJobs::find($request->id);
        $row->action_type = $request->action_type;
        $row->a_id = $request->a_id;
        $row->save();
        return redirect('ent/ent_check_app');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function see_detail_jobs($jobs_id)
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();

        $all = MyJobs::find($jobs_id);
        return view('applicants.applicants_see_detail_jobs', compact('all', 'count', 'noti_count', 'noti_count_box'));
    }

    public function see_detail_jobs2($jobs_id)
    {
        $all = MyJobs::find($jobs_id);
        return view('applicants.applicants_see_detail_jobs2', compact('all'));
    }

    // ============================================================================================
    // ============================================================================================ 
    // noti applicants
    public function applicants_noti($myjobs_id)
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();

        $all = MyJobs::find($myjobs_id);

        return view('applicants.applicants_noti', compact('all', 'count', 'noti_count', 'noti_count_box'));
    }

    // noti ent
    public function ent_noti($history_id)
    {
        $count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count = MyJobs::query()->where('a_id', 'LIKE', '2')->count();
        $noti_count_box2 = MyJobs::join('histories', 'histories.history_id', "=", "my_jobs.history_id")
            ->where('a_id', 'LIKE', '2')
            ->get();
        $noti_count_box = $noti_count_box2->sortDesc();
        $noti_count_box->values()->all();

        $history = History::find($history_id);
        return view('ent.ent_noti', compact('history', 'count', 'noti_count', 'noti_count_box'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function see_detail_search($jobs_id)
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();

        $jobs = JobsSearch::find($jobs_id);
        return view('applicants.applicants_see_detail_search', compact('jobs', 'count', 'noti_count', 'noti_count_box'));
    }

    public function see_detail_search2($jobs_id)
    {
        $jobs = JobsSearch::find($jobs_id);
        return view('applicants.applicants_see_detail_search2', compact('jobs'));
    }

    // =====================================================================================================================================
    // =====================================================================================================================================

    // profile page
    public function applicants_profile()
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();

        $app_profile = Applicants::query()->where('app_id', 'LIKE', session()->get("UserId"))->get();
        return view('applicants.applicants_profile', compact('app_profile', 'count', 'noti_count', 'noti_count_box'));
    }

    // ====================================================================================================================================
    // ====================================================================================================================================

    public function edit_profile($app_id)
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();

        $password_edit = Applicants::find($app_id);
        return view('applicants.applicants_edit_profile', compact('password_edit', 'count', 'noti_count', 'noti_count_box'));
    }

    // ====================================================================================================================================
    // ==================================================================================================================================== 

    public function change_password(Request $request, $app_id)
    {
        // dd('ok');

        // $user = Auth::user();
        // $userPassword = $user->password;

        $password_edit = session()->get("UserPassword");
        $user_password = $password_edit;

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:5|max:12',
            'confirm_password' => 'required',
        ]);

        // dd($password_edit); 

        if (!Hash::check($request->current_password, $user_password)) {
            return back()->withErrors(['current_password' => 'password not match']);
        }

        $password_edit = Applicants::find($app_id);
        // $password_edit->app_name = $request->session()->get("LoggedApp");
        // $password_edit->app_email = $request->session()->get("UserEmail");
        $password_edit->app_password = Hash::make($request->new_password);

        // dd($request->new_password); 
        $password_edit->save();

        return redirect()->back()->with('success', 'แก้ไขข้อมูลเข้าสู่ระบบเรียบร้อย');
    }

    // ====================================================================================================================================
    // ==================================================================================================================================== 

    // search from text search and option jobs post
    public function test_search(Request $request)
    {
        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // ============ get advance query index =============
        if ($request->get('query')) {
            $query = $request->get('query');
            $params = [
                'index' => 'jobs_searches',
                'body' => [

                    // ======================= analysis ==================
                    // 'setting' => [
                    //     'analysis' => [
                    //         'analyzer' => [
                    //             'autocomplete' => [
                    //                 'tokenlzer' => 'autocomplete',
                    //                 'filter' => [
                    //                     'lowercase',
                    //                 ]
                    //             ],
                    //             'autocomplete_search' => [
                    //                 'tokenlzer' => 'lowercase',
                    //             ]
                    //         ],
                    //         'tokenizer' => [
                    //             'autocomplete' => [
                    //                 'type' => 'edge_ngram',
                    //                 'min_gram' => 1,
                    //                 'max_gram' => 20,
                    //                 'token_chars' => [
                    //                     'letter',
                    //                     'whitespace'
                    //                 ]
                    //             ]
                    //         ]
                    //     ],
                    // ],
                    // 'mappings' => [
                    //     'properties' => [
                    //         'jobs_name' => [
                    //             'type' => 'text',
                    //             'analyzer' => 'autocomplete',
                    //             'search_analyzer' => 'autocomplete_search'
                    //         ],
                    //     ]
                    // ],

                    // 'query' => [
                    //     'match' => [
                    //         'jobs_name' => [
                    //             'query' => $query,
                    //             'operator' => 'and'
                    //         ]
                    //     ]
                    // ]

                    // =============================================================
                    // fuzzy
                    'query' => [
                        'multi_match' => [
                            'fields' => [
                                'jobs_name_company',
                                'jobs_name',
                                'jobs_type',
                                'jobs_detail',
                                'jobs_address',
                            ],
                            'query' => "*" . $query . "*",
                            'fuzziness' => 'AUTO'
                        ]
                    ]

                ]
            ];

            $ent_post0 = $client->search($params);
        } else {
            $query = "";
            $params = [
                'index' => 'jobs_searches_1631520417',
                'body' => [
                    'size' => 10,
                    'query' => [
                        'wildcard' => [
                            'jobs_name_company' => "*"
                        ]
                    ]
                ]
            ];

            $ent_post0 = $client->search($params);
            // dd($ent_post0);
        }

        // selected options
        $options = array();
        $options = [
            'jobs_name' => [],
            'jobs_type' => [],
            'jobs_name_company' => [],
            'start_post' => []
        ];

        foreach ($ent_post0["hits"]["hits"] as $v) {
            foreach ($options as $key => $b) {
                if (!in_array($v['_source'][$key], $options[$key])) {
                    array_push($options[$key], $v['_source'][$key]);
                }
            }
        }

        $ent_post = array_filter($ent_post0["hits"]["hits"], function ($v)  use ($request) {
            foreach ($request->all() as $query_all => $val) {
                if ($query_all != "query" && trim($v["_source"][$query_all]) != trim($val)) {
                    return false;
                }
            }
            return true;
        });

        // dd($options);
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        return view('applicants.applicants_search', compact('ent_post', 'options', 'query', 'count', 'noti_count', 'noti_count_box'));
    }

    // ====================================================================================================================================
    // ==================================================================================================================================== 

    // search from text search and option jobs post
    public function test_search2(Request $request)
    {
        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // ============ get advance query index =============
        if ($request->get('query')) {
            $query = $request->get('query');
            $params = [
                'index' => 'jobs_searches',
                'body' => [

                    // ======================= analysis ==================
                    // 'setting' => [
                    //     'analysis' => [
                    //         'analyzer' => [
                    //             'autocomplete' => [
                    //                 'tokenlzer' => 'autocomplete',
                    //                 'filter' => [
                    //                     'lowercase',
                    //                 ]
                    //             ],
                    //             'autocomplete_search' => [
                    //                 'tokenlzer' => 'lowercase',
                    //             ]
                    //         ],
                    //         'tokenizer' => [
                    //             'autocomplete' => [
                    //                 'type' => 'edge_ngram',
                    //                 'min_gram' => 1,
                    //                 'max_gram' => 20,
                    //                 'token_chars' => [
                    //                     'letter',
                    //                     'whitespace'
                    //                 ]
                    //             ]
                    //         ]
                    //     ],
                    // ],
                    // 'mappings' => [
                    //     'properties' => [
                    //         'jobs_name' => [
                    //             'type' => 'text',
                    //             'analyzer' => 'autocomplete',
                    //             'search_analyzer' => 'autocomplete_search'
                    //         ],
                    //     ]
                    // ],

                    // 'query' => [
                    //     'match' => [
                    //         'jobs_name' => [
                    //             'query' => $query,
                    //             'operator' => 'and'
                    //         ]
                    //     ]
                    // ]

                    // =============================================================
                    // fuzzy
                    'query' => [
                        'multi_match' => [
                            'fields' => [
                                'jobs_name_company',
                                'jobs_name',
                                'jobs_type',
                                'jobs_detail',
                                'jobs_address',
                            ],
                            'query' => "*" . $query . "*",
                            'fuzziness' => 'AUTO',
                        ]
                    ]

                ]
            ];
            $ent_post0 = $client->search($params);
            // dd($ent_post0);
        } else {
            $query = "";
            $params = [
                'index' => 'jobs_searches_1631520417',
                'body' => [
                    'size' => 5,
                    'query' => [
                        'wildcard' => [
                            'jobs_name_company' => "*"
                        ]
                    ]
                ]
            ];

            $ent_post0 = $client->search($params);
            // dd($ent_post0);
        }

        // selected options
        $options = array();
        $options = [
            'jobs_name' => [],
            'jobs_type' => [],
            'jobs_name_company' => [],
            'start_post' => []
        ];

        foreach ($ent_post0["hits"]["hits"] as $v) {
            foreach ($options as $key => $b) {
                if (!in_array($v['_source'][$key], $options[$key])) {
                    array_push($options[$key], $v['_source'][$key]);
                }
            }
        }

        $ent_post = array_filter($ent_post0["hits"]["hits"], function ($v)  use ($request) {
            foreach ($request->all() as $query_all => $val) {
                if ($query_all != "query" && trim($v["_source"][$query_all]) != trim($val)) {
                    return false;
                }
            }
            return true;
        });

        // dd($options);

        return view('applicants.applicants_search2', compact('ent_post', 'options', 'query'));
    }

    public function test_search_all_jobs(Request $request)
    {
        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // ============ get advance query index =============
        if ($request->get('query')) {
            $query = $request->get('query');
            $params = [
                'index' => 'my_jobs_1633942706',
                'body' => [
                    // =============================================================
                    // fuzzy
                    'query' => [
                        'multi_match' => [
                            'fields' => [
                                'action_type',
                                'myjobs_name_company',
                                'myjobs_name',
                                'myjobs_quantity',
                                'myjobs_salary',
                                'myjobs_type',
                                'myjobs_location_work',
                                'myjobs_detail',
                                'myjobs_contact',
                                'myjobs_address',
                            ],
                            'query' => "*" . $query . "*",
                            'fuzziness' => 'AUTO'
                        ]
                    ]

                ]
            ];

            $all = $client->search($params);
            dd($all);
        } else {
            $query = "";
            $params = [
                'index' => 'my_jobs_1633942706',
                'body' => [
                    'query' => [
                        'wildcard' => [
                            'myjobs_name_company' => "*"
                        ]
                    ]
                ]
            ];

            $all = $client->search($params);
            // dd($ent_post0);
        }

        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        // dd($all);
        return view('applicants.applicants_myjobs', compact('all', 'query', 'count', 'noti_count', 'noti_count_box'));
    }

    // =============================================================================================================
    // =============================================================================================================

    public function layout()
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();
        $noti_count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->count();
        $noti_count_box2 = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))
            ->where(function ($query) {
                $query->where('a_id', 'LIKE', '4')
                    ->orWhere('a_id', 'LIKE', '5');
            })->get();

        $noti_count_box = $noti_count_box2->sortByDesc('updated_at');
        $noti_count_box->values()->all();
        return view('applicants.count', compact('count', 'noti_count', 'noti_count_box'));
    }
}
