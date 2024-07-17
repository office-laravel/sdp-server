@extends('manager.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الصفحة الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

				<style>
					.dash-widget {
						background-color: #fff;
						border-radius: 4px;
						margin-bottom: 30px;
						padding: 20px;
						position: relative;
						box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
					}
					.dash-widget-bg1 {
						width: 65px;
						float: left;
						color: #fff;
						display: block;
						font-size: 50px;
						text-align: center;
						line-height: 65px;
						background: #0162e8;
						border-radius: 50%;
						font-size: 40px;
						height: 65px;
					}
					.dash-widget-info > span.widget-title1 {
						background: #0162e8;
						color: #fff;
						padding: 5px 10px;
						border-radius: 4px;
						font-size: 13px;
					}
				</style>

@endsection
@section('content')
	<!-- row -->
	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
			<a href="{{ url('manager/memberm/show') }}">
				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-users" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">الأعضاء</h3>
						  <br>
					</div>
				</div>
			</a>
		</div>
	
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">

				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-user" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">المدراء</h3>
						  <br>
					</div>
				</div>

		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
			
				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-map-marker-alt" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">المحافظات</h3>
						  <br>
					</div>
				</div>
			
		</div>
	
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
			<div class="dash-widget">
				<span class="dash-widget-bg1"><i class="fa fa-home" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<br>
						<h3 style="color: black;">المناطق</h3>
					  <br>
				</div>
			</div>
	</div>

		
	</div>
	
	<div class="row">

		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
			
				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-building" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">الأحياء</h3>
						  <br>
					</div>
				</div>
			
		</div>

		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">

			<div class="dash-widget">
				<span class="dash-widget-bg1"><i class="fa fa-university" aria-hidden="true"></i></span>
				<div class="dash-widget-info text-right">
					<br>
						<h3 style="color: black;">المؤهلات العلمية</h3>
					  <br>
				</div>
			</div>

	</div>
</div>

		<div class="row">
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">الاختصاصات</h3>
						  <br>
					</div>
				</div>
		</div>
	
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
				<div class="dash-widget">
					<span class="dash-widget-bg1"><i class="fa fa-gavel" aria-hidden="true"></i></span>
					<div class="dash-widget-info text-right">
						<br>
							<h3 style="color: black;">المهن</h3>
						  <br>
					</div>
				</div>
		</div>
	</div>
	<!-- row closed -->
@endsection
@section('js')
@endsection