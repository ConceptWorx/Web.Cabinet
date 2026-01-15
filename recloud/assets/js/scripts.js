function hideme(){
	$("#error_content").fadeOut(300)
}
$(document).ready(function(){
	var time = 5;
	var timeSec = time * 1000;

	$("#progress").animate({
		width: '100%'
	}, timeSec, function(){
    $(this).parent(".error__progress-bar").parent('.error_content').animate({'opacity': 0,'top': '-5px'},500, function(){
      $(this).parent(".error__progress-bar").parent('.error_content').css('display','none');
    })
	});
})