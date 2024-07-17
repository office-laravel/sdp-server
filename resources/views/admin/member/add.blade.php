@extends('admin.layouts.master')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
							<h4 class="content-title mb-0 my-auto">الأعضاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة عضو</span>
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


{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="{{ url('admin/member/save') }}" method="post" enctype="multipart/form-data" autocomplete="off">
									{{ csrf_field() }}
		
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">الرقم الحزبي </label>
											<input type="text" class="form-control @error('IDTeam') is-invalid @enderror" 
											id="inputName" name="IDTeam" required>
										
											@error('IDTeam')
												<div class="alert alert-danger">الرقم الحزبي مطلوب</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">الاسم </label>
											<input type="text" class="form-control" 
											id="inputName" name="FirstName">
										
											{{-- @error('FirstName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

									
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label"> النسبة</label>
											<input type="text" class="form-control" 
											id="inputName" name="LastName">
										
											{{-- @error('LastName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

									
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label"> اسم الأب</label>
											<input type="text" class="form-control" 
											id="inputName" name="FatherName">
										
											{{-- @error('FatherName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>


									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">اسم الأم</label>
											<input type="text" class="form-control" 
											id="inputName" name="MotherName">

											{{-- @error('MotherName')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">محل الولادة</label>
											<input type="text" class="form-control" 
											id="inputName" name="PlaceOfBirth">

											{{-- @error('PlaceOfBirth')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<div class="form-group">
												<label>تاريخ الولادة</label>
													<input type="datetime" class="form-control" 
													name="BirthDate">

													{{-- @error('BirthDate')
														<div class="alert alert-danger">{{ $message }}</div>
													@enderror --}}
											</div>
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">محل ورقم القيد</label>
											<input type="text" class="form-control" 
											id="inputName" name="Constraint">

											{{-- @error('Constraint')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>


									<div class="form-group">
										<label>المحافظة</label>
										<select name="City" id="city" 
										class="form-control">
											<option value="0">اختر المحافظة</option>
											
											@foreach($cityName as $city)
											<option value="{{$city->id}}" >{{$city->Name}}</option>
											@endforeach 

										</select>

										{{-- @error('City')
										<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
									</div><br>

									<div class="form-group">
										<label>المنطقة</label>
										<select name="area" id="area" 
										class="form-control select">

										{{-- @foreach($areas as $area)
											<option value="{{$area->id}}">{{$area->area}}</option>
										@endforeach --}}

										</select>

										{{-- @error('area')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
									</div><br>

									<div class="form-group">
										<label>الحي</label>
										<select name="street" id="street"
										class="form-control select">

										{{-- @foreach($streets as $street)
											<option value="{{$street->id}}">{{$street->street}}</option>
										@endforeach --}}
											
										</select>

										{{-- @error('street')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">الرقم الوطني</label>
											<input type="text" class="form-control" 
											id="inputName" name="IDNumber">

											{{-- @error('IDNumber')
    											<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

									<div class="form-group">
										<label class="display-block">الجنس</label> <br>
										<div class="form-check form-check-inline">
											<input class="form-check-input" 
											type="radio" name="Gender" id="status_active" value="ذكر" checked>

											<label class="form-check-label" for="status_active">
												&nbsp; ذكر 
											</label>
										</div> 
										<div class="form-check form-check-inline">
											<input class="form-check-input" 
											type="radio" name="Gender" id="status_inactive" value="أنثى">

											<label class="form-check-label" for="status_inactive">
												&nbsp; أنثى
											</label>
										</div>
									</div><br>

									<div class="form-group">
										<label>المهنة</label>
										<select name="Occupation" class="form-control select" id="Occupation"> 
											<option value="لايوجد">اختر المهنة</option>
											
											@foreach($occupations as $occupation)
											<option value="{{$occupation->Name}}">{{$occupation->Name}}</option>
											@endforeach 

										</select>
{{-- 
										@error('Occupation')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
									</div><br>

									<div class="form-group">
										<label>المؤهل العلمي</label>
										<select name="Qualification" id="qualificationSelect" class="form-control select" >
											<option value="لايوجد">اختر المؤهل العلمي</option>
											@foreach($qualifications as $qualification)
												
												<option value="{{$qualification->id}}">{{$qualification->Name}}</option>
											@endforeach 
										</select>
									</div><br>

									<div class="form-group">
										<label>الاختصاص</label>
										<select name="Specialization" class="form-control select" id="specializationSelect">
											<!-- Options will be loaded dynamically -->
										</select>
									</div><br> 
									
									 <div class="row">
										<div class="col">
										  <label for="inputName" class="control-label">رقم الموبايل</label>
										  <input type="text" class="form-control" 
										  id="inputName" name="MobilePhone">

										{{-- @error('MobilePhone')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
										</div>
									  </div><br>
					
									  <div class="row">
										<div class="col">
										  <label for="inputName" class="control-label">عنوان المنزل</label>
										  <input type="text" class="form-control" 
										  id="inputName" name="HomeAddress">

										    {{-- @error('HomeAddress')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror --}}
										</div>
									  </div><br>
					
									  <div class="row">
										<div class="col">
										  <label for="inputName" class="control-label">عنوان العمل</label>
										  <input type="text" class="form-control" 
										  id="inputName" name="WorkAddress">
										
										</div>
									  </div><br>
					
									  <div class="row">
										<div class="col">
										  <label for="inputName" class="control-label">هاتف المنزل</label>
										  <input type="text" class="form-control" 
										  id="inputName" name="HomePhone">
										
										  	{{-- @error('HomePhone')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror --}}
										</div>
									  </div><br>
					
									  <div class="row">
										<div class="col">
										  <label for="inputName" class="control-label">هاتف العمل</label>
										  <input type="text" class="form-control" 
										  id="inputName" name="WorkPhone">

										  	{{-- @error('WorkPhone')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror --}}
										</div>
									  </div><br>
					
									  <div class="row">
										<div class="col">
										  <div class="form-group">
											<label>تاريخ الانتساب</label> <br>
											  {{-- <input type="datetime-local" class="form-control @error('DateOfJoin') is-invalid @enderror" 
											  name="DateOfJoin" required> --}}
											  <select class="form-control select" name="DateOfJoin" id="year"></select>

											{{-- @error('DateOfJoin')
										  		<div class="alert alert-danger">{{ $message }}</div>
									  		@enderror --}}
												
										  </div>
										</div>
									  </div><br>

									  <div class="form-group">
										<label>حالة العضو</label>
										<select name="status" class="form-control select" id="status"> 
											<option value="لايوجد">اختر الحالة</option>
											
											@foreach($status as $stat)
											<option value="{{$stat->name}}">{{$stat->name}}</option>
											@endforeach 

										</select>

										{{-- @error('status')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror --}}
									</div><br>

									  <div class="row">
										<div class="col">
											<label for="inputName" class="control-label">ملاحظات</label>
											<input type="text" class="form-control" 
											id="inputName" name="NotPad" ></input>

											{{-- @error('NotPad')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror --}}
										</div>
									</div><br>

								

									{{-- <div class="row">
										<div class="col">
											<div class="custom-control custom-switch">
												<label class="custom-control-label" for="customSwitch1">حالة العضو</label>

												<input type="checkbox" name="status"  class="custom-control-input" id="customSwitch1" onchange="updateStatus(this)">
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="statusDisplay"></span>
											</div>
										</div>
									</div> --}}

									{{-- <div class="form-group">
										<label class="display-block"> حالة العضو</label> <br>
										<div class="form-check form-check-inline">
											<input class="form-check-input" 
											type="radio" name="Gender" id="status_active" value="فعال" checked>

											<label class="form-check-label" for="status_active">
												&nbsp; فعال 
											</label>
										</div> 
										<div class="form-check form-check-inline">
											<input class="form-check-input" 
											type="radio" name="Gender" id="status_inactive" value="غير فعال">

											<label class="form-check-label" for="status_inactive">
												&nbsp; غير فعال
											</label>
										</div>
									</div><br> --}}

									  <div class="row">
										<div class="col">
										  <label for="exampleTextarea">صورة العضو المنتسب</label>
										  <input type="file" name="Image" class="dropify" accept=".jpg, .png, image/jpeg, image/png"
										  data-height="70" />
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
		dateFormat: "Y",
		altInput: true,
		altFormat: "Y"
	}
	flatpickr("input[type=datetime-local]", config);
</script>

<script>
	config = {
    	dateFormat: "Y-m-d",
		altInput: true,
		altFormat: "F j, Y"
	}
	flatpickr("input[type=datetime]", config);
</script>



	{{-- Dependent Dropdown ===> qualification & specialization --}}
	<script>
		document.addEventListener("DOMContentLoaded", function() {
		  const qualificationSelect = document.querySelector('#qualificationSelect');
		  const specializationSelect = document.querySelector('#specializationSelect');
		
		  qualificationSelect.addEventListener('change', function() {
			const qualificationId = this.value;
			fetch(`get-specializations/${qualificationId}`)  // Corrected URL format
			  .then(response => {
				if (!response.ok) {
				  throw new Error('Network response was not ok');
				}
				return response.json();
			  })
			  .then(specializations => {
				specializationSelect.innerHTML = '<option value="">اختر الاختصاص</option>'; // Clear and add a placeholder
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
		{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

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