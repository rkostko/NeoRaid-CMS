jQuery(function($){
    $( ".datepicker" ).datepicker({
			showOn: "button",
			buttonImage: "calendar.gif",
			buttonImageOnly: true,
            onSelect: function(dateText, inst) 
            {
                var obj = this;
                var id = $(obj).attr("id").match(/(dateh)[-=_](\d+)/);
                $("#date_"+id[2]).text($(obj).val());
                var string = "id="+id[2]+"&date="+$(obj).val();
                $.post("set_news.php", string, function(responce)
        		{ 
        		    alert(responce);
        		    return;
        		});
            }
		});    
        
	$.datepicker.regional['pl'] = {
		closeText: 'Zamknij',
		prevText: '&#x3c;Poprzedni',
		nextText: 'Następny&#x3e;',
		currentText: 'Dziś',
		monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
		'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
		monthNamesShort: ['Sty','Lu','Mar','Kw','Maj','Cze',
		'Lip','Sie','Wrz','Pa','Lis','Gru'],
		dayNames: ['Niedziela','Poniedzialek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
		dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
		dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
		weekHeader: 'Tydz',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['pl']);
});

$("div[id^='title']").each(function()
{
    var obj = this;
    var id = $(obj).attr("id").match(/(title)[-=_](\d+)/);
    var before;
    var after;
    $(obj).get(0).contentEditable = true;
    $(obj).bind('focus', function() 
    { 
        before = $(obj).text(); 
    }).bind('blur paste', function() 
    { 
          if (before != $(obj).text()) 
          { 
            after = $(obj).text();
            $(obj).trigger('change'); 
          }
    });
    
    var string = "id="+id[2]+"&title="+after;
    
    $(obj).bind('change', function() 
    {
        $.post("set_news.php", string);
    });
    
    $(obj).keyup(function(ev)
    {
		kc = ( ( typeof( ev.charCode ) == 'undefined' || ev.charCode === 0 ) ? ev.keyCode : ev.charCode );
		key = String.fromCharCode(kc);

		if (kc == 27)
		{
			$(obj).text(before);
		}
		if (kc == 13)
		{
			$.post("set_news.php", string);
		}
    });          
});

$(".hide_news,.show_news").each(function()
{ 
    var obj = this;    
    var id = $(obj).attr("rel");
    
    $(obj).bind('click', function()
    {
        $(obj).toggleClass('show_news hide_news');
        var visible = ($(obj).hasClass('hide_news'))? 1 : 0;
        var string = "id="+id+"&isVisible="+visible;
        $.post("set_news.php", string);         
    });  
});


