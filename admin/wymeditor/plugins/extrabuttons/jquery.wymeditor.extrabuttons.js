WYMeditor.editor.prototype.ExtraButtons = function(edit) {
  
  var wym = this;
  //construct the button's html
  var html = "<li class='wym_tools_wrap'>"
  + "<a name='Wrap' href='#'"
  + " style='background: url(icons.png) no-repeat; text-indent: -9999px;background-position: 0 -672px;"
  + "'>"
  + "Wrap"
  + "<\/a><\/li>";
                                    	
  //add the button to the tools box
  $(wym._box).find(wym._options.toolsSelector + wym._options.toolsListSelector).append(html);
                                    	
  //handle click event
  $(wym._box).find('li.wym_tools_wrap a').click(function() 
  {
    wym.wrap( '<span>', '<\/span>');
    return(false);
  });
                                    	
  //construct the unwrap button's html
  var html = "<li class='wym_tools_unwrap'>"
  + "<a name='Unwrap' href='#'"
  + " style='background: url(icons.png) no-repeat; text-indent: -9999px;background-position: 0 -697px;"
  +"'>"
  + "Unwrap"
  + "<\/a><\/li>";
                                    	
  //add the button to the tools box
  $(wym._box).find(wym._options.toolsSelector + wym._options.toolsListSelector).append(html);
                                    	
  //handle click event
  $(wym._box).find('li.wym_tools_unwrap a').click(function() 
  {
    wym.unwrap();
    return(false);
  });
  
  //construct the save & close button's html
  var html = "<li class='wym_tools_save'>"
  + "<a name='Save' href='#'"
  + " style='background: url(icons.png) no-repeat; text-indent: -9999px;background-position: 0 -622px;"
  + "'>"
  + "Save"
  + "</a></li>";
                                    
  //add the button to the tools box
  $(wym._box).find(wym._options.toolsSelector+wym._options.toolsListSelector).append(html);
                                                    
  //handle click event
  $(wym._box).find('li.wym_tools_save a').click(function() 
  {
    //do something
    wym.saveajax(edit);
    return(false);
  });  
};