@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأعضاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ بحث متقدم</span>
						</div>
					</div>
					
					<div class="d-flex my-xl-auto right-content">
						<a href="{{ url('admin/member/show') }}" type="button" class="btn btn-primary" style="color: white">&nbsp; رجوع &nbsp;<i class="fa fa-arrow-left"></i></a>
					</div>

					{{-- <div class="d-flex my-xl-auto right-content">
						<a href="{{ route('export') }}" type="button" class="btn btn-primary" style="color: white">&nbsp; تصدير &nbsp;<i class="fas fa-file-upload"></i></a>
					</div> --}}

                    {{-- <div class="d-flex my-xl-auto right-content">
						<a href="{{ route('import') }}" type="button" class="btn btn-primary" style="color: white">&nbsp; استيراد &nbsp;<i class="fas fa-file-download"></i></a>
					</div> --}}

					{{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="file" name="file" accept=".csv">
						<button type="submit" class="btn btn-primary" style="color: white">&nbsp; استيراد &nbsp;<i class="fas fa-file-download"></i></button>
					</form> --}}

				</div>
                <!-- breadcrumb -->

				  
				{{-- search advanced --}}
                <form action="{{ route('Advancedsearch') }}" method="GET">
                    @csrf

                    <div class="row">
                        <h5>بحث متقدم</h5> <br><br>
                        <div class="col-12">
    
                          <div class="form-group">
                            <label>المحافظة</label>
                            <select name="City" id="city" 
                            class="form-control">
                              <option value="0">اختر المحافظة</option>
                              @foreach($city as $cit)
                              <option value="{{$cit->id}}" >{{$cit->Name}}</option>
                              @endforeach 
                            </select>
                          </div>
    
                          <div class="form-group">
                            <label>المنطقة</label>
                            <select name="area" id="area" class="form-control select">
                            </select>
                          </div>
    
                          <div class="form-group">
                            <label>الحي</label>
                            <select name="street" id="street" class="form-control select">
                            </select>
                          </div>
              
						  {{-- id="qualificationSelect" --}}
                          <div class="form-group">
                            <label>المؤهل العلمي</label>
                            <select name="Qualification" id="q" class="form-control select">
                              <option value="0">اختر المؤهل العلمي</option>
                              @foreach($qualifications as $qualification)
                                <option value="{{$qualification->id}}">{{$qualification->Name}}</option>
                              @endforeach 
                            </select>
                          </div>
    
						  {{-- id="specializationSelect" --}}
                          <div class="form-group">
                            <label>الاختصاص</label>
                            <select name="Specialization" class="form-control select" id="s">
                              <!-- Options will be loaded dynamically -->
                            </select>
                          </div> 
    
                          <div class="form-group">
                            <label>المهنة</label>
                            <select name="Occupation" class="form-control select"> 
                              <option value="0">اختر المهنة</option>
                              @foreach($occupations as $occupation)
                                <option value="{{$occupation->Name}}">{{$occupation->Name}}</option>
                              @endforeach 
                            </select>
                          </div>
    
                        </div>
                    </div>

					<div class="d-flex justify-content-center">
						<button type="submit" class="btn btn-primary">بحث متقدم</button>
					  </div>

                </form>
                <br>

<style>
.pagination {
    display: flex;
    justify-content: center;
}
.pagination .page-item {
    margin: 0 5px;
}
.pagination .page-link {
    font-size: 16px; /* تعديل حجم الخط حسب الحاجة */
    padding: 5px 10px; /* تعديل حجم الهامش حول العناصر */
    border: 1px solid #ccc; /* إضافة حدود للعناصر */
    border-radius: 5px; /* تقويس زوايا العناصر */
}
.pagination .page-item.active .page-link {
    background-color: #007bff; /* تغيير لون الخلفية للصفحة النشطة */
    color: #fff; /* تغيير لون النص للصفحة النشطة */
}
</style>

@endsection
@section('content')

@if(isset($members) && !$members->isEmpty()) 
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">جميع الأعضاء</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="">
                        <thead>
                            <tr>
								<th class="wd-15p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">الرقم الحزبي</th>
								<th class="wd-15p border-bottom-0">الاسم</th>
								<th class="wd-15p border-bottom-0"> النسبة</th>
								<th class="wd-15p border-bottom-0">المحافظة</th>
								<th class="wd-15p border-bottom-0">الحالة</th>

								<th class="wd-15p border-bottom-0">التفاصيل</th>
								<th class="wd-15p border-bottom-0">سجل التعديل</th>
								<th class="wd-15p border-bottom-0">تعديل</th>
								<th class="wd-15p border-bottom-0">حذف</th>
							</tr>
                        </thead>
                    	<tbody>
							<?php $i = 1 ?>
							@if(isset($members) && !$members->isEmpty()) 
							@foreach($members as $member)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$member->IDTeam}}</td>
								<td>{{$member->FirstName}}</td>
								<td>{{$member->LastName}}</td>
								<td>{{$member->City}}</td>
								<td>{{$member->status}}</td>

								<td>
									<a class="btn btn-sm btn-success" href="{{ route('member.details', $member->id)}}" title="التفاصيل"><i class="las la-user"></i></a>
								</td>
								<td>
									<a class="btn btn-sm btn-primary" href="{{ route('archive.GetArchive', $member->IDTeam)}}" title="سجل التعديل"><i class="la la-archive"></i></a>
								</td>
								<td>
									<a class="btn btn-sm btn-info" href="{{ route('member.edit', $member->id) }}" title="تعديل"><i class="las la-pen"></i></a>
								</td>
								<td>
									<a class="modal-effect btn btn-sm btn-danger" title="حذف" data-toggle="modal" style="cursor: pointer;"
									data-target="#delete{{$member->id}}"><i class="las la-trash"></i></a>
									<form action="{{route('member.delete', $member->id)}}" method="POST" enctype="multipart/form-data">
											@csrf
											@method('DELETE')
										<div id="delete{{$member->id}}" class="modal fade delete-modal" role="dialog">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">

													<div class="modal-header">
														<h6 class="modal-title">حذف العضو: &nbsp; {{$member->FirstName}}{{$member->LastName}}</h6><button aria-label="Close" class="close" data-dismiss="modal"
															type="button"><span aria-hidden="true">&times;</span></button>
													</div>

													<div class="modal-body text-center">
														<img src="{{URL::asset('assets/img/media/sent.png')}}" alt="" width="50" height="46">
														<br><br>
														<h5>هل أنت متأكد من عملية الحذف؟</h5>
														<br>
														<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">إلغاء</a>
															<button type="submit" class="btn btn-danger">حذف</button>
														</div>
														<br>
													</div>
												</div>
											</div>
										</div>
									</form>
								</td>
							</tr>
							@endforeach

						@else 
						<tr>
							<td colspan="20">لم يتم العثور على نتائج</td>
						</tr>
						@endif
						</tbody>
                    </table>
					{!! $paginationLinks !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @else 
			
<h3 style="background-color: white ; text-align: center"  colspan="20">لا توجد نتائج</h3>
		 --}}
@endif
@endsection
@section('js')

		<script>
			var qurl='{{url("admin/member/get-specializations","itemid")}}';
			 $(function() {
			 $('#q').change(function(){
					var thisqurl=qurl;
			var qId = $(this).find("option:selected").val();
			if(qId==0){
				$('#s').html('<option value="0">اختر الاختصاص</option>');
			}else{
				thisqurl=thisqurl.replace("itemid",qId);
			if(qId){
				$.ajax({
					url: thisqurl, // Use Laravel's route name
					method: 'Get', // Match the method type with your route definition
				 
					success: function(result){
						$('#s').html('<option value="0">اختر الاختصاص</option>');
						$.each(result, function(key, value) {
						
			 $('#s').append('<option value="'+value.id+'">'+value.specialization+'</option>');
						});
					 }
				 });
			 }
			 }
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