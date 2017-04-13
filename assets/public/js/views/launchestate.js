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

var ContactDivlaunchestate = document.getElementById('errormsglaunchestate');


	
	//Contact Form
	$(".btn-launchestate").click(function(e) {
		e.preventDefault();
		
		$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; <strong>Sending...</strong>');
		
		var launchestatename = $('input[name=launchestatename]').val();
		var launchestateemail = $('input[name=launchestateemail]').val();
		var launchestatephone = $('input[name=launchestatephone]').val();
		var launchestateagency = $('input[name=launchestateagency]').val();
		
		
				
		
				
		var that = $(this);
		
		$.ajax({
			url: base_url + "launch/estate",
			type: 'POST',
			data: {launchestatename: launchestatename, launchestateemail: launchestateemail, launchestatephone: launchestatephone, launchestateagency: launchestateagency},
			success: function(data) {
				
				$("form .launchestatename").closest(".form-group").removeClass("has-error");
				$("form .launchestateemail").closest(".form-group").removeClass("has-error");
				$("form .launchestatephone").closest(".form-group").removeClass("has-error");
				$("form .launchestateagency").closest(".form-group").removeClass("has-error");
				
				if(data.errorslaunchestate == 399) {
					$(".alert-error-launchestate").removeClass("hidden");
					$(".alert-error-launchestate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchestate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchestate));
					$('#launchestatename-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchestate == 398) {
					$(".alert-error-launchestate").removeClass("hidden");
					$(".alert-error-launchestate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchestate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchestate));
					$('#launchestatephone-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchestate == 397) {
					$(".alert-error-launchestate").removeClass("hidden");
					$(".alert-error-launchestate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchestate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchestate));
					$('#launchestateemail-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchestate == 396) {
					$(".alert-error-launchestate").removeClass("hidden");
					$(".alert-error-launchestate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchestate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchestate));
					$('#launchestateagency-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchestate == 395) {
					$(".alert-error-launchestate").removeClass("hidden");
					$(".alert-error-launchestate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchestate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchestate));
					$('#launchestateemail-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if (data.errorslaunchestate == 30){
					that.prop("disabled", true);
					that.html('<strong><i class="fa fa-smile-o"></i> Details sent. Thank you !</strong>');
					window.location = base_url + "welcome" ;
					
				}
				
			}
		});
		
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
	
	
});