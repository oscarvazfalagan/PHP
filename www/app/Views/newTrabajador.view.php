<?php

declare(strict_types=1);

?>

<!--Inicio HTML -->
<div class="card-body">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <form method="get" >
                    <input type="hidden" name="order" value="1"/>
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Datos del trabajador</h6>
                    </div>
                </form>
                <div class="card-body">
                    <div class="row col-12 col-lg-12 ">
                        <div class="col-4 mb-3">
                            <label for="alias">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" value="<?php echo $input["username"] ?? ''; ?>"/>
                            <p class="text-danger small"><?php echo $errores['username'] ?? ''; ?></p>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="alias">SalarioBruto:</label>
                            <input type="text" class="form-control" name="salarioBruto" id="salarioBruto" value="<?php echo $input["salarioBruto"] ?? ''; ?>"/>
                            <p class="text-danger small"><?php echo $errores['salarioBruto'] ?? ''; ?></p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Retencion:</label>
                                <input type="text" class="form-control" name="retencion" id="retencion" min="0" max="100" value="<?php echo $input["retencion"] ?? ''; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row"> <!-- Quitamos el col-lg-4 de aquí para que ocupe todo el ancho -->

                        <!-- Columna 1 (Debajo de Username) -->
                        <div class="col-4 mb-3 d-flex align-items-center">
                            <label for="activo" class="me-3 mb-0 pt-4" style="font-weight: bold; font-size: 1.1rem; margin-right:5px ">Activo :  </label>

                            <!-- Switch sin clases de colores (vuelve al estándar azul/gris) -->
                            <div class="custom-control custom-switch pt-4" style="transform: scale(1.3); transform-origin: left center;">
                                <input type="checkbox" class="custom-control-input" name="activo" id="activo" value="<?php echo $input["activo"] ?? ''; ?>" style="cursor: pointer;">
                                <label class="custom-control-label" for="activo" style="cursor: pointer;"></label>
                            </div>
                        </div>

                        <!-- Columna 2 (Debajo de Salario Bruto) -->
                        <?php if(!empty($roles)): ?>
                            <div class="col-4 mb-3">
                                <label for="rol" class="mb-1">Rol:</label>
                                <select name="rol" id="rol" class="form-control" data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($roles as $rol => $dataRol): ?>
                                        <option value="<?php echo $dataRol['id_rol']; ?>"
                                                <?php
                                                if(isset($rolFiltro) && (int)$dataRol['id_rol'] === (int)$rolFiltro) {
                                                    echo 'selected';
                                                }
                                                ?>>
                                            <?php echo $dataRol['nombre_rol']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <p class="text-danger small"><?php echo $errores['id_rol'] ?? ''; ?></p>
                        <?php endif; ?>

                        <!-- Columna 3 (Vacía, debajo de Retencion, para mantener la cuadrícula) -->
                         <?php
                             if(!empty($countrys)):
                                 ?>
                             <div class="col-4 mb-3">
                                 <label for="id_rol">Pais :</label>
                                 <select name="Pais " id="Pais " class="form-control" data-placeholder="Rol">
                                     <option value="">-</option>
                                     <?php foreach ($countrys as $country => $dataCountry): ?>
                                     <option value="<?php echo $dataCountry['id']?>"
                                             <?php if(isset($countryFiltro)):
                                         if((int)$dataCountry['id']==(int)$countryFiltro):
                                             echo 'selected'  ;
                                         else:
                                             echo'';
                                         endif;
                                         endif;?>> <?php echo $dataCountry['country_name']?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         <?php
                         endif;
                         ?>
                    </div>
                    <div class="card-footer">
                        <div class="col-12 text-right">
                            <a href="/trabajadorControllerFiltros/new/" value="" name="reiniciar" class="btn btn-danger">Limpiar Datos</a>
                            <input type="submit" value="Crear Usuario" name="enviar" class="btn btn-primary ml-2"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>