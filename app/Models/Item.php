<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = ['owner_name', 'item_code', 'category', 'type', 'price_suggestion', 'location'];

}
