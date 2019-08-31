<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Subjects extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'subjects';


    public function getSection()
    {
        return $this->belongsTo('App\Model\Section', 'section_id','_id');
    }
}
