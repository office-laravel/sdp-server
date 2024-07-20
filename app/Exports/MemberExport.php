<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
//use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Exportable;
//use Illuminate\Contracts\Queue\ShouldQueue;
class MemberExport implements FromCollection , WithHeadings
//, WithChunkReading
//,ShouldQueue
{
   // use Exportable;
    public $page_num=0;
    public function __construct( $page_num)
    {
        $this->page_num = $page_num;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $skiprows=($this->page_num -1)* 4000;
        return Member::select('id','IDTeam','FirstName','LastName'
        ,'FatherName',
    'MotherName',
    'PlaceOfBirth','BirthDate','Constraint',
    'City','IDNumber','Gender','Qualification','Occupation','MobilePhone','HomeAddress',
    'WorkAddress','HomePhone','WorkPhone','DateOfJoin','Specialization','Image','area','street')->skip($skiprows)->take(4000)->get();
    }
    public function headings(): array
    {
        return [
            
            'الرقم التعريفي',
             'الرقم الحزبي',
             'الاسم',
             'الكنية',
             'الاب',
            'الام',
            'PlaceOfBirth','BirthDate','Constraint',
    'City','IDNumber','Gender','Qualification','Occupation','MobilePhone','HomeAddress',
    'WorkAddress','HomePhone','WorkPhone','DateOfJoin','Specialization','Image','area','street'
        ];
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
