<?php

namespace App\Http\Controllers\Survey;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('survey.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        $survey = Survey::create([
            'subject' => $request->subject,
            'user_id' => Auth::id(),
            'status' => 1
        ]);
        foreach ($request->answer as $key_answer => $answer) {
            foreach ($request->count as $key_vote => $vote) {
                if ($key_answer == $key_vote) {
                    SurveyOptions::create([
                        'survey_id' => $survey->id,
                        'name' => $answer,
                        'count_votes' => $vote
                    ]);
                }
            }
        }

        return redirect()->route('home.index')
            ->with('success', 'Survey created');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function ownSurvey(Request $request)
    {
        $data = [];
        $surveys = DB::table('survey')
            ->where('user_id', Auth::id())
            ->orderBy($request->sort ?? 'created_at')
            ->paginate(10)
            ->appends($request->query()
            );
        foreach ($surveys as $survey){
            $data[] = [
                'id' => $survey->id,
                'status' => $survey->status,
                'subject' => $survey->subject,
                'take' => route('survey.take', $survey->id),
                'edit' => route('survey.edit', $survey->id),
                'delete' => route('survey.delete', $survey->id)
            ];
        }
        return view('survey.own', [
            'pagination' => $surveys,
            'data' => $data
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $survey = Survey::where('id', $id)->first()->toArray();
        $options = SurveyOptions::where('survey_id', $id)->get()->toArray();

        return view('survey.edit', [
            'survey' => $survey,
            'options' => $options
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Survey::where('id', $id)->update([
            'subject' => $request->subject
        ]);

        $options = SurveyOptions::where('survey_id', $id)->get();
        $i=0;
        foreach ($options as $option){
                $option->update([
                    'name' => $request->answer[$i],
                    'count_votes' => $request->count[$i]
                ]);
            $i++;
        }

        return redirect()->route('home.index')
        ->with('success', 'Survey updated');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function takeSurvey(Request $request, $id)
    {
        $survey = Survey::find($id);

        return view('survey.take', [
            'survey' => $survey,
            'options' => $survey->options
        ]);
    }

    public function delete($id)
    {
        Survey::where('id', $id)->forceDelete();

        return redirect()->route('home.index')
            ->with('success','Survey deleted');
    }
}
