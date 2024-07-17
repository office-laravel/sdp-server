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
							<h4 class="content-title mb-0 my-auto">الأحياء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة حي</span>
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

				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
			
								<form action="{{ route('street.save') }}" method="post">
									{{ csrf_field() }}
			
									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">الحي</label>
											<input type="text" class="form-control @error('street') is-invalid @enderror" 
											id="inputName" name="street" required>

											@error('street')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="form-group">
										<label>المحافظة</label>
										<select name="Name" id="city" class="form-control select @error('Name') is-invalid @enderror">
											<option>اختر المحافظة</option>
											
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->Name}}</option>
											@endforeach 
										</select>

										@error('Name')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
									</div><br>

                                    <div class="form-group">
										<label>المنطقة</label>
										<select name="area" class="form-control select @error('area') is-invalid @enderror" id="area">
											<!-- Options will be loaded dynamically -->
										</select>

										@error('area')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
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
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')


	{{-- Dependent Dropdown ===> city & area --}}

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

	 });  

 </script>

	{{-- <script>
		document.addEventListener("DOMContentLoaded", function() {
		  const citySelect = document.querySelector('#citySelect');
		  const areaSelect = document.querySelector('#areaSelect');
		
		  citySelect.addEventListener('change', function() {
			const cityId = this.value;
			fetch(`get-areas/${cityId}`)  // Corrected URL format
			  .then(response => {
				if (!response.ok) {
				  throw new Error('Network response was not ok');
				}
				return response.json();
			  })
			  .then(areas => {
				areaSelect.innerHTML = '<option value="">اختر المنطقة</option>'; // Clear and add a placeholder
				areas.forEach(area => {
				  const option = document.createElement('option');
				  option.value = area.id;
				  option.textContent = area.area;
				  areaSelect.appendChild(option);
				});
			  })
			  .catch(error => {
				console.error('There has been a problem with your fetch operation:', error);
			  });
		  });
		});
	</script> --}}



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