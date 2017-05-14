$(document).ready(function() {
	$('.delete-staff').click( function() {
		const id = $(this).data("id");

		if (confirm('Are you sure you want to delete this item?')) {

            window.location.href = '/staff/'+id+'/delete';
        }
    });
});
