/*
Template Name: STUDIO - Responsive Bootstrap 4 Admin Template
Version: 1.0.0
Author: Sean Ngu
Website: http://www.seantheme.com/studio/
*/

var handleRenderTableData = function() {
	$('#datatableDefault').DataTable({
		dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-right'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'mr-auto'i><'mb-0'p>>",
		lengthMenu: [ 10, 20, 30, 40, 50 ],
		responsive: true,
		buttons: [
			{ extend: 'print', className: 'btn btn-default' },
			{ extend: 'csv', className: 'btn btn-default' }
		]
	});
};


/* Controller
------------------------------------------------ */
$(document).ready(function() {
	handleRenderTableData();
});