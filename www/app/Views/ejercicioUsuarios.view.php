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
                    <?php
                    if(!empty($roles)):
                        ?>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="idRol[]" id="idRol" class="form-control select2" data-placeholder="Rol" multiple>
                                    <option value="">-</option>
                                    <?php foreach ($roles as $rol => $dataRol): ?>
                                        <option value="<?php echo $dataRol['id_rol']?>"
                                                <?php if(isset($input['idRol'])):
                                                    if(in_array($dataRol['id_rol'], $input['idRol'])):
                                                        echo 'selected'  ;
                                                    else:
                                                        echo'';
                                                    endif;
                                                endif;?>> <?php echo $dataRol['rol']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Email :</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $input["email"] ?? ''; ?>"/>
                            </div>
                        </div>
                         <?php
                             if(!empty($idiomas)):
                                 ?>
                         <div class="col-12 col-lg-4">
                             <div class="mb-3">
                                 <label for="id_rol">Idioma:</label>
                                 <select name="idioma" id="idioma" class="form-control" data-placeholder="Rol">
                                     <option value="">-</option>
                                     <?php foreach ($idiomas as $idioma => $dataIdioma): ?>
                                     <option value="<?php echo $dataIdioma['idioma']?>"
                                             <?php if(isset($idiomaFiltro)):
                                                if(($dataIdioma['idioma']===$idiomaFiltro)):
                                                     echo 'selected'  ;
                                                else:
                                                     echo'';
                                                endif;
                                                endif;?>> <?php echo $dataIdioma['idioma']?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         </div>
                         <?php
                         endif;
                         ?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $input["nombre"] ?? ''; ?>"/>
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
            <div class="col-12">
            <?php  if(!empty($usuarios)){?>
            <table class="table table-striped">
                <?php
                require_once '../app/Helpers/fomr_helper.php';
                echo printTableHeader(
                        ['Rol', 'Email', 'Nombre', 'Idioma', 'UtimaFecha'],
                        1,
                        $input['sentido'] ?? null,
                        $queryParams ?? ''
                );
                ?>
                <tbody>
                <?php
                foreach ($usuarios as $usuario => $dataUsuario) {
                    ?>
                    <tr>
                        <td><?php echo $dataUsuario['rol'] ?></td>
                        <td><?php echo $dataUsuario['email'] ?></td>
                        <td><?php echo $dataUsuario['nombre'] ?></td>
                        <td><?php echo $dataUsuario['idioma'] ?></td>
                        <td><?php echo $dataUsuario['last_date'] ?></td>
                    </tr>
                    <tr>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php }else{?>
                <div style="color: red" >
                    No se han encontrado coincidencias
                </div>
            <?php } ?>
        </div>
    </div>
</div>