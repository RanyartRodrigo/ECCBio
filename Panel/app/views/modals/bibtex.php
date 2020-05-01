<!--MODAL de Publicaciones Bibtex-->
<div class="modal fade" id="bibtexModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
               
                <h3>Publicaciones de Bibtex</h3>
                <br />
                <div id="alertBibtex">     
                </div>
                
                <em>Seleccione el archivo bibtex</em>
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-info btn-file">
                          Buscar… <input type="file" name="fileToUpload" id="fileToUpload">
                        </span>
                    </span>
                    <input id="filename" type="text" class="form-control" readonly="">
                </div>
                <br />
                <br />
                <em>¿Remplazar las publicaciones actuales?</em>
                <label class="checkbox">
                  <input id="replace" type="checkbox" 
                  data-toggle="toggle" data-onstyle="default" data-width="200"
                  data-on="<i class='glyphicon glyphicon-eye-open'></i> Si, remplazar todo" 
                  data-off="<i class='glyphicon glyphicon-eye-close'></i> No, agregar al final">
                </label>
                <br />
                <br />
                <button type="button" value="Upload Image" name="submit" onclick="fileUploadFunction()" 
                        id="fileUploadSubmit" class="btn btn-success">
                          <span class="glyphicon glyphicon-plus-sign"></span> Aceptar 
                </button>
                <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#bibtexModal">Cancelar</a>
                 
             
             </div>
        </div>
    </div>
</div>