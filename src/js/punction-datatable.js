jQuery(document)
		.ready(
				function($) {
					/**
					 * rowClass
					 * 
					 * @returns
					 */
					function getRowClass(num) {
						switch (num) {
						case '1':
							return 'alert-success';
							break;
						case '2':
							return 'alert-warning';
							break;
						case '3':
							return 'alert-danger';
							break;
						default:
							return '';
						}
					}
					function rowClass(row, kategoriaPacjenta, id) {
						var r = $(row);
						r.attr('id', id);
						var patientClass = getRowClass(kategoriaPacjenta);
						r.addClass('k' + kategoriaPacjenta);
						$('td', row).eq(0).addClass(patientClass);
					}
					/**
					 * init patients table
					 */
					if ($('#patientsTable').length != 0) {
						var table = $('#patientsTable')
								.DataTable(
										{
											// wierszy na stronę
											"iDisplayLength" : 12,
											"paging" : false,
											"scrollY" : "450px",
											"order" : [ [ 1, "asc" ] ], // sort
											language : {
												processing : "Przetwarzanie...",
												search : "Szukaj",
												paginate : {
													first : "Pierwsza strona",
													previous : "Poprzednia",
													next : "Następna",
													last : "Ostatnia strona"
												},
												lengthMenu : "Pokaż _MENU_ pacjentów",
												zeroRecords : "Nie znaleziono pasujących pacjentów",
												"sInfoThousands" : " ",
												info : "Pacjenci od _START_ do _END_ z _TOTAL_ łącznie",
												infoEmpty : "Pacjenci 0 z 0 dostępnych",
												infoFiltered : "(filtrowanie spośród _MAX_ dostępnych pacjentów)",
												infoPostFix : "",
												"sUrl" : "",
												emptyTable : "Brak danych",
												loadingRecords : "Wczytywanie...",
												"oAria" : {
													"sSortAscending" : ": aktywuj, by posortować kolumnę rosnąco",
													"sSortDescending" : ": aktywuj, by posortować kolumnę malejąco"
												}
											},
											data : patientsData,
											columns : patientColumns,
											"columnDefs" : [ {
												"targets" : [ 0 ],
												"visible" : false,
												"searchable" : false
											} ],
											"createdRow" : function(row, data,
													index) {
												/**
												 * css classes id, index,
												 * category
												 */
												rowClass(row,
														data.kategoriaPacjenta,
														data.id);
											}
										});
					}
					/**
					 * datatable search szukaj przeniesione na navbar
					 */
					jQuery("div.dataTables_filter").detach().appendTo(
							'div.form-group#search-navbar');
					/**
					 * datatables pozycji na strone na navbar
					 */
					jQuery("div.dataTables_length").detach().appendTo(
							"div#length-navbar");
					/**
					 * show patients having category between min and max;
					 */
					function filterPatientsByCategory() {
						try {
							var btn = $('.btn-group > .btn[name="patientTypes"].active');
							var data = btn.val().split("-");
							var min = data[0];
							var max = data[1];
							$('#patients-min-category').val(min);
							$('#patients-max-category').val(max);
							var pTable = $('#patientsTable').DataTable();
							pTable.draw(false);
						} catch (e) {
							console.log("table filters:" + e);
						}
					}
					/**
					 * wszystkie / nieksategoryzwane "pacjenty"
					 */
					$('.btn-group > button.btn[name="patientTypes"]').click(
							function() {
								$('.btn-group > .btn[name="patientTypes"]')
										.removeClass("active");
								$(this).addClass("active");
								filterPatientsByCategory();
							});
					/**
					 * filtrowanie kategorii - 0-3 (wszyscy) lub 0-0
					 * (nieksateg.)
					 */
					$.fn.dataTable.ext.search.push(function(settings, data,
							dataIndex) {
						var min = parseInt($('#patients-min-category').val());
						var max = parseInt($('#patients-max-category').val());
						var category = parseInt(data[5]) || 0;
						if ((isNaN(min) && isNaN(max))
								|| (isNaN(min) && category <= max)
								|| (min <= category && isNaN(max))
								|| (min <= category && category <= max)) {
							return true;
						}
						return false;
					});
				});
