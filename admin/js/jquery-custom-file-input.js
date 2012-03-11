jQuery.fn.choose = function(f) {
	$(this).bind('choose', f);
};


jQuery.fn.file = function() {
	return this.each(function() {
		var btn = $(this);
		var pos = btn.offset();							
		function update() {
			pos = btn.offset();
			file.css({
				'top': pos.top,
				'left': pos.left,
				'width': btn.width(),
				'height': btn.height()
			});
			
		}

		btn.mouseover(update);
		/*var hidden = $('<div></div>').css({
			'display': 'none'
		}).appendTo('body');*/

    		var file = $('<div id="upload-container"><form name="uploader" id="uploader" method="post" enctype="multipart/form-data" target="jquery_upload"></form></div>').appendTo('body').css({
    			'position': 'absolute',
    			'overflow': 'hidden',
    			'-moz-opacity': '0',
    			'filter':  'alpha(opacity: 0)',
    			'opacity': '0',
    			'z-index': '2',
    		});

        
 
		  var iframe = $('<iframe name="jquery_upload" id="jquery_upload" style="position:absolute;top:-9999px; width:1px; height:1px" />').appendTo('body');

		var form = file.find('form');
		form.attr('action', 'upload.php');
		var input = form.find('input');
		
		function reset() {
			var input = $('<input type="file" name="file" id="file1"/>').appendTo(form);
			input.change(function(e) {
			//alert(btn.attr("rel"));
			var directory = btn.attr("rel");
			var hidden = $('<input type="hidden" name="gallery" id="gallery" value="'+directory+'"/>').appendTo(form);
			//$("#gallery").val()= btn.attr("rel");
				goSubmit();	
				input.unbind();
				input.detach();
				btn.trigger('choose', [input]);
				reset();
			});
		};
		
		reset();

		function goSubmit()
		{
			
			form.submit();
		}
		
		
		function placer(e) {
			form.css('margin-left', e.pageX - pos.left - offset.width);
			form.css('margin-top', e.pageY - pos.top - offset.height + 3);
			
		}

		function redirect(name) {
			file[name](function(e) {
				btn.trigger(name);
			});
		}

		file.mousemove(placer);
		btn.mousemove(placer);

		redirect('mouseover');
		redirect('mouseout');
		redirect('mousedown');
		redirect('mouseup');

		var offset = {
			width: file.width() - 25,
			height: file.height() / 2
		};

		//update();
	});
};