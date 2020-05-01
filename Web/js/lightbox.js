

function gradient(id, level)
{
	var box = document.getElementById(id);
	box.style.opacity = level;
	box.style.MozOpacity = level;
	box.style.KhtmlOpacity = level;
	box.style.filter = "alpha(opacity=" + level * 100 + ")";
	box.style.display="block";
	return;
}


function fadein(id) 
{

gradient(id,1);
setTimeout(function(){$("#"+id).addClass("muestraLight");},10);
}


// Open the lightbox

// Close the lightbox

function closebox(id)
{
$("#"+id).removeClass("muestraLight");
   document.getElementById(id).style.display='none';
   document.getElementById('shadowing').style.display='none';
}
