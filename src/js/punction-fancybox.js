jQuery(document).ready(
		function($) {
			/**
			 * CLEAR FORM
			 */
			function clearForm() {
				$('#patients_form_ajax input:radio').attr('checked', false);
			}
			/**
			 * checks the radio
			 */
			function formCheckRadio(selector) {
				try {
					$(selector).attr('checked', true);
				} catch (ex) {
				}
			}
			/**
			 * set sum of category
			 */
			function updateCategorySum() {
				// 3 categories
				var categories = [];
				for (i = 1; i <= 3; i++) {
					categories[i] = $('#patients_form_ajax input[value=' + i
							+ ']:checked').length;
					$("#punction_c" + i).html(categories[i]);
				}
				// algorithm: patient category
				if (categories[3] <= 1) {
					return categories[2] > 2 ? 2 : 1;
				} else if (categories[3] == 2) {
					return 2;
				} else if (categories[3] > 2) {
					return 3;
				}
			}
			/**
			 * progress bar
			 */
			function progress() {
				var checked = $('#patients_form_ajax input:checked').length;
				var labels = $('#patients_form_ajax .btn-group').length;
				var percentage = checked * 100 / labels;
				$("div#progress").attr('aria-valuenow', percentage);
				$("div#progress").css('width', percentage + "%");
				var patientCategory = updateCategorySum();
				$("#punction_pc").html(patientCategory);
			}
			/**
			 * updates progress and scrolls patient form upon click
			 */
			$('#patients_form_ajax input').on('click', function(event) {
				progress();
			});
			/**
			 * sets name and pesel and hidden id
			 */
			function formFillBasicData(name, pesel, id, rowIndex) {
				$("#patient-name").html(name + " (" + pesel + ")");
				$("#patient-id").val(id);
				$("#rowIndex").val(rowIndex);
			}
			/**
			 * does what it should do (AM ;))
			 */
			function capitaliseFirstLetter(string) {
				return string.charAt(0).toUpperCase() + string.slice(1);
			}
			/**
			 * runs through categories radios and checks
			 */
			function formFillCategories(aData) {
				for ( var name in aData) {
					var categoryValue = aData[name];
					var selector = "input[id=" + capitaliseFirstLetter(name)
							+ categoryValue + "]:radio";
					formCheckRadio(selector);
				}
				progress();
			}
			/**
			 * fills forms with values from table
			 */
			function fillForm(td) {
				var aPos = $('#patientsTable').dataTable().fnGetPosition(td);
				var idx = aPos[0];
				var aData = $('#patientsTable').dataTable().fnGetData(idx);
				formFillBasicData(aData.name, aData.pesel, aData.id, idx);
				formFillCategories(aData);
			}
			/**
			 * click na wierszu otwiera fancybox i wypełnia dane
			 */
			$("#patientsTable tbody td").live('click', function() {
				$.fancybox({
					minWidth : 750,
					minHeight : 500,
					scrolling : 'no',
					fitToView : true,
					autoSize : false,
					openEffect : 'elastic',
					closeEffect : 'elastic',
					href : "#patients_form_ajax",
				}); // fancybox
				clearForm();
				fillForm(this);
			});
		});
