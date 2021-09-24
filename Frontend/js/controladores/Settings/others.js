function modificarModalIngresar(tipo) {
    let formIngresar = document.getElementById('body')
    if (tipo == "categoria") {
        formIngresar.innerHTML=
        `<form class="align-items-center" id="formCategoria" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="id" id="idCategoria" value="">
                <div class="col mb-1">
                    <input type="text" class="form-control" id="descripcionCat" name="descripcion" placeholder="Descripcion">
                </div>
                <div class="col mb-1">
                    <input type="text" class="form-control" id="material" name="material" placeholder="Material">
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
                <a type="button" class="btn btn-outline-warning" onclick="guardarCategoria(this)" style="display:block !important;" data-bs-dismiss="modal">Guardar</a>
                <a type="button" class="btn btn-outline-success" onclick="confirmarModificarCategoria(this)" value="modificar" style="display:none !important;" data-bs-dismiss="modal">Modificar</a>
            </div>
        </form>`
    } else if (tipo == "estilo") {
        formIngresar.innerHTML =
            `<form class="align-items-center" id="formEstilo" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="idEstilo" value="">
                    <div class="col mb-1">
                        <select class="form-select" name="tipo" id="selectCategoria"></select>
                    </div>
                    <div class="col mb-1">
                        <input type="text" class="form-control" id="estilo" name="estilo" placeholder="Estilo">
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
                    <a type="button" class="btn btn-outline-warning" onclick="guardarEstilo(this)" style="display:block !important;" data-bs-dismiss="modal">Guardar</a>
                    <a type="button" class="btn btn-outline-success" onclick="confirmarModificarEstilo(this)" value="modificar" style="display:none !important;" data-bs-dismiss="modal">Modificar</a>
                </div>
            </form>`
            rellenarSelect()
    } else if (tipo == "talla") {
        formIngresar.innerHTML=
        `<form class="align-items-center" id="formTalla">
            <div class="modal-body">
                <input type="hidden" name="id" id="idTalla">
                <div class="col mb-1">
                    <div class="input-group">
                        <input type="text" class="form-control" id="descripcionTal" name="descripcion" placeholder="Talla">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
                <a type="button" class="btn btn-outline-warning" onclick="guardarTalla(this)" style="display:block !important;" data-bs-dismiss="modal">Guardar</a>
                <a type="button" class="btn btn-outline-success" onclick="confirmarModificarTalla(this)" value="modificar" style="display:none !important;" data-bs-dismiss="modal">Modificar</a>
            </div>
        </form>`
    } else if (tipo == "cargo") {
        formIngresar.innerHTML=
        `<form class="align-items-center" id="formCargo">
            <div class="modal-body">    
                <input type="hidden" name="id" id="idCargo">
                <div class="col mb-1">
                    <div class="input-group">
                        <input type="text" class="form-control" id="descripcionTip" name="descripcion" placeholder="Cargo">
                    </div>
                </div>
                <div class="col mb-1">
                    <select class="form-select" name="rol" id="selectRoles"></select>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
                <a type="button" class="btn btn-outline-warning" onclick="guardarCargo(this)" style="display:block !important;" data-bs-dismiss="modal">Guardar</a>
                <a type="button" class="btn btn-outline-success" onclick="confirmarModificarCargo(this)" value="modificar" style="display: none !important;" data-bs-dismiss="modal">Modificar</a>
            </div>
        </form>`
        rellenarSelectRoles()
    } else if (tipo == "empresa") {
        formIngresar.innerHTML=`
        <form class="align-items-center" id="formEmpresa">
            <div class="modal-body">    
                <input type="hidden" name="id" id="idEmpresa">
                <div class="col mb-1">
                    <div class="input-group">
                        <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" placeholder="Nombre de empresa">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</a>
                <a type="button" class="btn btn-outline-warning" onclick="guardarCargo(this)" style="display:block !important;">Guardar</a>
                <a type="button" class="btn btn-outline-success" onclick="confirmarModificarCargo(this)" value="modificar" style="display: none !important;">Modificar</a>
            </div>
        </form>`
    }
}