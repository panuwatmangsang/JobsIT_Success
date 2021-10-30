<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\JobsSearch;
use App\Models\MyJobs;
use App\Models\Applicants;

use Illuminate\Support\Facades\File;
use Elasticsearch\ClientBuilder;

class App_HistoryController extends Controller
{
    public function applicants_home(Request $request)
    {
        $query = $request->get('query');

        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // $params = [
        //     'index' => 'jobs_searches_1631520417',
        //     'body' => [
        //         'query' => [
        //             'wildcard' => [
        //                 'jobs_name_company' => "*"
        //             ]
        //         ]
        //     ]
        // ];
        // $jobs = $client->search($params);

        // paginate
        // $paginate = MyJobs::paginate(5);

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

        // =================================================================
        // =================================================================
        // count
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
        // $jobs = JobsSearch::all();

        // =================================================================
        // =================================================================

        $count_jobs = MyJobs::query()->where('a_id', 'LIKE', '2')->get();

        // =======================================================================
        // มากไปน้อย
        $count_Jobs_list_top = array();

        foreach ($count_jobs as $row) {
            $jobs_name = $row['myjobs_name'];

            if (isset($count_Jobs_list_top[$jobs_name])) {
                $count_Jobs_list_top[$jobs_name]++;
            } else {
                $count_Jobs_list_top[$jobs_name] = 1;
            }
        }

        arsort($count_Jobs_list_top);

        $count_Jobs_list_top =  array_slice($count_Jobs_list_top, 0, 5);

        // =======================================================================
        // น้อยไปมาก
        $count_Jobs_list_less = array();

        foreach ($count_jobs as $row) {
            $jobs_name = $row['myjobs_name'];

            if (isset($count_Jobs_list_less[$jobs_name])) {
                $count_Jobs_list_less[$jobs_name]++;
            } else {
                $count_Jobs_list_less[$jobs_name] = 1;
            }
        }

        asort($count_Jobs_list_less);

        $count_Jobs_list_less =  array_slice($count_Jobs_list_less, 0, 5);
        return view('applicants.applicants_home', compact('ent_post', 'options', 'query', 'count', 'noti_count', 'noti_count_box', 'count_Jobs_list_top', 'count_Jobs_list_less'));
    }


    public function applicants_home2(Request $request)
    {
        $query = $request->get('query');

        $hosts = ["http://127.0.0.1:9200"];

        $client = ClientBuilder::create()
            ->setHosts($hosts)
            ->build();

        // $params = [
        //     'index' => 'jobs_searches_1631520417',
        //     'body' => [
        //         // 'from' => 1,
        //         // 'size' => 50,
        //         'query' => [
        //             'wildcard' => [
        //                 'jobs_name_company' => "*"
        //             ]
        //         ]
        //     ]
        // ];
        // $jobs = $client->search($params);

        // paginate
        // $paginate = JobsSearch::paginate(5);

        if ($request->get('query')) {
            $query = $request->get('query');
            $params = [
                'index' => 'jobs_searches',
                'body' => [
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


        // =================================================================
        // =================================================================

        $count_jobs = MyJobs::query()->where('a_id', 'LIKE', '2')->get();

        $count_Jobs_list_top = array();

        foreach ($count_jobs as $row) {
            $jobs_name = $row['myjobs_name'];

            if (isset($count_Jobs_list_top[$jobs_name])) {
                $count_Jobs_list_top[$jobs_name]++;
            } else {
                $count_Jobs_list_top[$jobs_name] = 1;
            }
        }

        arsort($count_Jobs_list_top);

        $count_Jobs_list_top =  array_slice($count_Jobs_list_top, 0, 5);

        // =======================================================================
        // น้อยไปมาก
        $count_Jobs_list_less = array();

        foreach ($count_jobs as $row) {
            $jobs_name = $row['myjobs_name'];

            if (isset($count_Jobs_list_less[$jobs_name])) {
                $count_Jobs_list_less[$jobs_name]++;
            } else {
                $count_Jobs_list_less[$jobs_name] = 1;
            }
        }

        asort($count_Jobs_list_less);

        $count_Jobs_list_less =  array_slice($count_Jobs_list_less, 0, 5);

        // return view('applicants.applicants_search2', compact('ent_post', 'options', 'query'));
        // return view('applicants.applicants_home2', compact('query', 'jobs', 'count_Jobs_list_top', 'count_Jobs_list_less'));
        return view('applicants.applicants_home2', compact('ent_post', 'options', 'query', 'count_Jobs_list_top', 'count_Jobs_list_less'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function index_history()
    {
        return view('applicants.applicants_history');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function add_history(Request $request)
    {
        $request->validate([
            'name_prefix' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'birthday' => 'required',
            'year_old' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university' => 'required',
            'faculty' => 'required',
            'branch' => 'required',
            'gpa' => 'required',
            'educational' => 'required',
            'experience' => 'required',
            'dominant_language' => 'required',
            'language_learned' => 'required',
            'charisma' => 'required',
            'portfolio' => 'required',
            'name_village' => 'required',
            'home_number' => 'required',
            'alley' => 'required',
            'road' => 'required',
            'district' => 'required',
            'canton' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'my_name_village' => 'required',
            'my_home_number' => 'required',
            'my_alley' => 'required',
            'my_road' => 'required',
            'my_district' => 'required',
            'my_canton' => 'required',
            'my_province' => 'required',
            'my_postal_code' => 'required',
        ]);

        $input = $request->all();

        if ($profile = $request->file('profile')) {
            $destinationPath = 'uploads/profile/';
            $profileImage = date('YmdHis') . "." . $profile->getClientOriginalExtension();
            $profile->move($destinationPath, $profileImage);
            $input['profile'] = "$profileImage";
        }

        if ($portfolio = $request->file('portfolio')) {
            $destinationPath = 'uploads/portfolio/';
            $profileImage = date('YmdHis') . "." . $portfolio->getClientOriginalExtension();
            $portfolio->move($destinationPath, $profileImage);
            $input['portfolio'] = "$profileImage";
        }

        History::create($input);


        // $history = new History;
        // $history->name_prefix = $request->name_prefix;
        // $history->first_name = $request->first_name;
        // $history->last_name = $request->last_name;
        // $history->email = $request->email;
        // $history->phone_number = $request->phone_number;
        // $history->birthday = $request->birthday;
        // $history->year_old = $request->year_old;
        // if ($request->hasfile("profile")) {
        //     $file = $request->file("profile");
        //     $extention = $file->getClientOriginalName();
        //     $filename = time() . '.' . $extention;
        //     $file->move(\public_path("uploads/profile/"), $filename);
        //     $history->profile = $filename;
        // }
        // $history->university = $request->university;
        // $history->faculty = $request->faculty;
        // $history->branch = $request->branch;
        // $history->gpa = $request->gpa;
        // $history->educational = $request->educational;
        // $history->experience = $request->experience;
        // $history->dominant_language = $request->dominant_language;
        // $history->language_learned = $request->language_learned;
        // $history->charisma = $request->charisma;
        // if ($request->hasfile("portfolio")) {
        //     $file = $request->file("portfolio");
        //     $extention = $file->getClientOriginalName();
        //     $filename = time() . '.' . $extention;
        //     $file->move(\public_path("uploads/portfolio/"), $filename);
        //     $history->portfolio = $filename;
        // }
        // $history->name_village = $request->name_village;
        // $history->home_number = $request->home_number;
        // $history->alley = $request->alley;
        // $history->road = $request->road;
        // $history->district = $request->district;
        // $history->canton = $request->canton;
        // $history->province = $request->province;
        // $history->postal_code = $request->postal_code;
        // $history->my_name_village = $request->my_name_village;
        // $history->my_home_number = $request->my_home_number;
        // $history->my_alley = $request->my_alley;
        // $history->my_road = $request->my_road;
        // $history->my_district = $request->my_district;
        // $history->my_canton = $request->my_canton;
        // $history->my_province = $request->my_province;
        // $history->my_postal_code = $request->my_postal_code;

        // $history->save();


        return redirect()->route('applicants_show_history')->with('success', 'เพิ่มข้อมูลฝากประวัติเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function show_history()
    {
        // $history = History::all();
        $history = History::query()->where('history_id', 'LIKE', session()->get("UserId"))->get();
        // ('histories', 'histories.history_id', "=", "applicants.history_id")
        // ->where('app_id', 'LIKE', '2')
        // ->get();

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

        return view('applicants.applicants_show_history', compact('history', 'count', 'noti_count', 'noti_count_box'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function edit_history($history_id)
    {
        $count = MyJobs::query()->where('history_id', 'LIKE', session()->get("UserId"))->count();

        $history_edit = History::find($history_id);

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
        return view('applicants.applicants_edit_history', compact('history_edit', 'count', 'noti_count', 'noti_count_box'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function update_history($history_id, Request $request)
    {
        $history_edit = History::find($history_id);
        $request->validate([
            'name_prefix' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'birthday' => 'required',
            'year_old' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'university' => 'required',
            'faculty' => 'required',
            'branch' => 'required',
            'gpa' => 'required',
            'educational' => 'required',
            'experience' => 'required',
            'dominant_language' => 'required',
            'language_learned' => 'required',
            'charisma' => 'required',
            'portfolio' => 'required',
            'name_village' => 'required',
            'home_number' => 'required',
            'alley' => 'required',
            'road' => 'required',
            'district' => 'required',
            'canton' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'my_name_village' => 'required',
            'my_home_number' => 'required',
            'my_alley' => 'required',
            'my_road' => 'required',
            'my_district' => 'required',
            'my_canton' => 'required',
            'my_province' => 'required',
            'my_postal_code' => 'required',
        ]);

        $input = $request->all();

        if ($profile = $request->file('profile')) {
            $destinationPath = 'uploads/profile/';
            $profileImage = date('YmdHis') . "." . $profile->getClientOriginalExtension();
            $profile->move($destinationPath, $profileImage);
            $input['profile'] = "$profileImage";
        }

        if ($portfolio = $request->file('portfolio')) {
            $destinationPath = 'uploads/portfolio/';
            $profileImage = date('YmdHis') . "." . $portfolio->getClientOriginalExtension();
            $portfolio->move($destinationPath, $profileImage);
            $input['portfolio'] = "$profileImage";
        }

        $history_edit->update($input);


        // $history_edit = History::find($history_id);
        // $history_edit->name_prefix = $request->name_prefix;
        // $history_edit->first_name = $request->first_name;
        // $history_edit->last_name = $request->last_name;
        // $history_edit->email = $request->email;
        // $history_edit->phone_number = $request->phone_number;
        // $history_edit->birthday = $request->birthday;
        // $history_edit->year_old = $request->year_old;
        // if ($request->hasfile('profile')) {
        //     $destination = 'uploads/profile/' . $history_edit->profile;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('profile');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extention;
        //     $file->move(\public_path("uploads/profile/"), $filename);
        //     $history_edit->profile = $filename;
        // }
        // $history_edit->university = $request->university;
        // $history_edit->faculty = $request->faculty;
        // $history_edit->branch = $request->branch;
        // $history_edit->gpa = $request->gpa;
        // $history_edit->educational = $request->educational;
        // $history_edit->experience = $request->experience;
        // $history_edit->dominant_language = $request->dominant_language;
        // $history_edit->language_learned = $request->language_learned;
        // $history_edit->charisma = $request->charisma;
        // if ($request->hasfile('portfolio')) {
        //     $destination = 'uploads/portfolio/' . $history_edit->portfolio;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $file = $request->file('portfolio');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extention;
        //     $file->move(\public_path("uploads/portfolio/"), $filename);
        //     $history_edit->portfolio = $filename;
        // }
        // $history_edit->name_village = $request->name_village;
        // $history_edit->home_number = $request->home_number;
        // $history_edit->alley = $request->alley;
        // $history_edit->road = $request->road;
        // $history_edit->district = $request->district;
        // $history_edit->canton = $request->canton;
        // $history_edit->province = $request->province;
        // $history_edit->postal_code = $request->postal_code;
        // $history_edit->my_name_village = $request->my_name_village;
        // $history_edit->my_home_number = $request->my_home_number;
        // $history_edit->my_alley = $request->my_alley;
        // $history_edit->my_road = $request->my_road;
        // $history_edit->my_district = $request->my_district;
        // $history_edit->my_canton = $request->my_canton;
        // $history_edit->my_province = $request->my_province;
        // $history_edit->my_postal_code = $request->my_postal_code;

        // $history_edit->update();

        return redirect()->route('applicants_show_history')->with('success', 'แก้ไขข้อมูลฝากประวัติเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function delete_history($history_id)
    {
        $history = History::find($history_id);

        $destination = 'uploads/profile/' . $history->profile;
        if (File::exists($destination)) {
            File::delete($destination);
        }


        // $portfolios = Portfolio::where("history_id", $history->history_id)->get();
        // foreach ($portfolios as $key => $portfolio ) {

        //     if (File::exists("uploads/portfolio/" . $portfolio->portfolio)) {
        //         File::delete("uploads/portfolio/" . $portfolio->portfolio);
        //     }
        //     // dd(File::exists("uploads/portfolio/" . $portfolio->portfolio));
        //     $portfolio->delete();
        // }

        $history->delete();

        return redirect()->route('applicants_history')->with('success', 'ลบข้อมูลฝากประวัติเรียบร้อย');
    }

    // ============================================================================================
    // ============================================================================================ 

    public function view_portfolio($history_id)
    {
        $count = MyJobs::where('history_id', 'LIKE', session()->get("UserId"))->count();

        $view_portfolio = History::find($history_id);

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
        return view('applicants.applicants_view_portfolio', compact('view_portfolio', 'count', 'noti_count', 'noti_count_box'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function see_detail($jobs_id)
    {
        // $history = History::all();
        $count = MyJobs::where('history_id', 'LIKE', session()->get("UserId"))->count();

        $jobs = JobsSearch::find($jobs_id);

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
        return view('applicants.applicants_see_detail', compact('jobs', 'count', 'noti_count', 'noti_count_box'));
    }

    // ============================================================================================
    // ============================================================================================ 

    public function see_detail_map($jobs_id)
    {
        // $history = History::all();
        $count = MyJobs::where('history_id', 'LIKE', session()->get("UserId"))->count();

        $jobs = JobsSearch::find($jobs_id);

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
        return view('applicants.applicants_see_detail_map', compact('jobs', 'count', 'noti_count', 'noti_count_box'));
    }

    public function see_detail_map2($jobs_id)
    {
        // $history = History::all();
        $count = MyJobs::where('history_id', 'LIKE', session()->get("UserId"))->count();

        $jobs = JobsSearch::find($jobs_id);

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
        return view('applicants.applicants_see_detail_map2', compact('jobs', 'count', 'noti_count', 'noti_count_box'));
    }

    public function see_detail2($jobs_id)
    {
        $jobs = JobsSearch::find($jobs_id);
        return view('applicants.applicants_see_detail2', compact('jobs'));
    }
   
}
