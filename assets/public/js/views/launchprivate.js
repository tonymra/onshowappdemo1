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

var ContactDivlaunchprivate = document.getElementById('errormsglaunchprivate');


	
	//Contact Form
	$(".btn-launchprivate").click(function(e) {
		e.preventDefault();
		
		$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; <strong>Sending...</strong>');
		
		var launchprivatename = $('input[name=launchprivatename]').val();
		var launchprivateemail = $('input[name=launchprivateemail]').val();
		var launchprivatephone = $('input[name=launchprivatephone]').val();
		
		
		
				
		
				
		var that = $(this);
		
		$.ajax({
			url: base_url + "launch/privateseller",
			type: 'POST',
			data: {launchprivatename: launchprivatename, launchprivateemail: launchprivateemail, launchprivatephone: launchprivatephone},
			success: function(data) {
				
				$("form .launchprivatename").closest(".form-group").removeClass("has-error");
				$("form .launchprivateemail").closest(".form-group").removeClass("has-error");
				$("form .launchprivatephone").closest(".form-group").removeClass("has-error");
				
				
				if(data.errorslaunchprivate == 199) {
					$(".alert-error-launchprivate").removeClass("hidden");
					$(".alert-error-launchprivate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchprivate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchprivate));
					$('#launchprivatename-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchprivate == 198) {
					$(".alert-error-launchprivate").removeClass("hidden");
					$(".alert-error-launchprivate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchprivate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchprivate));
					$('#launchprivatephone-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if(data.errorslaunchprivate == 197) {
					$(".alert-error-launchprivate").removeClass("hidden");
					$(".alert-error-launchprivate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchprivate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchprivate));
					$('#launchprivateemail-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				
				} else if(data.errorslaunchprivate == 195) {
					$(".alert-error-launchprivate").removeClass("hidden");
					$(".alert-error-launchprivate").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.launchprivate_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDivlaunchprivate));
					$('#launchprivateemail-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Submit');
					
				} else if (data.errorslaunchprivate == 10){
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