jQuery(document).ready(function($) {
	// AM: links in right upper "Howdy, administrator" with id's of parent
	// element
	$('a.ab-item').each(function() {
		$(this).attr('id', 'a-' + $(this).parent().attr('id'));
	});
	// AM: hide elements by id (testing)
	var hide = GetURLParameter('hide');
	$('#' + hide).hide();
	var important = GetURLParameter('important');
	$('#' + important).addClass('important');
	function GetURLParameter(sParam) {
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
		for (var i = 0; i < sURLVariables.length; i++) {
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam) {
				return sParameterName[1];
			}
		}
	}
});
