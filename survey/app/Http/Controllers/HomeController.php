<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $data = [];
        $surveys = DB::table('survey')
            ->orderBy($request->sort ?? 'created_at')
            ->paginate(10)
            ->appends($request->query()
            );

        foreach ($surveys as $survey){
            $data[] = [
                'id' => $survey->id,
                'status' => $survey->status,
                'subject' => $survey->subject,
                'link' => route('survey.take', $survey->id)
            ];
        }
        return view('home.index', [
            'pagination' => $surveys,
            'data' => $data
        ]);
    }
}
