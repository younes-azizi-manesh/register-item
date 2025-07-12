<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimAd extends Model
{

    protected $fillable = ['mobile_number', 'owner_name', 'type', 'price', 'city', 'expire_at', 'is_special'];

    protected $enumTypeMap = [
        'for_sale' => 'فروشی',
        'installment'  => 'قسطی',
        'loan'     => 'وام',
    ];

    public function getTypeAttribute($value)
    {
        return $this->enumTypeMap[$value] ?? $value;
    }


    public function setTypeAttribute($value)
    {
        $flip = array_flip($this->enumTypeMap);
        $this->attributes['type'] = $flip[$value] ?? $value;
    }
}
