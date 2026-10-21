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
                <input type="hidden" name="order" value="1"/>
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
                                <input type="text" class="form-control" name="username" id="username" value=<?php echo $input["username"]; ?>> ?? '' ?>>
                            </div>
                        </div>
                        <?php
                            if(!empty($input["roles"])):
                                ?>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control" data-placeholder="Rol">
                                    <option value="">-</option>
                                    <?php foreach ($input["roles"] as $rol => $dataRol): ?>
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
                                <input type="text" class="form-control" name="salarioMinBruto" id="salarioMinBruto" placeholder="0"  value=<?php echo $username ?? '' ?>>
                              </div>
                            <div class="mb-3">
                                <label for="alias">Valor Maximo:</label>
                                <input type="text" class="form-control" name="username" id="username" value=<?php echo $username ?? '' ?>>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_continente">Continente:</label>
                                <select name="id_continente" id="id_continente" class="form-control" data-placeholder="Continente">
                                    <option value="">-</option>
                                    <option value="1" >Europa</option>
                                    <option value="2" >Asia</option>
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
            <thead>
            <tr>
                <th>USERNAME</th>
                <th>SALARIO BRUTO</th>
                <th>RETENCION IRPF</th>
                <th>ACTIVO</th>
                <th>ROL</th>
                <th>COUNTRY</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($trabajadores as $trabajador => $datos) {
                ?>
                <tr>
                    <td><?php echo $datos['username'] ?></td>
                    <td><?php echo $datos['salarioBruto'] ?></td>
                    <td><?php echo $datos['retencionIRPF'] ?></td>
                    <td><?php echo $datos['activo'] ?></td>
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

    </div>
</div>