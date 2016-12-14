/*

 Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.

 For licensing, see LICENSE.md or http://ckeditor.com/license

*/

CKEDITOR.addTemplates(

	"default",

	{

		imagesPath: CKEDITOR.getUrl(CKEDITOR.plugins.getPath("templates")+"templates/images/"),

		templates: [

			{

				title : "Dos columnas",

				html : '<div class="col-md-6"><p>Contenido...</p></div><div class="col-md-6"><p>Contenido...</p></div><div class="clearfix"></div>'

			},

			{

				title : "Cuatro columnas",

				html : '<div class="col-md-3"><p>Contenido...</p></div><div class="col-md-3"><p>Contenido...</p></div><div class="col-md-3"><p>Contenido...</p></div><div class="col-md-3"><p>Contenido...</p></div><div class="clearfix"></div>'

			},

			{

				title : "Tabs",

				html : '<div><ul class="nav nav-tabs" role="tablist"><li role="presentation" class="active"><a href="#tab1" role="tab" data-toggle="tab">Home</a></li><li role="presentation"><a href="#tab2" role="tab" data-toggle="tab">Profile</a></li><li role="presentation"><a href="#tab3" role="tab" data-toggle="tab">Messages</a></li></ul><div class="tab-content"><div role="tabpanel" class="tab-pane active" id="tab1">Contenido Tab 1</div><div role="tabpanel" class="tab-pane" id="tab2">Contanido Tab 2</div><div role="tabpanel" class="tab-pane" id="tab3">Contanido Tab 3</div></div></div>'

			}

		]

	}

);
