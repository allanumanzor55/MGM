<script>perfil()</script>
<style>.labelPerfil{color:gray !important;}</style>
<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="perfilCanvas" aria-labelledby="perfilCanvasLabel">
        <div class="offcanvas-header">
            <h5 id="perfilCanvasLabel">Perfil</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 m-0 ms-1">
            <div class="container-fluid">
                <div class="row">
                <form id="formPerfil" class="row g-3" enctype="multipart/form-data">
                    <div class="form-floating mb-1">
                        <input name="dni"  type="text" class="form-control rounded-mg" id="perfilDNI" placeholder="ex">
                        <label class="labelPerfil" for="perfilDNI">DNI</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="usuario"  type="text" class="form-control rounded-mg" id="perfilUsuario" placeholder="ex">
                        <label class="labelPerfil" for="perfilUsuario">Usuario</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="nombre"  type="text" class="form-control rounded-mg" id="perfilNombres" placeholder="ex">
                        <label class="labelPerfil" for="perfilNombres">Nombres</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="apellidos"  type="text" class="form-control rounded-mg" id="perfilApellidos" placeholder="ex">
                        <label class="labelPerfil" for="perfilApelldios">Apellidos</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="celular"  type="text" class="form-control rounded-mg" id="perfilCelular" placeholder="ex">
                        <label class="labelPerfil" for="perfilApelldios">Celular</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input name="telefono"  type="text" class="form-control rounded-mg" id="perfilTelefono" placeholder="ex">
                        <label class="labelPerfil" for="perfilApelldios">Telefono</label>
                    </div>
                    <div class="mb-1">
                        <textarea name="direccion"  rows="10" type="text" class="form-control rounded-mg" id="perfilDireccion" placeholder="Direccion"></textarea>
                    </div>
                </form>
                </div>
                <div class="d-flex justify-content-between mt-1 ms-5 me-0 pe-0">
                    <div></div>
                    <div class="col-2">
                        <a onclick="logout()" href="#" class="btn btn-outline-warning zmdi zmdi-arrow-left"></a>
                    </div>
                </div>
            </div>
        </div>
</div>