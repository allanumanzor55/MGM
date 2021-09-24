<script>perfil()</script>
<style>.labelPerfil{color:gray !important;}</style>
<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="perfilCanvas" aria-labelledby="perfilCanvasLabel">
        <div class="offcanvas-header">
            <h5 id="perfilCanvasLabel">Perfil</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 m-0 ms-1">
            <div class="container-fluid">
                <div class="row text-center">
                    <i class="zmdi zmdi-account-circle" style="font-size: 150px;"></i>
                </div>
                <div class="row">
                    <form id="formPerfil" class="row g-3" enctype="multipart/form-data">
                        <p class="h6 text-center" id="datosPerfil">
                            <span id="nombrePerfil">Allan Josue Alonzo Umanzor</span>
                            <br>
                            <small class="text-muted" id="usuarioPerfil">Administrador</small>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mx-3 mb-3">
            <a href="perfil.php">
                <i class="zmdi zmdi-edit"></i>
                Editar Perfil
            </a>
            <a onclick="logout()" href="#" style="color:tomato !important;">
                    <i class="zmdi zmdi-arrow-left"></i>
                    Cerrar sesion
            </a>
        </div>
</div>