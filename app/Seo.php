<?php

namespace App;

use App\Models\Campaign;
use Session;

class Seo
{

    public static function setSeo(Campaign $campaign): void
    {
        Session::remove('seo');
        Session::put('seo',$campaign->seo());
    }
}

