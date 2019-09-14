<?php

namespace App\Model;
use App\Model\SubTopics;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AssignSubTopics extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'assign_subtopics';

    public function getSection()
    {
        return $this->belongsTo('App\Model\Section', 'section_id','_id');
    }

    public static function getSubTopics($topicId)
    {    $subtopicsName = [];
         $assignSubTopic = self::where('topic_id',$topicId)->first();
         if(!empty($assignSubTopic->assign_sub_topics)){
            $subtopics = SubTopics::select('sub_topic_name')->whereIn('_id',$assignSubTopic->assign_sub_topics)->get();
            if(!empty($subtopics)){
                foreach($subtopics as $value){
                    $subtopicsName[] = $value->sub_topic_name;
                }
                return implode("<br/>",$subtopicsName);
            }
         }
         
    }
}
