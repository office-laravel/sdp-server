<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;


class StatusController extends Controller
{
    public function index()
    { 
         $status = Status::orderBy('created_at','Asc')->get();
         return view('admin.status.show',compact('status'));
    }

    
    public function create()
    {
       return view('admin.status.add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:statuses|max:255',
        ]);

        $status= Status::create([
            'name'=>$request->name,
        ]);

        session()->flash('Add', 'تم إضافة الحالة بنجاح');
        return back();
    }

    
  public function edit( $id)
  {
    $status = Status::findOrFail($id);
    return view('admin.status.edit',compact('status'));
  }
 
   
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
        'name' => 'required|unique:statuses|max:255',
    ]);

      $status = Status::findOrFail($id);

      $status->update([
        'name'=>$request->name,
      ]);

      session()->flash('update', 'تم تعديل الحالة بنجاح');
      return back();
    }

    public function destroy( $id)
    {
      Status::findOrFail($id)->delete();
      session()->flash('delete', 'تم حذف الحالة بنجاح');
      return back();
    }
}
