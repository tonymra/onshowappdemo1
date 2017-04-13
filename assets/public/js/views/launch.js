$(document).ready(function() {
	
	
	
	
//Finds y value of the error message  object
function findPos(obj) {
	var curtop = -90;
	if (obj.offsetParent) {
		do {
			curtop += obj.offsetTop;
		} while (obj = obj.offsetParent);
	return [curtop];
	}
}
//Get the error message object
var SupportDivLaunch = document.getElementById('errormsglaunch');



	// Subscribe Form
	$(".btn-launch").click(function(e) {
		e.preventDefault();
		
		$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; Submitting');
		
		var launchEmail = $('input[name=launchEmail]').val();
		
				
		
				
		var that = $(this);
		
		$.ajax({
			url: base_url + "launch/subscribe",
			type: 'POST',
			data: {launchEmail: launchEmail},
			success: function(data) {
				
				$("form .launchEmail").closest(".input-group").removeClass("has-error");
				
				if(data.errorlaunch == 799) {
					$(".alert-error-launch").removeClass("hidden");
					$(".alert-error-launch").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg_launch + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDivLaunch));
					$('#launchEmail-group').addClass('has-error');
					that.html('Submit');
					
				} else if(data.errorlaunch == 798) {
					$(".alert-error-launch").removeClass("hidden");
					$(".alert-error-launch").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg_launch + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDivLaunch));
					$('#launchEmail-group').addClass('has-error');
					that.html('Submit');
					
				} else if(data.errorlaunch == 797) {
					$(".alert-error-launch").removeClass("hidden");
					$(".alert-error-launch").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg_launch + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDivLaunch));
					$('#launchEmail-group').addClass('has-error');
					that.html('Submit');
					
				
				} else if (data.errorlaunch == 70){
					that.prop("disabled", true);
					that.html('<strong><i class="fa fa-smile-o"></i> Submitted !</strong>');
					window.location = base_url + "welcome" + "?submission=ok";
				}
				
			}
		});
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
	
	
	
	
});