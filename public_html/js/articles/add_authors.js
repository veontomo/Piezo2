$(document).ready(function(){
	var lineCounter = $('#authors .control-group').length; // start counting with the current number of authors
	$('.delete_author').click(function(){
		$(this).parent().remove();
	})
	$('<div id="addNewAuthor"><img src="images/general/add_author.png" alt="add author" /></div>').insertAfter('#authors label');
	$('#addNewAuthor').click(function(){
		$('#authors').append(
			'<div class="control-group"><input placeholder="name" name="Authors[' + lineCounter + '][name]" \
			id="Authors_' + lineCounter + '_name" type="date">\
			<input placeholder="surname" name="Authors[' + lineCounter + '][surname]" \
			id="Authors_' + lineCounter + '_surname" type="date">\
			<div class="delete_author"><img src="images/general/delete_author.png" /></div></div>');
		lineCounter++;
		$('.delete_author').click(function(){
			$(this).parent().remove();
		})
	})
})