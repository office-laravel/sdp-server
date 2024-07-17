 @extends('admin.layouts.master')

@section('css')

<!--- Internal Select2 css-->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<!---Internal Fancy uploader css-->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">إشعارات الحذف</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل إشعار الحذف</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')

@if(session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session()->get('Add') }}</strong>
  <button type="button" class="close" data_dismiss="alert" aria_lable="Close">
    <span aria_hidden="true">&times;</span>
  </button>
</div>
@endif

@if(session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('delete') }}</strong>
	<button type="button" class="close" data_dismiss="alert" aria_lable="Close">
		<span aria_hidden="true">&times;</span>
	</button>
</div>
@endif

				<!-- row -->
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('notice.deleteDetails', $member->id) }}" method="get" autocomplete="off">
                                {{ csrf_field() }}
                                @method('get')

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الرقم الحزبي</label>
                                        <input type="hidden" name="IDTeam" value="{{ $member->IDTeam }}">
                                        <input type="text" class="form-control" id="inputName" name="IDTeam"
                                        value="{{ $member->IDTeam }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الاسم </label>
                                        <input type="hidden" name="FirstName" value="{{ $member->FirstName }}">
                                        <input type="text" class="form-control" id="inputName" name="FirstName"
                                        value="{{ $member->FirstName }}" readonly>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label"> النسبة</label>
                                        <input type="hidden" name="LastName" value="{{ $member->LastName }}">
                                        <input type="text" class="form-control" id="inputName" name="LastName"
                                        value="{{ $member->LastName }}" readonly>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label"> اسم الأب</label>
                                        <input type="hidden" name="FatherName" value="{{ $member->FatherName }}">
                                        <input type="text" class="form-control" id="inputName" name="FatherName"
                                        value="{{ $member->FatherName }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">اسم الأم</label>
                                        <input type="hidden" name="MotherName" value="{{ $member->MotherName }}">
                                        <input type="text" class="form-control" id="inputName" name="MotherName"
                                        value="{{ $member->MotherName }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">محل الولادة</label>
                                        <input type="hidden" name="PlaceOfBirth" value="{{ $member->PlaceOfBirth }}">
                                        <input type="text" class="form-control" id="inputName" name="PlaceOfBirth"
                                        value="{{ $member->PlaceOfBirth }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">تاريخ الولادة</label>
                                        <input type="hidden" name="BirthDate" value="{{ $member->BirthDate }}">
                                        <input type="text" class="form-control" id="inputName" name="BirthDate"
                                        value="{{ $member->BirthDate }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">محل ورقم القيد</label>
                                        <input type="hidden" name="Constraint" value="{{ $member->Constraint }}">
                                        <input type="text" class="form-control" id="inputName" name="Constraint"
                                        value="{{ $member->Constraint }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">المحافظة</label>
                                        <input type="hidden" name="City" value="{{ $member->City }}">
                                        <input type="text" class="form-control" id="inputName" name="City"
                                        value="{{ $member->City }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الرقم الوطني</label>
                                        <input type="hidden" name="IDNumber" value="{{ $member->IDNumber }}">
                                        <input type="text" class="form-control" id="inputName" name="IDNumber"
                                        value="{{ $member->IDNumber }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الجنس</label>
                                        <input type="hidden" name="Gender" value="{{ $member->Gender }}">
                                        <input type="text" class="form-control" id="inputName" name="Gender"
                                        value="{{ $member->Gender }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">المهنة</label>
                                        <input type="hidden" name="Occupation" value="{{ $member->Occupation }}">
                                        <input type="text" class="form-control" id="inputName" name="Occupation"
                                        value="{{ $member->Occupation }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">المؤهل العلمي</label>
                                        <input type="hidden" name="Qualification" value="{{ $member->Qualification }}">
                                        <input type="text" class="form-control" id="inputName" name="Qualification"
                                        value="{{ $member->Qualification }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">الاختصاص</label>
                                        <input type="hidden" name="Specialization" value="{{ $member->Specialization }}">
                                        <input type="text" class="form-control" id="inputName" name="Specialization"
                                        value="{{ $member->Specialization }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">رقم الموبايل</label>
                                        <input type="hidden" name="MobilePhone" value="{{ $member->MobilePhone }}">
                                        <input type="text" class="form-control" id="inputName" name="MobilePhone"
                                        value="{{ $member->MobilePhone }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">عنوان المنزل</label>
                                        <input type="hidden" name="HomeAddress" value="{{ $member->HomeAddress }}">
                                        <input type="text" class="form-control" id="inputName" name="HomeAddress"
                                        value="{{ $member->HomeAddress }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">عنوان العمل</label>
                                        <input type="hidden" name="WorkAddress" value="{{ $member->WorkAddress }}">
                                        <input type="text" class="form-control" id="inputName" name="WorkAddress"
                                        value="{{ $member->WorkAddress }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">هاتف المنزل</label>
                                        <input type="hidden" name="HomePhone" value="{{ $member->HomePhone }}">
                                        <input type="text" class="form-control" id="inputName" name="HomePhone"
                                        value="{{ $member->HomePhone }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">هاتف العمل</label>
                                        <input type="hidden" name="WorkPhone" value="{{ $member->WorkPhone }}">
                                        <input type="text" class="form-control" id="inputName" name="WorkPhone"
                                        value="{{ $member->WorkPhone }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">تاريخ الانتساب</label>
                                        <input type="hidden" name="DateOfJoin" value="{{ $member->DateOfJoin }}">
                                        <input type="text" class="form-control" id="inputName" name="DateOfJoin"
                                        value="{{ $member->DateOfJoin }}" readonly>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">حالة العضو</label>
                                        <input type="hidden" name="status" value="{{ $member->status }}">
                                        <input type="text" class="form-control" id="inputName" name="status"
                                        value="{{ $member->status }}" readonly>
                                    </div>
                                </div><br>
                                
                                <div class="row">
                                    <div class="col">
                                        <label for="inputName" class="control-label">ملاحظات</label>
                                        <input type="hidden" name="NotPad" value="{{ $member->NotPad }}">
                                        <input type="text" class="form-control" id="inputName" name="NotPad"
                                        value="{{ $member->NotPad }}" readonly>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col">
                                        <label for="exampleTextarea">صورة العضو المنتسب</label> <br>
                                        <input type="hidden" name="Image" value="{{ $member->Image }}">
                                        <br>
                                        
                                        @if ($member->Image)
                                            <td><img src="{{asset('images/'.$member->Image)}}" style="width: 100px;"></td>
                                        @else
                                            <td><img src="{{URL::asset('assets/img/media/user.jpg')}}"  style="width: 100px;"></td>
                                        @endif
                                    </div>
                                </div><br>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="center" style="text-align: center;">

                    {{-- <form action="{{ route('notice.destroyForNotice', $member->IDTeam) }}" method="GET">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-success" style="align-items: center;">تأكيد الحذف &nbsp; <i class="fa fa-check"></i></button> &nbsp;
                    </form> --}}


                    <a class="btn btn-success" href="{{ route('notice.destroyForNotice', $member->IDTeam) }}" style="align-items: center; font-size: 14px;">تأكيد الحذف &nbsp; <i class="fas fa-check"></i></a> &nbsp;
                    <a class="btn btn-danger" href="{{ route('notice.destroyNotice', $member->id) }}" style="align-items: center; font-size: 14px;">تجاهل الحذف &nbsp; <i class="fas fa-times"></i></a> &nbsp;
                    <a href="{{ url('admin/notice/delete') }}" class="btn btn-primary" style="align-items: center;">رجوع &nbsp; <i class="fa fa-arrow-left"></i></a>
                </div>
                <br>
				<!-- row closed -->

@endsection

@section('js')

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Fileuploads js-->
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<!--Internal Fancy uploader js-->
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<!--Internal  Form-elements js-->
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<!-- Internal TelephoneInput js-->
<script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>

@endsection
