<?php

namespace App\Http\Controllers;

use App\Models\JobsSearch;
use App\Models\MyJobs;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function map()
    {
        // $jobs = JobsSearch::find($jobs_id);

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
        return view("applicants.map", compact('count', 'noti_count', 'noti_count_box'));
    }

    public function map2()
    {
        return view("applicants.map2");
    }
}
