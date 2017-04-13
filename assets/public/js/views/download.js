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
var SupportDiv = document.getElementById('errormsgsubscribe');



	// Subscribe Form
	$(".btn-newsletter").click(function(e) {
		e.preventDefault();
		
		$(this).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; Subscribing');
		
		var newsletterEmail = $('input[name=newsletterEmail]').val();
		
				
		
				
		var that = $(this);
		
		$.ajax({
			url: base_url + "newsletter/subscribe",
			type: 'POST',
			data: {newsletterEmail: newsletterEmail},
			success: function(data) {
				
				$("form .newsletterEmail").closest(".input-group").removeClass("has-error");
				
				if(data.error == 499) {
					$(".alert-error-subscribe").removeClass("hidden");
					$(".alert-error-subscribe").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDiv));
					$('#newsletterEmail-group').addClass('has-error');
					that.html('Submit');
					
				} else if(data.error == 498) {
					$(".alert-error-subscribe").removeClass("hidden");
					$(".alert-error-subscribe").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDiv));
					$('#newsletterEmail-group').addClass('has-error');
					that.html('Submit');
					
				} else if(data.error == 497) {
					$(".alert-error-subscribe").removeClass("hidden");
					$(".alert-error-subscribe").html('<span style="color: #C00"><i class="fa fa-warning (alias)"></i>&nbsp;' + data.error_msg + '</span>').fadeIn();
					 //Scroll to location of error message SupportDiv on load
                    window.scroll(0,findPos(SupportDiv));
					$('#newsletterEmail-group').addClass('has-error');
					that.html('Submit');
					
				
				} else if (data.error == 40){
					that.prop("disabled", true);
					that.html('<strong><i class="fa fa-smile-o"></i> Subscribed !</strong>');
					window.location = base_url + "welcome" + "?subscription=ok";
				}
				
			}
		});
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
	
	
	
	
});