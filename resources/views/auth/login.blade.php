@extends('layouts.master')

@section('title')
تسجيل الدخول  
@stop


@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')


<div class="container-fluid">
	{{-- <div class="row no-gutter"> --}}

		<div class="login d-flex align-items-center py-2">
		<div class="container p-0">

<div class="row">
	
	<div class="col-md-12 col-lg-12 col-xl-12 mx-auto">
		<div class="card-sigin">
			<div class="card-sigin">

				<br>
				<div class="col-md-4 col-lg-4 col-xl-4 my-auto mx-auto">
					<img src="{{URL::asset('assets/img/media/team.png')}}"  style="text-align: center;" alt="logo">
				</div>

				<div class="main-signup-header">
					<h2>مرحبا بك</h2>
					<h5 class="font-weight-semibold mb-4"> تسجيل الدخول</h5>
					<form method="POST" action="{{ route('login') }}">
					 @csrf
						<div class="form-group">
						<label>البريد الالكتروني</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						 @error('email')
						 <span class="invalid-feedback" role="alert">
						 <strong>{{ $message }}</strong>
						 </span>
						 @enderror
						</div>

					 <div class="form-group">
					  <label>كلمة المرور</label> 
					
					  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

					  @error('password')
					  <span class="invalid-feedback" role="alert">
					  <strong>{{ $message }}</strong>
					  </span>
					  @enderror
					  <div class="form-group row">
						  <div class="col-md-6 offset-md-4">
							   <div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<label class="form-check-label" for="remember">
										   {{ __('تذكرني') }}
									</label>
							   </div>
						   </div>
					   </div>
					  </div>
						<button type="submit" class="btn btn-main-primary btn-block">
						{{ __('تسجيل الدخول') }}
						</button>

						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
{{-- </div> --}}

</div>



@endsection
@section('js')
@endsection