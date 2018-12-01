tinyMCE.init({
	theme : 'advanced',
	mode : 'textareas',
	theme_advanced_toolbar_location:'top',
	theme_advanced_toolbar_align : 'left',
	plugins : 'table,media',
	theme_advanced_buttons1_add : "fontselect,fontsizeselect",
/*	theme_advanced_buttons2_add : "forecolor,backcolor,liststylem", */
	theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle,media",
	theme_advanced_buttons3_add_before : "tablecontrols,separator",
 /*   theme_advanced_buttons2_add : "media", */
	height : "300",
	width : "600",
//	content_css : "mycontent.css", 
	relative_urls : false 
});