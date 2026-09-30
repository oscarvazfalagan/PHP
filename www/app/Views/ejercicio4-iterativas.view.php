<?php

declare(strict_types=1);
?>
<div class="row">
    <?php
    if (isset($mayor) && isset($menor)):
        ?>
        <div class="col-12 alert alert-success">
            <p>Mayor: <?php echo $mayor ?>, Menor: <?php echo $menor ?></p>
        </div>
    <?php endif; ?>
    <div class="col-12">
        <div class="card shadow mb-4">
            <p>Numeros ordenados :<?php echo implode(',', $arraySort); ?></p>
            </p>
            <form method="post" action="">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ordenación de mayor a menor</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="numeros">Introduce los números se separarán con comas y el cambio de línea se marca con el carácter | :</label>
                                <textarea name="texto" id="texto">
                                    <?php echo $texto ?? '' ?>
                                </textarea>
                                <p class="text-danger small"><?php echo $error ?? ''; ?></p>
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