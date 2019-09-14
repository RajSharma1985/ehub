<?php

namespace App\Http\Controllers;

use App\Http\Helper\Constant;
use App\Model\Topics;
use App\Model\AssignSubTopics;
use App\Model\SubTopics;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class AssignSubTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topics::paginate(10);
        return view('admin.assign_subtopics.index', compact('topics'));
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topics::find($id);
        $assginSubTopics = [];
        $assSubTopics = AssignSubTopics::where('topic_id',$id)->first();
        $subtopics = Subtopics::whereIn('status',[1,'1']);
        if(!empty($assSubTopics->assign_sub_topics)){
            $subtopics = $subtopics->whereNotIn('_id',$assSubTopics->assign_sub_topics);
            $assginSubTopics = SubTopics::whereIn('_id',$assSubTopics->assign_sub_topics)->get();
        }
       
        $subtopics = $subtopics->get();
        return View::make('admin.assign_subtopics.edit',compact('subtopics','assginSubTopics','topic'));
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
            return Redirect::to(route('assignsubtopic.edit', $id))
                ->withErrors($validator);

        } else {
                $assignSubTopic = AssignSubTopics::where('topic_id',$id)->first();
                if(empty($assignSubTopic)){
                    $assignSubTopic = new AssignSubTopics();     
                }
                $assignSubTopic->topic_id = $id;
                $assignSubTopic->assign_sub_topics = $request->assigned_selections;
                $assignSubTopic->save();

                // redirect
                Session::flash('message', 'Successfully assigned sub topics!');
                return Redirect::to('assignsubtopic');
            
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
