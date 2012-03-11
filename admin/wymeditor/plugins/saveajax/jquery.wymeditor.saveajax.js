//Extend WYMeditor
WYMeditor.editor.prototype.saveajax = function(rel) {
  
  var wym = this;
  wym.update();
  $(wym._box).hide();
  /*$(wym._element).show(function()
  {
    alert($(rel).html());
    $(rel).show();    
  });*/
  $(wym._element).show();
  $(rel).show();
};