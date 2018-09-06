/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.stylesSet.add( 'my_styles',
[
	{ name : 'Green Title', element : 'h3', styles : { 'color' : '#009933', 'font-size' : '14px' } },
	{ name : 'Blue Title', element : 'h3', styles : { 'color' : '#99CCFF', 'font-size' : '14px' } },
	{ name : 'Purple Title', element : 'h3', styles : { 'color' : '#996666', 'font-size' : '14px' } },
	// inline
	{ name : 'Green Text', element : 'span', styles : { 'color' : '#009933' } },
	{ name : 'Blue Text', element : 'span', styles : { 'color' : '#99CCFF' } },
	{ name : 'Purple Text', element : 'span', styles : { 'color' : '#996666' } },
	// element
	{ name : 'Green Link', element : 'a', styles : { 'color' : '#009933' } },
	{ name : 'Blue Link', element : 'a', styles : { 'color' : '#99CCFF' } },
	{ name : 'Purple Link', element : 'a', styles : { 'color' : '#996666' } }
]);

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#a6c4da';
	config.skin = 'kama';
	
	// config.baseHref = 'http://192.168.2.7/proje/assets/js/ckeditor/';
	
	// file manager eklentisi
	config.filebrowserBrowseUrl 		= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl 	= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl 	= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl 		= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl 	= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl 	= 'http://www.izmirweb.org/poultech/yonetim/ckeditor/kcfinder/upload.php?type=flash';
	
	/**
	* This is the default toolbar definition used by the editor. It contains all
	* editor features.
	* @type Array
	* @default (see example)
	* @example
	* // This is actually the default value.
	* config.toolbar_Full =
	* [
	*     ['Source','-','Save','NewPage','Preview','-','Templates'],
	*     ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
	*     ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	*     ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	*     '/',
	*     ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	*     ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
	*     ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	*     ['BidiLtr', 'BidiRtl' ],
	*     ['Link','Unlink','Anchor'],
	*     ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	*     '/',
	*     ['Styles','Format','Font','FontSize'],
	*     ['TextColor','BGColor'],
	*     ['Maximize', 'ShowBlocks','-','About']
	* ];
	*/
	// MyToolbar1
	config.toolbar_MyToolbar1 =
    [
        ['Cut','Copy','Paste','PasteText','PasteFromWord'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
        '/',
        ['Styles','FontSize'],
        ['Bold','Italic','Strike','-','Subscript','Superscript'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['Link','Unlink','Anchor'],
        ['Source']
    ];
	
	config.stylesSet = 'my_styles';
	
	
};