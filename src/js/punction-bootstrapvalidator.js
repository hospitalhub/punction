jQuery(document).ready(function($) {
//	$("#patient-save").on('click', function() {
//		alert('validate!');
//	});
	$('#patientForm').submit(function () {

	    // Get the Login Name value and trim it
	    var name = $.trim($('[name="NAME"]').val());
	    var pesel = $.trim($('[name="PESEL"]').val());

	    // Check if empty of not
	    if (name  === '') {
	        alert('Należy wypełnić pole Nazwisko i imię.');
	        return false;
	    }
	    if (pesel.length != 0 && pesel.length != 11) {
	        alert('Nieprawidłowy PESEL.');
	        return false;
	    }
	});
});
