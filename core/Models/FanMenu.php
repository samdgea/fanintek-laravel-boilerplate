<?php

namespace Fanintek\Fantasena\Models;

use Illuminate\Database\Eloquent\Model;

class FanMenu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'parent_id', 'menu_label', 'menu_url', 'menu_route', 'menu_icon', 'granted_to'
    ];
}
