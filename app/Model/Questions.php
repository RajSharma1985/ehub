<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Questions extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'questions';
}
