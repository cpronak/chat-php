$(document).ready(function() {
    $('#LiveHelpTab').on('click', function(e) {
		$('#LiveHelpEmbedded').toggleClass("closed"); 
		e.preventDefault();
    });
});