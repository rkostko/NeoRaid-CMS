function delImg(obj)
{
// var this = obj;
    var imgContainer = $(obj).parent();
    var id = $(obj).attr("id").match(/(.+)[-=_](.+)/);
    var string = 'id='+ id[2];
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: string,
            cache: false,
            success: function(responce)
            {
                imgContainer.remove();
                $("#contentLeft ul.thumbnails").sortable("refresh");
            }
        });
}

function hideImg(obj)
{
    var imgContainer = $(obj).parent();
    var id = $(obj).attr("id").match(/(.+)[-=_](.+)/);
    var string = 'id='+ id[2];
    var img = $(obj);
    
    var src = ($(obj).attr("src") == "stop.png")? "show.png" : "stop.png";
    var opacity = ($(obj).attr("src") == "stop.png")? 0.25 : 1.0;
    var rel = ($(obj).attr("src") == "stop.png")? "stop" : "show";
    string += ($(obj).attr("src") == "stop.png")? "&action=hide" : "&action=show"; 

    $.ajax({
       type: "POST",
       url: "hide_show.php",
       data: string,
       cache: false,
       success: function(responce)
       {
    	    var img_id = '#pic_'+id[2];
    	    $(img_id).attr("rel", rel);
    	   
    	   
    	    if($(img_id).attr("rel") == "stop")
    	    {
    			$(img_id).css({ "opacity" : 0.25 });
    			$(img_id).hover(function()
    				{
    					$(img_id).css({ "opacity" : 1.0 });
    				},
    				function()
    				{
    					$(img_id).css({ "opacity" : 0.25 });
    				}
    			);
    	    }
    	    else
    	    {
    			$(img_id).css({ "opacity" : 1.0 });
    			$(img_id).hover(function()
    				{
    					$(img_id).css({ "opacity" : 1.0 });
    				},
    				function()
    				{
    					$(img_id).css({ "opacity" : 1.0 });
    				}
    			);
    		} 
    		img.attr("src", src);
      }
    });
}

function insertImg(obj, dim)
{
    obj.src = 'inserted.png';
    var id = $(obj).attr("id").match(/(insert)[-=_](\d+)/);
    id = id[2];
    var thumb = {};   
    var imgSrc = $('#pic_'+id).attr('src');
    var idx = imgSrc.indexOf('?');
    imgSrc = imgSrc.slice(idx+1);
    
    var tmp = imgSrc.split('&');
    var w = 0;
    var h = 0;
    $.each(tmp,function(k,v)
    {
        var path = v.match(/img=(.+)/);
        if(path != null)
        {
            for(var i=0; i<insertArr.length; i++)
            {
                if(insertArr[i].id == id) return;    
            }
            thumb.id = id;
            thumb.url = path[1];
            thumb.alt = dim;
            //insertArr.push({id:id, url:path[1], alt:dim});
            insertArr.push(thumb);
            insertOnDemand(thumb)
            return;
        }    
    });
}

function insertOnDemand(thumb)
{    
    var wym_box = $("#tabs-2").find(".wym_box");
    var imageContainer = $(wym_box).find($("#mycarousel"));
    
    if(typeof imageContainer == "object")
    {
        if($(imageContainer).has("ul").length == false)
        {
            $('<ul style="width:107px; height:150px; overflow:auto;"></ul>').appendTo($(imageContainer));
        }
        var image = document.createElement('img');
        $(image).attr("src", "showthumb.php?img="+thumb.url+"&width=100&height=75&quality=50");
        $(image).attr("id", "s_"+thumb.id);
        $(image).attr("title", thumb.alt);
        $(image).wrap('<li></li>');           
        $(imageContainer).find("ul").append($(image));
        
        tmp = (parseInt(thumb.alt) != 0)? thumb.alt.split('x') : [0,0];                                                        
        var instance = WYMeditor.INSTANCES[0];
        $(image).bind(
        {
            click: function()
            {
                instance.insertAtCaret('<img src="image.php?img='+thumb.url+'" width="'+tmp[0]+'" style="clear:both" height="'+tmp[1]+'" alt="Zdjęcie"/>');
                return false;
            },
            contextmenu: function(e)
            {
                instance.imgDialog(thumb.url, tmp);
                return false;
            }
        }); 
    }                      
}

function clickOnTree(id)
{
    $('span:first', $("#"+id)).click();
    return false;
}


$(document).ready(function()
{ 
    if ($('#upload-container').length > 0)
    {
        $('#upload-container').remove();
    }
    if ($('#jquery_upload').length > 0)
    {
        $('#jquery_upload').remove();
    }
    
    $("input[name=default]").click(function()
	{
        var img_id = $("input[name=default]:checked").val();
        var string = 'id='+img_id;	
		$.post("default.php", string, function(responce)
		{ 
		    return;
		});
	});
					 
	if(_images_dir_ != 'top')
	{
	   $(function() 
		          {
					$("#contentLeft ul.thumbnails").sortable({ 
                                                    opacity: 0.6, 
                                                    cursor: 'move', 
                                                    update: function()
                                					{
                                						alert("here");
                                						var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
                                						$.post("imagesort.php", order, function(theResponse)
                                						{
                                							$("#contentRight").html(theResponse);
                                						});
                                					}
                                                });
				   });
	}
	else 
	{
		$("img[id^='drop_']").each(function() 
		{ 
			$(this).draggable({
    							  cursor: "move",
    							  cursorAt: { top: -12, left: -20 },
    							  helper: function( event ) 
                                  {
    							  	return $("<div class='ui-widget-header'>przypisz</div>");
    							  }
                              });
		});
		tooltip();
	}
						 
						 
						 
	$("img[id^='pic_']").each(function() 
	{ 
		if($(this).attr("rel") == "stop")
		{
			$(this).css({ "opacity" : 0.25 });
			$(this).hover(
                        function()
            			{
            			    $(this).css({ "opacity" : 1.0 });
            			},
            			function()
            			{
            			    $(this).css({ "opacity" : 0.25 });
            			});
		} 
	});
    
                        
	var uploader = '<li class="sig_cont" style="border: medium none; background: transparent url(upload.png) no-repeat; width:152px; height:120px; overflow:hidden;">'
    +'<div id="file-uploader" rel="'+_images_dir_+'"></div>'
    +'</li>';	
	$(uploader).appendTo("#contentLeft ul.thumbnails");
    
    $("img[id^='unlink_']").each(function()
    {
        $(this).click(function()
        {
            var obj = this;
            var id = $(obj).attr("id").match(/(unlink)[-=_](\d+)/);
            id = id[2];
            unlinkArticle(id);
        });
        
    });
    
    $("img[id^='viewedit_']").each(function()
    {
        $(this).click(function()
        {
            var obj = this;
            var id = $(obj).attr("id").match(/(viewedit)[-=_](\d+)/);
            id = id[2];
            $('span:first', $("#"+id)).click();
            return false;
        });
        
    });
    
    if(linked != false) setLinked(linked);                    
});

function setLinked(id)
{    
    if($("#articleContainer").children().length == 0)
    {

        if(id != undefined)
        {
            var link = '<div class="articons" style="float:left;clear:both;"><img class="common_icons blinking" src="link.png"/></div><br/>';
            $("#articleContainer").append(link);
            //setInterval(function(){$('.blinking').toggle();},500);
            //alert(id);
            $(".articons").click(function()
            {
                $.ajax({
                        type: "POST",
                        url: "get_article.php",
                        data: "id="+id,
                        cache: false,
                        success: function(responce)
                        {
                            $(".articons").empty();
                            loadAdditinalCSS('articles');
                            var unlink = document.createElement('img');
                            $(unlink).attr("src", "unlink.png");
                            $(unlink).attr("id", "unlink_"+id);
                            $(unlink).attr("alt", "Unlink");
                            $(unlink).attr("class", "common_icons");
                            $(unlink).click(function()
                            {
                                unlinkArticle(id);
                            });
                            $(".articons").append($(unlink));
                            var viewedit = document.createElement('img');
                            $(viewedit).attr("src", "view_edit.png");
                            $(viewedit).attr("id", "viewedit_"+id);
                            $(viewedit).attr("alt", "View/Edit");
                            $(viewedit).attr("class", "common_icons");
                            $(viewedit).click(function()
                            {
                                $('span:first', $("#"+id)).click();
                                return false;
                            });
                            $(".articons").append($(viewedit));
                            $("#articleContainer").append(responce);
                        }
                });
            }); 
        }
    }
}
 
$("#file-uploader").file().choose(function(e, input)
                            {
                                return;
                            });  

function unlinkArticle(id)
{
    alert("unlink function");    
    
}

function loadAdditinalCSS(typeOfContent)
{
    var css_path ='../css/'+typeOfContent+'.css';
    if($('head > link[href$="'+css_path+'"]').length == 0)
    {
       $('<link>').attr('rel','stylesheet')
          .attr('type','text/css')
          .attr('href',css_path)
          .appendTo('head');  
    }    
}



				    
/// show just uploaded image in gallery view
function showThumb(data)
{
    var obj = $.parseJSON(data);
	var html = '<li class="sig_cont" id="image_'+obj.id+'">';
	html += '<div id="div">';
	html += '<a rel="lightbox[sig0]" href="'+obj.path+'/'+obj.gallery+'/'+obj.filename+'">';
	html += '<img src="showthumb.php?img='+obj.gallery+'/'+obj.filename+'&width=150&height=100&quality=80" width="150" height="100"  rel="show"/>';
	html += '</a>';
	html += '</div>';
	html += '<img onclick="hideImg(this)" id="hid_'+obj.id+'" class="hide" src="stop.png" alt="Usuń" style="float:left; margin:3px"/>';
					        
	if(_images_dir_ == 'top')
	{
		html += '<input type="radio" name="default" value="'+obj.id+'"/><label style=\"color: #ff0000\" for=\"default\">domyslny</label>';
	}

	html += '<img onclick="delImg(this)" id="del_'+obj.id+'" class="delete" src="cross.png" alt="Usuń" style="float:right; margin:3px"/>';
	html += '</li>';
	//var img = $(html).appendTo("#contentLeft ul");
    var img = $(html).insertBefore("#contentLeft ul > li:last-child");
						
	$("#contentLeft ul.thumbnails").sortable("refresh");		
}

