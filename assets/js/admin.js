

var Admin = {
	setFlatRate: function(postData){
		$.ajax({
	        url: admin_ajax_url + "/set_flat_rate",
	        data: postData,
	        type: 'POST',
	        dataType: 'JSON',
	        success: function (data) {
	        	if(data.status == "OK"){
	            	$('#ajaxModal').modal('hide');
	            	alert("Success");
	            	window.location = site_url + 'admin/quotes';
	        	}
	        	else{
	        		
	        	}
	        },
	        error: function (data) {
	        }
	    });
	},
	/*
	*Admin ban user
	*/
	adminbanReason: function(postDataban){
		$.ajax({
	        url: admin_ajax_url + "/admin_ban_reason",
	        data: postDataban,
	        type: 'POST',
	        dataType: 'JSON',
	        success: function (data) {
	        	if(data.status == "OK"){
	            	$('#ajaxModal').modal('hide');
	            	alert("Success");
	            	window.location = site_url + 'admin/user_list';
	        	}
	        	else{
	        		
	        	}
	        },
	        error: function (data) {
	        }
	    });
	},
	jobCompletePopup: function(order_id){
		// alert('TO DO here');
		//Show popup
		//Admin.jobComplete(order_id);
	},
	jobComplete: function(order_id){
		if( !confirm("Are you sure you want to mark it as done?") ){
			return false;
		}
		$.ajax({
	        url: admin_ajax_url + "/job_complete",
	        data: {order_id: order_id},
	        type: 'POST',
	        dataType: 'JSON',
	        success: function (data) {
	        	if(data.status == "OK"){
	            	alert("Success");
	            	window.location = site_url + 'admin/orders';
	        	}
	        	else{
	        		
	        	}
	        },
	        error: function (data) {
	        }
	    });
	},
	Message: {
		send: function(action){
			if (typeof(tinyMCE) != "undefined"){
				var editorContent = tinyMCE.activeEditor.getContent();
				if (editorContent == ''){
					alert("Message can not be empty!");
				    return false;
				}
			}
			else{
				if ($("#message").val() == ''){
					alert("Message can not be empty!");
				    return false;
				}
			}

			if(action == 'redirect' || action == 'refresh'){
				Portal.wait();
			}
			else{
				var icon = '<i class="fa fa-spinner fa-spin"></i>';
				$(".ajax_msg").html(icon + ' ' + $(".ajax_msg").data('wait')).show();
			}

			var text = $("#message_form").serializeArray();
			$.ajax({
	            url: admin_ajax_url + "/send_message",
	            type: 'POST',
	            dataType: 'JSON',
	            data: text,
	            success: function (json) {
	            	if(json.status == 'OK'){
	            		/* Clear Input Values */
	            		if (typeof(tinyMCE) != "undefined" && tinyMCE.activeEditor != null) {
							tinyMCE.activeEditor.setContent('');
	            		}
	            		$("#subject").val('');
						$("#message").val('');

						//var source   = $("#tpl_messages").html();
						//var template = Handlebars.compile(source);

						//var html    = template(json);
						//$("#message_content").html(html);

						if(action == 'redirect'){
							window.location = site_url + '/message';
						}
						else if(action == 'refresh'){
							location.reload();
						}
						else{
							var icon = '<i class="fa fa-check-square"></i>';
							$(".ajax_msg").html(icon + ' ' + $(".ajax_msg").data('done')).show();
							setTimeout(function(){
								$(".ajax_msg").hide();
							}, 5000);
						}

					}
					else{
						if(action == 'redirect' || action == 'refresh'){
							Portal.removeWait();
						}
						else{
							setTimeout(function(){
								$(".ajax_msg").hide();
							}, 5000);
						}
					}

					$(".timeago").timeago();
	            	// Portal.removeWait();
	            },
	            error: function (data) {
	            }
	        });
			return false;
		}
	}
}

jQuery(document).ready(function($) {
	
	$("#submit_flatrate").on("submit", document, function(event){
		event.preventDefault();
		var postData = $(this).serializeArray();
		Admin.setFlatRate(postData);
		return false;
	});

	$(document).on("submit", "#submit_ban_user", function(event){
		event.preventDefault();
		var postDataban = $(this).serializeArray();
		Admin.adminbanReason(postDataban);
		return false;
	});
});