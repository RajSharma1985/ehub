<?php

namespace App\Http\Controllers;
use App\Http\Helper\Constant;
use App\Model\Section;
use App\Model\Subjects;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $subjects = Subjects::paginate(2);
        // load the view and pass the nerds
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Constant::$status;
        $sections = Section::all();
        return View::make('admin.subjects.create',compact('status','sections'));
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
        //echo "<pre>";print_r($request->all());exit;
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'subject_name_en_us' => 'required|unique:section|max:255',
            'subject_name_hindi' => 'required|unique:section|max:255',
            'status' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('subject/create')
                ->withErrors($validator);

        }else {
            // store
            $subject = new Subjects;
            $subjectName = ['en_us'=>Input::get('subject_name_en_us'),'hindi'=>Input::get('subject_name_hindi')];
            $subject->subject_lang = $subjectName;
            $subject->subject_name = Input::get('subject_name_en_us');
            $subject->status = Input::get('status');
            $subject->save();

            // redirect
            Session::flash('message', 'Successfully created subject!');
            return Redirect::to('subject');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = Constant::$status;
        $sections = Section::all();
        $subject = Subjects::find($id);
        return View::make('admin.subjects.edit',compact('status','sections','subject'));
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
            'subject_name_en_us' => 'required|unique:section|max:255',
            'subject_name_hindi' => 'required|unique:section|max:255',
            'status' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('subject.edit',$id))
                ->withErrors($validator);

        } else {

            $subject = Subjects::where('_id',$id)->first();
            if(!empty($subject)){
                $subjectName = ['en_us'=>Input::get('subject_name_en_us'),'hindi'=>Input::get('subject_name_hindi')];
                $subject->subject_lang = $subjectName;
                $subject->subject_name = Input::get('subject_name_en_us');
                $subject->status = Input::get('status');
                $subject->save();

                // redirect
                Session::flash('message', 'Successfully updated subject!');
                return Redirect::to('subject');
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
        $subject = Subjects::findOrFail($id);
        $subject->delete();
        Session::flash('message', 'Subject successfully deleted!');
        return Redirect::to('subject');

    }
}
