<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class City extends Model
{
    use HasFactory;
    
    protected $areas = 'parent_name';
    protected $streets = 'grand_name';

    

    protected $fillable = ['Name', 'parentId', 'area', 'grandId', 'street'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'city_id');
    }
}
