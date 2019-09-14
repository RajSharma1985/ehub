<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class SubTopics extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'subtopics';
    //
}
