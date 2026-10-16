<?php

declare(strict_types=1);

?>
<div class="row">
    <?php
    if (!empty($trabajadores)) {
    ?>
    <div class="col-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>USERNAME</th>
                <th>SALARIO BRUTO</th>
                <th>RETENCION IRPF</th>
                <th>ACTIVO</th>
                <th>ID_ROL</th>
                <th>ID_COUNTRY</th>
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
                    <td><?php echo $datos['id_rol'] ?></td>
                    <td><?php echo $datos['id_country'] ?></td>
                </tr>
                <tr>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
        <?php
    }
?>