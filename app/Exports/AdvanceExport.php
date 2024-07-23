<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
//use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Exportable;
//use Illuminate\Contracts\Queue\ShouldQueue;
class AdvanceExport implements FromCollection , WithHeadings
//, WithChunkReading
//,ShouldQueue
{
   // use Exportable;
    public $list;
    public function __construct($list)
    {
        $this->list = $list;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      //  $skiprows=($this->page_num -1)* 4000;
        return $this->list;
    }
    public function headings(): array
    {
        return [
            'الرقم التعريفي',
            'الرقم الحزبي',
            'الاسم',
            'الكنية',
            'الأب',
            'الأم',
            'مكان الولادة',
            'تاريخ الولادة',
            'محل ورقم القيد',
            'المحافظة',
            'الرقم الوطني',
            'الجنس',
            'الؤهل العلمي',
            'المهنة',
            'موبايل',
            'عنوان المنزل',
            'عنوان العمل',
            'هاتف المنزل',
            'هاتف العمل',
            'تاريخ الإنتساب',
            'الاختصاص',
            'رابط الصورة',
            'المنطقة',
            'الحي',
            'الحالة',
        ];
    }
    // public function chunkSize(): int
    // {
    //     return 1000;
    // }
}
