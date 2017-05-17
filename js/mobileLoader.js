/**
 * Created by Tovin on 11/9/16.
 */
$( document ).on( "mobileinit", function() {
    $.mobile.loader.prototype.options.text = "loading";
    $.mobile.loader.prototype.options.textVisible = true;
    $.mobile.loader.prototype.options.theme = "a";
    $.mobile.loader.prototype.options.html = "<iframe src='loading.html' align='middle' frameborder='0' width='100%' scrolling='no' height='100%'>";
});