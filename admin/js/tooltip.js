
this.tooltip = function(){	
	/* CONFIG */		
		xOffset = 10;
		yOffset = 20;
		width = 156;
		height = 36;
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("span.text").hover(
    function(e){											  
		//this.t = this.title;
		//this.title = "";
        if($(this).parent().attr('rel') == '' || $(this).parent().attr('rel') == undefined)
        {

		//if($(this).parent().attr('class') == 'doc' || $(this).parent().attr('class') == 'doc-last')
		//{
			var id = $(this).parent().attr('id');
		    var string = 'id='+id;
		    var thumb = '';
		    $.post("tooltip.php", string, function(responce)
			{ 
			    if(responce != 0)
			    {
			    	thumb = '<img src="showtooltip.php?img=top/'+responce+'&width='+width+'&height='+height+'&quality=60" width="'+width+'" height="'+height+'"/>';
					$("body").append("<div id='tooltip'>"+thumb+"</div>");
					$("#tooltip")
						.css("top",(e.pageY - xOffset) + "px")
						.css("left",(e.pageX + yOffset) + "px")
						.fadeIn("fast");
			    }
			});
        }	
    },
	function(){
		//this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("span.text").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};



// starting the script on page load
/*$(document).ready(function(){
	tooltip();
});*/