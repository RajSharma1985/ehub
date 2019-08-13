<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Section extends Eloquent
{
    protected $connection = 'mongodb';
}
