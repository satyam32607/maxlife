/* js code for select all option in roles module*/
$("#selectall").click(function () {
	if (this.checked)
	   $(".allselect").prop("checked", true);
	else
	   $(".allselect").prop("checked", false);

	});

$("#select_all").click(function () {
	if (this.checked)
	   $(".all_select").prop("checked", true);
	else
	   $(".all_select").prop("checked", false);

	});

/*js code for checkboxes in roles module */
$(".allselect").click(function () { 
	/*Root info */
	var getParntClass = $.grep(this.className.split(" "), function(v, i){
		   return v.indexOf('parent') === 0;
	   }).join();
	
	if(getParntClass!=0 && getParntClass!=" ")
	{
		var rootValueId=getParntClass.slice(6);
		var numberOfAncestorChildCheckBoxes = $(".getAncestorid"+rootValueId).length;
		$("."+getParntClass).change(function() { 
			if(this.checked)
			{
				$(".getAncestorid"+rootValueId).prop('checked', true);
			}
			else
			{
				$(".getAncestorid"+rootValueId).prop('checked', false);
			}
		});
	}
	/* Each checkbox info and whether it has child or not if yes,checked child */
	var getUserRights = $(this).attr("id");
	var userRightsValueId=getUserRights.slice(11);

	if ($(".getParentid"+userRightsValueId).length > 0) {
		if(this.checked)
		{
			$(".getParentid"+userRightsValueId).prop('checked', true);
		}
		else
		{
			$(".getParentid"+userRightsValueId).prop('checked', false);
		}
	
	}
	
	/* Ancestor info of current(this) checkbox */
	var getAncestorClass=$(this).attr("class").split(' ').pop();
	var ancestorValueId=getAncestorClass.slice(13);
	/*Parent info of current(this) checkbox*/
	var getParentClass = $.grep(this.className.split(" "), function(v, i){
	   return v.indexOf('getParentid') === 0;
	}).join();		
	var parentValueId=getParentClass.slice(11);
	
	if(this.checked){
		/*Checked ancestor and parent*/
		$(".parent"+ancestorValueId).prop("checked", true);
		$("#role_rights"+parentValueId).prop("checked", true);
	}
	else{
		/*  if no child is checked then uncheck the master or root checkbox  */
		var numberOfAncestorChildCheckBoxes = $(".getAncestorid"+ancestorValueId).length;
		$(".getAncestorid"+ancestorValueId).change(function() {
		var checkedAncestorChildCheckBox = $(".getAncestorid"+ancestorValueId+":checked").length;
		  if (checkedAncestorChildCheckBox == 0){
			  $(".parent"+ancestorValueId).prop('checked', false);}
		
		});
		
		var numberOfChildCheckBoxes = $(".getParentid"+parentValueId).length;
		$(".getParentid"+parentValueId).change(function() {
		var checkedChildCheckBox = $(".getParentid"+parentValueId+":checked").length;
		  if (checkedChildCheckBox > 0){
			$("#role_rights"+parentValueId).prop('checked', true);
		  $(".parent"+ancestorValueId).prop('checked', true);}
		else {
			$("#role_rights"+parentValueId).prop('checked', false);
			}
		}); 
	}
});


$(".all_select").click(function () { 
	/*Root info */
	var getParntClass = $.grep(this.className.split(" "), function(v, i){
		   return v.indexOf('parent') === 0;
	   }).join();
	
	if(getParntClass!=0 && getParntClass!=" ")
	{
		var rootValueId=getParntClass.slice(6);
		var numberOfAncestorChildCheckBoxes = $(".getAncestorid"+rootValueId).length;
		$("."+getParntClass).change(function() { 
			if(this.checked)
			{
				$(".getAncestorid"+rootValueId).prop('checked', true);
			}
			else
			{
				$(".getAncestorid"+rootValueId).prop('checked', false);
			}
		});
	}
	/* Each checkbox info and whether it has child or not if yes,checked child */
	var getUserRights = $(this).attr("id");
	var userRightsValueId=getUserRights.slice(11);

	if ($(".getParentid"+userRightsValueId).length > 0) {
		if(this.checked)
		{
			$(".getParentid"+userRightsValueId).prop('checked', true);
		}
		else
		{
			$(".getParentid"+userRightsValueId).prop('checked', false);
		}
	
	}
	
	/* Ancestor info of current(this) checkbox */
	var getAncestorClass=$(this).attr("class").split(' ').pop();
	var ancestorValueId=getAncestorClass.slice(13);
	/*Parent info of current(this) checkbox*/

	var getParentClass = $.grep(this.className.split(" "), function(v, i){
	   return v.indexOf('getParentid') === 0;
	}).join();		
	var parentValueId=getParentClass.slice(11);
	
	if(this.checked){
		/*Checked ancestor and parent*/
		$(".parent"+ancestorValueId).prop("checked", true);
		$("#user_modules"+parentValueId).prop("checked", true);
	}
	else{
		/*  if no child is checked then uncheck the master or root checkbox  */
		var numberOfAncestorChildCheckBoxes = $(".getAncestorid"+ancestorValueId).length;
		$(".getAncestorid"+ancestorValueId).change(function() {
		var checkedAncestorChildCheckBox = $(".getAncestorid"+ancestorValueId+":checked").length;
		  if (checkedAncestorChildCheckBox == 0){
			  $(".parent"+ancestorValueId).prop('checked', false);}
		
		});
		
		var numberOfChildCheckBoxes = $(".getParentid"+parentValueId).length;
		$(".getParentid"+parentValueId).change(function() {
		var checkedChildCheckBox = $(".getParentid"+parentValueId+":checked").length;
		  if (checkedChildCheckBox > 0){
			$("#user_modules"+parentValueId).prop('checked', true);
		  $(".parent"+ancestorValueId).prop('checked', true);}
		else {
			$("#user_modules"+parentValueId).prop('checked', false);
			}
		}); 
	}
});


	 function page_loader()
		 {
			$("#fullpage-loader").fadeIn(400), window.fullpageloaderTimeout = window.setTimeout(function() {
				$("#loader-error").fadeIn(400), $("#loader-icon").removeClass("fa-spin").addClass("text-danger")
			}, 1e4)
		
		 }
		 $(document).on("click", ".fullpage-loader-close", function() {
			$("#fullpage-loader").fadeOut(400), $("#loader-error").hide(), $("#loader-icon").addClass("fa-spin").removeClass("text-danger"), clearTimeout(window.fullpageloaderTimeout)
		});
		
		

$(function () {
            $(".photopreview").change(function () {
                if (typeof (FileReader) != "undefined") {
					var get_val=$(this).val();
					var get_name=$(this).attr('name');
					var dvPreview = $("#dvPreview_"+get_name);
					dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:200px;width: 150px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
		
		
	
	   function get_state(country_id,state_id){
		$('#state_id').html('');
		var get_val=country_id;
		$("#state_id").find('option').remove();
		$.get(path+'ajaxrequest/get_states/'+get_val, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#state_id').append($("<option></option>").attr("value",'').text('Select State'));
			$.each(obj, function(idx, obj1) {
				var state_name=obj1.state_name;
				var state_id=obj1.state_id;
				$('#state_id').append($("<option></option>").attr("value",state_id).text(state_name)); 
			});
			$('#state_id option[value='+state_id+']').attr("selected", "selected");
			});
		 }
	 
	   function get_city(state_id,city_id){
			$('#city_id').html('');
			var get_val=state_id;
			$("#city_id").find('option').remove();
			$.get(path+'ajaxrequest/get_cities/'+get_val, function( data ) {
				var obj = jQuery.parseJSON(data);
				$('#city_id').append($("<option></option>").attr("value",'').text('Select City'));
				$.each(obj, function(idx, obj1) {
					var city_name=obj1.city_name;
					var city_id=obj1.city_id;
					//alert(city_name);
					$('#city_id').append($("<option></option>").attr("value",city_id).text(city_name)); 
				});
				$('#city_id option[value='+city_id+']').attr("selected", "selected");
			});
	   }
	 

	
	
	 function get_category(category_type_id,category_id){
		$('#state_id').html('');
		var get_val=category_type_id;
		$("#category_id").find('option').remove();
		$.get(path+'ajaxrequest/get_category/'+get_val, function( data ) {
			var obj = jQuery.parseJSON(data);
			$('#category_id').append($("<option></option>").attr("value",'').text('Select'));
			$.each(obj, function(idx, obj1) {
				var category_name=obj1.category_name;
				var category_id=obj1.category_id;
				$('#category_id').append($("<option></option>").attr("value",category_id).text(category_name)); 
			});
			$('#category_id option[value='+category_id+']').attr("selected", "selected");
			});
		 }
		 				
	
  $("#date_of_birth").datepicker({
	changeMonth: true,startDate: '-65y',endDate: '-10y',
	 format: 'yyyy-mm-dd',
	 autoclose: true,
	}).on('changeDate', function(e) {
	});	
	
	$("#date_of_joining").datepicker({
	changeMonth: true,startDate: '-65y',endDate: '0',
	 format: 'yyyy-mm-dd',
	 autoclose: true,
	}).on('changeDate', function(e) {
	});
	
	$("#expiry_date").datepicker({
	changeMonth: true,
	 format: 'yyyy-mm-dd',
	 autoclose: true,
	}).on('changeDate', function(e) {
	});
	
	
/*	$('#start_date').datepicker({
	 changeMonth: true,startDate: '-1y',endDate: '0',
	 format: 'yyyy-mm-dd',
	  autoclose: true,
	 }).on('changeDate', function(e) {
	  var date2 = $('#start_date').datepicker('getDate', '+30d'); 
	  date2.setDate(date2.getDate()+30); 
	  $('#end_date').datepicker('setDate', date2);
	});
	
	$("#end_date").datepicker({
	changeMonth: true,
	 format: 'yyyy-mm-dd',
	 autoclose: true,
	}).on('changeDate', function(e) {
	});*/

	
$(function(){
	$(".date-picker").datepicker({
	changeMonth: true,
	 format: 'yyyy-mm-dd',
	 autoclose: true,
	}).on('changeDate', function(e) {
	});
});

