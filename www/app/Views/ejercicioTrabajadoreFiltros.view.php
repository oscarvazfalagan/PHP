<?php

declare(strict_types=1);

?>
    <div class="row">

<!--Inicio HTML -->
<div class="row">
    <style>
        .mensaje-error {
            color: #d9534f;
            background-color: #fdf7f7;
            border: 1px solid #d9534f;
            padding: 10px;
            margin-top: 15px;
            border-radius: 4px;
        }
    </style>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" >
                <input type="hidden" name="order" value="<?php echo $order; ?>"/>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Username:</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $input["username"] ?? ''; ?>"/>
                            </div>
                        </div>
                        <?php
                            if(!empty($roles)):
                                ?>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control" data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($roles as $rol => $dataRol): ?>
                                    <option value="<?php echo $dataRol['id_rol']?>"
                                            <?php if(isset($rolFiltro)):
                                        if((int)$dataRol['id_rol']==(int)$rolFiltro):
                                            echo 'selected'  ;
                                        else:
                                            echo'';
                                        endif;
                                        endif;?>> <?php echo $dataRol['nombre_rol']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        endif;
                        ?>

                        <div class="col-12 col-lg-2">
                            <div class="mb-3">
                                <label for="alias">Valor Minimo:</label>
                                <input type="text" class="form-control" name="salarioMinBruto" id="salarioMinBruto" placeholder="0"  value="<?php echo $input["salarioMinBruto"] ?? ''; ?>"/>
                              </div>
                            <div class="mb-3">
                                <label for="alias">Valor Maximo:</label>
                                <input type="text" class="form-control" name="salarioMaximoBruto" id="salarioMaximoBruto"  placeholder="5000" value="<?php echo $input["salarioMaximoBruto"] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div class="mb-3">
                                <label for="alias">Retencion Minima:</label>
                                <input type="text" class="form-control" name="retencionMin" id="retencionMin" placeholder="0"  value="<?php echo $input["retencionMin"] ?? ''; ?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="alias">Retencion Maxima:</label>
                                <input type="text" class="form-control" name="retencionMax" id="retencionMax"  placeholder="30" value="<?php echo $input["retencionMax"] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_continente">Continente:</label>
                                <select name="idCountry[]" id="idCountry" class="form-control select2" data-placeholder="Continente" multiple>
                                    <?php foreach ($countrys as $country => $dataCountry): ?>
                                        <option value="<?php echo $dataCountry['id'] ?>"
                                                <?php if(isset($input['idCountry'])):
                                                    if(in_array($dataCountry['id'], $input['idCountry'])):
                                                        echo 'selected'  ;
                                                    else:
                                                        echo'';
                                                    endif;
                                                endif;?>> <?php echo $dataCountry['country_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <a href="/trabajadorControllerFiltros" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <?php  if(!empty($trabajadores)){?>
        <table class="table table-striped">
            <?php
            require_once '../app/Helpers/fomr_helper.php';
            echo printTableHeader(
                    ['Username', 'Salario Bruto', 'Retención', 'Rol', 'País'],
                    $order,
                    $input['sentido'] ?? null,
                    $queryParams
            );
            ?>
            <tbody>
            <?php
            foreach ($trabajadores as $trabajador => $datos) {
                ?>
                <tr>
                    <td><?php echo $datos['username'] ?></td>
                    <td><?php echo $datos['salarioBruto'] ?></td>
                    <td><?php echo $datos['retencionIRPF'] ?></td>
                    <td><?php echo $datos['nombre_rol'] ?></td>
                    <td><?php echo $datos['country_name'] ?></td>
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
        <div class="card-footer">
            <nav aria-label="Navegacion por paginas">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=1" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">First</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=2&o" aria-label="Previous">
                            <span aria-hidden="true">&lt;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>

                    <li class="page-item active"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=4&order=1" aria-label="Next">
                            <span aria-hidden="true">&gt;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="/proveedores?page=8&order=1" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Last</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>