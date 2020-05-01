<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
				<div class="modal-body">
					<h3>Galería del proyecto</h3>
                    <br />
                    Administre las imágenes que se desplegarán en la galería de este proyecto.
                    <br />
                    <br />
                    
                    <form id="fileupload" method="POST" enctype="multipart/form-data">
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-info btn-file">
                                            	<i class="glyphicon glyphicon-plus"></i>
                                                 Agregar imágenes <input type="file" name="files[]" multiple>
                                            </span>
                                        </span>
                                    </div>
              						
                                    <div class="btn-group pull-right">
                                    	<input type="checkbox" class="toggle">
                                    </div>
                                    <div class="btn-group pull-right" role="group" aria-label="...">
                                        <button type="submit" class="btn btn-success start">
                                            <i class="glyphicon glyphicon-upload"></i>
                                            <span>Subir todas</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                            <span>Cancelar todas</span>
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Eliminar seleccionadas</span>
                                        </button>
                                        
                                     </div>
                                    
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-4 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                           
                            	<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                            
                        </form>
                    
                        <!-- The blueimp Gallery widget -->
                        <!--
                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>
                        -->
                        
                        
                        <br />
                        <br />
                        <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#galleryModal">Terminar</a>
                
                
                </div>
		</div>
	</div>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Procesando...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-success start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Subir</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Eliminar</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo asset_url('js/vendor/jquery.ui.widget.js') ?>"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo asset_url('file-uploader-master/js/extras/tmpl.min.js') ?>"></script>
<!--<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo asset_url('file-uploader-master/js/extras/load-image.all.min.js') ?>"></script>
<!--<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>-->
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo asset_url('file-uploader-master/js/extras/canvas-to-blob.min.js') ?>"></script>
<!--<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>-->
<!-- blueimp Gallery script -->
<script src="<?php echo asset_url('file-uploader-master/js/extras/jquery.blueimp-gallery.min.js') ?>"></script>
<!--<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>-->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo asset_url('file-uploader-master/js/jquery.iframe-transport.js') ?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/jquery.fileupload.js') ?>"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/jquery.fileupload-process.js') ?>"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/jquery.fileupload-image.js') ?>"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/fileupload-audio.js') ?>"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/fileupload-video.js') ?>"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/fileupload-validate.js') ?>"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo asset_url('file-uploader-master/js/jquery.fileupload-ui.js') ?>"></script>
<!-- The main application script -->
