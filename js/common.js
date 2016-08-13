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
    
    var retVal = confirm("Are you sure,do you want to detele this image?");
    
    if(retVal ==true)
    {
	$('.gallery_image_list #'+key).css('opacity','0.1');
	  $.get(SITE_BASE_URL+'index.php/temples/remove_galleryimage/id/'+key, function(data)
          { $('.gallery_image_list #'+key).remove();});
     }
}


  countSplit	=	new Array("1");


function get_pooja_option_form(){
	 option_form_count++;
	 var optin_count =   $('#key').val();
	  optin_count += ','+option_form_count;
	 $.get(SITE_BASE_URL+'index.php/pooja/option_form/key/'+option_form_count, function(data){
																								   $('.pooja_options_list').append(data);
																								   $('#key').val(optin_count)
																								   $('.optionform_required').attr('required',true);
																								   });

}
function remove_pooja_option_form(key)
{
	  var optin_count1 =   $('#key').val();
	  optin_count1 =  optin_count1.replace(","+key, '');
     $('#key').val(optin_count1)
     $('.pooja_options_list #option'+key).remove();
}

function get_product_option_form(){
	 option_form_count++;
	  var optin_count =   $('#key').val();
	  optin_count += ','+option_form_count;
	$.get(SITE_BASE_URL+'index.php/storeproducts/option_form/key/'+option_form_count, function(data){
																								   $('.product_options_list').append(data);
																								     $('#key').val(optin_count)
																								   $('.optionform_required').attr('required',true);
																								   });

}
function remove_product_option_form(key){
	  var optin_count1 =   $('#key').val();
	  optin_count1 =  optin_count1.replace(","+key, '');
     $('#key').val(optin_count1)
	 $('.product_options_list #option'+key).remove();
}

function uploadpicture(targetid){	
	var action_url = SITE_BASE_URL+'/index.php/storeproducts/pimageupload';
	uploadpicture_process(targetid,action_url);
}

function uploadpoojapicture(targetid){	
	var action_url = SITE_BASE_URL+'/index.php/pooja/pimageupload';
	uploadpicture_process(targetid,action_url);
}

function uploadpicture_process(targetid,action_url){
	
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


function uploadguidepicture(targetid){
	var action_url = SITE_BASE_URL+'/index.php/user/guideimageupload/name/'+targetid;
	uploadguideimages(targetid, action_url);	
	
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


function uploadguideimages(targetid,action_url){
	if($('#'+targetid).val() != ''){
		$('#'+targetid).parent().find('.upload_progress').html('<img src="'+SITE_BASE_URL+'/images/ajax-loader.gif" alt="Loading..." />');
	var data = new FormData();     
	$.each($('#'+targetid)[0].files, function(i, file) {
		data.append(targetid, file);
	});
	$('ul.pimagelist').append('<li class="span2 thumbnail"><span>Uploading file... please wait</span></li>');
	
	
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
			  var clickfunction = "deleteguideimage('"+targetid+"','"+splitupload[1]+"','1')";
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
	deletepictues(targetid,path,type,action_url);
}

function deleteguideimage(targetid,path,type){
	var action_url = SITE_BASE_URL+'/index.php/user/deleteguideimage';
	deletepictues(targetid,path,type,action_url);
}



function deletepoojaimage(targetid,path,type){
	var action_url = SITE_BASE_URL+'/index.php/pooja/deletepimage';
	deletepictues(targetid,path,type,action_url);
}


function deletepictues(targetid,path,type,action_url){
	
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



function changeprofileimage(targetid,id){
		var action_url = SITE_BASE_URL+'/index.php/user/userpicture/name/'+targetid+'/userid/'+id;
	if($('#'+targetid).val() != ''){
		$('.profileimagecontainer').css('display','none');
		 $('.profileimageuploadprogress').css('display','block');
		  
	var data = new FormData();     
	$.each($('#'+targetid)[0].files, function(i, file) {
		data.append(targetid, file);
	});
	

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
			  $('.profileimagecontainer .profileimage img').attr('src',SITE_BASE_URL+splitupload[2]);
		  }
		  else{
			   alert(splitupload[1]);
		  }
		},
		complete: function(){
		 $('.profileimagecontainer').css('display','block');
		 $('.profileimageuploadprogress').css('display','none');
		}
	});
	
	}
}


function guide_have_certificate_change(obj){
	if($(obj).is(':checked')){
	$('#Guide_guide_license').attr('required',true);
	$('.guide_license_div').css('display','block');
	}else{
	$('#Guide_guide_license').attr('required',false);
	$('.guide_license_div').css('display','none');
	}
}

var Guide_activities_count = 1;
function get_Guide_activities_form(id){
	Guide_activities_count++;
	$.get(SITE_BASE_URL+'index.php/front/user/guideactivityform/key/'+Guide_activities_count+'/id/'+id, function(data){
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

jQuery(function(){
jQuery('.flashmessage .close').click(function(){
										 jQuery(this).parent().remove();
										 });


	jQuery('.tootltiptrigger').mouseover(function() {	
		// first remove all existing abbreviation tooltips
		jQuery('.tootltiptrigger').next('.tooltip').remove();
		// create the tooltip
		jQuery(this).after('<span class="tooltip">' + jQuery(this).attr('title') + '</span>');
		// position the tooltip 4 pixels above and 4 pixels to the left of the abbreviation
		var left = jQuery(this).position().left + jQuery(this).width() -120;
		var top = jQuery(this).position().top - 60;
		jQuery(this).next().css('left',left);
		jQuery(this).next().css('top',top);	
	});
	
jQuery('.triggerlogin').click(function() {	
		// first remove all existing abbreviation tooltips
		$('#Login_modal #type' ).val( jQuery(this).attr('data-type'));
		  $('#Login_modal #dataid' ).val( jQuery(this).attr('data-id'));
		//closeloginmodal('common');
		
		 if($("#Login_modal #loginsuccess").val() == '1'){
	       closeloginmodal( jQuery(this).attr('data-type'));
          }else{
				// position the tbox
				var left = jQuery(this).position().left - 180 ;
				var top = jQuery(this).offset().top - 150;
				
				jQuery('#Login_modal').css('left',left);
				jQuery('#Login_modal').css('top',top);	
				jQuery('#Login_modal').css('display','block');
		  }
	});

	 });

function showmeetingpointcontent(idval){
	jQuery('.centerpopup .popupcontent').html(jQuery('#starting_point_content'+idval).html());
	jQuery('.overlay, .centerpopup').css('display','block');
}


function ratingstar(ratings){
	jQuery('#Reviews_review_rate').val(ratings);
}

function reviewsubmitsuccess(objmsg){
jQuery(".flashmessage-review p").html(objmsg);  $(".flashmessage-review").css("display","block");
jQuery('.stars .star').removeClass('active');
 jQuery("#Reviews_review_title, #Reviews_review_content").val('');
setTimeout(function(){
					jQuery(".flashmessage-review").css("display","none");
					},4000);
}

function closeloginmodal_common(){
		jQuery('#Login_modal #type' ).val('');
	jQuery('#Login_modal #dataid' ).val('');
	   
	jQuery('#Login_modal').css('display','none');
	jQuery('#Login_modal .errorMessage').html('');
}

function closeloginmodal(type){
	
	if(jQuery('#Login_modal #type' ).val() == 'review'){
		jQuery('.notloggerinactionbox').remove();
		jQuery('.loggerinactionbox').css('display','block');
		jQuery('.loggerinactionbox #submit').click();
	}else if(jQuery('#Login_modal #type' ).val() == 'like'){
		var dataid =   jQuery('#Login_modal #dataid' ).val();
		likereview(dataid);
		
	}else if(jQuery('#Login_modal #type' ).val() == 'unlike'){
		var dataid =   jQuery('#Login_modal #dataid' ).val();
		unlikereview(dataid);
		
	}else if(jQuery('#Login_modal #type' ).val() == 'favourite'){
		var dataid =   jQuery('#Login_modal #dataid' ).val();
		makefavourite(dataid);
	}
	
	jQuery('#Login_modal #type' ).val('');
	jQuery('#Login_modal #dataid' ).val('');
	   
	jQuery('#Login_modal').css('display','none');
	jQuery('#Login_modal .errorMessage').html('');
}

function likereview(reviewid){
	$('.reviewlikeunlikewidget'+reviewid).load(SITE_BASE_URL+'index.php/front/review/makelike/id/'+reviewid+'/type/like');
}

function unlikereview(reviewid){
	$('.reviewlikeunlikewidget'+reviewid).load(SITE_BASE_URL+'index.php/front/review/makelike/id/'+reviewid+'/type/unlike');
}

function makefavourite(productid){
	$('.favouritewidget'+productid).load(SITE_BASE_URL+'index.php/front/profile/makefavourite/id/'+productid);
}

function removefavourite(productid)
{
 $('.favouritewidget'+productid).load(SITE_BASE_URL+'index.php/front/profile/removefavouritestore/id/'+productid);	
}


