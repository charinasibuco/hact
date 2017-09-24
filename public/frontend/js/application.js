$(function(){
	$element 		= $(".element-to-center");

	$navbarLogin 	= $("#navbar-login");
	$loginForm	 	= $("#login-form");
	$bannerText	 	= $("#banner-text");

	$(window).load(function() {
		centerElement();
//		$modal.hide();
	});

	$(window).resize(function(){
		centerElement();
	});

/*$navbarLogin.on("click", function() {
		$bannerText.toggle();
		$loginForm.toggle();
		centerElement();
	});
	
	$loginForm.toggle();
	
	if($("div#login-form div.alert").length > 0)
	{
		$bannerText.toggle();
		$loginForm.toggle();
		centerElement();
	}
	*/
	function centerElement() {
		$element.each(function() {
			$container = $($(this).data("container"));
			$(this).css("margin-top", $container.height()/2 -$(this).height() /2);
		});
	}
});
