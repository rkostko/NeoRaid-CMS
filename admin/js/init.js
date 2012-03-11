// JavaScript Document
/********************************************
* 	Filename:	js/init.js
*	Author:		Ahmet Oguz Mermerkaya
*	E-mail:		ahmetmermerkaya@hotmail.com
*	Begin:		Sunday, April 20, 2008  16:22
***********************************************/

	
/**
 * initialization script 
 */
var langManager = new languageManager();
//de for german
//en for english
//tr for turkish
langManager.load("pl");  
var linked = false;
var treeOps = new TreeOperations();
$(document).ready(function() {

	// binding menu functions
    $('#myMenu1 .addDoc2').click(function()  {  treeOps.addElementReq(false, 'articles'); });
    
	$('#myMenu1 .addDoc').click(function()  {  treeOps.addElementReq(false, 'galleries'); });
	$('#myMenu1 .addFolder').click(function()  {  treeOps.addElementReq(true, null); });
$('#myMenu1 .hide, #myMenu2 .hide').click(function() {  treeOps.hideElementReq(); });
	$('#myMenu1 .edit, #myMenu2 .edit').click(function() {  treeOps.updateElementNameReq(); });
	$('#myMenu1 .delete, #myMenu2 .delete').click(function() {  treeOps.deleteElementReq(); });
	$('#myMenu1 .expandAll').click(function (){ treeOps.expandAll($('.simpleTree > .root > ul')); });
	$('#myMenu1 .collapseAll').click(function (){ treeOps.collapseAll(); });
	
	
	// setting menu texts 
	$('#myMenu1 .addDoc').append(langManager.addDocMenu);
    $('#myMenu1 .addDoc2').append(langManager.addDoc2Menu);
	$('#myMenu1 .addFolder').append(langManager.addFolderMenu);
    $('#myMenu1 .hide, #myMenu2 .hide').append(langManager.hideMenu);
	$('#myMenu1 .edit, #myMenu2 .edit').append(langManager.editMenu);
	$('#myMenu1 .delete, #myMenu2 .delete').append(langManager.deleteMenu);
	$('#myMenu1 .expandAll').append(langManager.expandAll);
	$('#myMenu1 .collapseAll').append(langManager.collapseAll);
	
		
	// initialization of tree
	simpleTree = $('.simpleTree').simpleTree(
    {
		autoclose: false,
		/**
		 * restore tree state according the cookies it stored.
		 */
		restoreTreeState: true,

		/**
		 * Callback function is called when one item is clicked
		 */	
		afterClick:function(node)
        {
//alert($('span:first', node).text() + " clicked");
//alert($('span:first',node).parent().attr('id')+":"+$('span:first',node).parent().attr('class'));
			if($('span:first',node).parent().attr('class') == 'doc' || $('span:first',node).parent().attr('class') == 'doc-last')
			{
//alert($('span:first',node).parent().attr('rel'));	
			if($('span:first',node).parent().attr('rel') == undefined)
			{
				$('span:first',node).parent().attr('rel', 'galleries');
			}
            
            var recordId = $('span:first',node).parent().attr('id');
            
			$.ajax(
            {
			    type: "POST",
			    async: false,
			    url: $('span:first',node).parent().attr('id')+","+$('span:first',node).parent().attr('rel')+"_view.php",
			    success: function(html)
                {
                    var index = 0;  
                	$("#tabs > ul > li").each(function()
                    {
                       index = $(this).children('a').attr("href").match(/(.+)[-=_](\d+)/);
                       index = parseInt(index[2]);
                       if($('span:first',node).parent().attr('rel') == $(this).children('a').attr("rel"))
                       {
                            return false;
                       }    
                    });
          
       
                     //var tabs = "#tabs-"+index;
					 $("#tabs-"+index).html(html);
                     index = index-1;
					 var window_width = $(window).width();
					 var info_width = "100%";
                     var width = "100%";
                     setTimeout(function()
                     {
                    	 $("#info").width(info_width);
                    	 $("#tabs").width(width);
                    	 $("#contentLeft").width(width);
                    	 $("#tabs").tabs({ selected: index });
	                     //$(".ui-sortable").width(width);
            		     var typeOfContent = $('span:first',node).parent().attr('rel');
                         
                         var css_path ='../css/'+typeOfContent+'.css';
                         if($('head > link[href$="'+css_path+'"]').length == 0)
                         {
                               $('<link>').appendTo('head')
                                  .attr('type','text/css')
                                  .attr('rel','stylesheet')
                                  .attr('href',css_path);
                                    
                         }

                         if(typeOfContent == 'articles')
                         {
//alert($("#tabs-"+(index+1)+":first").get(0));
//alert(recordId);

                            var article_body =$("div:first", $("#tabs-"+(index+1))).get(0);
                            $(article_body).attr("id", typeOfContent+'_'+recordId);
                            $(article_body).addClass("rte_1");
                            $('div[class*="rte"]').each(function()
                            {
                                var class_id = $(this).attr("class").match(/rte[-=_]?\d+/);
                                if(class_id != null)
                                {
                                    var edit = $('<div rel="'+class_id+'" class="rte-edit"></div>').click(function()
                                    {
                                        $(edit).hide();
                                        $(function()
                                        { 
                                           $('.'+class_id).wymeditor(
                                           {          
                                                skin: 'compact',
                                                /*stylesheet: '../css/articles.css',*/
                                                
                                                classesItems: [
                                    	            {'name': 'city', 'title': 'SPAN: City', 'expr': 'span'},
                                                    {'name': 'centered', 'title': 'IMG: Centered', 'expr': 'img'}
                                    	        ],
	
                                    	        editorStyles: [
                                    	            {'name': '.city', 'css': 'border: 2px solid #ccc;'},
                                                    {'name': '.centered', 'css': 'border: 2px solid #cc0000; text-align: center'}
                                    	        ],
                                                
                                                postInit: function(wym)
                                                {
                                                    var position =$(wym._box).find("iframe").position(); 
                                                    var position_tabs =$("#info").position();  
                                                    $(wym._box).find("iframe").height($(window).height() - position_tabs.top - position.top - 40);
   
                                                    wym.ExtraButtons(edit);
                                   	                wym.hovertools();
 
                                                    if(insertArr.length > 0)
                                                    {
                                                        wym.imgDropdown(insertArr);   
                                                    }          
                                                }    
                                            });  
                                        });       
                                    });
                                    
                                    $(edit).insertBefore($(this));     
                                }
                            });
                         }
                         if(typeOfContent == 'galleries' || typeOfContent == 'top')
                         {
                            if($('head > script[src$="js/gallery.js"]').length == 0)
                            {
                               $('<script>').attr('type','text/javascript')
                                            .attr('src',"js/gallery.js")
                                            .appendTo('head');
                                              
                            }   
                         }
                         if(typeOfContent == 'news')
                         {
                            if($('head > script[src$="js/news.js"]').length == 0)
                            {
                               $('<script>').attr('type','text/javascript')
                                            .attr('src',"js/news.js")
                                            .appendTo('head');
                                              
                            }   
                         }
  
                     }, 100);
                     
         			 $("a[rel^='lightbox']").picbox({/* Put custom options here */}, null, function(el) {
         				 return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
         			 });
                  }
			  });
			}
		},
		/**
		 * Callback function is called when one item is double-clicked
		 */	
		afterDblClick:function(node){
			//alert($('span:first',node).text() + " double clicked");	
			//alert($('span:first',node).parent().attr('id'));
		},
        iconClick:function(node){
           //alert($(node).get(0).tagName);
           if($(node).attr("rel") == "articles")
           {
              linked = $(node).attr("id");
              if(typeof setLinked == 'function')
		      {
                  setLinked(linked); 
              }
           }   
        },
		afterMove:function(destination, source, pos) {
		//	alert("destination-"+destination.attr('id')+" source-"+source.attr('id')+" pos-"+pos);	
			if (dragOperation == true) 
			{				
				
				var params = "action=changeOrder&elementId="+source.attr('id')+"&destOwnerEl="+destination.attr('id')+
							 "&position="+pos + "&oldOwnerEl=" + simpleTree.get(0).ownerElOfDraggingItem;
				
				treeOps.ajaxReq(params, structureManagerURL, null, function(result)
				{						
					treeOps.treeBusy = false;
					treeOps.showInProcessInfo(false);
					try {
						var t = eval(result);
						// if result is less than 0, it means an error occured														
						if (treeOps.isInt(t) == true  && t < 0) { 
							alert(eval("langManager.error_" + Math.abs(t)) + "\n"+langManager.willReload);									
							window.location.reload();							
						}
						else {
							var info = eval("(" + result + ")");
							$('#' + info.oldElementId).attr("id", info.elementId);
						}
					}
					catch(ex) {	
							var info = eval("(" + result + ")");
							$('#' + info.oldElementId).attr("id", info.elementId);	
					}	
				});
			}
		},
		afterAjax:function(node)
		{			
			if (node.html().length == 1) {
				node.html("<li class='line-last'></li>");
			}
		},		
		afterContextMenu: function(element, event)
		{
			var className = element.attr('class');
  
			if (className.indexOf('doc') >= 0) {
				$('#myMenu2').css('top',event.pageY).css('left',event.pageX).show();				
			}
			else {
				if (className.indexOf('root') >= 0) {
					$('#myMenu1 .edit, #myMenu1 .delete').hide();
					$('#myMenu1 .expandAll, #myMenu1 .collapseAll').show();
				}
				else {
					$('#myMenu1 .expandAll, #myMenu1 .collapseAll').hide();
				}
				$('#myMenu1').css('top',event.pageY).css('left',event.pageX).show();
			}
			
			$('*').click(function() { $('#myMenu1, #myMenu2').hide(); $('#myMenu1 .edit, #myMenu1 .delete').show(); });
			
		},
		animate:true
		//,docToFolderConvert:true		
	});		
});
