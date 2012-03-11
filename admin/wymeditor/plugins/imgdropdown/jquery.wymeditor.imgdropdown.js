WYMeditor.editor.prototype.imgDropdown = function(insertArr) {
  
  var wym = this;
  var imageContainer = $(wym._box).find("#mycarousel");
  var url = '';
  var items = '<ul style="width:107px; height:150px; overflow:auto;">';
  for(var i=0; i<insertArr.length; i++)
  {
    url = insertArr[i].url;
    items += '<li><img src="showthumb.php?img='+url+'&width=100&height=75&quality=50" id="s_'+insertArr[i].id+'" title="'+insertArr[i].alt+'"/></li>';   }                                                
  
  items += "</ul>";
                                                        
  $(imageContainer).html(items);
  $(imageContainer).find("ul > li > img").each(function()
  {
      var image = this;
      var imgSrc = $(image).attr("src");
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
      tmp = (parseInt(alt) != 0)? alt.split('x') : [0,0];
                                                                
      $(image).bind(
      {
        click: function()
        {
            wym.insertAtCaret('<img src="image.php?img='+imgSrc+'" width="'+tmp[0]+'" style="clear:both" height="'+tmp[1]+'" alt="Zdjęcie"/>');
            return false;  
        },
        contextmenu: function(e)
        {
            wym.imgDialog(imgSrc, tmp);
            return false;
        },
      }); 
  });
   
};