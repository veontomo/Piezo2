$(document).ready(function(){
	var lineCounter = 1;
	$('<div id="addNewAuthor">add new author</div>').insertAfter('#authors');
	$('#addNewAuthor').click(function(){
		$('#authors').append(
			'<div class="control-group"><input placeholder="name" name="Authors[' + lineCounter + '][name]" \
			id="Authors_' + lineCounter + '_name" type="date">\
			<input placeholder="surname" name="Authors[' + lineCounter + '][surname]" \
			id="Authors_' + lineCounter + '_surname" type="date"></div>');
		lineCounter++;
	})
})