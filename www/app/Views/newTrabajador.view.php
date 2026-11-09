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
                        </div>
                        <div class="col-4 mb-3">
                            <label for="alias">SalarioBruto:</label>
                            <input type="text" class="form-control" name="salarioBruto" id="salarioBruto" value="<?php echo $input["salarioBruto"] ?? ''; ?>"/>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Retencion:</label>
                                <input type="text" class="form-control" name="retencion" id="retencion" min="0" max="100" value="<?php echo $input["retencion"] ?? ''; ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="alias">activo:</label>
                                    <input type="text" class="form-control" name="activo" id="activo" value="<?php echo $input["activo"] ?? ''; ?>"/>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>