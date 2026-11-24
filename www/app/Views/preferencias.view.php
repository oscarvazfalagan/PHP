<?php

declare(strict_types=1);

?>

<!--Inicio HTML -->
<div class="card-body">id
    <div class="row">
        <div class="col-12">country_code
            <div class="card shadow mb-4">
                <form method="post" >
                    <input type="hidden" name="order" value="1"/>
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Opciones</h6>
                    </div>

                <div class="card-body">
                    <div class="row col-12 col-lg-12 ">
                    <div class="col-4 mb-3">
                                <label for="rol" class="mb-1">Tema:</label>
                                <select name="tema" id="tema" class="form-control" data-placeholder="Rol">
                                    <option value="light" <?php echo empty($_COOKIE['dark_mode'])? 'selected' : ''?>>Claro</option>
                                    <option value="dark" <?php echo !empty($_COOKIE['dark_mode'])? 'selected' : ''?>>Oscuro</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-12 text-right">
                        <input type="submit" value="GuardarCambios" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>