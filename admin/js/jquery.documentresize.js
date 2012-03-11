/*
 http://plugins.jquery.com/project/documentresize
*/
var l="resize",n="scroll";
jQuery(function(){function o(){p();m();q()}function p(){var b,c;b=a.width();c=a.height();if(b!=f||c!=g){f=b;g=c;d=true;a.trigger(l);d=false}}function m(){var b,c;b=e.width();c=e.height();if(b!=h||c!=i){h=b;i=c;d=true;e.trigger(l);d=false}}function q(){var b,c;b=a.scrollLeft();c=a.scrollTop();if(b!=j||c!=k){j=b;k=c;d=true;a.trigger(n);d=false}}function r(){if(!d){h=e.width();i=e.height()}}function s(){if(!d){f=a.width();g=a.height();m()}}function t(){if(!d){j=a.scrollLeft();k=a.scrollTop()}}var a,
e,f,g,h,i,j,k,d;a=jQuery(window);e=jQuery(document);f=g=h=i=j=k=-1;d=false;e.resize(r);a.resize(s);a.scroll(t);setInterval(o,1E3)});