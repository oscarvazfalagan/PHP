<?php

declare(strict_types=1);

?>
<div class="row">
    <?php
    if (!empty($resultado)) {
        ?>
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Media</th>
                    <th>Suspensos</th>
                    <th>Aprobados</th>
                    <th>Nota max</th>
                    <th>Nota min</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($resultado as $nombreAsignatura => $datos) {
                    ?>
                    <tr>
                        <?php
                        if ($datos['media'] === null) {
                            ?>
                            <td><?php echo $nombreAsignatura ?></td>
                            <td colspan="99"><i>Sin alumnado</i></td>
                            <?php
                        } else { ?>
                            <td><?php echo $nombreAsignatura ?></td>
                            <td><?php echo $datos['media'] ?></td>
                            <td><?php echo $datos['suspensos']; ?></td>
                            <td><?php echo $datos['aprobados']; ?></td>
                            <td><?php echo $datos['max']['alumno'] . ": " . $datos['max']['nota'] ?></td>
                            <td><?php echo $datos['min']['alumno'] . ": " . $datos['min']['nota'] ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

        <div class="alert alert-success">
            <h3>Han aprobado todo</h3>
            <ul>
            <?php
            foreach ($suspensos as $nombreSuspenso => $datos) {
            ?>

                    <?php
                    if($suspensos[$nombreSuspenso] == 0) :?>
                        <li><?php echo $nombreSuspenso; ?></li>
                        <?php
                    endif;
                    }
                    ?>
            </ul>
        </div>
        <div class="alert alert-warning">
            <h3>Han suspenido al menos una</h3>
            <ul>
                <?php
                foreach ($suspensos as $nombreSuspenso => $datos) {
                    ?>

                    <?php
                    if($suspensos[$nombreSuspenso] >= 1) :?>
                        <li><?php echo $nombreSuspenso; ?></li>
                    <?php
                    endif;
                }
                ?>
            </ul>
        </div>
        <div class="alert alert-info">
            <h3>Promocionan</h3>
            <ul>
                <?php
                foreach ($suspensos as $nombreSuspenso => $datos) {
                    ?>

                    <?php
                    if($suspensos[$nombreSuspenso] <= 1) :?>
                        <li><?php echo $nombreSuspenso; ?></li>
                    <?php
                    endif;
                }
                ?>
            </ul>
        </div>
        <div class="alert alert-danger">
            <h3>No promocionan</h3>
            <ul>
                <?php
                foreach ($suspensos as $nombreSuspenso => $datos) {
                    ?>

                    <?php
                    if($suspensos[$nombreSuspenso] >= 2) :?>
                        <li><?php echo $nombreSuspenso; ?></li>
                    <?php
                    endif;
                }
                ?>
            </ul>
        </div>

        <?php
    }
    ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cálculo de notas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="numeros">Json con los datos:</label>
                                <textarea class="form-control" rows="10"
                                          name="json"><?php echo $json ?? ''; ?></textarea>
                                <p class="text-danger small">
                                    <?php
                                    if (!empty($errores)) {
                                        foreach ($errores['json'] as $error) {
                                            echo $error . '<br/>';
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Hacer cálculos" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
