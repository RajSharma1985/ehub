<?php

namespace App\Http\Controllers;

use App\Http\Helper\Constant;
use App\Model\Section;
use App\Model\Subjects;
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
            'topic_name_en_us' => 'required|unique:section|max:255',
            'topic_name_hindi' => 'required|unique:section|max:255',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('topic/create')
                ->withErrors($validator)
                ->withInput(Input::except('topic_name'));
        } else {
            dd($request->all());
            // store
            $section = new Section;
            $sctionName = ['en_us'=>Input::get('section_name_en_us'),'hindi'=>Input::get('section_name_hindi')];
            $section->section_lang = $sctionName;
            $section->section_name = Input::get('section_name_en_us');
            $section->status = Input::get('status');
            $section->save();

            // redirect
            Session::flash('message', 'Successfully created section!');
            return Redirect::to('section');
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
        $section = Section::find($id);

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

        $section = Section::find($id);
        $status = Constant::$status;
        return View::make('admin.section.edit',compact('status','section'));
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
            'section_name_en_us' => 'required|unique:section|max:255',
            'section_name_hindi' => 'required|unique:section|max:255',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('section.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::except('section_name'));
        } else {
            // store
            $section = Section::where('_id',$id)->first();
            if(!empty($section)){

                $sctionName = ['en_us'=>Input::get('section_name_en_us'),'hindi'=>Input::get('section_name_hindi')];
                $section->section_lan = $sctionName;
                $section->section_name = Input::get('section_name_en_us');
                $section->status = Input::get('status');
                $section->save();
                // redirect
                Session::flash('message', 'Successfully updated section!');
                return Redirect::to('section');
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
        $section = Section::findOrFail($id);
        if(!empty($section))
        {
            $section->delete();
            Subjects::where('section_id',$section->_id)->delete();
        }
        Session::flash('message', 'Section successfully deleted!');
        return Redirect::to('section');


    }
}
