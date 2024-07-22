var streetdata;
$(document).ready(function () {

	$('#street_txt').on( "keyup", function (e) {
	
		var inputval=$('#street_txt').val()
		if(inputval!='' && inputval.length > 0){
			 
			  setTimeout(loadstreet, 1000);
		}
		//setTimeout(loadstreet, 1000);
		//e.preventDefault();	
		// var option = $('#page_id').find(":selected").val(); 
		// var optiontext = $('#page_id').find(":selected").text();
		// if(option!=0){		 
		// appendrow(option,optiontext);
		// $('#page_id').find(":selected").remove();
		// }
		// alert( option +'-'+optiontext);
});

$('#street').on( "change", function (e) {
	
	  var selectedop = $(this).find(":selected").val(); 
 
	if( selectedop!=0 ){
		loadarea();
		// alert(optiontext);
	}
	//setTimeout(loadstreet, 1000);
	//e.preventDefault();	
	// var option = $('#page_id').find(":selected").val(); 
	// var optiontext = $('#page_id').find(":selected").text();
	// if(option!=0){		 
	// appendrow(option,optiontext);
	// $('#page_id').find(":selected").remove();
	// }
	// alert( option +'-'+optiontext);
}); 
 
 
 //show list
 
 
//pages combo
function loadstreet() {	
	 
	var this_street_url=search_street_url;
	var searchval =$('#street_txt').val();
	this_street_url=this_street_url.replace("itemid",searchval);	 
	//	resetForm();
	 
	 var choose='اختر الحي';	 
		 $('#street').html('<option   value="0"  class="text-muted">'+choose+'</option>');
	 
 	$.ajax({
	url:this_street_url,
	type: "GET",  
//	contentType: false,
//	processData: false,
	//contentType: 'application/json',
	success: function (data) {	
		streetdata=data; 
		if (data.length == 0) {		
			 
			choose='لا يوجد نتائج';
			$('#street').html('<option   value="0"  class="text-muted">'+choose+'</option>');	 
		} else   {
			datalist=data;
			$(data).each(function(index, item) {
				$('#street').append('<option value="'+ item.id +'" >'+ item.street +'</option>');
		});		 
		}		 
	}, error: function (errorresult) {			 
	} 
});

	};

	 
	function loadarea() {	

		var street_id=$('#street').find(":selected").val(); 
  var filteredata= streetdata.filter(function(item){ return item.id == street_id }) ;
  
	//	var filteredata = streetdata.find(item => item.id === street_id);
		
		var area_id= filteredata[0].grandId;
		var city_id= filteredata[0].parentId;
		var	this_area_url=	search_area_url;
		this_area_url=this_area_url.replace("itemid",area_id);	 
		//	resetForm();
		 
		 var choose='اختر المنطقة';	 
			 $('#area').html('<option   value="0"  class="text-muted">'+choose+'</option>');
		 
		 $.ajax({
		url:this_area_url,
		type: "GET",  
	//	contentType: false,
	//	processData: false,
		//contentType: 'application/json',
		success: function (data) {			 
			if (data.length == 0) {		
				choose='لا يوجد نتائج';
				$('#area').html('<option   value="0"  class="text-muted">'+choose+'</option>');	 
			} else   {
				//datalist=data;
				$(data).each(function(index, item) {
					$('#area').append('<option value="'+ item.id +'" >'+ item.area +'</option>');

			});	
			var asel= data[0].id;
$("#area").val(asel).change();
loadcity(city_id);
			}		 
		}, error: function (errorresult) {			 
		} 
	});
	
		};

		function loadcity(city_id) {	

			var	this_city_url=	search_city_url;
			this_city_url=this_city_url.replace("itemid",city_id);	 		 
			 $.ajax({
			url:this_city_url,
			type: "GET",  
		//	contentType: false,
		//	processData: false,
			//contentType: 'application/json',
			success: function (data) {			 
				if (data.length == 0) {		
					$("#city").val(0).change(); 
				} else   {			 
				var asel= data[0].id;
	$("#city").val(asel).change();
				}		 
			}, error: function (errorresult) {			 
			} 
		});
		
			};
 
});

 
 
 