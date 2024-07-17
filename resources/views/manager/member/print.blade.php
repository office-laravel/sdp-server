@extends('manager.layouts.master')

@section('css')

<style>
    @media print {
        #print_Button {
            display: none;
        }
        /* #div1 img {
        display: block;
    } */
    }

</style>

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
							<h4 class="content-title mb-0 my-auto">الأعضاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معاينة طباعة تفاصيل العضو</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row -->
				<div class="row" id="print">
					<div class="col-lg-12 col-md-12">
                        <div class="card">
							<div class="card-body">

								<div id="div1" style="border: solid; display: flex; align-items: center;">
									<div style="display: flex; flex-direction: column; align-self: flex-end; margin-right: 5%;">
										<h4>الحزب الديمقراطي السوري</h4>
										<h6>تأسس عام 2012</h6>
									</div>
									<img src="{{URL::asset('assets/img/media/team.png')}}" style="height: 80px; margin-right: 60%;" alt="logo">
								</div><br><br>


									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">الرقم الحزبي</label>
											<input type="hidden" name="IDTeam" value="{{ $member->IDTeam }}">
											<input type="text" class="form-control" id="inputName" name="IDTeam"
											value="{{ $member->IDTeam }}" readonly>
										</div>
										<div class="col-6">
											<label for="inputName" class="control-label">تاريخ الانتساب</label>
											<input type="hidden" name="DateOfJoin" value="{{ $member->DateOfJoin }}">
											<input type="text" class="form-control" id="inputName" name="DateOfJoin"
											value="{{ $member->DateOfJoin }}" readonly>
										</div>
									</div><br>
									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">الاسم </label>
											<input type="hidden" name="FirstName" value="{{ $member->FirstName }}">
											<input type="text" class="form-control" id="inputName" name="FirstName"
											value="{{ $member->FirstName }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label"> النسبة</label>
											<input type="hidden" name="LastName" value="{{ $member->LastName }}">
											<input type="text" class="form-control" id="inputName" name="LastName"
											value="{{ $member->LastName }}" readonly>
										</div>
									</div><br>
									
									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">اسم الأب </label>
											<input type="hidden" name="FatherName" value="{{ $member->FatherName }}">
											<input type="text" class="form-control" id="inputName" name="FatherName"
											value="{{ $member->FatherName }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">اسم الأم</label>
											<input type="hidden" name="MotherName" value="{{ $member->MotherName }}">
											<input type="text" class="form-control" id="inputName" name="MotherName"
											value="{{ $member->MotherName }}" readonly>
										</div>
									</div><br>
                                    
                                    <div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">محل الولادة</label>
											<input type="hidden" name="PlaceOfBirth" value="{{ $member->PlaceOfBirth }}">
											<input type="text" class="form-control" id="inputName" name="PlaceOfBirth"
											value="{{ $member->PlaceOfBirth }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">تاريخ الولادة</label>
											<input type="hidden" name="BirthDate" value="{{ $member->BirthDate }}">
											<input type="text" class="form-control" id="inputName" name="BirthDate"
											value="{{ $member->BirthDate }}" readonly>
										</div>
									</div><br>
                                    
                                    <div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">محل ورقم القيد</label>
											<input type="hidden" name="Constraint" value="{{ $member->Constraint }}">
											<input type="text" class="form-control" id="inputName" name="Constraint"
											value="{{ $member->Constraint }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">المحافظة</label>
											<input type="hidden" name="City" value="{{ $member->City }}">
											<input type="text" class="form-control" id="inputName" name="City"
											value="{{ $member->City }}" readonly>
										</div>
									</div><br>
                                    
									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">المنطقة</label>
											<input type="hidden" name="area" value="{{ $member->area }}">
											<input type="text" class="form-control" id="inputName" name="area"
											value="{{ $member->area }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">الحي</label>
											<input type="hidden" name="street" value="{{ $member->street }}">
											<input type="text" class="form-control" id="inputName" name="street"
											value="{{ $member->street }}" readonly>
										</div>
									</div><br>

                                    <div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">الرقم الوطني</label>
											<input type="hidden" name="IDNumber" value="{{ $member->IDNumber }}">
											<input type="text" class="form-control" id="inputName" name="IDNumber"
											value="{{ $member->IDNumber }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">الجنس</label>
											<input type="hidden" name="Gender" value="{{ $member->Gender }}">
											<input type="text" class="form-control" id="inputName" name="Gender"
											value="{{ $member->Gender }}" readonly>
										</div>
									</div><br>
              
            
                                    <div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">المهنة</label>
											<input type="hidden" name="Occupation" value="{{ $member->Occupation }}">
											<input type="text" class="form-control" id="inputName" name="Occupation"
											value="{{ $member->Occupation }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">المؤهل العلمي</label>
											<input type="hidden" name="Qualification" value="{{ $member->Qualification }}">
											<input type="text" class="form-control" id="inputName" name="Qualification"
											value="{{ $member->Qualification }}" readonly>
										</div>
									</div><br>
              
									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">الاختصاص</label>
											<input type="hidden" name="Specialization" value="{{ $member->Specialization }}">
											<input type="text" class="form-control" id="inputName" name="Specialization"
											value="{{ $member->Specialization }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">رقم الموبايل</label>
											<input type="hidden" name="MobilePhone" value="{{ $member->MobilePhone }}">
											<input type="text" class="form-control" id="inputName" name="MobilePhone"
											value="{{ $member->MobilePhone }}" readonly>
										</div>
									</div><br>
                
									<div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">عنوان المنزل</label>
											<input type="hidden" name="HomeAddress" value="{{ $member->HomeAddress }}">
											<input type="text" class="form-control" id="inputName" name="HomeAddress"
											value="{{ $member->HomeAddress }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">عنوان العمل</label>
											<input type="hidden" name="WorkAddress" value="{{ $member->WorkAddress }}">
											<input type="text" class="form-control" id="inputName" name="WorkAddress"
											value="{{ $member->WorkAddress }}" readonly>
										</div>
									</div><br>
                                    
                                    <div class="row">
										<div class="col-6">
											<label for="inputName" class="control-label">هاتف المنزل</label>
											<input type="hidden" name="HomePhone" value="{{ $member->HomePhone }}">
											<input type="text" class="form-control" id="inputName" name="HomePhone"
											value="{{ $member->HomePhone }}" readonly>
										</div>
                                        <div class="col-6">
											<label for="inputName" class="control-label">هاتف العمل</label>
											<input type="hidden" name="WorkPhone" value="{{ $member->WorkPhone }}">
											<input type="text" class="form-control" id="inputName" name="WorkPhone"
											value="{{ $member->WorkPhone }}" readonly>
										</div>
									</div><br>
									<div class="row">
											<div class="col-6">
												<label for="inputName" class="control-label">حالة العضو</label>
												<input type="hidden" name="status" value="{{ $member->status }}">
												<input type="text" class="form-control" id="inputName" name="status"
												value="{{ $member->status }}" readonly>
											</div>
		
	
										<div class="col-6">
											<label for="inputName" class="control-label">ملاحظات</label>
											<input type="hidden" name="NotPad" value="{{ $member->NotPad }}">
											<input type="text" class="form-control" id="inputName" name="NotPad"
											value="{{ $member->NotPad }}" readonly></input>
										 </div>
										</div><br>
							   
										<div class="row">
											
											<div class="col-6">
												<label for="exampleTextarea">صورة العضو المنتسب</label> <br>
												<input type="hidden" name="Image" value="{{ $member->Image }}">
												
												@if ($member->Image)
													<img src="{{URL::asset('/assets/img/media/'.$member->Image)}}" style="width: 150px;">
												@else	
													<img src="{{URL::asset('assets/img/media/user.jpg')}}"  style="width: 150px;">
												@endif
								
											</div>
											
										</div><br>

                         
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary" id="print_Button" onclick="printDiv()">
                                        <i class="fas fa-print"></i>&nbsp; طباعة </button>
                                    </div>

							</div>
						</div>
				    </div>
                </div>
				<!-- row closed -->

@endsection

@section('js')

<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>


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
