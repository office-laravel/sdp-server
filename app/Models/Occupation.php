<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Occupation extends Model
{
    use HasFactory;
    protected  $fillable =['Name'];

    
    // public function members(): HasMany
    // {
    //     return $this->hasMany(Member::class,'occupation_id');
    // }
}
