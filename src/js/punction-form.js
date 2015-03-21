jQuery(document).ready(function($) {
	/**
	 * update class
	 */
	function setRowClass(id, category) {
		try {
			var className = $("tr#" + id).attr('class');
			className = className.replace(/k[0-3]/g, 'k' + category);
			$("tr#" + id).attr('class', className);
			$("tr#" + id + '>td:nth-of-type(1)').attr('class', getRowClass(category));
		} catch (e) {
			console.log("setRowClass function:" + e);
		}
	}
	/**
	 */
	function setRow(table, patient) {
		try {
			var row = table.row("tr#" + patient.id);
			row.data(patient);
		} catch (e) {
			console.log("setRow function:" + e);
		}
		setRowClass(patient.id, patient.kategoriaPacjenta);
	}
	/**
	 * updates datatable with values received from server
	 */
	function updateTable(response) {
		var pTable = $('#patientsTable').DataTable();
		var patient = JSON.parse(response);
		// setRow
		try {
			setRow(pTable, patient);
		} catch (e) {
			console.log("setRow:" + e);
		}
		// update filters
		$('.btn-group > button[name="patientTypes"].btn.active').click();
	}

	/**
	 * removes <tags> from text
	 */
	function stripTags(text) {
		return $("<html>" + text + "</html>").text();
	}
	/**
	 * ajax: sends patient form to server
	 */
	function postPatient(data) {
		try {
			// implementations
			jQuery.post('admin-ajax.php', data, function(response) {
				try {
					var message = stripTags(response);
					console.log('RESPONSE: ' + message);
					updateTable(response);
					close_fancybox();
				} catch (err) {
					console.log("ERR: " + err);
				}
			});
		} catch (err) {
			console.log("ERR: " + err);
		}
	}
	/**
	 * reads each radio input from patients form and stringifies it
	 */
	function readForm() {
		var patient = {};
		patient['id'] = $('#patient-id').val().replace("\n", "");
		$('#patients_form_ajax input:checked').each(function() {
			var index = $(this).attr('name');
			var value = $(this).attr('value');
			patient[index] = value;
		});
		patient['kategoriaPacjenta'] = $('#punction_pc').html();
		patient['typ'] = wardType;
		var resultString = JSON.stringify(patient);
		console.log('CATEGORIES: ' + resultString);
		return resultString;
	}
	/**
	 * action: clicking on save button in patients form
	 */
	$("#save").on('click', function() {
		var data = {
			'action' : 'my_action',
			'data' : readForm()
		};
		postPatient(data);
	});
	/**
	 * closes patients form
	 */
	function close_fancybox() {
		$.fancybox.close();
	}
	/**
	 * sets the timeout to close patients form
	 */
	setTimeout(close_fancybox, 150);
	/**
	 * dalej
	 */
	$("#forward").click(function() {
		formNextPage();
	});
});
