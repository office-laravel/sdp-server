<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected  $fillable =['NotPad','IDTeam','FullName',
    'MotherName','PlaceOfBirth','BirthDate','Constraint',
    'City','IDNumber','Gender','Qualification','Occupation','MobilePhone','HomeAddress',
    'WorkAddress','HomePhone','WorkPhone','DateOfJoin','Specialization','Image','area','street'];
   

// public function user(): BelongsTo
// {
//     return $this->belongsTo(User::class);
// }

// public function qualification(): BelongsTo
// {
//     return $this->belongsTo(Qualification::class);
// }

// public function occupation(): BelongsTo
// {
//     return $this->belongsTo(Occupation::class);
// }

}
