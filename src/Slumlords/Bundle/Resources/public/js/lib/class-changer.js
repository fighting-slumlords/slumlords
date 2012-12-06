$(function() {
	$(".courses_select").change(function()
	{
		window.location.href += "/" + $(this).val();
	});

});
