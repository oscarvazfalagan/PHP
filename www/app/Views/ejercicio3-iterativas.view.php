<?php

declare(strict_types=1);
?>
<div class="row">
    <?php
    if (isset($resultado) && $resultado !== []):
        ?>
        <div class="col-12 alert alert-success">
            <table class="table table-bordered">
                <?php
                foreach ($resultado as $row):
                    ?>
                    <tr>
                        <?php
                        foreach ($row as $column):
                            ?>
                            <td><?= $column ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="post" action="">
                <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ordenación matriz de mayor a menor</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="numeros">Matriz a ordenar:</label>
                                <input type="text" class="form-control" name="numeros" id="numeros" value="<?php echo $numeros ?? '' ?>" placeholder="1,2,3|4,5,6|7,8,9" />
                                <p class="text-danger small"><?php echo $errores['numeros'] ?? ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">
                        <input type="submit" value="Ordenar números" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
