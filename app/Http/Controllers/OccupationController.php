<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Occupation;
use Illuminate\Support\Facades\Validator;

class OccupationController extends Controller
{
    public function index()
    { 
         $occupations = Occupation::orderBy('created_at','Asc')->get();
         return view('admin.occupation.show',compact('occupations'));
    }

    
    public function create()
    {
       return view('admin.occupation.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|unique:occupations|max:255',
        ]);

        $occupations= Occupation::create([
            'Name'=>$request->Name,
        ]);

        session()->flash('Add', 'تم إضافة المهنة بنجاح');
        return back();
    }

    
  public function edit( $id)
  {
    $occupation = Occupation::findOrFail($id);
    return view('admin.occupation.edit',compact('occupation'));
  }
 
   
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
        'Name' => 'required|unique:occupations|max:255',
    ]);

      $occupation = Occupation::findOrFail($id);

      $occupation->update([
        'Name'=>$request->Name,
      ]);

      session()->flash('update', 'تم تعديل المهنة بنجاح');
      return back();
    }

    public function destroy( $id)
    {
      Occupation::findOrFail($id)->delete();
      session()->flash('delete', 'تم حذف المهنة بنجاح');
      return back();
    }
}
