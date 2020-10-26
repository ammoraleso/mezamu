<div class="modal fade" id="modalDetailsAdminMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-auto text-center modal-header" id="header-tittle"></h5>
                <button type="button" class="close m-0 p-0 modal-close-button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <label for="name" style="padding-left: 3%; padding-top: 6%; margin-bottom: 0px;">Nombre:</label>
            <input maxlength="32" type="text" id="name" style="margin-left: 3%; margin-right: 3%; margin-bottom: 0px;"><br><br>
            <label for="description" style="padding-left: 3%; padding-top: 2%; margin-bottom: 0px;">Descripcion:</label>
            <textarea maxlength="255" id="description" style="margin-left: 3%; margin-right: 3%; margin-bottom: 0px; resize: none; width: auto;" id="descriptionOrder" placeholder="Ingresa aquí tus descripción.." rows="4" cols="50"></textarea>
            <label for="price" style="padding-left: 3%; padding-top: 2%; margin-bottom: 0px;">Precio:</label>
            <input maxlength="10" type="text" id="price" style="margin-left: 3%; margin-right: 3%; margin-bottom: 0px;"><br><br>

            <div id="back" class="pt-3"style="justify-content: space-evenly; display: flex; padding-bottom: 1%;">
                <a class="btn btn-success" style="color: white" onclick="updateDish()">Guardar</a>
            </div>
            
        </div>

        
    </div>
</div>


