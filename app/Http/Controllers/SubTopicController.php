<?php

namespace App\Http\Controllers;

use App\Model\SubTopics;
use App\Model\Topics;
use App\Model\AssignSubTopics;
use Illuminate\Http\Request;
use App\Http\Helper\Constant;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class SubTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subtopics = SubTopics::paginate(10);

        // load the view and pass the nerds
        return view('admin.subtopics.index', compact('subtopics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topics::whereIn('status',['1',1])->get();
        $status = Constant::$status;
        return View::make('admin.subtopics.create',compact('status','topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'topic_name' => 'required',
            'sub_topic_name_hindi' => 'required',
            'sub_topic_name_en_us' => 'required',
            'sub_topic_desc_en_us' => 'required',
            'sub_topic_desc_hindi' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('subtopic/create')
                ->withErrors($validator)
                ->withInput(Input::except('sub_topic_name'));
        }else{

            $subTopic = new SubTopics;
            $subTopicsName = ['en_us'=>Input::get('sub_topic_name_en_us'),'hindi'=>Input::get('sub_topic_name_hindi')];
            $subTopicsDesc = ['en_us'=>Input::get('sub_topic_desc_en_us'),'hindi'=>Input::get('sub_topic_desc_hindi')];
            $subTopic->topic_id = Input::get('topic_name');
            $subTopic->sub_topic_name_lang = $subTopicsName;
            $subTopic->sub_topic_desc_lang = $subTopicsDesc;
            $subTopic->sub_topic_name = Input::get('sub_topic_name_en_us');
            $subTopic->status = Input::get('status');
            $subTopic->save();

            // redirect
            Session::flash('message', 'Successfully created subtopic!');
            return Redirect::to('subtopic');

        }
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
        $subtopic = SubTopics::find($id);
        $status = Constant::$status;
        $topics = Topics::whereIn('status',[1,'1'])->get();
        return View::make('admin.subtopics.edit',compact('status','subtopic','topics'));
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
            'topic_name' => 'required',
            'sub_topic_name_hindi' => 'required',
            'sub_topic_name_en_us' => 'required',
            'sub_topic_desc_en_us' => 'required',
            'sub_topic_desc_hindi' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('subtopic.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::except('sub_topic_name'));
        }else{

            $subTopic = SubTopics::find($id);
            $subTopicsName = ['en_us'=>Input::get('sub_topic_name_en_us'),'hindi'=>Input::get('sub_topic_name_hindi')];
            $subTopicsDesc = ['en_us'=>Input::get('sub_topic_desc_en_us'),'hindi'=>Input::get('sub_topic_desc_hindi')];
            $subTopic->topic_id = Input::get('topic_name');
            $subTopic->sub_topic_name_lang = $subTopicsName;
            $subTopic->sub_topic_desc_lang = $subTopicsDesc;
            $subTopic->sub_topic_name = Input::get('sub_topic_name_en_us');
            $subTopic->status = Input::get('status');
            $subTopic->save();

            // redirect
            Session::flash('message', 'Successfully updated subtopic!');
            return Redirect::to('subtopic');

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
        $subtopic = SubTopics::findOrFail($id);
        if(!empty($subtopic))
        {
            $subtopic->delete();

        }
        Session::flash('message', 'Subtopic successfully deleted!');
        return Redirect::to('subtopic');
    }

    public function getSubTopics(Request $request){
        if(!empty($request->topic_id)){
            $assignSubTopics = AssignSubTopics::where('topic_id',$request->topic_id)->first();
            if(!empty($assignSubTopics->assign_sub_topics)){
                $subtopics = SubTopics::select('_id','sub_topic_name')->whereIn('_id',$assignSubTopics->assign_sub_topics)->get();
                return ['status'=>'success', 'data'=>$subtopics, 'message'=>'Sub topics founds'];
            }
            else{
                return ['status'=>'error', 'data'=>[], 'message'=>'Sub topics not founds'];
            }
        }
        else{
            return ['status'=>'error', 'data'=>[], 'message'=>'Sub topics not founds'];
        }
    }
}
