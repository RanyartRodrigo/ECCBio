$(document).ready(function(){
	console.log("Script loadedd");
	$('#fileUploadSubmit').hide();
	$(document).on('change', '.btn-file :file', function() {
		console.log("wnteo jaja");
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			console.log(label);
			$('#filename').val(label);
		if(label==""){
			$('#fileUploadSubmit').hide();
		}else{
			$('#fileUploadSubmit').show();
		}
	});
	

	
});
function fileUploadFunction(){
	
	var file_data = $('#fileToUpload').prop('files')[0];
	var fileName = $('#fileToUpload').prop('files')[0].name; 
	
	var form_data = new FormData();                  
	form_data.append('file', file_data);
	//console.log("here");
	$.ajax({
		url: 'assets/bibtex/upload_bibtex.php', // point to server-side PHP script 
		dataType: 'text',  // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'post',
		success: function(php_script_response){
			//alert(php_script_response); // display response from the PHP script, if any
			if(php_script_response==1){
				
				mssg="<div class=\"alert alert-warning alert-dismissible\">"+
										"<span class=\"close\" data-dismiss=\"alert\">&times;</span>"+
										"	No es un archivo bibtex. Revise que la extensión sea .bib "+
										"</div>";
				
				$("#alertBibtex").html(mssg);
			}else{
				if(php_script_response==2){
					mssg="<div class=\"alert alert-warning alert-dismissible\">"+
										"<span class=\"close\" data-dismiss=\"alert\">&times;</span>"+
										"	Ha ocurrido un problema al cargar el archivo. Contacte al administrador del sitio. "+
										"</div>";
					$("#alertBibtex").html(mssg);
				}else{
					//alert("Ok: "+php_script_response);
					mssg="<div class=\"alert alert-info alert-dismissible\">"+
										"<span class=\"close\" data-dismiss=\"alert\">&times;</span>"+
										"	Se han agregado las entradas del archivo bibtex. "+$("#replace").prop('checked')+
										"</div>";
					$("#alertBibtex").html(mssg);
					
					if( $("#replace").prop('checked') === true){
						
						$("#editorT-publications").trumbowyg('html', php_script_response);
						$('#usermeta-publications').text(php_script_response);
					}
					else
					{
						
						var formerText=$('#usermeta-publications').text();
						$("#editorT-publications").trumbowyg('html', formerText+"<br>"+php_script_response);
						$('#usermeta-publications').text(formerText+"<br>"+php_script_response);
					}
					
					
					setTimeout(function(){
						$("#bibtexModal").modal('hide');
						$('#replace').bootstrapToggle('off');
					}, 500);
					 
	
				}
			}
			
		},
		error: function(php_script_response, textStatus, errorThrown){
			//alert(php_script_response);
			console.log("Status: " + textStatus); 
			console.log("Error: " + errorThrown);
		}
	});
	

}

 
