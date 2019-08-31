<?php

namespace App\Http\Controllers;

use App\Model\Section;
use App\Model\AssignSubjects;
use App\Model\Subjects;
use Illuminate\Http\Request;
use App\Http\Helper\Constant;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds

        $assignSubjects = AssignSubjects::with('getSection')->paginate(2);
        // load the view and pass the nerds
        return view('admin.assign_subjects.index', compact('assignSubjects'));
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
        $assignSubject = AssignSubjects::find($id);
        $subjects = Subjects::whereIn('status',['1',1])->get();
        return View::make('admin.assign_subjects.edit',compact('assignSubject','subjects'));
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
            return Redirect::to(route('assignsubjects.edit', $id))
                ->withErrors($validator);

        } else {
            $assignSubject = AssignSubjects::where('_id', $id)->first();
            if (!empty($assignSubject)) {
                $assignSubject->assigned_subjects = $request->assigned_selections;
                $assignSubject->save();

                // redirect
                Session::flash('message', 'Successfully assigned subject!');
                return Redirect::to('assignsubjects');
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
        //
    }
}
