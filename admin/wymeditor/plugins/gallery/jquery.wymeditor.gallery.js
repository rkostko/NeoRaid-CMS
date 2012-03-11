WYMeditor.editor.prototype.gallery = function(doc) {
  
  
  var wym = this;
  var itemList = wym._options.imagesGallery;
  //alert(itemList.length);
  //if(arr.length > 0)
  //{
    /*for(a in arr)
    {
        alert(a+':'+arr[a]);
    }*/

    /*for(var i=0; i<itemList.length; i++)
    {
        alert(itemList[i].id+" - "+itemList[i].url);
    }*/

//alert($(doc).find("#gallery").html());
   
itemLoadCallback();

$(doc).ready(function() {
    
    $(doc).find("#gallery").html('<ul id="mycarousel" class="jcarousel-skin-tango"></ul>');
    var imagesSelector = $(doc).find('#mycarousel');
    
    $(imagesSelector).jcarousel({
        size: itemList.length,
        itemLoadCallback: {onBeforeAnimation: itemLoadCallback}
    });
});  
      
  //}
  return;  

}; 