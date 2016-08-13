var gallery_image_count = 1;
var option_form_count = 1;
function get_temple_galleryimage_form(){
	gallery_image_count++;
	$.get(SITE_BASE_URL+'index.php/temples/galleryimage_form/key/'+gallery_image_count, function(data){
																								   $('.gallery_image_items').append(data);
																								   });
}
function remove_temple_galleryimage_form(key){
	 $('.gallery_image_items #image'+key).remove();
}

function remove_uploaded_galleryimage(key){
	$('.gallery_image_list #'+key).css('opacity','0.1');
	  $.get(SITE_BASE_URL+'index.php/temples/remove_galleryimage/id/'+key, function(data){
																								   $('.gallery_image_list #'+key).remove();
																								   });
}

function get_pooja_option_form(){
		option_form_count++;
	$.get(SITE_BASE_URL+'index.php?r=pooja/option_form/key/'+option_form_count, function(data){
																								   $('.pooja_options_list').append(data);
																								   $('.optionform_required').attr('required',true);
																								   });

}
function remove_pooja_option_form(key){
	 $('.pooja_options_list #option'+key).remove();
}

function uploadpicture(targetid){
	if($('#'+targetid).val() != ''){
		$('#'+targetid).parent().find('.upload_progress').html('<img src="'+SITE_BASE_URL+'/images/ajax-loader.gif" alt="Loading..." />');
	var data = new FormData();     
	$.each($('#'+targetid)[0].files, function(i, file) {
		data.append(targetid, file);
	});
	var action_url = SITE_BASE_URL+'/index.php/storeproducts/pimageupload';
	$('ul.pimagelist').append('<li class="span3 thumbnail"><span>Uploading file... please wait</span></li>');
	
	
	$('#'+targetid).next('input.btn').attr('disabled',true);
	$('#'+targetid).css('display','none');
	$.ajax({
		type: 'POST',
		data: data,
		url: action_url,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#'+targetid).val('');
		  var splitupload = data.split('#####uploaded#####');
		  if(splitupload[0] == 'success'){
			   $('#yt'+targetid).val($('#yt'+targetid).val()+'SPLITIMAGESHERE'+splitupload[1]);
			  var clickfunction = "deletepimage('"+targetid+"','"+splitupload[1]+"','1')";
		    $('ul.pimagelist li').last().html('<a class="deleteqimage" href="javascript:void(0);" onclick="'+clickfunction+'"></a><img src="'+SITE_BASE_URL+'/'+splitupload[1]+'" style="max-width:100%;"/>');
			 $('#'+targetid).parent().find('.upload_progress').html('');
		  }
		  else{
			   $('#'+targetid).parent().find('.upload_progress').html('');
			   $('ul.pimagelist li').last().remove();
			    alert(splitupload[1]);
		  }
		},
		complete: function(){
		 $('#'+targetid).next('input.btn').attr('disabled',false);
		 $('#'+targetid).css('display','inline-block');
		}
	});
	
	}
}


function uploadguidepicture(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/guideimageupload/name/'+targetid;
	uploadimages(targetid, action_url);	
}


function uploadimages(targetid,action_url){
	if($('#'+targetid).val() != ''){
		$('#'+targetid).parent().find('.upload_progress').html('<img src="'+SITE_BASE_URL+'/images/ajax-loader.gif" alt="Loading..." />');
	var data = new FormData();     
	$.each($('#'+targetid)[0].files, function(i, file) {
		data.append(targetid, file);
	});
	$('ul.pimagelist').append('<li class="span3 thumbnail"><span>Uploading file... please wait</span></li>');
	
	
	$('#'+targetid).next('input.btn').attr('disabled',true);
	$('#'+targetid).css('display','none');
	$.ajax({
		type: 'POST',
		data: data,
		url: action_url,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
			$('#'+targetid).val('');
		  var splitupload = data.split('#####uploaded#####');
		  if(splitupload[0] == 'success'){
			   $('#yt'+targetid).val($('#yt'+targetid).val()+'SPLITIMAGESHERE'+splitupload[1]);
			  var clickfunction = "deletepimage('"+targetid+"','"+splitupload[1]+"','1')";
		    $('ul.pimagelist li').last().html('<a class="deleteqimage" href="javascript:void(0);" onclick="'+clickfunction+'"></a><img src="'+SITE_BASE_URL+'/'+splitupload[1]+'" style="max-width:100%;"/>');
			 $('#'+targetid).parent().find('.upload_progress').html('');
		  }
		  else{
			   $('#'+targetid).parent().find('.upload_progress').html('');
			   $('ul.pimagelist li').last().remove();
			    alert(splitupload[1]);
		  }
		},
		complete: function(){
		 $('#'+targetid).next('input.btn').attr('disabled',false);
		 $('#'+targetid).css('display','inline-block');
		}
	});
	
	}
}

function deletepimage(targetid,path,type){
	var action_url = SITE_BASE_URL+'/index.php/storeproducts/deletepimage';
	var data = 'path='+path+'&type='+type;
	$.ajax({
		type: 'POST',
		data: data,
		url: action_url,
		cache: false,
		success: function(data){
		  var currentitemimages =  $('#yt'+targetid).val();
		  currentitemimages = currentitemimages.split('SPLITIMAGESHERE');
		 
			  for (var key in currentitemimages) { 
				if (currentitemimages[key] == path) { 
					currentitemimages.splice(key, 1);
				 }
			 }
		 
		 
		  var currentitemimagesstr = currentitemimages.join('SPLITIMAGESHERE');
		   $('#yt'+targetid).val(currentitemimagesstr);
		    if(isNaN(path)){
		  $('ul.pimagelist li img').each(function(){
						if(($(this).attr('src')).indexOf(path) != -1){
							$(this).parent('li').remove();
						}
			});
		   }else{
			  $('#imagelist'+path).remove();
		  }
		  
		  
		},
		complete: function(){
		}
	});
}

function selectproductcategories(catid){
	var action_url = SITE_BASE_URL+'/index.php/storeproducts/Getsubcategories/id/'+catid;
	$('.productscategories_list_div').css('opacity','0.1');
	$.get(action_url, function(data){
							   var res=($.parseJSON(data));
							 $('.productcategory').html(res.details.category_name);
							 $('#Storeproducts_store_category_id').val(res.details.category_id);
							   if(res.have_subcategory){
								  
								   var new_ul = '<ul class="span4 productscategories_list">';
								   	$.each(res.subcategories,function(i,v){
								       new_ul +=  ' <li class="productscategories" onclick="selectproductcategories(\''+v.category_id+'\')">'+v.category_name+'</li>';
									   
														});
								   new_ul +='</ul>';
							   }
							    $('.productscategories_list_div').append(new_ul);
							    $('.productscategories_list_div').css('opacity','1');
							   });
}


function selectpoojacategories(catid){
	var action_url = SITE_BASE_URL+'/index.php/pooja/Getsubcategories/id/'+catid;
	$('.productscategories_list_div').css('opacity','0.1');
	$.get(action_url, function(data){
							   var res=($.parseJSON(data));
							 $('.productcategory').html(res.details.category_name);
							 $('#Pooja_pooja_category_id').val(res.details.category_id);
							   if(res.have_subcategory){
								  
								   var new_ul = '<ul class="span4 productscategories_list">';
								   	$.each(res.subcategories,function(i,v){
								       new_ul +=  ' <li class="productscategories" onclick="selectpoojacategories(\''+v.category_id+'\')">'+v.category_name+'</li>';
									   
														});
								   new_ul +='</ul>';
							   }
							    $('.productscategories_list_div').append(new_ul);
							    $('.productscategories_list_div').css('opacity','1');
							   });
}

function uploaduserpicture(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/userpicture/name/'+targetid;
	uploadsingle(targetid, action_url);
}

function uploadiyerimage(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/uploadiyerimage/name/'+targetid;
	uploadsingle(targetid, action_url);
}



function uploadguidelicense(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/uploadguidelicense/name/'+targetid;
	uploadsingle(targetid, action_url);
}

function uploadguidevideo(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/uploadvideo/name/'+targetid;
	uploadsingle(targetid, action_url);
}

function uploadsingle(targetid,action_url){
	if($('#'+targetid).val() != ''){
		$('#'+targetid).parent().find('.upload_progress').html('<img src="'+SITE_BASE_URL+'/images/ajax-loader.gif" alt="Loading..." />');
	var data = new FormData();     
	$.each($('#'+targetid)[0].files, function(i, file) {
		data.append(targetid, file);
	});
	
	
	$('#'+targetid).next('input.btn').attr('disabled',true);
	$('#'+targetid).css('display','none');
	$.ajax({
		type: 'POST',
		data: data,
		url: action_url,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data){
		  var splitupload = data.split('#####uploaded#####');
		  if(splitupload[0] == 'success'){
			  $('#yt'+targetid).val(splitupload[2]);
		    $('#'+targetid).parent().find('.upload_progress').html(splitupload[1]);
		  }
		  else{
			   $('#'+targetid).parent().find('.upload_progress').html('');
		  }
		},
		complete: function(){
		 $('#'+targetid).next('input.btn').attr('disabled',false);
		 $('#'+targetid).css('display','inline-block');
		}
	});
	
	}
}


function guide_have_certificate_change(obj){
	if($(obj).is(':checked'))
	$('#Guide_guide_license').attr('required',true);
	else
	$('#Guide_guide_license').attr('required',false);
}

var Guide_activities_count = 1;
function get_Guide_activities_form(){
	Guide_activities_count++;
	$.get(SITE_BASE_URL+'index.php/user/guideactivityform/key/'+Guide_activities_count, function(data){
																								   $('.activitieslists').append(data);
																								   });
}

function remove_div(classval){
	$('.'+classval).remove();
}

function selectactivityplanper(thisval,keyval){
	
	if(thisval == 'per_person'){
		$('.activitiesgroupforms'+keyval).css('display','none');
		$('.activitiesgroupforms'+keyval+' input').attr('required',false);
		$('.activitiespersonforms'+keyval).css('display','block');
		$('.activitiespersonforms'+keyval+' input').attr('required',true);
		
	}else if(thisval == 'per_group'){
		$('.activitiespersonforms'+keyval).css('display','none');
		$('.activitiespersonforms'+keyval+' input').attr('required',false);
		$('.activitiesgroupforms'+keyval).css('display','block');
		$('.activitiesgroupforms'+keyval+' input').attr('required',true);
	}else{
		$('.activitiesgroupforms'+keyval).css('display','none');
		$('.activitiesgroupforms'+keyval+' input').attr('required',false);
		$('.activitiespersonforms'+keyval).css('display','none');
		$('.activitiespersonforms'+keyval+' input').attr('required',false);
	}
}
