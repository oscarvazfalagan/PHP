<?php

declare(strict_types=1);

?>

<!--Inicio HTML -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" >
                <input type="hidden" name="order" value="1"/>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $input["nombre"] ?? ''; ?>"/>
                            </div>
                        </div>
                        <?php if(!empty($roles)): ?>
                            <div class="col-4 mb-3">
                                <label for="rol" class="mb-1">Rol:</label>
                                <select name="id_rol" id="id_rol" class="form-control" data-placeholder="Rol">
                                    <option value="<?php echo $input['id_rol']; ?>">-</option>
                                    <?php foreach ($roles as $rol => $dataRol): ?>
                                        <option value="<?php echo $dataRol['id_rol']; ?>"
                                                <?php
                                                if(isset($input["id_rol"]) && (int)$dataRol['id_rol'] === (int)$input["id_rol"]) {
                                                    echo 'selected';
                                                }
                                                ?>>
                                            <?php echo $dataRol['rol']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <p class="text-danger small"><?php echo $errores['id_rol'] ?? ''; ?></p>
                        <?php endif; ?>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Idioma:</label>
                                <select name="idioma" id="idioma" class="form-control" data-placeholder="Rol">
                                    <option value="<?php echo $input['idioma']; ?>">-</option>
                                    <option value="es" <?php echo $input['idioma'] = 'es' ? 'selected' : ''; ?>>es</option>
                                    <option value="en">en</option>
                                    <option value="gl">gl</option>

                                </select>
                            </div>
                        </div>







                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Email :</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $input["email"] ?? ''; ?>"/>
                            </div>

                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Contraseña:</label>
                                <input type="password" class="form-control" name="pasword" id="pasword" value="<?php echo $input["pasword"] ?? ''; ?>"/>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Repite la contraseña</label>
                                <input type="password" class="form-control" name="pasword2" id="pasword2" value="<?php echo $input["pasword2"] ?? ''; ?>"/>
                            </div>
                        </div>


                    </div>


                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/UsuariosController" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
            </div>


        </div>
    </div>