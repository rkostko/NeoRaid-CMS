WYMeditor.editor.prototype.imgDialog = function(imgSrc, tmp) {
  
  var wym = this;
  /*var imgSrc = $(image).attr("src");
  var alt = $(image).attr("title");
  var idx = imgSrc.indexOf('?');
  imgSrc = imgSrc.slice(idx+1);                     
  var tmp = imgSrc.split('&');
  var path;
  $.each(tmp,function(k,v)
  {
        path = v.match(/img=(.+)/);
        if(path != null)
        {
            imgSrc = path[1];
            return;
        }   
  });
  
  tmp = (parseInt(alt) != 0)? alt.split('x') : [0,0];*/

  if(parseInt(tmp[0]) <= 800)
  {
    var width = (parseInt(tmp[0]));
    var height = parseInt(tmp[1]);  
  }
  else
  {
     var width = 800;
     var k = (width*tmp[1])/tmp[0]
     var height = parseInt(k);
  }

  $( "#dialog-modal" ).css({"display":"none"});
  $( "#dialog-modal" ).html('<img src="../galleries/'+imgSrc+'"/>');
  $( "#dialog-modal" ).dialog(
  {
			modal: true,
            resizable: false,
            width: (width+4),
            title:  '<form class="coords dimensions">'
                    +'size:<span class="image_xy">&nbsp;'
                    +tmp[0]+'x'+tmp[1]+'</span>'
                    +'&nbsp;<input type="checkbox" name="cropped" id="cropped"/>cropped:&nbsp;<span class="crop_width"></span>x'
                    +'<span class="crop_height"></span>'
                    +'&nbsp;<input type="checkbox" name="resized" id="resized"/>resized:&nbsp;<span class="image_width"></span>x'
                    +'<span class="image_height"></span>'
                    +'<input type="hidden" />'
                    +'<input type="hidden" />'
                    +'<input type="hidden" />'
                    +'<input type="hidden" />'
                    +'<input type="hidden" />'
                    +'<input type="hidden" />'
                    +'<input type="button" name="submit" value="OK" class="okbutton"/>'
                    +'</form>',
            autoOpen: true,
            open: function(event, ui) 
            {
                  var jrac_plugin = $('.ui-dialog-content img').jrac(
                  {
                          'crop_width': 250,
                          'crop_height': 170,
                          'crop_x': 100,
                          'crop_y': 100,
                          'image_width': width, //tmp[0],
                          'image_height': height, //tmp[1],
                          'viewport_onload': function() 
                                          {
                                            var $viewport = this;
                                            //var inputs = $viewport.$container.parent('.ui-dialog-title').find('.coords input:hidden');
                                            var $form = $viewport.$container.parent().prev().find('.coords');
                                            var inputs =  $form.find('input:hidden');
                                            var okbutton = $form.find('.okbutton').hover( 
                                                                                        function () 
                                                                                        { 
                                                                                            $(this).addClass("okbutton_hover"); 
                                                                                        }, 
                                                                                        function () 
                                                                                        { 
                                                                                            $(this).removeClass("okbutton_hover"); 
                                                                                        } 
                                                                                    ).click(function()
                                                                                            {
                                                                                                var newSize = $(this).parent();
                                                                                                ResizeCrop(newSize);    
                                                                                            }
                                                                                    );
                                            var events = ['crop_x','crop_y','crop_width','crop_height','image_width','image_height'];
                                            for (var i = 0; i < events.length; i++) {
                                              var event_name = events[i];
                                              // Register an event with an element.
                                              $viewport.observator.register(event_name, inputs.eq(i));
                                              // Attach a handler to that event for the element.
                                              inputs.eq(i).bind(event_name, function(event, $viewport, value) {
                                                $(this).val(value);
                                              }).attr("name", event_name);
                                            }
                                            $viewport.$container.parent('.ui-dialog-content').find('.jrac_viewport').width(width);
                                            $viewport.$container.parent('.ui-dialog-content').find('.jrac_viewport').height(height);
                                          }
                   }).bind('viewport_events', function(event, $viewport) {
                      var inputs = $(this).parents('.ui-dialog-content').find('.coords input');
                      inputs.css('background-color',($viewport.observator.crop_consistent())?'chartreuse':'salmon');
                    });// React on all viewport events.

                    $(this).css({padding: "0px 0px"});
                                
            }, 
            beforeclose: function(event, ui) {
                //jrac_plugin = null;
                //alert("here");
                //return false;
            } 
            
  })
  .height("auto"); 
  
  function ResizeCrop(newSize)
  {
    var params = [];
    
    params.push(parseInt($('input:hidden[name="image_width"]').val()));
    params.push(parseInt($('input:hidden[name="image_height"]').val()));    

    if($('input:checkbox[name="cropped"]:checked').val() == 'on')
    {
       params.push(parseInt($('input:hidden[name="crop_x"]').val()));
       params.push(parseInt($('input:hidden[name="crop_y"]').val()));
       params.push(parseInt($('input:hidden[name="crop_width"]').val()));
       params.push(parseInt($('input:hidden[name="crop_height"]').val())); 
    }
    params = (params.length > 0)? params.join(',') : '';
    var img_arr = imgSrc.split(".");
    imgSrc = img_arr[0]+","+params+"."+img_arr[1];
    wym.insertAtCaret('<img src="image.php?img='+imgSrc+'" style="clear:both" alt="Zdjęcie"/>');
    $( "#dialog-modal" ).dialog('close');
  }
   
};