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

var ContactDiv = document.getElementById('errormsgcontact');


	
	//Contact Form
	$(".btn-contact").click(function(e) {
		e.preventDefault();
		
		$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; <strong>Sending...</strong>');
		
		var name = $('input[name=name]').val();
		var email = $('input[name=email]').val();
		var phone = $('input[name=phone]').val();
		var message = $('textarea[name=message]').val();
		
		
				
		
				
		var that = $(this);
		
		$.ajax({
			url: base_url + "welcome/contact_us_pro",
			type: 'POST',
			data: {name: name, email: email, phone: phone, message: message},
			success: function(data) {
				
				$("form .name").closest(".form-group").removeClass("has-error");
				$("form .email").closest(".form-group").removeClass("has-error");
				$("form .phone").closest(".form-group").removeClass("has-error");
				$("form .message").closest(".form-group").removeClass("has-error");
				
				if(data.errors == 999) {
					$(".alert-error-contact").removeClass("hidden");
					$(".alert-error-contact").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.contact_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDiv));
					$('#name-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Send us a message');
					
				} else if(data.errors == 998) {
					$(".alert-error-contact").removeClass("hidden");
					$(".alert-error-contact").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.contact_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDiv));
					$('#phone-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Send us a message');
					
				} else if(data.errors == 997) {
					$(".alert-error-contact").removeClass("hidden");
					$(".alert-error-contact").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.contact_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDiv));
					$('#email-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Send us a message');
					
				} else if(data.errors == 996) {
					$(".alert-error-contact").removeClass("hidden");
					$(".alert-error-contact").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.contact_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDiv));
					$('#message-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Send us a message');
					
				} else if(data.errors == 995) {
					$(".alert-error-contact").removeClass("hidden");
					$(".alert-error-contact").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.contact_error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(ContactDiv));
					$('#email-group').addClass('has-error');
					that.html('<span class="icon_check"></span>Send us a message');
					
				} else if (data.errors == 0){
					that.prop("disabled", true);
					that.html('<strong><i class="fa fa-smile-o"></i> Message sent !</strong>');
					window.location = base_url + "welcome" + "?message=ok";
					
				}
				
			}
		});
		
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
	
	
});