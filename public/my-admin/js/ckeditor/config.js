/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'es';
	// config.uiColor = '#AADC6E';
	
	config.filebrowserBrowseUrl = 'js/ckfinder/ckfinder.html',
	config.filebrowserImageBrowseUrl = 'js/ckfinder/ckfinder.html?Type=Images',
	config.filebrowserFlashBrowseUrl = 'js/ckfinder/ckfinder.html?Type=Flash',
	config.filebrowserUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	config.filebrowserImageUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	config.filebrowserFlashUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	
	config.toolbar_Full =
	[
		['Source', 'Templates'],
		['Cut','Copy','Paste','PasteText','PasteFromWord'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
		['Bold','Italic','Underline','Strike', 'HorizontalRule','-','Subscript','Superscript'],
		['NumberedList','BulletedList','-','Outdent','Indent'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Blockquote'],
		['Link','Unlink','Anchor'],
		['Image','Flash','Table','HorizontalRule','SpecialChar','Iframe'],
		['Styles','Format','Font','FontSize'],
		['TextColor','BGColor'],
		['Maximize', 'ShowBlocks'],
		[ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ],
	];

	config.allowedContent = true;
	
	config.toolbar = 'Full';
};
