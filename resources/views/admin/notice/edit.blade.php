@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between">
							<div class="my-auto">
								<div class="d-flex">
									<h4 class="content-title mb-0 my-auto">إشعارات التعديل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
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

				<!-- row opened -->
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

						@foreach($members as $member)
						<div class="dash-widget">
							<div class="dash-widget-info text-right">
								<h5 style="color: black;">قام &nbsp; <span style="color: #0162e8">{{$member->managerEmail}} </span> &nbsp;
									بتعديل العضو: &nbsp; <span style="color: #0162e8">{{$member->FirstName}} {{$member->LastName}}</span>
									&nbsp;	ذو الرقم الحزبي: &nbsp; <span style="color: #0162e8">{{$member->IDTeam}}</span> &nbsp; </h5>
							</div>

							<div class="dash-widget-info text-left">
								<a class="btn btn-sm btn-info" href="{{ route('notice.editDetails', $member->IDTeam) }}" style="font-size: 14px;">إظهار التفاصيل</a> &nbsp;
								{{-- <a class="btn btn-sm btn-success" href="{{ route('member.update', $member->id) }}" style="font-size: 14px;">تأكيد</a> &nbsp; --}}
								<a class="btn btn-sm btn-danger" href="{{ route('notice.destroyNotice_delete', $member->id) }}" style="font-size: 14px;">تجاهل</a>

							</div>
						</div>
						@endforeach

					</div>

					{!! $paginationLinks !!}

				</div>
				<!-- /row -->

@endsection
@section('js')

<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection