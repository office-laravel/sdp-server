<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TemporaryController;
use App\Models\City;
use App\Models\Member;
use App\Models\Temporary;
use App\Models\Occupation;
use App\Models\Qualification;
use App\Models\Status;

use App\Models\User;
use Auth;
use DateTime;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
// use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;


use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\paginate;

class MemberController extends Controller
{

public function index()
{ 
    if (optional(auth()->user())->Role == 'admin') {
        $city = City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
        $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();
        $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
        $occupations = Occupation::orderBy('created_at','Asc')->get();
        $status = Status::orderBy('created_at','Asc')->get();


        $members = Member::orderBy('IDTeam', 'Asc')->select('id','IDTeam','FirstName','LastName',
        'City','status')->paginate(50);
        $memberCount = Member::count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('admin.member.show', [
            'city' => $city,
            'areas' => $areas,
            'streets' => $streets,
            'qualifications' => $qualifications,
            'specializations' => $specializations,
            'occupations' => $occupations,
            'status'=>$status,
            'members' => $members,
            'memberCount'=>$memberCount,
            'paginationLinks' => $paginationLinks
        ]);
    }

    elseif (optional(auth()->user())->Role == 'manager') {
        $user = auth()->user();
        $cityName = DB::table('cities')
            ->where('id', $user->city_id)
            ->value('Name');
        
        $members = Member::where('City', $cityName)->orderBy('IDTeam', 'Asc')->paginate(50);
        $memberCount = Member::where('City', $cityName)->count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('manager.member.show', [
            'members' => $members,
            'memberCount'=>$memberCount,
            'paginationLinks' => $paginationLinks
        ]);
    }
}

public function orderBy_Last()
{ 
        if (optional(auth()->user())->Role == 'admin') 
        {
            $members = Member::orderBy('created_at','Desc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
            return view('admin.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }

        elseif (optional(auth()->user())->Role == 'manager') {
            $user = auth()->user();
            $cityName = DB::table('cities')
                ->where('id', $user->city_id)
                ->value('Name');
            
            $members = Member::where('City', $cityName)->orderBy('created_at', 'Desc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('manager.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
         }
}

    
public function orderBy_Name()
{ 
        if (optional(auth()->user())->Role == 'admin') 
        {
            $members = Member::orderBy('FirstName','Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('admin.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }

        elseif (optional(auth()->user())->Role == 'manager') {
            $user = auth()->user();
            $cityName = DB::table('cities')
                ->where('id', $user->city_id)
                ->value('Name');
            
            $members = Member::where('City', $cityName)->orderBy('FirstName', 'Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('manager.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }
}

public function orderBy_LastName()
{ 
        if (optional(auth()->user())->Role == 'admin') 
        {
            $members = Member::orderBy('LastName','Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('admin.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }

        elseif (optional(auth()->user())->Role == 'manager') {
            $user = auth()->user();
            $cityName = DB::table('cities')
                ->where('id', $user->city_id)
                ->value('Name');
            
            $members = Member::where('City', $cityName)->orderBy('LastName', 'Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('manager.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }
}


public function orderBy_IDTeam()
{ 
        if (optional(auth()->user())->Role == 'admin') 
        {
            $members = Member::orderBy('IDTeam','Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('admin.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }
        elseif (optional(auth()->user())->Role == 'manager') {
            $user = auth()->user();
            $cityName = DB::table('cities')
                ->where('id', $user->city_id)
                ->value('Name');
            
            $members = Member::where('City', $cityName)->orderBy('IDTeam','Asc')->paginate(50);
            $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

            return view('manager.member.show', [
                'members' => $members,
                'paginationLinks' => $paginationLinks
            ]);
        }
}


public function orderBy_DateOfJoin()
{ 
        if (optional(auth()->user())->Role == 'admin') 
        {
        $members = Member::orderBy('DateOfJoin','Desc')->paginate(50);
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('admin.member.show', [
            'members' => $members,
            'paginationLinks' => $paginationLinks
        ]);
        }

        elseif (optional(auth()->user())->Role == 'manager') {
        $user = auth()->user();
        $cityName = DB::table('cities')
            ->where('id', $user->city_id)
            ->value('Name');
        
        $members = Member::where('City', $cityName)->orderBy('DateOfJoin', 'Desc')->paginate(50);
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
        
        return view('manager.member.show', [
            'members' => $members,
            'paginationLinks' => $paginationLinks
        ]);
        }
}

public function avilable_create($avilable)
{
        $user = auth()->user();
        $city = DB::table('cities')
            ->where('id', $user->city_id)
            ->value('Name');
            if($city)
            {
               $cityName = $city;
             //  $branch = City::where('branch', 'like', '%' . $cityName . '%')->pluck('branch')->first();
               $areas = City::where('parentId', $user->city_id)->whereNotNull('area')->orderBy('created_at','Asc')->get();
               $streets = City::where('grandId', $user->city_id)->whereNotNull('street')->orderBy('created_at','Asc')->get();
            }
            else
            {
                $cityName =City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
                $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
                $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();

            }
      
        $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
        $occupations = Occupation::orderBy('created_at','Asc')->get();
        $status = Status::orderBy('created_at','Asc')->get();

        if ( auth()->user()->Role == 'admin')
        {
            return view('admin.member.avilable_add', compact('avilable', 'cityName', 'qualifications', 'occupations', 'areas', 'streets','status'));
        }
        // else if ( auth()->user()->Role == 'manager')
        // {
        //     return view('manager.member.add', compact('avilable', 'cityName', 'qualifications', 'occupations', 'areas', 'streets','status'));
        // }
}






public function create()
{
        $user = auth()->user();
        $city = DB::table('cities')
            ->where('id', $user->city_id)
            ->value('Name');
            if($city)
            {
               $cityName = $city;
             //  $branch = City::where('branch', 'like', '%' . $cityName . '%')->pluck('branch')->first();
               $areas = City::where('parentId', $user->city_id)->whereNotNull('area')->orderBy('created_at','Asc')->get();
               $streets = City::where('grandId', $user->city_id)->whereNotNull('street')->orderBy('created_at','Asc')->get();
            }
            else
            {
                $cityName =City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
                $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
                $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();

            }
      
        $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
        $occupations = Occupation::orderBy('created_at','Asc')->get();
        $status = Status::orderBy('created_at','Asc')->get();

        if ( auth()->user()->Role == 'admin')
        {
            return view('admin.member.add', compact('cityName', 'qualifications', 'occupations', 'areas', 'streets','status'));
        }
        else if ( auth()->user()->Role == 'manager')
        {
            return view('manager.member.add', compact('cityName', 'qualifications', 'occupations', 'areas', 'streets','status'));
        }
}







public function store(Request $request): RedirectResponse
{
        $validated = $request->validate([
           // 'NotPad' => 'required|max:255',
            'IDTeam' => 'required|unique:members|max:255',
            // 'FirstName' => 'required',
            // 'LastName' => 'required',
            // 'FatherName' => 'required',
            // 'MotherName' => 'required',
            // 'PlaceOfBirth' => 'required',
            // 'BirthDate' => 'required|date|before:today',
            // 'Constraint' => 'required',
            // 'City' => 'required',
            // 'IDNumber' => 'required|unique:members|min:10|max:11',
            // 'Gender' => 'required',
          //  'Qualification' =>'required',
            // 'Occupation' => 'required',
            // 'MobilePhone' => 'required|max:10|min:9',
            // 'HomeAddress' => 'required',
            // 'WorkAddress' => 'required',
            // 'HomePhone' => 'required|max:10|min:9',
            // 'WorkPhone' => 'required|max:10|min:9',
            // 'DateOfJoin' => 'required|numeric|digits:4|before_or_equal:' . date('Y'),
            // 'Specialization' => 'required',
            // 'area' => 'required',
            // 'street' => 'required',
            // 'Image' =>'required',
        ]);

    // for increment IDTeam automatically when adding a new member
    // $latestIDTeam = DB::table('members')->orderBy('IDTeam', 'desc')->first();
    // if($latestIDTeam){
    //     $IDTeam = $latestIDTeam->IDTeam + 1;
    // }
    // else{
    //     $IDTeam = 1;
    // }
    
  // Convert Birthdate format
  $birthDate = DateTime::createFromFormat('m/d/Y',$request->BirthDate);
  $birthDateFormatted = $birthDate ? $birthDate->format('Y-m-d') : $request->BirthDate;

  // Convert DateOfJoin format
  $dateJoin = DateTime::createFromFormat('Y',$request->DateOfJoin );
  $dateJoinFormatted = $dateJoin ? $dateJoin->format('Y') : null;



  $qualificationId = $request->Qualification;

  if (is_numeric($qualificationId)) {
      // إذا كانت القيمة هي id
      $qualificationName = Qualification::where('id', $qualificationId)->value('Name');
  } else {
      // إذا كانت القيمة هي اسم
      $qualificationName = $qualificationId;
  }


  $specializationId = $request->Specialization;

  if (is_numeric($specializationId)) {
      // إذا كانت القيمة هي id
      $specializationName = Qualification::where('id', $specializationId)->value('specialization');
  } else {
      // إذا كانت القيمة هي اسم
      $specializationName = $specializationId;
  }


  //   $qualificationId = $request->Qualification;
 //   if($qualificationId){
 //     $qualificationName = Qualification::where('id', $qualificationId)->first()->Name;
 //   }
 //   else{
 //     $qualificationName = $qualificationId;
 //   }
  

 //   $specializationId = $request->Specialization;
 //   if($specializationId){
 //     $specializationName = Qualification::where('id', $specializationId)->first()->specialization;
 //   }
 //   else{
 //     $specializationName = $specializationId;
 //   }



  $cityId = $request->City;

  if (is_numeric($cityId)) {
      // إذا كانت القيمة هي id
      $cityName = City::where('id', $cityId)->value('Name');
  } else {
      // إذا كانت القيمة هي اسم
      $cityName = $cityId;
  }


  $areaId = $request->area;

  if (is_numeric($areaId)) {
      // إذا كانت القيمة هي id
      $areaName = City::where('id', $areaId)->value('area');
  } else {
      // إذا كانت القيمة هي اسم
      $areaName = $areaId;
  }


  $streetId = $request->street;

  if (is_numeric($streetId)) {
      // إذا كانت القيمة هي id
      $streetName = City::where('id', $streetId)->value('street');
  } else {
      // إذا كانت القيمة هي اسم
      $streetName = $streetId;
  }


  $statusId = $request->status;

  if (is_numeric($statusId)) {
      // إذا كانت القيمة هي id
      $statusName = Status::where('id', $statusId)->value('name');
  } else {
      // إذا كانت القيمة هي اسم
      $statusName = $statusId;
  }
  //   $cityId = $request->City;
  //   $cityName = City::where('id', $cityId)->first()->Name;

 //   $areaId = $request->area;
 //   $areaName = City::where('id', $areaId)->first()->area;

 //   $streetId = $request->street;
 //   $streetName = City::where('id', $streetId)->first()->street;


    $member = new Member(); 
    $member->NotPad = $request->NotPad;
    $member->IDTeam  = $request->IDTeam;
   // $member->IDTeam  = $IDTeam;
    $member->FirstName = $request->FirstName;
    $member->LastName = $request->LastName;
    $member->FatherName = $request->FatherName;

    $member->MotherName = $request->MotherName;
    $member->PlaceOfBirth = $request->PlaceOfBirth;
    $member->BirthDate = $birthDateFormatted;
    // $member->BirthDate = $request->BirthDate;
    $member->Constraint = $request->Constraint;
    $member->City = $cityName;
    $member->area = $areaName;
    $member->street = $streetName;

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
    $member->DateOfJoin  = $dateJoinFormatted;
    $member->status  = $statusName;

    // $member->DateOfJoin  = $request->DateOfJoin;
    $member->save();

    // store image
    if($request->hasFile('Image')){
        $newImage = $request->file('Image');
        //$newImageName = $img->getClientOriginalName();
        //for change image name
        $newImageName = 'image_' . $member->id . '.' . $newImage->getClientOriginalExtension();
        $newImage->move('assets/img/media/', $newImageName);

        Member::find($member->id)->update([
            'Image'=> $newImageName,
        ]);
   }
    
 //    session()->flash('Add', ' تم إضافة العضو بنجاح ورقمه الحزبي هو '.$IDTeam);

    session()->flash('Add', ' تم إضافة العضو بنجاح ورقمه الحزبي هو '.$request->IDTeam);
    return back();
}

  
public function edit($id)
{
     $member = Member::findOrFail($id);

     $user = auth()->user();
     $city = DB::table('cities')
         ->where('id', $user->city_id)
         ->value('Name');
        if( $city)
        {
            $cityName = $city;
            $areas = City::where('parentId', $user->city_id)->whereNotNull('area')->orderBy('created_at','Asc')->get();
            $streets = City::where('grandId', $user->city_id)->whereNotNull('street')->orderBy('created_at','Asc')->get();
        }
        else
        {
            $cityName =City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
            $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
            $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();
        }

     $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
     $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
     $occupations = Occupation::orderBy('created_at','Asc')->get();
     $status = Status::orderBy('created_at','Asc')->get();

     if ( auth()->user()->Role == 'admin')
     {
      return view('admin.member.edit',compact('member', 'cityName', 'qualifications', 'specializations', 'occupations', 'areas', 'streets','status'));
     }
    else if ( auth()->user()->Role == 'manager')
     {
      return view('manager.member.edit',compact('member', 'cityName', 'qualifications', 'specializations', 'occupations','status'));
     }
}

  
public function updateForNotice(Request $request, $IDTeam)
{
  
  // Convert Birthdate format
  $birthDate = DateTime::createFromFormat('m/d/Y',$request->BirthDate);
  $birthDateFormatted = $birthDate ? $birthDate->format('Y-m-d') : $request->BirthDate;

  // Convert DateOfJoin format
  $dateJoin = DateTime::createFromFormat('Y',$request->DateOfJoin );
  $dateJoinFormatted = $dateJoin ? $dateJoin->format('Y') : null;


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


  $city = $request->City;

  if (is_numeric($city)) {
      // إذا كانت القيمة هي id
      $cityName = City::where('id', $city)->value('Name');
  } else {
      // إذا كانت القيمة هي اسم
      $cityName = $city;
  }
  
   $area = $request->area;

  if (is_numeric($area)) {
      // إذا كانت القيمة هي id
      $areaName = City::where('id', $area)->value('area');

  } else {
      // إذا كانت القيمة هي اسم
      $areaName = $area;
  }

  $street = $request->street;

  if (is_numeric($street)) {
      // إذا كانت القيمة هي id
      $streetName = City::where('id', $street)->value('street');

  } else {
      // إذا كانت القيمة هي اسم
      $streetName = $street;
  }

  $statusId = $request->status;

  if (is_numeric($statusId)) {
      // إذا كانت القيمة هي id
      $statusName = Status::where('id', $statusId)->value('name');
  } else {
      // إذا كانت القيمة هي اسم
      $statusName = $statusId;
  }


  $member = Member::where('IDTeam',$IDTeam)->first();
  // return($member);
  $oldImageName=$member->Image;
  $member->NotPad = $request->NotPad;
  $member->IDTeam  = $IDTeam;
  $member->FirstName = $request->FirstName;
  $member->LastName = $request->LastName;
  $member->FatherName = $request->FatherName;
  $member->MotherName = $request->MotherName;
  $member->PlaceOfBirth = $request->PlaceOfBirth;
  $member->BirthDate = $birthDateFormatted;
  $member->Constraint = $request->Constraint;
  $member->City = $cityName;
  $member->area = $areaName;
  $member->street = $streetName;

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
  $member->DateOfJoin  = $dateJoinFormatted;
  $member->status  = $statusName;

  $member->update();

    // store image
   // store newImage
  if ($request->hasFile('Image')) {
    // Delete the old image from server
    if ($oldImageName) {
       // Storage::delete('public/assets/img/media/' . $oldImageName);
       File::delete('assets/img/media/'. $oldImageName);
    }

    // Upload new image
    $newImage = $request->file('Image');
    $newImageName = 'image_' . $member->id . '.' . $newImage->getClientOriginalExtension();
    $newImage->move('assets/img/media/', $newImageName);

    // Update the image record with the new image name
    $member->update(['Image' => $newImageName]);
  }


    //Temporary::where($request->IDTeam)->get('AdminAgree')->set('1');
    Temporary::where('IDTeam', $request->IDTeam)->update(['AdminAgree' => 1]);


    session()->flash('Add', 'تم تعديل العضو بنجاح');
    return redirect()->route('edit');
}

public function update(Request $request, $id)
{
  // Convert Birthdate format
  $birthDate = DateTime::createFromFormat('m/d/Y',$request->BirthDate);
  $birthDateFormatted = $birthDate ? $birthDate->format('Y-m-d') : $request->BirthDate;

  // Convert DateOfJoin format
  $dateJoin = DateTime::createFromFormat('Y',$request->DateOfJoin );
  $dateJoinFormatted = $dateJoin ? $dateJoin->format('Y') : null;

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

  $city = $request->City;

  if (is_numeric($city)) {
      // إذا كانت القيمة هي id
      $cityName = City::where('id', $city)->value('Name');
  } else {
      // إذا كانت القيمة هي اسم
      $cityName = $city;
  }
   
   $area = $request->area;

  if (is_numeric($area)) {
      // إذا كانت القيمة هي id
      $areaName = City::where('id', $area)->value('area');

  } else {
      // إذا كانت القيمة هي اسم
      $areaName = $area;
  }

  $street = $request->street;

  if (is_numeric($street)) {
      // إذا كانت القيمة هي id
      $streetName = City::where('id', $street)->value('street');

  } else {
      // إذا كانت القيمة هي اسم
      $streetName = $street;
  }

  $statusId = $request->status;

  if (is_numeric($statusId)) {
      // إذا كانت القيمة هي id
      $statusName = Status::where('id', $statusId)->value('name');
  } else {
      // إذا كانت القيمة هي اسم
      $statusName = $statusId;
  }


  $member = Member::findOrFail($id);
  $oldImageName=$member->Image;
  $member->NotPad = $request->NotPad;
  $member->FirstName = $request->FirstName;
  $member->LastName = $request->LastName;
  $member->FatherName = $request->FatherName;
  $member->MotherName = $request->MotherName;
  $member->PlaceOfBirth = $request->PlaceOfBirth;
  $member->BirthDate = $birthDateFormatted;
  $member->Constraint = $request->Constraint;
  $member->City = $cityName;
  $member->area = $areaName;
  $member->street = $streetName;
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
  $member->DateOfJoin  = $dateJoinFormatted;
  $member->status  = $statusName;

 //   $member->update();

  // Store newImage
  if ($request->hasFile('Image')) {
    // Delete the old image from the server
    if ($oldImageName) {
         // Storage::delete('public/assets/img/media/' . $oldImageName);
         File::delete('assets/img/media/' . $oldImageName);
    }
    // Upload new image
    $newImage = $request->file('Image');
    $newImageName = 'image_' . $member->id . '.' . $newImage->getClientOriginalExtension();
    $newImage->move('assets/img/media/', $newImageName);

    // Update the image record with the new image name
    // $member->update(['Image' => $newImageName]);
    $member->Image = $newImageName;
  }
    $member->update();

    
    if (optional(auth()->user())->Role == 'admin') 
    {
      
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
    $member->AdminAgree ='1';
    $member->managerEmail = $user->email;

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
      }
  

    session()->flash('Edit', 'تم تعديل العضو بنجاح');
    return back(); 
}


public function destroy($id)
{
       Member::findOrFail($id)->delete();

       session()->flash('delete', 'تم حذف العضو بنجاح');
       return back(); 
}

public function destroyForNotice($IDTeam)
{
       Member::where('IDTeam', $IDTeam)->delete();
       Temporary::where('IDTeam', $IDTeam)->where('operation', '0')->delete();
       
       session()->flash('Add', 'تم حذف العضو بنجاح');
       return redirect()->route('delete');
}

public function searchByName(Request $request)
{
        $searchTerm = $request->input('search_FirstName');
        $request->session()->put('search_FirstName', $searchTerm);
      if ( auth()->user()->Role == 'admin')
     {
    $members =  Member::where('FirstName', 'like', '%'.$searchTerm.'%')->orderBy('FirstName', 'Asc')->paginate(50);
    $memberCount =  Member::where('FirstName', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');

    $members = Member::where('City', $cityName)->where('FirstName', 'like', '%'.$searchTerm.'%')->orderBy('FirstName', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('FirstName', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4'); 
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
 
 }

}


// public function searchByName(Request $request)
// {
//     $searchTerm = $request->input('search_FirstName');

//     if (auth()->user()->Role == 'admin')
//     {
//         $members = Member::where('FirstName', 'like', '%'.$searchTerm.'%')->orderBy('FirstName', 'Asc')->paginate(50);
//         $memberCount = Member::where('FirstName', 'like', '%'.$searchTerm.'%')->count();
//         $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

//         return view('admin.member.show', [
//             'members' => $members,
//             'memberCount' => $memberCount,
//             'paginationLinks' => $paginationLinks,
//             'searchTerm' => $searchTerm // إرسال كلمة البحث لعرضها في حقل البحث
//         ]);
//     }
//     elseif (optional(auth()->user())->Role == 'manager') {
//         $user = auth()->user();
//         $cityName = DB::table('cities')
//             ->where('id', $user->city_id)
//             ->value('Name');

//         $members = Member::where('City', $cityName)->where('FirstName', 'like', '%'.$searchTerm.'%')->orderBy('FirstName', 'Asc')->paginate(50);
//         $memberCount = Member::where('City', $cityName)->where('FirstName', 'like', '%'.$searchTerm.'%')->count();
//         $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

//         return view('manager.member.show', [
//             'members' => $members,
//             'memberCount' => $memberCount,
//             'paginationLinks' => $paginationLinks,
//             'searchTerm' => $searchTerm // إرسال كلمة البحث لعرضها في حقل البحث
//         ]);
//     }
// }


public function searchByLastName(Request $request)
{
        $searchTerm = $request->input('search_LastName');
        $request->session()->put('search_LastName', $searchTerm);

   if ( auth()->user()->Role == 'admin')
   {
    $members =  Member::where('LastName', 'like', '%'.$searchTerm.'%')->orderBy('LastName', 'Asc')->paginate(50);
    $memberCount =  Member::where('LastName', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');
    
    $members = Member::where('City', $cityName)->where('LastName', 'like', '%'.$searchTerm.'%')->orderBy('LastName', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('LastName', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
}

public function searchByPhoneNull()
{
   if ( auth()->user()->Role == 'admin')
   {
    $members =  Member::where('MobilePhone',Null)->orwhere('MobilePhone','')->orderBy('FirstName', 'Asc')->paginate(50);
    $memberCount =  Member::where('MobilePhone',Null)->orwhere('MobilePhone','')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);

   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');
    
    $members = Member::where('City', $cityName)->where('MobilePhone',Null)->orwhere('MobilePhone','')->orderBy('FirstName', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('MobilePhone',Null)->orwhere('MobilePhone','')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
}

public function searchForActiveMember()
{
    if ( auth()->user()->Role == 'admin')
    {
     $members =  Member::where('status','فعال')->orderBy('IDTeam', 'Asc')->paginate(50);
     $memberCount =  Member::where('status','فعال')->count();
     $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
     
     return view('admin.member.show', [
         'members' => $members,
         'memberCount'=>$memberCount,
         'paginationLinks' => $paginationLinks
     ]);
 
    }
    elseif (optional(auth()->user())->Role == 'manager') {
     $user = auth()->user();
     $cityName = DB::table('cities')
         ->where('id', $user->city_id)
         ->value('Name');
     
     $members = Member::where('City', $cityName)->where('status','فعال')->orderBy('FirstName', 'Asc')->paginate(50);
     $memberCount = Member::where('City', $cityName)->where('status','فعال')->count();
     $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
     
     return view('manager.member.show', [
         'members' => $members,
         'memberCount'=>$memberCount,
         'paginationLinks' => $paginationLinks
     ]);
    }
}
public function searchForDisActiveMember()
{
   if ( auth()->user()->Role == 'admin')
   {
    $members =  Member::where('status','غير فعال')->orderBy('IDTeam', 'Asc')->paginate(50);
    $memberCount =  Member::where('status','غير فعال')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);

   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');
    
    $members = Member::where('City', $cityName)->where('status','غير فعال')->orderBy('FirstName', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('status','غير فعال')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
}

    public function searchByIDTeam(Request $request)
{
    $searchTerm = $request->input('search_IDTeam');
    if( $searchTerm)
    {
    $request->session()->put('search_IDTeam', $searchTerm);

   if ( auth()->user()->Role == 'admin')
   {
    $members =  Member::where('IDTeam', 'like', $searchTerm)->orderBy('IDTeam', 'Asc')->paginate(50);
    $memberCount =  Member::where('IDTeam', 'like',$searchTerm)->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');

    $members = Member::where('City', $cityName)->where('IDTeam', 'like',$searchTerm)->orderBy('IDTeam', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('IDTeam', 'like',$searchTerm)->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
 }
 else{
   return $this->index();
 }

}

 public function searchByQualification(Request $request)
{
      $searchTerm = $request->input('search_Qualification');
      $request->session()->put('search_Qualification', $searchTerm);

       if ( auth()->user()->Role == 'admin')
        {
          $members =  Member::where('Qualification', 'like', '%'.$searchTerm.'%')->orderBy('Qualification', 'Asc')->paginate(50);
          $memberCount =  Member::where('Qualification', 'like', '%'.$searchTerm.'%')->count();
          $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
           
        return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
        ]);
        }
      elseif (optional(auth()->user())->Role == 'manager') {
      $user = auth()->user();
      $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');

    $members = Member::where('City', $cityName)->where('Qualification', 'like', '%'.$searchTerm.'%')->orderBy('Qualification', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('Qualification', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
        ]);
     }
}

public function searchBySpecialization(Request $request)
{
        $searchTerm = $request->input('search_Specialization');
      $request->session()->put('search_Specialization', $searchTerm);

   if ( auth()->user()->Role == 'admin')
   {
    $members =  Member::where('Specialization', 'like', '%'.$searchTerm.'%')->orderBy('Specialization', 'Asc')->paginate(50);
    $memberCount =  Member::where('Specialization', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
   elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');
    $members = Member::where('City', $cityName)->where('Specialization', 'like', '%'.$searchTerm.'%')->orderBy('Specialization', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('Specialization', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
   }
}

public function searchByArea(Request $request)
{
    $searchTerm = $request->input('search_Area');
    $request->session()->put('search_Area', $searchTerm);

    if ( auth()->user()->Role == 'admin')
    {
        $members =  Member::where('area', 'like', '%'.$searchTerm.'%')->orderBy('area', 'Asc')->paginate(50);
        $memberCount =  Member::where('area', 'like', '%'.$searchTerm.'%')->count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    return view('admin.member.show', [
    'members' => $members,
    'memberCount'=>$memberCount,
    'paginationLinks' => $paginationLinks
    ]);
    }

    elseif (optional(auth()->user())->Role == 'manager') {
        $user = auth()->user();
        $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');
        $members = Member::where('City', $cityName)->where('area', 'like', '%'.$searchTerm.'%')->orderBy('area', 'Asc')->paginate(50);
        $memberCount = Member::where('City', $cityName)->where('area', 'like', '%'.$searchTerm.'%')->count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    return view('manager.member.show', [
    'members' => $members,
    'memberCount'=>$memberCount,
    'paginationLinks' => $paginationLinks
    ]);
    }
}

public function searchBystreet(Request $request)
{
    $searchTerm = $request->input('search_Street');
    $request->session()->put('search_Street', $searchTerm);
    
    if ( auth()->user()->Role == 'admin')
    {
        $members =  Member::where('street', 'like', '%'.$searchTerm.'%')->orderBy('street', 'Asc')->paginate(50);
        $memberCount =  Member::where('street', 'like', '%'.$searchTerm.'%')->count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    return view('admin.member.show', [
    'members' => $members,
    'memberCount'=>$memberCount,
    'paginationLinks' => $paginationLinks
    ]);
    }

    elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
    ->where('id', $user->city_id)
    ->value('Name');

    $members = Member::where('City', $cityName)->where('street', 'like', '%'.$searchTerm.'%')->orderBy('street', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('street', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    return view('manager.member.show', [
    'members' => $members,
    'memberCount'=>$memberCount,
    'paginationLinks' => $paginationLinks
    ]);
    }
}

public function searchByCity(Request $request)
{
    $searchTerm = $request->input('search_City');
    $request->session()->put('search_City', $searchTerm);

    $members =  Member::where('City', 'like', '%'.$searchTerm.'%')->paginate(50);
    $memberCount =  Member::where('City', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
    ]);
}
    
public function searchByOccupation(Request $request)
{
    $searchTerm = $request->input('search_Occupation');
    $request->session()->put('search_Occupation', $searchTerm);

    if ( auth()->user()->Role == 'admin')
     {
      $members =  Member::where('Occupation', 'like', '%'.$searchTerm.'%')->orderBy('Occupation', 'Asc')->paginate(50);
      $memberCount =  Member::where('Occupation', 'like', '%'.$searchTerm.'%')->count();
      $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('admin.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
      ]);
    }
     elseif (optional(auth()->user())->Role == 'manager') {
    $user = auth()->user();
    $cityName = DB::table('cities')
        ->where('id', $user->city_id)
        ->value('Name');

    $members = Member::where('City', $cityName)->where('Occupation', 'like', '%'.$searchTerm.'%')->orderBy('Occupation', 'Asc')->paginate(50);
    $memberCount = Member::where('City', $cityName)->where('Occupation', 'like', '%'.$searchTerm.'%')->count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('manager.member.show', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'paginationLinks' => $paginationLinks
         ]);
      }
}

 public function import(Request $request)
{
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
    
        foreach ($fileContents as $key => $line) {
            if ($key == 0 ||$key=='فارغ'||$key=='') {
                continue; // Skip the first row (headers)
            }
    
            $data = str_getcsv($line);
    
            // Convert Birthdate format
            // $birthDate = DateTime::createFromFormat('d/m/Y', $data[6]);
            // $birthDateFormatted = $birthDate ? $birthDate->format('Y-m-d') : null;

                
            // Convert DateOfJoin format
            // $dateJoin = DateTime::createFromFormat('Y', $data[18]);
            // $dateJoinFormatted = $dateJoin ? $dateJoin->format('Y') : null;
    
            // var_dump( $data[13]);

            Member::create([
                'NotPad' => $data[0],
                'IDTeam' => $data[2],
                'FirstName' => $data[3],
                'LastName' => $data[4],
                'FatherName' => $data[5],
                'MotherName' => $data[6],
                'PlaceOfBirth' => $data[7],
                'BirthDate' => $data[8],
                'Constraint' => $data[9],
                'City' => $data[10],
                'IDNumber' => $data[11],
                'Gender' => $data[12],
                'Qualification' => $data[13],
                'Occupation' => $data[14],
                'MobilePhone' => $data[15],
                'HomeAddress' => $data[16],
                'WorkAddress' => $data[17],
                'HomePhone' => $data[18],
                'WorkPhone' => $data[19],
                'DateOfJoin' => $data[20],
                'Specialization' => $data[21],
                'Image' => $data[22],
            ]);
        }
        session()->flash('Add', 'تم إستيراد البيانات بنجاح');
        return back();
}
    

public function exportDataToCSV(Request $request)
{
       $searchFirstName = $request->session()->get('search_FirstName');
        $searchLastName = $request->session()->get('search_LastName');
        $searchIDTeam = $request->session()->get('search_IDTeam');
        $searchQualification = $request->session()->get('search_Qualification');
        $searchSpecialization = $request->session()->get('search_Specialization');
        $searchCity = $request->session()->get('search_City');
        $searchOccupation =$request->session()->get('search_Occupation');

  // return dd($searchFirstName);
  if(!empty($searchFirstName) )
  {
    $data = Member::where('FirstName', 'like', '%' . $searchFirstName . '%')->get();
  }
  elseif(!empty($searchLastName))
   {
    $data = Member::where('LastName', 'like', '%' . $searchLastName . '%')->get();
   }
  elseif(!empty($searchIDTeam))
   {
    $data = Member::where('IDTeam', 'like', '%' . $searchIDTeam . '%')->get();
   }
   elseif(!empty($searchQualification))
   {
    $data = Member::where('Qualification', 'like', '%' . $searchQualification . '%')->get();
   }
   elseif(!empty($searchSpecialization))
   {
    $data = Member::where('Specialization', 'like', '%' . $searchSpecialization . '%')->get();
    }
   elseif(!empty($searchCity))
   {
    $data = Member::where('City', 'like', '%' . $searchCity . '%')->get();
    }
   elseif(!empty($searchOccupation))
   {
    $data = Member::where('Occupation', 'like', '%' . $searchOccupation . '%')->get();
    }
    else{
    $data = Member::get();
       }

        $csvFileName = 'members.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];
    
        $handle = fopen('php://output', 'w');
        fputs($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM for Excel
        fputcsv($handle, [
            'الرقم الحزبي',
                'الاسم ',
                'النسبة',
                'اسم الأب',
                'اسم الأم',
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
                'المنطقة',
                'الحي',
                'الملاحظات',
                'رابط الصورة',
            ]);
    
        foreach ($data as $member) {
            fputcsv($handle, [
                $member->IDTeam,
                $member->FirstName,
                $member->LastName,
                $member->FatherName,
                $member->MotherName,
                $member->PlaceOfBirth,
                $member->BirthDate,
                $member->Constraint,
                $member->City,
                $member->IDNumber,
                $member->Gender,
                $member->Qualification,
                $member->Occupation,
                $member->MobilePhone,
                $member->HomeAddress,
                $member->WorkAddress,
                $member->HomePhone,
                $member->WorkPhone,
                $member->DateOfJoin,
                $member->Specialization,
                $member->area,
                $member->street,
                $member->NotPad,
                $member->Image
            ]);
        }
        fclose($handle);
        return response()->make('', 200, $headers);
}
  
 // public function GetCityWithMemberCount(Request $request)
    // {
    //     $searchTerm = $request->input('searchTerm');
    //     $membersCount = Member::where('City', 'like', $searchTerm)->count();
        
    //     return view('admin.index', compact('membersCount'));
  // }

public function GetCityWithMemberCount(Request $request)
{
    // $searchTerm = $request->input('searchTerm');
    $members =  Member::where('City', 'like', 'حلب')->count();
    
    if($members)
        return view('admin.index', compact('members'));
    else
        return view('404');
}

public function getMembersCountByCity()
{
    $membersCountByCity = Member::select('City', DB::raw('count(*) as count'))
        ->groupBy('City')
        ->get();

    return view('admin.index', ['membersCountByCity' => $membersCountByCity]);
}

public function GetCityWithMember(Request $request)
{
    $searchTerm = $request->input('searchTerm');
    $members =  Member::where('City', $searchTerm)->get();

  //   $members =  Member::where('City', 'حلب')->get();
  
   return view('admin.show-members',compact('members'));
}


public function details($id)
{
     $member = Member::where('id',$id)->first();

     if ( auth()->user()->Role == 'admin')
     {
      return view('admin.member.details',compact('member'));
     }
    else if ( auth()->user()->Role == 'manager')
     {
      return view('manager.member.details',compact('member'));
     }
}

public function detailsForCompare($IDTeam)
{
    $memb = Temporary::where('IDTeam',$IDTeam)->where('operation','1')->where('AdminAgree', 0)->first();
    $member = Member::where('IDTeam',$IDTeam)->first();
  //  $temctrlr=new TemporaryController();
 //   $temctrlr->getDeletedMember()
    return view('admin.notice.editDetails',compact('member','memb'));
}

public function getSpecializations($qualificationId)
{
    $specializations = Qualification::where('parentId', $qualificationId)
                                  ->whereNotNull('specialization')
                                  ->orderBy('specialization', 'Asc')
                                  ->get();
    return response()->json($specializations);
}

public function AdvancedIndex()
{
    if (optional(auth()->user())->Role == 'admin') {
  
    $city =City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
    $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
    $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();

    $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
    $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
    $occupations = Occupation::orderBy('created_at','Asc')->get();

        
        return view('admin.member.Advancedsearch', [
            'city'=>$city,
            'areas'=>$areas,
            'streets'=>$streets,
            
            'qualifications'=>$qualifications,
            'specializations'=>$specializations,
            'occupations'=>$occupations,
        ]);
    }
}

public function Advancedsearch(Request $request)
{
    $results = Member::query();
    $city =City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
    $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
    $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();

    $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
    $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
    $occupations = Occupation::orderBy('created_at','Asc')->get();

    $members = Member::orderBy('IDTeam', 'Asc')->select('id','IDTeam','FirstName','LastName',
    'City','status')->paginate(50);
    // $memberCount = Member::count();
    // $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

    if ($request->City != 0) {
        $cityId = $request->City;
        $cityName = City::where('id', $cityId)->first()->Name;
        $results->where('City', $cityName);
    }

    if ($request->area != 0) {
        $areaId = $request->area;
        $areaName = City::where('id', $areaId)->first()->area;
        $results->where('area', $areaName);
    }

    if ($request->street != 0) {
        $streetId = $request->street;
        $streetName = City::where('id', $streetId)->first()->street;
        $results->where('street', $streetName);
    }

    if ($request->Qualification != 0) {
        $qualificationId = $request->Qualification;
        $qualificationName = Qualification::where('id', $qualificationId)->first()->Name;
        $results->where('Qualification', $qualificationName);
    }

    if ($request->Specialization != 0) {
        $specializationId = $request->Specialization;
        $specializationName = Qualification::where('id', $specializationId)->first()->specialization;
        $results->where('Specialization', $specializationName);
    }

    if ($request->Occupation != 0) {
        $results->where('Occupation', $request->Occupation);
    }

    $members = $results->orderBy('IDTeam', 'Asc')->select('id','IDTeam','FirstName','LastName',
    'City','status')->paginate(50);
    $memberCount = Member::count();
    $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');
    
    return view('admin.member.Advancedsearch', [
        'members' => $members,
        'memberCount'=>$memberCount,
        'city'=>$city,
        'areas'=>$areas,
        'streets'=>$streets,
        'qualifications'=>$qualifications,
        'specializations'=>$specializations,
        'occupations'=>$occupations,
        'paginationLinks' => $paginationLinks
    ]);
}



public function print($id) {
    $member = Member::where('id', $id)->first();
    return view('admin.member.print', compact('member'));
}



public function avilable_idteam()
{
    $IDTeam = Member::get()->pluck('IDTeam')->toArray();

    // $memberCount = Member::count();
    // $pagination = $IDTeam->withQueryString()->links('pagination::bootstrap-4');

    $avilableID = [];
    $maxID = max($IDTeam);

    for ($i = 1; $i <= $maxID; $i++) {
        if (!in_array($i, $IDTeam)) {
            $avilableID[] = $i;
        }
    }

    // $avilableID = collect($avilableID);
    // dd($avilableID);

    // $paginationLinks = $avilableID->withQueryString()->links('pagination::bootstrap-4');

    // $avilableID = collect($avilableID);
    // $avilableID = $avilableID->toArray()->paginate(50);

    return view('admin.member.show', [
        'avilableID' => $avilableID,
        // 'IDTeam' => $IDTeam,
        // 'memberCount'=>$memberCount,
        // 'paginationLinks' => $paginationLinks
    ]);

    // return $avilableID;
}



public function all_members()
{ 
    if (optional(auth()->user())->Role == 'admin') {
        $city = City::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $areas = City::whereNotNull('area')->orderBy('created_at','Asc')->get();
        $streets = City::whereNotNull('street')->orderBy('created_at','Asc')->get();
        $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
        $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();
        $occupations = Occupation::orderBy('created_at','Asc')->get();
        $status = Status::orderBy('created_at','Asc')->get();

        $members = Member::orderBy('IDTeam', 'Asc')->select('id','IDTeam','FirstName','LastName',
        'City','status')->paginate(4000);
        $memberCount = Member::count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('admin.member.all_members', [
            'city' => $city,
            'areas' => $areas,
            'streets' => $streets,
            'qualifications' => $qualifications,
            'specializations' => $specializations,
            'occupations' => $occupations,
            'status'=>$status,
            'members' => $members,
            'memberCount'=>$memberCount,
            'paginationLinks' => $paginationLinks
        ]);
    }

    elseif (optional(auth()->user())->Role == 'manager') {
        $user = auth()->user();
        $cityName = DB::table('cities')
            ->where('id', $user->city_id)
            ->value('Name');
        
        $members = Member::where('City', $cityName)->orderBy('IDTeam', 'Asc')->paginate(4000);
        $memberCount = Member::count();
        $paginationLinks = $members->withQueryString()->links('pagination::bootstrap-4');

        return view('manager.member.show', [
            'members' => $members,
            'memberCount'=>$memberCount,
            'paginationLinks' => $paginationLinks
        ]);
    }
}




}
