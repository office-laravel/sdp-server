@extends('admin.layouts.master')

@section('css')

{{-- flatpicker --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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
							<h4 class="content-title mb-0 my-auto">الأعضاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل عضو</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection

@section('content')

@if(session()->has('Edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>{{ session()->get('Edit') }}</strong>
	<button type="button" class="close" data_dismiss="alert" aria_lable="Close">
		<span aria_hidden="true">&times;</span>
	</button>
</div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="{{ route('member.update', $member->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
									{{ csrf_field() }}

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
											<label for="inputName" class="control-label">الاسم</label>
											<input type="hidden" name="FirstName" value="{{ $member->FirstName }}">
											<input type="text" class="form-control @error('FirstName') is-invalid @enderror" 
											id="inputName" name="FirstName" value="{{ $member->FirstName }}">

											@error('FirstName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>
									
								
									
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">النسبة</label>
											<input type="hidden" name="LastName" value="{{ $member->LastName }}">
											<input type="text" class="form-control @error('LastName') is-invalid @enderror" 
											id="inputName" name="LastName" value="{{ $member->LastName }}">

											@error('LastName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">اسم الأب</label>
											<input type="hidden" name="FatherName" value="{{ $member->FatherName }}">
											<input type="text" class="form-control @error('FatherName') is-invalid @enderror" 
											id="inputName" name="FatherName" value="{{ $member->FatherName }}">

											@error('FatherName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">اسم الأم</label>
											<input type="hidden" name="MotherName" value="{{ $member->MotherName }}">
											<input type="text" class="form-control @error('MotherName') is-invalid @enderror" 
											id="inputName" name="MotherName" value="{{ $member->MotherName }}">

											@error('MotherName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">محل الولادة</label>
											<input type="hidden" name="PlaceOfBirth" value="{{ $member->PlaceOfBirth }}">
											<input type="text" class="form-control @error('PlaceOfBirth') is-invalid @enderror" 
											id="inputName" name="PlaceOfBirth" value="{{ $member->PlaceOfBirth }}">

											@error('PlaceOfBirth')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">تاريخ الولادة</label>
											<input type="hidden" name="BirthDate" value="{{ $member->BirthDate }}">
											<input type="datetime" class="form-control @error('BirthDate') is-invalid @enderror" 
											id="inputName" name="BirthDate" value="{{ $member->BirthDate }}">

											@error('BirthDate')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">محل ورقم القيد</label>
											<input type="hidden" name="Constraint" value="{{ $member->Constraint }}">
											<input type="text" class="form-control @error('Constraint') is-invalid @enderror" 
											id="inputName" name="Constraint" value="{{ $member->Constraint }}">

											@error('Constraint')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="form-group">
										<label>المحافظة</label>
										{{-- <input type="hidden" name="City" value="{{ $member->City }}"> --}}
										<select name="City" id="city" 
										class="form-control @error('City') is-invalid @enderror" >
											<option value="{{ $member->City }}">اختر المحافظة</option>
											
											@foreach($cityName as $city)
												{{-- <option value="{{$city->id}}" @selected(old('City')==$city->id)>{{$city->Name}}</option> --}}
												<option value="{{ $city->id }}" {{ old('City') == $city->id ? 'selected' : '' }}>{{ $city->Name }}</option>
											@endforeach 
										</select>

										@error('City')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br>

									<div class="form-group">
										<label>المنطقة</label>
										<select name="area" id="area" class="form-control select @error('area') is-invalid @enderror">
											<option value="{{ $member->area }}">اختر المنطقة</option>
											<!-- Options will be loaded dynamically -->
										</select>
										@error('area')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br> 

									<div class="form-group">
										<label>الحي</label>
										<select name="street" id="street" class="form-control select @error('street') is-invalid @enderror">
											<option value="{{ $member->street }}">اختر الحي</option>
											<!-- Options will be loaded dynamically -->
										</select>
										@error('street')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br> 

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">الرقم الوطني</label>
											<input type="hidden" name="IDNumber" value="{{ $member->IDNumber }}">
											<input type="text" class="form-control @error('IDNumber') is-invalid @enderror" 
											id="inputName" name="IDNumber" value="{{ $member->IDNumber }}">

											@error('IDNumber')
    											<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="form-group">
										<label class="display-block">الجنس</label> <br>

										@if ($member->Gender == 'ذكر')
											
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="ذكر" name="Gender" id="status_active" checked>
											<label class="form-check-label" for="status_active">
												&nbsp; ذكر 
											</label>
										</div> 

										@else
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="ذكر" name="Gender" id="status_active">
											<label class="form-check-label" for="status_active">
												&nbsp; ذكر 
											</label>
										</div> 

										@endif

										@if ($member->Gender == 'أنثى')

										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="أنثى" name="Gender" id="status_inactive" checked>
											<label class="form-check-label" for="status_inactive">
												&nbsp; أنثى
											</label>
										</div>

										@else
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" value="أنثى" name="Gender" id="status_inactive">
											<label class="form-check-label" for="status_inactive">
												&nbsp; أنثى
											</label>
										</div>
										@endif
									</div><br>


									<div class="form-group">
										<label>المهنة</label>
										<input type="hidden" name="Occupation" value="{{ $member->Occupation }}">
										<select name="Occupation" class="form-control select @error('Occupation') is-invalid @enderror">
											<option value="{{ $member->Occupation }}">اختر المهنة</option>
											
											@foreach($occupations as $occupation)
											<option value="{{ $occupation->Name }}" {{ old('Occupation') == $occupation->Name ? 'selected' : '' }}>{{ $occupation->Name }}</option>
											@endforeach 
										</select>

										@error('Occupation')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>

									{{-- <div class="form-group">
										<label>المؤهل العلمي</label>
										<select name="Qualification" id="qualificationSelect" class="form-control select @error('Qualification') is-invalid @enderror" onChange="loadSpecializations()">
											<option value="{{ $member->Qualification }}">اختر المؤهل العلمي</option>

											@foreach($qualifications as $qualification)	
												<option value="{{$qualification->id}}" @selected(old('Qualification')==$qualification->id)>{{$qualification->Name}}</option>
											@endforeach 
										</select>

										@error('Qualification')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br> --}}

									<div class="form-group">
										<label>المؤهل العلمي</label>
										<select name="Qualification" id="qualificationSelect" class="form-control select @error('Qualification') is-invalid @enderror" onChange="loadSpecializations()">
											<option value="{{ $member->Qualification }}">اختر المؤهل العلمي</option>
											@foreach($qualifications as $qualification)  
												<option value="{{ $qualification->id }}" {{ old('Qualification') == $qualification->id ? 'selected' : '' }}>{{ $qualification->Name }}</option>
											@endforeach 
										</select>
										@error('Qualification')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br>

									<div class="form-group">
										<label>الاختصاص</label>
										<select name="Specialization" id="specializationSelect"
										class="form-control select @error('Specialization') is-invalid @enderror">
											<option value="{{ $member->Specialization }}">اختر الاختصاص</option>
											<!-- Options will be loaded dynamically -->
										</select>
										
										 @error('Specialization')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div><br> 

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">رقم الموبايل</label>
											<input type="hidden" name="MobilePhone" value="{{ $member->MobilePhone }}">
											<input type="text" class="form-control @error('MobilePhone') is-invalid @enderror" 
											id="inputName" name="MobilePhone" value="{{ $member->MobilePhone }}">

											@error('MobilePhone')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">عنوان المنزل</label>
											<input type="hidden" name="HomeAddress" value="{{ $member->HomeAddress }}">
											<input type="text" class="form-control @error('HomeAddress') is-invalid @enderror" 
											id="inputName" name="HomeAddress" value="{{ $member->HomeAddress }}">

											@error('HomeAddress')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">عنوان العمل</label>
											<input type="hidden" name="WorkAddress" value="{{ $member->WorkAddress }}">
											<input type="text" class="form-control @error('WorkAddress') is-invalid @enderror" 
											id="inputName" name="WorkAddress" value="{{ $member->WorkAddress }}">

											@error('WorkAddress')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">هاتف المنزل</label>
											<input type="hidden" name="HomePhone" value="{{ $member->HomePhone }}">
											<input type="text" class="form-control @error('HomePhone') is-invalid @enderror" 
											id="inputName" name="HomePhone" value="{{ $member->HomePhone }}">

											@error('HomePhone')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">هاتف العمل</label>
											<input type="hidden" name="WorkPhone" value="{{ $member->WorkPhone }}">
											<input type="text" class="form-control @error('WorkPhone') is-invalid @enderror" 
											id="inputName" name="WorkPhone" value="{{ $member->WorkPhone }}">

											@error('WorkPhone')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">تاريخ الانتساب</label>
											<input type="hidden" name="DateOfJoin" value="{{ $member->DateOfJoin }}">
											<input type="text" class="form-control" 
											id="inputName" name="DateOfJoin" value="{{ $member->DateOfJoin }}" readonly>
										</div>
									</div><br>

									<div class="form-group">
										<label>حالة العضو</label>
										<input type="hidden" name="status" value="{{ $member->status }}">
										<select name="status" class="form-control select @error('status') is-invalid @enderror">
											<option value="{{ $member->status }}">اختر الحالة</option>
											
											@foreach($status as $stat)
											<option value="{{ $stat->id }}" {{ old('stat') == $stat->id ? 'selected' : '' }}>{{ $stat->name }}</option>
											@endforeach 
										</select>

										@error('status')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>


									
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">ملاحظات</label>
											<input type="hidden" name="NotPad" value="{{ $member->NotPad }}">
											{{-- <textarea type="text" class="form-control @error('NotPad') is-invalid @enderror" 
											id="inputName" name="NotPad" rows="3" cols="30" value="{{ $member->NotPad }}"></textarea> --}}
											<input type="text" class="form-control @error('NotPad') is-invalid @enderror" 
											id="inputName" name="NotPad" value="{{ $member->NotPad }}">

											@error('NotPad')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

{{-- 
									<div class="row">
										<div class="col">
											@if($member->status =='فعال')
									<div class="custom-control custom-switch">
										<input type="checkbox"  name="status" value="{{ $member->status }}" class="custom-control-input" checked id="customSwitch1" >
										<label class="custom-control-label" for="customSwitch1">  حالة العضو  : {{ $member->status }} </label>
									  </div>
									  @else
									  <div class="custom-control custom-switch">
										<input type="checkbox"  name="status" value="{{ $member->status }}" class="custom-control-input" id="customSwitch1" >
										<label class="custom-control-label" for="customSwitch1">  حالة العضو  : {{ $member->status }} </label>
									  </div>
									  @endif
									</div>
								</div><br> --}}



								{{-- <div class="form-group">
									<label class="display-block"></label> <br>

									@if ($member->status == 'فعال')
										
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="فعال" name="status" id="status_active" checked>
										<label class="form-check-label" for="status_active">
											&nbsp; فعال 
										</label>
									</div> 

									@else
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="فعال" name="status" id="status_active">
										<label class="form-check-label" for="status_active">
											&nbsp; فعال 
										</label>
									</div> 

									@endif

									@if ($member->status == 'غير فعال')

									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="غير فعال" name="status" id="status_inactive" checked>
										<label class="form-check-label" for="status_inactive">
											&nbsp; غير فعال
										</label>
									</div>

									@else
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" value="غير فعال" name="status" id="status_inactive">
										<label class="form-check-label" for="status_inactive">
											&nbsp; غير فعال
										</label>
									</div>
									@endif
								</div><br> --}}


									<div class="row">
										<div class="col">
											<label for="exampleTextarea">صورة العضو المنتسب</label> <br>
											{{-- <input type="hidden" name="Image" value="{{ $member->Image }}"> --}}
											<br>
											
											@if ($member->Image)
												<img src="{{ URL::asset('assets/img/media/' . $member->Image) }}" style="width: 100px;">
											@else
												<img src="{{ URL::asset('assets/img/media/user.jpg') }}" style="width: 100px;">
											@endif
											
											<br>    
											{{-- <input id="Image" name="Image" type="file" class="upload form-control  @error('Image') is-invalid @enderror" value="{{ old('Image') }}">                   --}}
											<input type="File"  id="Img" name="Image" class="dropify" accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
										</div>
									</div><br>

									

									<div class="d-flex justify-content-center">
										<button type="submit" class="btn btn-primary">حفظ البيانات</button>
									</div>
			
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->

@endsection

@section('js')

<script>
	const yearSelect = document.getElementById("year");

	function populateYears(){
		let year = new Date().getFullYear();
		for(let i=0; i<101; i++){
			const option = document.createElement("option");
			option.textContent = year-i;
			yearSelect.appendChild(option);
		}
	}
	populateYears();
</script>


{{-- flatpicker --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	config = {
    	// enableTime: true,
    	// dateFormat: "Y-m-d",
		// dateFormat: "Y/m/d H:i",
		dateFormat: "Y",

		altInput: true,
		// altFormat: "F j, Y"
		altFormat: "Y"

	}

	flatpickr("input[type=datetime-local]", config);
</script>

<script>
	config = {
    	// enableTime: true,
    	dateFormat: "Y-m-d",
		// dateFormat: "Y/m/d H:i",
		// dateFormat: "Y",

		altInput: true,
		altFormat: "F j, Y"
		// altFormat: "Y"

	}

	flatpickr("input[type=datetime]", config);
</script>


{{-- Dependent Dropdown ===> qualification & specialization --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
  const qualificationSelect = document.querySelector('#qualificationSelect');
  const specializationSelect = document.querySelector('#specializationSelect');

  qualificationSelect.addEventListener('change', function() {
    const qualificationName = this.value;

    var url = "{{ url('admin/member/get-specializations/[itemname]') }}";
    url = url.replace('[itemname]', qualificationName);

    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(specializations => {
        specializationSelect.innerHTML = '<option value="">اختر الاختصاص</option>';
        specializations.forEach(specialization => {
          const option = document.createElement('option');
          option.value = specialization.id;
          option.textContent = specialization.specialization;
          specializationSelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
      });
  });
});	
</script>



	{{-- Dependent Dropdown ===> city & area & street --}}
		<script>
			var cityurl='{{url("admin/member/get-areasm","itemid")}}';
			var areaurl='{{url("admin/member/get-streets","itemid")}}';
			 $(function() {
			 $('#city').change(function(){
					var thiscityurl=cityurl;
			var cityId = $(this).find("option:selected").val();
			if(cityId==0){
				$('#area').html('<option value="0">اختر المنطقة</option>');
			}else{
				thiscityurl=thiscityurl.replace("itemid",cityId);
			if(cityId){
				$.ajax({
					url: thiscityurl, // Use Laravel's route name
					method: 'Get', // Match the method type with your route definition
				 
					success: function(result){
						$('#area').html('<option value="0">اختر المنطقة</option>');
						$.each(result, function(key, value) {
						
			 $('#area').append('<option value="'+value.id+'">'+value.area+'</option>');
						});
					 }
				 });
			 }
			 }
			 });
 
 
			 $('#area').change(function(){
		 var thisareaurl=areaurl;
		 var areaId = $(this).find("option:selected").val();
		 thisareaurl=thisareaurl.replace("itemid",areaId);
		 if(areaId){
			 $.ajax({
				 url: thisareaurl, // Use Laravel's route name
				 method: 'Get', // Match the method type with your route definition
			  
				 success: function(result){
					 $('#street').html('<option value="0">اختر الحي</option>');
					 $.each(result, function(key, value) {
		  $('#street').append('<option value="'+value.id+'">'+value.street+'</option>');
		  });
		 }
		  });
		 }
		 }); 
		 }); 
 
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
