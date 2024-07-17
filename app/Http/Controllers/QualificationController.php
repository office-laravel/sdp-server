<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\Validator;

class QualificationController extends Controller
{
    public function indexQualification()
    { 
      $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
      return view('admin.qualification.show',compact('qualifications'));
    }

    public function indexSpecialization()
    { 
         $specializations = Qualification::whereNotNull('specialization')->orderBy('created_at','Asc')->get();

         foreach($specializations as  $specialization)
         {
             if($specialization->parentId>0)
             {
                 $parent = Qualification::find( $specialization->parentId);
                 $specialization->parent_name = $parent->specialization;
             }
         }
         
        return view('admin.specialization.show',compact('specializations'));
    }
    
    public function createQualification()
    {
      return view('admin.qualification.add');
    }

    public function createSpecialization()
    {
      $qualifications = Qualification::whereNotNull('Name')->orderBy('created_at','Asc')->get();
      // $qualifications = Qualification::where('parentId','=','0')->orderBy('Name','Asc')->get('Name');
      return view('admin.specialization.add', compact('qualifications'));
    }

    public function storeQualification(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|unique:qualifications|max:255',
        ]);

        Qualification::create([
            'Name'=>$request->Name,
        ]);

        session()->flash('Add', 'تم إضافة المؤهل العلمي بنجاح');
        return back();
    }

    public function storeSpecialization(Request $request)
    {
        // $validated = $request->validate([
        //     'parentId'=>'required',
        //     'specialization' => 'required|unique:occupations|max:255',
        // ]);

         Qualification::create([
            'parentId'=>$request->parentId,
            'specialization'=>$request->specialization
        ]);

        session()->flash('Add', 'تم إضافة الاختصاص بنجاح');
        return back();
    }
    
  public function editQualification($id)
  {
    $qualification = Qualification::findOrFail($id);
    return view('admin.qualification.edit',compact('qualification'));
  }
 
  public function editSpecialization($id)
  {
    $specialization = Qualification::findOrFail($id);
    return view('admin.specialization.edit',compact('specialization'));
  }
 
   
  public function updateQualification(Request $request, $id)
  {
    $validated = $request->validate([
        'Name' => 'required|unique:qualifications|max:255',
    ]);

      $qualification = Qualification::findOrFail($id);

      $qualification->update([
        'Name'=>$request->Name,
      ]);

      session()->flash('update', 'تم تعديل المؤهل العلمي بنجاح');
      return back();
    }

  
  public function updateSpecialization(Request $request, $id)
  {
    $validated = $request->validate([
      
      //'parentId'=>'required',
      'specialization' => 'required|unique:qualifications|max:255',
    ]);

    $specialization = Qualification::findOrFail($id);


    $specialization->update([
    //  'parentId'=>$request->parentId,
      'specialization'=>$request->specialization,
    ]);

    session()->flash('Edit', 'تم تعديل الاختصاص بنجاح');
    return back();
  }

    public function destroyQualification($id)
    {
        $qualification = Qualification::findOrFail($id);
    
        $subSpecializations = Qualification::where('parentId', $id)->get();
  
        foreach ($subSpecializations as $subSpecialization) {
            $subSpecialization->delete();
        }
    
        $qualification->delete();
    
        session()->flash('delete', 'تم حذف المؤهل العلمي بنجاح');
        return back();
    }
   
    public function destroySpecialization($id)
    {
      Qualification::findOrFail($id)->delete();

      session()->flash('delete', 'تم حذف الاختصاص بنجاح');
      return back();
    }
}
