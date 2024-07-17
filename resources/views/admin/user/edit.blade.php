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



<style>
	select[name="city_id"] {
		display: none;
	}

	select[name="Role"][value="manager"] ~ select[name="city_id"] {
		display: block;
	}
</style>

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المدراء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مدير</span>
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

				<!-- row -->
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="{{ route('user.update', $user->id) }}" method="post" autocomplete="off">
									{{ csrf_field() }}

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">البريد الإلكتروني</label>
											<input type="hidden" name="email" value="{{ $user->email }}">
											<input type="text" class="form-control @error('email') is-invalid @enderror" 
											id="inputName" name="email" value="{{ $user->email }}" required>

											@error('email')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="row">
										<div class="col">
											<label for="inputName" class="control-label">كلمة المرور</label>
											<input type="hidden" name="password" value="{{ $user->password }}">
											<input type="password" class="form-control @error('password') is-invalid @enderror" id="inputName" name="password" value="{{ bcrypt($user->password) }}">

											@error('password')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										</div>
									</div><br>

									<div class="form-group">
										<label>الدور</label>
											<select name="Role" class="form-control select">
												<option value="{{ $user->Role }}">اختر نوع الإدارة</option>
												<option value="admin">مدير الموقع</option>
												<option value="manager">مدير فرعي</option>
											</select>
									</div><br>

									<div class="form-group">
										{{-- <label>المحافظة</label> --}}
										<select name="city_id" class="form-control select @error('city_id') is-invalid @enderror">
											<option value="{{ $user->city_id }}">اختر المحافظة</option>
											
											@foreach($cities as $city)
											<option value="{{$city->id}}">{{$city->Name}}</option>
											@endforeach 
										</select>

										@error('city_id')
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

<script>
	document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.querySelector('select[name="Role"]');
    const citySelect = document.querySelector('select[name="city_id"]');

    roleSelect.addEventListener('change', function() {
        if (roleSelect.value === 'manager') {
            citySelect.style.display = 'block';
        } else {
            citySelect.style.display = 'none';
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
