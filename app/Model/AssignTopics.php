<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AssignTopics extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'assign_topics';

    public static function getTopics($topicId)
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
