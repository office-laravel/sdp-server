<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Temporary;
use App\Models\Qualification;
use App\Models\Status;

use App\Models\Member;
use Illuminate\Http\Request;
use DateTime;

class TemporaryController extends Controller
{
  public function getDeletedMember()
  {
    $members = Temporary::where('operation', '0')->select('id', 'FirstName','LastName','FatherName', 'IDTeam', 'managerEmail')
      ->orderBy('updated_at', 'desc')->paginate(4);

    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    return view('admin.notice.delete', [
      'members' => $members,
      'paginationLinks' => $paginationLinks
    ]);
  }

  
  public function getEtidedMember()
  {
    $members = Temporary::where('operation', '1')->where('AdminAgree', 0)->select('id', 'FirstName','LastName','FatherName', 'IDTeam', 'managerEmail')
      ->orderBy('updated_at', 'desc')->paginate(4);

    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    return view('admin.notice.edit', [
      'members' => $members,
      'paginationLinks' => $paginationLinks
    ]);
  }


  public function storeUpdatedMember(Request $request)
  {
    // Convert Birthdate format
    $birthDate = DateTime::createFromFormat('m/d/Y', $request->BirthDate);
    $birthDateFormatted = $birthDate ? $birthDate->format('Y-m-d') : $request->BirthDate;


    $qualification = $request->Qualification;

    if (is_numeric($qualification)) {
      // إذا كانت القيمة هي id
      $qualificationName = Qualification::where('id', $qualification)->value('Name');
    } else {
      // إذا كانت القيمة هي اسم
      $qualificationName = $qualification;
    }

    $specialization = $request->Specialization;

    if (is_numeric($specialization)) {
      // إذا كانت القيمة هي id
      $specializationName = Qualification::where('id', $specialization)->value('specialization');
    } else {
      // إذا كانت القيمة هي اسم
      $specializationName = $specialization;
    }

    
  $statusId = $request->status;

  if (is_numeric($statusId)) {
      // إذا كانت القيمة هي id
      $statusName = Status::where('id', $statusId)->value('name');
  } else {
      // إذا كانت القيمة هي اسم
      $statusName = $statusId;
  }


    $user = auth()->user();

    $member = new Temporary();
    $member->NotPad = $request->NotPad;
    $member->IDTeam  = $request->IDTeam;
    $member->FirstName = $request->FirstName;
    $member->LastName = $request->LastName;
    $member->FatherName = $request->FatherName;
    $member->MotherName = $request->MotherName;
    $member->PlaceOfBirth = $request->PlaceOfBirth;
    $member->BirthDate = $birthDateFormatted;
    $member->Constraint = $request->Constraint;
    $member->City = $request->City;
    $member->IDNumber  = $request->IDNumber;
    $member->Gender  = $request->Gender == 'ذكر' ? 'ذكر' : 'أنثى';
    $member->Qualification = $qualificationName;
    $member->Specialization  = $specializationName;
    $member->Occupation  = $request->Occupation;
    $member->MobilePhone  = $request->MobilePhone;
    $member->HomeAddress  = $request->HomeAddress;
    $member->WorkAddress  = $request->WorkAddress;
    $member->HomePhone  = $request->HomePhone;
    $member->WorkPhone  = $request->WorkPhone;
    $member->DateOfJoin  = $request->DateOfJoin;
    $member->status  = $statusName;

    $member->operation = '1';
    $member->managerEmail = $user->email;
 
    // if (optional(auth()->user())->Role == 'admin') 
    // {
    //   $member->AdminAgree ='1';
    // }
   
    if(Temporary::where('IDTeam', $member->IDTeam)->where('operation', '1')->where('AdminAgree', 0)->exists())
    {
  
        session()->flash('Edit', 'طلب التعديل قد تم إرساله مسبقا إلى المدير');
        return back();
    }
    else
    {
      $member->save();

      // return dd($request->all());
    // store image
    if ($request->hasfile('Image')) {
      $img = $request->file('Image');
      $img_name = $img->getClientOriginalName();
      $img->move('assets/img/media/', $img_name);

      Temporary::find($member->id)->update([
        'Image' => $img_name,
      ]);
    }

        session()->flash('Edit', 'سيتم تعديل العضو بعد الموافقة عليه من قبل المدير');
        return back();
    }
  }

  public function storeDeletedMember($id)
  {
    //  return $id;

    $user = auth()->user();

    $Oldmember = Member::find($id);
    //return   $Oldmember;
    $member = new Temporary();
    $member->NotPad = $Oldmember->NotPad;
    $member->IDTeam  = $Oldmember->IDTeam;
    $member->FirstName = $Oldmember->FirstName;
    $member->LastName = $Oldmember->LastName;
    $member->FatherName = $Oldmember->FatherName;
    $member->MotherName = $Oldmember->MotherName;
    $member->PlaceOfBirth = $Oldmember->PlaceOfBirth;
    $member->BirthDate = $Oldmember->BirthDate;
    $member->Constraint = $Oldmember->Constraint;
    $member->City = $Oldmember->City;
    $member->IDNumber  = $Oldmember->IDNumber;
    $member->Gender  = $Oldmember->Gender;
    $member->Qualification = $Oldmember->Qualification;
    $member->Specialization  = $Oldmember->Specialization;
    $member->Occupation  = $Oldmember->Occupation;
    $member->MobilePhone  = $Oldmember->MobilePhone;
    $member->HomeAddress  = $Oldmember->HomeAddress;
    $member->WorkAddress  = $Oldmember->WorkAddress;
    $member->HomePhone  = $Oldmember->HomePhone;
    $member->WorkPhone  = $Oldmember->WorkPhone;
    $member->DateOfJoin  = $Oldmember->DateOfJoin;
    $member->status  = $Oldmember->status;
    $member->Image  = $Oldmember->Image;
    $member->operation = '0';
    $member->managerEmail = $user->email;

    // if (optional(auth()->user())->Role == 'admin') 
    // {
    //   $member->AdminAgree ='1';
    // }

    if(Temporary::where('IDTeam', $member->IDTeam)->where('operation', '0')->exists())
    {
        session()->flash('delete', 'طلب الحذف قد تم إرساله مسبقا إلى المدير');
        return back();
    }
    else
    {
        $member->save();
        session()->flash('delete', 'سيتم حذف العضو بعد الموافقة عليه من قبل المدير');
        return back();
    }

    session()->flash('delete', 'سيتم حذف العضو بعد الموافقة عليه من قبل المدير');
    return back();
  }


    public function destroyNotice_delete($id)
{
    Temporary::find($id)->delete();
    session()->flash('delete', 'تم تجاهل الإشعار ');
    return back();
} 

public function destroyNotice($id)
{
    Temporary::find($id)->delete();
    session()->flash('delete', 'تم تجاهل الإشعار ');
    return redirect()->route('delete');
  
} 
public function destroyNoticeUpdate($id)
{
    Temporary::find($id)->delete();
    session()->flash('delete', 'تم تجاهل الإشعار ');
    return redirect()->route('edit');
  
}  


  public function editDetails($IDTeam)
  {
    $memb = Temporary::where('IDTeam', $IDTeam)->first();

    // return $memb;
    return view('admin.notice.editDetails', ['memb' => $memb]);
    // return dd($mem);
  }

public function deleteDetails($id)
{
   $member = Temporary::where('id',$id)->first();
   return view('admin.notice.deleteDetails',compact('member'));
}

public function GetArchive($IDTeam)
{
  $members = Temporary::where('IDTeam',$IDTeam)
  ->where('operation','1')
  ->where('AdminAgree',1)
  ->orderBy('updated_at', 'desc')->get();
  return view('admin.member.editArchive',compact('members'));
}

}
