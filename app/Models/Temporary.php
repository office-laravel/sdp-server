<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporary extends Model
{
    use HasFactory;

    protected  $fillable =['NotPad','IDTeam','FullName',
    'MotherName','PlaceOfBirth','BirthDate','Constraint',
    'City','IDNumber','Gender','Qualification','Occupation','MobilePhone','HomeAddress',
    'WorkAddress','HomePhone','WorkPhone','DateOfJoin','Specialization','Image','operation','managerEmail'];
   

}
