$(document).ready(function(){
	var caret = $('.dropdown-toggle');
	var drop_menu = $('.dropdown');
	caret.on('click', function() {
		if (!drop_menu.hasClass('open')) {
			drop_menu.addClass('open');
		} else {
			drop_menu.removeClass('open');
		}
	});
});