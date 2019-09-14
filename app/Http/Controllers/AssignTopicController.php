<?php

namespace App\Http\Controllers;

use App\Http\Helper\Constant;
use App\Model\Topics;
use App\Model\AssignTopics;
use App\Model\Subjects;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class AssignTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subjects::paginate(10);
        return view('admin.assign_topics.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subjects::find($id);
        $assignTopics = [];
        $assTopics = AssignTopics::where('subject_id',$id)->first();
        $topics = Topics::whereIn('status',[1,'1']);
        if(!empty($assTopics->assign_topics)){
            $topics = $topics->whereNotIn('_id',$assTopics->assign_topics);
            $assignTopics = Topics::whereIn('_id',$assTopics->assign_topics)->get();
        }
       
        $topics = $topics->get();
        return View::make('admin.assign_topics.edit',compact('topics','assignTopics','subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'assigned_selections' => 'required|unique:section|max:255'

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('assigntopics.edit', $id))
                ->withErrors($validator);

        } else {
                $assignTopics = AssignTopics::where('subject_id',$id)->first();
                if(empty($assignTopics)){
                    $assignTopics = new AssignTopics();     
                }
                $assignTopics->subject_id = $id;
                $assignTopics->assign_topics = $request->assigned_selections;
                $assignTopics->save();

                // redirect
                Session::flash('message', 'Successfully assigned topics!');
                return Redirect::to('assigntopics');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
