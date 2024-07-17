<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Qualification extends Model
{
    use HasFactory;

    protected $specializations = 'parent_name';

    protected  $fillable =['Name','parentId','specialization'];

    // public function members(): HasMany
    // {
    //     return $this->hasMany(Member::class,'qualification_id');
    // }

}
