jQuery(document).ready(function($) {
	$('.datepicker').datepicker({
		format : 'yyyy-mm-dd',
		language : "pl",
		"autoclose" : true,
		"todayHighlight" : true,
		startDate : '-7d',
		endDate : new Date()
	});
});
