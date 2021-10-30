<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EntController;
use App\Http\Controllers\Ent_PostController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Ent_CheckController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\profile_Ent;
use App\Http\Controllers\App_HistoryController;

use App\Models\JobsSearch;
use App\Models\MyJobs;
use App\Models\History;
use App\Models\SaveApplicants;

use Elasticsearch\ClientBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ent login register logout
Route::post('/auth/ent_save', [EntController::class, 'ent_save'])->name('auth.ent_save');
Route::post('/auth/ent_check', [EntController::class, 'ent_check'])->name('auth.ent_check');
Route::get('/auth/ent_logout', [EntController::class, 'ent_logout'])->name('auth.ent_logout');



// Ent Check login
Route::group(['middleware' => ['EntCheck']], function () {
    Route::get('/auth/ent_login', [EntController::class, 'ent_login'])->name('auth.ent_login');
    Route::get('/auth/ent_register', [EntController::class, 'ent_register'])->name('auth.ent_register');

    // display index page
    Route::get('/ent/ent_index', [EntController::class, 'app_search'])->name('ent_index');
    Route::get('/ent/layout', [EntController::class, 'ent_layout'])->name('layout');


    // display home page
    // Route::get('/ent/ent_home', [Ent_HomeController::class, 'ent_home'])->name('ent_home');

    // display check page
    Route::get('/ent/ent_check_app', [ApplicantsController::class, 'ent_check_app'])->name('ent_check_app');
    // Route::delete('/ent/ent_delete_apply/{myjobs_id}', [ApplicantsController::class, 'ent_delete_apply'])->name('ent_delete_apply');

    // approv check table
    Route::get('ent/ent_approve/{myjobs_id}', [ApplicantsController::class, 'ent_approve'])->name('approve');
    Route::post('ent/ent_updeate_approve/', [ApplicantsController::class, 'ent_update_approve'])->name('ent_update_approve');
    // Route::get('ent/ent_interview_update/', [ApplicantsController::class, 'ent_interview'])->name('message');
    Route::get('ent/ent_interview/', [ApplicantsController::class, 'see_detail_inter'])->name('see_detail_inter');
    Route::post('ent/store_inter/', [ApplicantsController::class, 'store_inter'])->name('store_inter');


    // reject check table
    Route::get('ent/ent_reject/{myjobs_id}', [ApplicantsController::class, 'ent_reject'])->name('reject');
    Route::post('ent/ent_update_reject', [ApplicantsController::class, 'ent_update_reject'])->name('ent_update_reject');

    // save file check table
    Route::get('ent/ent_save_file/{myjobs_id}', [ApplicantsController::class, 'ent_save_file'])->name('save_file');
    Route::post('ent/ent_update_save_file', [ApplicantsController::class, 'ent_update_save_file'])->name('ent_update_save_file');

    // approv save file table
    Route::get('Ent/edit_flie_approve/{myjobs_id}', [ApplicantsController::class, 'edit_flie_approve'])->name('edit_flie_approve');
    Route::post('Ent/edit_flie_approve', [ApplicantsController::class, 'update_flie_approve']);

    // reject save file table
    Route::get('Ent/edit_flie_reject/{myjobs_id}', [ApplicantsController::class, 'edit_flie_reject'])->name('edit_flie_reject');
    Route::post('/Ent/edit_flie_reject', [ApplicantsController::class, 'update_flie_reject']);

    // display crud post page
    Route::get('/ent/ent_list_post', [EntController::class, 'list_jobs'])->name('ent_list_post');
    Route::get('/ent/ent_post', [EntController::class, 'ent_post'])->name('ent_post');
    Route::post('/ent_post', [EntController::class, 'add_jobs'])->name('add_jobs');
    Route::get('/ent/ent_edit_post/{jobs_id}', [EntController::class, 'ent_edit_post'])->name('ent.ent_edit_post');
    Route::patch('/ent/ent_edit_post/{jobs_id}', [EntController::class, 'ent_update_post'])->name('ent.ent_update_post');
    Route::get('/ent/ent_show/{jobs_id}', [EntController::class, 'ent_show_post'])->name('ent.ent_show_post');
    Route::delete('ent/{jobs_id}', [EntController::class, 'ent_delete_post'])->name('ent.ent_delete_post');

    // display crud profile
    Route::get('/ent/ent_profile', [profile_Ent::class, 'ent_profile'])->name('ent_profile');
    Route::post('/ent_profile', [profile_Ent::class, 'add_profile_company'])->name('add_profile_company');
    Route::get('/ent/ent_show_profile/{profile_company_id}', [profile_Ent::class, 'ent_show_profile'])->name('ent_show_profile');
    Route::get('/ent/ent_edit_profile/{profile_company_id}', [profile_Ent::class, 'ent_edit_profile'])->name('ent_edit_profile');
    Route::patch('/ent/ent_update_profile/{profile_company_id}', [profile_Ent::class, 'ent_update_profile'])->name('ent_update_profile');
    Route::delete('/ent/ent_show_profile/{profile_company_id}', [profile_Ent::class, 'ent_delete_profile'])->name('ent_delete_profile');


    // display detail page
    // Route::get('/ent/ent_see_detail_search/{history_id}', [EntController::class, 'ent_see_detail'])->name('ent.ent_see_detail');
    Route::get('/ent/ent_view_portfolio/{profile_id}', [EntController::class, 'ent_view_portfolio'])->name('ent_view_portfolio');

    Route::get('/ent/ent_see_detail_history/{history_id}', [EntController::class, 'ent_see_detail_history'])->name('ent.ent_see_detail_history');
    Route::get('/ent/ent_see_detail_history_check/{history_id}', [EntController::class, 'ent_see_detail_history_check'])->name('ent.ent_see_detail_history_check');


    // display profile/change password page 
    Route::get('/ent/ent_edit_login/{ent_id}', [EntController::class, 'ent_edit_login'])->name('ent_edit_login');
    Route::patch('/ent/ent_change_password/{ent_id}', [EntController::class, 'change_password'])->name('ent_change_password');

    // see detail noti
    Route::get('/ent/ent_noti/{history_id}', [ApplicantsController::class, 'ent_noti'])->name('ent_noti');

    // display search/applicants post page
    // Route::get('/applicants/applicants_search', [EntController::class, 'applicants_search'])->name('applicants_search');

    // search text / applicants search
    Route::get('/app_search', [EntController::class, 'app_search'])->name('app_search');
    // search jobs post
    Route::get('/search_post', [EntController::class, 'list_jobs'])->name('search_post');
    // search check appliForm
    // Route::get('/search_post', [ApplicantsController::class, 'ent_check_app'])->name('search_post');

    // add interesting jobs to check app
    Route::get('/interest_app', function (Request $request) {
        // dd('ok');
        $checkcount = SaveApplicants::query()
            ->where('history_id', 'LIKE', $request->input('id'))
            ->count();

        if ($checkcount == 0) {
            $mies = History::query()->where('history_id', 'LIKE', $request->input('id'))->get();

            $row = new SaveApplicants();

            $row['history_id'] = $mies[0]['history_id'];
            $row['name_prefix'] = $mies[0]['name_prefix'];
            $row['first_name'] = $mies[0]['first_name'];
            $row['last_name'] = $mies[0]['last_name'];
            $row['email'] = $mies[0]['email'];
            $row['phone_number'] = $mies[0]['phone_number'];
            $row['birthday'] = $mies[0]['birthday'];
            $row['year_old'] = $mies[0]['year_old'];
            $row['profile'] = $mies[0]['profile'];
            $row['university'] = $mies[0]['university'];
            $row['faculty'] = $mies[0]['faculty'];
            $row['branch'] = $mies[0]['branch'];
            $row['gpa'] = $mies[0]['gpa'];
            $row['educational'] = $mies[0]['educational'];
            $row['experience'] = $mies[0]['experience'];
            $row['dominant_language'] = $mies[0]['dominant_language'];
            $row['language_learned'] = $mies[0]['language_learned'];
            $row['charisma'] = $mies[0]['charisma'];
            $row['portfolio'] = $mies[0]['portfolio'];
            $row['name_village'] = $mies[0]['name_village'];
            $row['home_number'] = $mies[0]['home_number'];
            $row['alley'] = $mies[0]['alley'];
            $row['road'] = $mies[0]['road'];
            $row['district'] = $mies[0]['district'];
            $row['canton'] = $mies[0]['canton'];
            $row['province'] = $mies[0]['province'];
            $row['postal_code'] = $mies[0]['postal_code'];
            $row['my_name_village'] = $mies[0]['my_name_village'];
            $row['my_home_number'] = $mies[0]['my_home_number'];
            $row['my_alley'] = $mies[0]['my_alley'];
            $row['my_road'] = $mies[0]['my_road'];
            $row['my_district'] = $mies[0]['my_district'];
            $row['my_canton'] = $mies[0]['my_canton'];
            $row['my_province'] = $mies[0]['my_province'];
            $row['my_postal_code'] = $mies[0]['my_postal_code'];
            $row->save();

            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    });
});

#############################################################################################################
#############################################################################################################
#############################################################################################################
#############################################################################################################


// appkicants login register logout
Route::post('/auth/applicants_save', [ApplicantsController::class, 'applicants_save'])->name('auth.applicants_save');
Route::post('/auth/applicants_check', [ApplicantsController::class, 'applicants_check'])->name('auth.applicants_check');
Route::get('/auth/applicants_logout', [ApplicantsController::class, 'applicants_logout'])->name('auth.applicants_logout');

// Applicants Check login
Route::group(['middleware' => ['ApplicantsCheck']], function () {
    Route::get('/auth/applicants_login', [ApplicantsController::class, 'applicants_login'])->name('auth.applicants_login');
    Route::get('/auth/applicants_register', [ApplicantsController::class, 'applicants_register'])->name('auth.applicants_register');

    // display history crud image page
    Route::get('/applicants/applicants_history', [App_HistoryController::class, 'index_history'])->name('applicants_history');
    Route::post('/applicants_history', [App_HistoryController::class, 'add_history'])->name('add_history');
    Route::get('/applicants/applicants_show_history', [App_HistoryController::class, 'show_history'])->name('applicants_show_history');
    Route::get('/applicants/applicants_edit_history/{history_id}', [App_HistoryController::class, 'edit_history'])->name('applicants_edit_history');
    Route::delete('/applicants/applicants_delete_history/{history_id}', [App_HistoryController::class, 'delete_history'])->name('applicants_delete_history');
    Route::patch('/applicants/applicants_update_history/{history_id}', [App_HistoryController::class, 'update_history'])->name('applicants_update_history');
    Route::get('/applicants/applicants_view_portfolio/{history_id}', [App_HistoryController::class, 'view_portfolio'])->name('view_portfolio');

    // display my jobs page
    Route::get('/applicants/applicants_myjobs', [ApplicantsController::class, 'applicants_myjobs'])->name('myjobs');
    Route::delete('/applicants/applicants_delete_myjobs/{myjobs_id}', [ApplicantsController::class, 'applicants_delete_myjobs'])->name('applicants_delete_myjobs');
    Route::delete('/applicants/applicants_delete_myjobs_fav/{myjobs_id}', [ApplicantsController::class, 'applicants_delete_myjobs_fav'])->name('applicants_delete_myjobs_fav');
    Route::delete('/applicants/applicants_delete_myjobs_apply/{myjobs_id}', [ApplicantsController::class, 'applicants_delete_myjobs_apply'])->name('applicants_delete_myjobs_apply');
    Route::delete('/applicants/applicants_delete_myjobs_approve/{myjobs_id}', [ApplicantsController::class, 'applicants_delete_myjobs_approve'])->name('applicants_delete_myjobs_approve');
    Route::delete('/applicants/applicants_delete_myjobs_reject/{myjobs_id}', [ApplicantsController::class, 'applicants_delete_myjobs_reject'])->name('applicants_delete_myjobs_reject');

    // add interesting jobs to myjobs

    Route::get('/applicants/add_interest_jobs', function (Request $request) {
        $checkcount = MyJobs::query()
            ->where('jobs_id', 'LIKE', $request->input('id'))
            ->where('history_id', 'LIKE', session()->get("UserId"))
            ->where('a_id', 'LIKE', '1')
            ->count();
        if ($checkcount == 0) {
            $mies = JobsSearch::query()->where('jobs_id', 'LIKE', $request->input('id'))->get();
            // dd($mies);
            $row = new MyJobs();
            $myrow = History::query()->where('history_id', 'LIKE', $request->input('jobs_id'))->where('history_id', 'LIKE', session()->get("UserId"))->get('history_id');

            $row['history_id'] = $myrow[0]['history_id'];
            $row['jobs_id'] = $request->input('id');
            $row['action_type'] = 'FavoriteJobs';
            $row['message'] = 'no interview';
            $row['user_id'] = $mies[0]['user_id'];
            $row['a_id'] = '1';
            $row['myjobs_name_company'] = $mies[0]['jobs_name_company'];
            $row['myjobs_logo'] = $mies[0]['logo'];
            $row['myjobs_name'] = $mies[0]['jobs_name'];
            $row['myjobs_quantity'] = $mies[0]['jobs_quantity'];
            $row['myjobs_salary'] = $mies[0]['jobs_salary'];
            $row['myjobs_type'] = $mies[0]['jobs_type'];
            $row['myjobs_location_work'] = $mies[0]['location_work'];
            $row['myjobs_start_post'] = $mies[0]['start_post'];
            $row['myjobs_stop_post'] = $mies[0]['stop_post'];
            $row['myjobs_detail'] = $mies[0]['jobs_detail'];
            $row['myjobs_contact'] = $mies[0]['jobs_contact'];
            $row['myjobs_address'] = $mies[0]['jobs_address'];
            $row['myjobs_lat'] = $mies[0]['lat'];
            $row['myjobs_lng'] = $mies[0]['lng'];

            $row->save();
            // dd($row);
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    });

    // add apply jobs to myjobs
    Route::get('/applicants/add_apply_jobs', function (Request $request) {
        // dd('ok');
        $checkcount = MyJobs::query()
            ->where('jobs_id', 'LIKE', $request->input('id'))
            ->where('history_id', 'LIKE', session()->get("UserId"))
            ->where('a_id', 'LIKE', '2')
            ->count();
        if ($checkcount == 0) {
            $mies = JobsSearch::query()->where('jobs_id', 'LIKE', $request->input('id'))->get();

            $row = new MyJobs();
            $myrow = History::query()->where('history_id', 'LIKE', $request->input('jobs_id'))->where('history_id', 'LIKE', session()->get("UserId"))->get('history_id');

            // dd($mies[0]['jobs_name_company']);
            $row['history_id'] = $myrow[0]['history_id'];
            $row['jobs_id'] = $request->input('id');
            $row['action_type'] = 'AppliForm';
            $row['message'] = 'no interview';
            $row['user_id'] = $mies[0]['user_id'];
            $row['a_id'] = '2';
            $row['myjobs_name_company'] = $mies[0]['jobs_name_company'];
            $row['myjobs_logo'] = $mies[0]['logo'];
            $row['myjobs_name'] = $mies[0]['jobs_name'];
            $row['myjobs_quantity'] = $mies[0]['jobs_quantity'];
            $row['myjobs_salary'] = $mies[0]['jobs_salary'];
            $row['myjobs_type'] = $mies[0]['jobs_type'];
            $row['myjobs_location_work'] = $mies[0]['location_work'];
            $row['myjobs_start_post'] = $mies[0]['start_post'];
            $row['myjobs_stop_post'] = $mies[0]['stop_post'];
            $row['myjobs_detail'] = $mies[0]['jobs_detail'];
            $row['myjobs_contact'] = $mies[0]['jobs_contact'];
            $row['myjobs_address'] = $mies[0]['jobs_address'];
            $row['myjobs_lat'] = $mies[0]['lat'];
            $row['myjobs_lng'] = $mies[0]['lng'];
            $row->save();
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    });

    // add approve jobs to myjobs
    Route::get('/applicants/add_approve_jobs', function (Request $request) {
        $mies = JobsSearch::query()->where('jobs_id', 'LIKE', $request->input('id'))->where('history_id', 'LIKE', session()->get("UserId"))->get();
        // dd($mies);
        $row = new MyJobs();
        $row['jobs_id'] = $request->input('id');
        $row['action_type'] = 'ApproveForm';
        // $row['message'] = 'interview';
        // $row['message'] = 'interview';
        $row['user_id'] = $mies[0]['user_id'];
        $row['a_id'] = '4';
        $row['myjobs_name_company'] = $mies[0]['jobs_name_company'];
        $row['myjobs_logo'] = $mies[0]['logo'];
        $row['myjobs_name'] = $mies[0]['jobs_name'];
        $row['myjobs_quantity'] = $mies[0]['jobs_quantity'];
        $row['myjobs_salary'] = $mies[0]['jobs_salary'];
        $row['myjobs_type'] = $mies[0]['jobs_type'];
        $row['myjobs_location_work'] = $mies[0]['location_work'];
        $row['myjobs_start_post'] = $mies[0]['start_post'];
        $row['myjobs_stop_post'] = $mies[0]['stop_post'];
        $row['myjobs_detail'] = $mies[0]['jobs_detail'];
        $row['myjobs_contact'] = $mies[0]['jobs_contact'];
        $row['myjobs_address'] = $mies[0]['jobs_address'];
        $row['myjobs_lat'] = $mies[0]['lat'];
        $row['myjobs_lng'] = $mies[0]['lng'];
        // $row['message'] = $request->input('message');
        // dd($row);
        $row->save();
    });

    // display profile/change password page 
    Route::get('/applicants/applicants_profile', [ApplicantsController::class, 'applicants_profile'])->name('profile');
    Route::get('/applicants/applicants_edit_profile/{app_id}', [ApplicantsController::class, 'edit_profile'])->name('applicants_edit_profile');
    Route::patch('/applicants/applicants_change_password/{app_id}', [ApplicantsController::class, 'change_password'])->name('applicants_change_password');

    // display home page
    Route::get('/applicants/applicants_home', [App_HistoryController::class, 'applicants_home'])->name('applicants_home');

    // display search/jobs post page
    Route::get('/applicants/applicants_search', [ApplicantsController::class, 'test_search'])->name('applicants_search');
    // search text
    Route::get('/search', [ApplicantsController::class, 'test_search'])->name('search');
    Route::get('/search', [App_HistoryController::class, 'applicants_home'])->name('search');

    // search all jobs 
    // Route::get('/search_all', [ApplicantsController::class, 'test_search_all_jobs'])->name('search_all');
    Route::get('/search_all', [ApplicantsController::class, 'applicants_myjobs'])->name('search_all');
    Route::get('/search_fav', [ApplicantsController::class, 'applicants_myjobs'])->name('search_fav');
    // Route::get('/applicants/jobs_option_search', [ApplicantsController::class, 'jobs_option_search'])->name('jobs_option_search');


    // see detail in ้ome
    Route::get('/applicants/applicants_see_detail/{jobs_id}', [App_HistoryController::class, 'see_detail'])->name('see_detail');
    // see detail in map
    Route::get('/applicants/applicants_see_detail_map/{jobs_id}', [App_HistoryController::class, 'see_detail_map'])->name('see_detail_map');
    // see detail in myjobs
    Route::get('/applicants/applicants_see_detail_jobs/{jobs_id}', [ApplicantsController::class, 'see_detail_jobs'])->name('see_detail_jobs');
    // see detail in search
    Route::get('/applicants/applicants_see_detail_search/{jobs_id}', [ApplicantsController::class, 'see_detail_search'])->name('applicants.applicants_see_detail_search');

    // see detail noti
    Route::get('/applicants/applicants_noti/{myjobs_id}', [ApplicantsController::class, 'applicants_noti'])->name('applicants_noti');
});


// display home 2 page
Route::get('/applicants/applicants_home2', [App_HistoryController::class, 'applicants_home2'])->name('applicants_home2');
// display search/jobs post 2 page
Route::get('/applicants/applicants_search2', [ApplicantsController::class, 'test_search2'])->name('applicants_search2');
// search text 2
// Route::get('/search2', [ApplicantsController::class, 'test_search2'])->name('search2');
Route::get('/search2', [App_HistoryController::class, 'applicants_home2'])->name('search2');


// see detail
Route::get('/applicants/applicants_see_detail2/{jobs_id}', [App_HistoryController::class, 'see_detail2'])->name('see_detail2');
// see detail in map2
Route::get('/applicants/applicants_see_detail_map2/{jobs_id}', [App_HistoryController::class, 'see_detail_map2'])->name('see_detail_map2');
// see detail in search
Route::get('/applicants/applicants_see_detail_search2/{jobs_id}', [ApplicantsController::class, 'see_detail_search2'])->name('applicants.applicants_see_detail_search2');


// Route::get('/add_jobs', [JobsController::class, 'add_jobs']);



// search text
// Route::get('/search', [JobsController::class, 'test_search'])->name('search');
// Route::get('/applicants/jobs_option_search', [JobsController::class, 'jobs_option_search'])->name('jobs_option_search');

#############################################################################################################
#############################################################################################################
#############################################################################################################
#############################################################################################################

// display map
Route::get('ent/map', [MapController::class, 'map'])->name('map');
Route::get('ent/mapData', function (Request $request) {
    // $uname = "root";
    // $pass = "";
    // $servername = "localhost";
    // $dbname = "jobs_it_2";
    // $db = new mysqli($servername, $uname, $pass, $dbname);

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

        $ent_post0 = $client->search($params)["hits"]["hits"];

        $resultArray = array();

        foreach ($ent_post0 as $row) {
            $jobs_id = $row["_source"]['jobs_id'];
            $jobs_name_company = $row["_source"]['jobs_name_company'];
            $logo = $row["_source"]['logo'];
            $jobs_name = $row["_source"]['jobs_name'];
            $jobs_quantity = $row["_source"]['jobs_quantity'];
            $jobs_salary = $row["_source"]['jobs_salary'];
            $jobs_type = $row["_source"]['jobs_type'];
            $location_work = $row["_source"]['location_work'];
            $jobs_detail = $row["_source"]['jobs_detail'];
            $jobs_contact = $row["_source"]['jobs_contact'];
            $jobs_address = $row["_source"]['jobs_address'];
            $lat = $row["_source"]['lat'];
            $lng = $row["_source"]['lng'];
            array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
        }
    } else {
        $query = "";
        $params = [
            'index' => 'jobs_searches_1631520417',
            'body' => [
                'query' => [
                    'wildcard' => [
                        'jobs_name' => "*"
                    ]
                ]
            ]
        ];

        $ent_post0 = $client->search($params)["hits"]["hits"];
        // dd($ent_post0);

        $resultArray = array();

        foreach ($ent_post0 as $row) {
            $jobs_id = $row["_source"]['jobs_id'];
            $jobs_name_company = $row["_source"]['jobs_name_company'];
            $logo = $row["_source"]['logo'];
            $jobs_name = $row["_source"]['jobs_name'];
            $jobs_quantity = $row["_source"]['jobs_quantity'];
            $jobs_salary = $row["_source"]['jobs_salary'];
            $jobs_type = $row["_source"]['jobs_type'];
            $location_work = $row["_source"]['location_work'];
            $jobs_detail = $row["_source"]['jobs_detail'];
            $jobs_contact = $row["_source"]['jobs_contact'];
            $jobs_address = $row["_source"]['jobs_address'];
            $lat = $row["_source"]['lat'];
            $lng = $row["_source"]['lng'];
            array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
        }
    }

    return ($resultArray);
})->name("search_map");



// display map2
Route::get('ent/map2', [MapController::class, 'map2'])->name('map2');
Route::get('ent/mapData2', function (Request $request) {
    // $uname = "root";
    // $pass = "";
    // $servername = "localhost";
    // $dbname = "jobs_it_2";
    // $db = new mysqli($servername, $uname, $pass, $dbname);


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

        $ent_post0 = $client->search($params)["hits"]["hits"];

        $resultArray = array();

        foreach ($ent_post0 as $row) {
            $jobs_id = $row["_source"]['jobs_id'];
            $jobs_name_company = $row["_source"]['jobs_name_company'];
            $logo = $row["_source"]['logo'];
            $jobs_name = $row["_source"]['jobs_name'];
            $jobs_quantity = $row["_source"]['jobs_quantity'];
            $jobs_salary = $row["_source"]['jobs_salary'];
            $jobs_type = $row["_source"]['jobs_type'];
            $location_work = $row["_source"]['location_work'];
            $jobs_detail = $row["_source"]['jobs_detail'];
            $jobs_contact = $row["_source"]['jobs_contact'];
            $jobs_address = $row["_source"]['jobs_address'];
            $lat = $row["_source"]['lat'];
            $lng = $row["_source"]['lng'];
            array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
        }
    } else {
        $query = "";
        $params = [
            'index' => 'jobs_searches_1631520417',
            'body' => [
                'query' => [
                    'wildcard' => [
                        'jobs_name' => "*"
                    ]
                ]
            ]
        ];

        $ent_post0 = $client->search($params)["hits"]["hits"];
        // dd($ent_post0);

        $resultArray = array();

        foreach ($ent_post0 as $row) {
            $jobs_id = $row["_source"]['jobs_id'];
            $jobs_name_company = $row["_source"]['jobs_name_company'];
            $logo = $row["_source"]['logo'];
            $jobs_name = $row["_source"]['jobs_name'];
            $jobs_quantity = $row["_source"]['jobs_quantity'];
            $jobs_salary = $row["_source"]['jobs_salary'];
            $jobs_type = $row["_source"]['jobs_type'];
            $location_work = $row["_source"]['location_work'];
            $jobs_detail = $row["_source"]['jobs_detail'];
            $jobs_contact = $row["_source"]['jobs_contact'];
            $jobs_address = $row["_source"]['jobs_address'];
            $lat = $row["_source"]['lat'];
            $lng = $row["_source"]['lng'];
            array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
        }
    }

    return ($resultArray);

    // =======================================================================================================
    // =======================================================================================================

    // if ($request->get('query')) {
    //     //dd($request->input('query'));
    //     $txtSearch = $request->input('query');

    //     $sql = "SELECT * FROM jobs_searches WHERE jobs_name LIKE '%$txtSearch%'";
    //     $getquery =  $db->query($sql);

    //     // dd($getquery);
    //     // $query =  $db->query("SELECT * FROM jobs_searches WHERE jobs_name LIKE '%net%'");

    //     // $query =  $db->query("SELECT * FROM jobs_searches");

    //     $resultArray = array();

    //     while ($row = $getquery->fetch_assoc()) {
    //         $jobs_id = $row['jobs_id'];
    //         $jobs_name_company = $row['jobs_name_company'];
    //         $logo = $row['logo'];
    //         $jobs_name = $row['jobs_name'];
    //         $jobs_quantity = $row['jobs_quantity'];
    //         $jobs_salary = $row['jobs_salary'];
    //         $jobs_type = $row['jobs_type'];
    //         $location_work = $row['location_work'];
    //         $jobs_detail = $row['jobs_detail'];
    //         $jobs_contact = $row['jobs_contact'];
    //         $jobs_address = $row['jobs_address'];
    //         $lat = $row['lat'];
    //         $lng = $row['lng'];
    //         array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
    //     }

    //     return ($resultArray);
    // } else {
    //     $query =  $db->query("SELECT * FROM jobs_searches");

    //     $resultArray = array();

    //     while ($row = $query->fetch_assoc()) {
    //         $jobs_id = $row['jobs_id'];
    //         $jobs_name_company = $row['jobs_name_company'];
    //         $logo = $row['logo'];
    //         $jobs_name = $row['jobs_name'];
    //         $jobs_quantity = $row['jobs_quantity'];
    //         $jobs_salary = $row['jobs_salary'];
    //         $jobs_type = $row['jobs_type'];
    //         $location_work = $row['location_work'];
    //         $jobs_detail = $row['jobs_detail'];
    //         $jobs_contact = $row['jobs_contact'];
    //         $jobs_address = $row['jobs_address'];
    //         $lat = $row['lat'];
    //         $lng = $row['lng'];
    //         array_push($resultArray, [$jobs_id, $jobs_name_company, $logo, $jobs_name, $jobs_quantity, $jobs_salary, $jobs_type, $location_work, $jobs_detail, $jobs_contact, $jobs_address, $lat, $lng]);
    //         // print_r($resultArray);
    //     }

    //     return ($resultArray);
    // }
})->name("search_map2");
Route::get('ent_check_app/edit_cancel/{id}', [ApplicantsController::class, 'edit_cancel'])->name('edit_cancel');
