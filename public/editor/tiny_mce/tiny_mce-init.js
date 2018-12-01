tinyMCE.init({
	theme : 'advanced',
	mode : 'textareas',
	theme_advanced_toolbar_location:'top',
	theme_advanced_toolbar_align : 'left',
	plugins : 'table,fullscreen',
	theme_advanced_buttons1_add : "fontselect,fontsizeselect",
	theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
	theme_advanced_buttons3_add_before : "tablecontrols,separator",
	theme_advanced_buttons3_add : "fullscreen",
	height : "300",
	width : "950",

	//document_base_url : "http://www.sinoweb.local",
	//remove_script_host : false,
	relative_urls : false 
	
});

/*
tinyMCE.init({			
			mode : 'textareas',
			elements : "ajaxfilemanager",
			theme : "advanced",
			plugins : "table,advhr,advimage,advlink,flash,paste,fullscreen,noneditable,contextmenu",
			theme_advanced_buttons1_add_before : "newdocument,separator",
			theme_advanced_buttons1_add : "fontselect,fontsizeselect",
			theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before : "cut,copy,paste,pastetext,pasteword,separator,",
			theme_advanced_buttons3_add_before : "tablecontrols,separator",
			theme_advanced_buttons3_add : "flash,separator,fullscreen",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			extended_valid_elements : "hr[class|width|size|noshade]",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : true,
			apply_source_formatting : true,
			force_br_newlines : true,
			force_p_newlines : false, 
			relative_urls : true
});
*/