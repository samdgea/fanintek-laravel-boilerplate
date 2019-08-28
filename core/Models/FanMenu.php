<?php

namespace Fanintek\Fantasena\Models;

use Illuminate\Database\Eloquent\Model;

class FanMenu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'parent_id', 'menu_label', 'menu_link_type', 'menu_data', 'menu_icon', 'granted_to'
    ];

    public function parent_menu()
    {
        return $this->hasOne(FanMenu::class, 'id', 'parent_id');
    }
}
