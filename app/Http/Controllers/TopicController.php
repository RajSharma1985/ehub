<?php

namespace App\Http\Controllers;

use App\Http\Helper\Constant;
use App\Model\Section;
use App\Model\Subjects;
use App\Model\AssignTopics;
use App\Model\Topics;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $topics = Topics::paginate(10);

        // load the view and pass the nerds
        return view('admin.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Constant::$status;
        $sections = Section::whereIn('status',[1,'1'])->get();
        return View::make('admin.topics.create',compact('status','sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'topic_name_en_us' => 'required|unique:topics',
            'topic_name_hindi' => 'required|unique:topics',
            'topic_desc_en_us' => 'required|unique:topics',
            'topic_desc_hindi' => 'required|unique:topics',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('topic/create')
                ->withErrors($validator)
                ->withInput(Input::except('topic_name'));
        } else {
            // store
            $topics = new Topics;
            $topicsName = ['en_us'=>Input::get('topic_name_en_us'),'hindi'=>Input::get('topic_name_hindi')];
            $topicsDesc = ['en_us'=>Input::get('topic_desc_en_us'),'hindi'=>Input::get('topic_desc_hindi')];
            $topics->topic_name_lang = $topicsName;
            $topics->topic_desc_lang = $topicsDesc;
            $topics->topic_name = Input::get('topic_name_en_us');
            $topics->status = Input::get('status');
            $topics->save();

            // redirect
            Session::flash('message', 'Successfully created topic!');
            return Redirect::to('topic');
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
        // get the nerd
        $section = Topics::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.section.show')
            ->with('section', $section);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the nerd

        $topics = Topics::find($id);
        $status = Constant::$status;
        return View::make('admin.topics.edit',compact('status','topics'));
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
            'topic_name_en_us' => 'required|unique:topics',
            'topic_name_hindi' => 'required|unique:topics',
            'topic_desc_en_us' => 'required|unique:topics',
            'topic_desc_hindi' => 'required|unique:topics',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('topic.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::except('topic_name'));
        } else {
            // store
            $topics = Topics::where('_id',$id)->first();
            if(!empty($topics)){

                $topicsName = ['en_us'=>Input::get('topic_name_en_us'),'hindi'=>Input::get('topic_name_hindi')];
                $topicsDesc = ['en_us'=>Input::get('topic_desc_en_us'),'hindi'=>Input::get('topic_desc_hindi')];
                $topics->topic_name_lang = $topicsName;
                $topics->topic_desc_lang = $topicsDesc;
                $topics->topic_name = Input::get('topic_name_en_us');
                $topics->status = Input::get('status');
                $topics->save();
                // redirect
                Session::flash('message', 'Successfully updated topic!');
                return Redirect::to('topic');
            }
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
        $topic = Topics::findOrFail($id);
        if(!empty($topic))
        {
            $topic->delete();

        }
        Session::flash('message', 'Topic successfully deleted!');
        return Redirect::to('topic');


    }

    public function getTopics(Request $request){
        if(!empty($request->subject_id)){
            $assignTopics = AssignTopics::where('subject_id',$request->subject_id)->first();
            if(!empty($assignTopics->assign_topics)){
                $topics = Topics::select('_id','topic_name')->whereIn('_id',$assignTopics->assign_topics)->get();
                return ['status'=>'success', 'data'=>$topics, 'message'=>'Topics founds'];
            }
            else{
                return ['status'=>'error', 'data'=>[], 'message'=>'Topics not founds'];
            }
        }
        else{
            return ['status'=>'error', 'data'=>[], 'message'=>'Topics not founds'];
        }
    }
}
