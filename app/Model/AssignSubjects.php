<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AssignSubjects extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'assign_subjects';

    public function getSection()
    {
        return $this->belongsTo('App\Model\Section', 'section_id','_id');
    }

    public static function getSubjects($subjectId)
    {    $subjectName = [];
         $assignedSubjects = self::where('_id',$subjectId)->first();
         if(!empty($assignedSubjects->assigned_subjects)){
            $subjects = Subjects::select('subject_name')->whereIn('_id',$assignedSubjects->assigned_subjects)->get();
            if(!empty($subjects)){
                foreach($subjects as $value){
                    $subjectName[] = $value->subject_name;
                }
                return implode("<br/>",$subjectName);
            }
         }
         
    }
}
