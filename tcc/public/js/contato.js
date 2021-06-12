var submitButton = document.getElementById("submit_form");
var form = document.getElementById("email_form");
form.addEventListener("submit", function(e) {
setTimeout(function() {
	submitButton.value = "Enviando...";
	submitButton.disabled = true;
	swal("Sucesso!", "E-mail Enviado com sucesso!", "success");
	$(".swal2-confirm").on('click', function(){
		window.location.href = BASE_URL + "restrict";
});
}, 1);

});