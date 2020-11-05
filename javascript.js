function ClearUrl(url) { // törli az URL paramétereit
	if (typeof window.history.pushState == 'function') {
		window.history.pushState({}, "Hide", url);
	}
}



function PageReload() {
	location.reload()
}



$(document).ready(function(){
	$("#myInput").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#myTable tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});