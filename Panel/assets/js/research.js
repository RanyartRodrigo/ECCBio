function toDelete( id,  msg)
{
	//alert(id +" "+msg);
	$(".target").val(id);
	$(".deleteMessage").html(msg);
	
}

function showhideDisplayProject(id){

	 if($("#isdisplayProject-"+id).val()==0){	  
	  	$("#displayProject-"+id).hide();
		$("#nodisplayProject-"+id).show();
		$("#projectName-"+id).addClass("disabled");
	 }
	  else{
	  	$("#displayProject-"+id).show();
		$("#nodisplayProject-"+id).hide();
		$("#projectName-"+id).removeClass("disabled");
	  }	
	 
}

function updateDisplayResearcharea(id, display){
		
	  $.ajax({
          url: 'admin.php?page=research-edit-display&type=researcharea&id='+id+'&display='+display,
          type: 'GET',
          success: function(data) {
			   if(data.error==false){
				  // alert(data.msg);
				    if(display==0)
				   	$( "#panel-"+id ).addClass( "disabled" );
					
					else
					$( "#panel-"+id ).removeClass( "disabled" );
					
					$("#isdisplayRA-"+id).val(display);
			   }
			   else
			   {
				   	 alert(data.msg);
			   }
           
          },
          error: function(jqXHR, textStatus, error) {
            alert( "error: " + jqXHR.responseText);
          }
        });
}	

function updateDisplayProject(id, display){
		
	  $.ajax({
          url: 'admin.php?page=research-edit-display&type=project&id='+id+'&display='+display,
          type: 'GET',
          success: function(data) {
			   if(data.error==false){
				//   alert(data.msg);
				   $("#isdisplayProject-"+id).val(display);
					showhideDisplayProject(id);
				  
			   }
			   else
			   {					
			  
				   	 alert(data.msg);
			   }
           
          },
          error: function(jqXHR, textStatus, error) {
            alert( "error: " + jqXHR.responseText);
          }
        });
}	

$(function() {
	
		//Initializing vivible on/off
	 $($("[id^='isdisplayProject-']").each(function() {
  		 var end=$(this).attr('id').replace('isdisplayProject-','');
		 showhideDisplayProject(end);
		 
	 }));
	 
	 $($("[id^='isdisplayRA-']").each(function() {
  		 var end=$(this).attr('id').replace('isdisplayRA-','');
		 if( $(this).val()=="1")
		{ $('#displayRA-'+end).bootstrapToggle('on');
		}
		 else
		 {	 $('#displayRA-'+end).bootstrapToggle('off');
		 	$( "#panel-"+end ).addClass( "disabled" );
		 }
		 
	 }));
	
	
	//Change visibility functions
	$("[id^='displayProject-']").click(function() {
		 var end=$(this).attr('id').replace('displayProject-','');
		updateDisplayProject(end, "0");
	
    });
	
	$("[id^='nodisplayProject-']").click(function() {
	   var end=$(this).attr('id').replace('nodisplayProject-','');
		updateDisplayProject(end, "1");
	
    })
	
		
	 $("[id^='displayRA-']").change(function() {
		 var end=$(this).attr('id').replace('displayRA-','');
		 var display=0;
		 if( $(this).prop('checked'))
			 display=1;
		updateDisplayResearcharea(end, display)
      
    });
	
  })
  

