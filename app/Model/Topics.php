<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Topics extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'topics';
}
