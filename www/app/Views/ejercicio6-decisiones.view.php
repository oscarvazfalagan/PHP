
<?php
    if($nota<5): ?>
        <div class='alert alert-danger'><?php echo $nota?> Suspenso</div>
    <?php elseif ($nota>=5 && $nota<6): ?>
        <div class='alert alert-warning'><?php echo $nota?> Aprobado</div>
    <?php elseif ($nota>=6 && $nota<7): ?>
        <div class='alert alert-info'><?php echo $nota?> Bien</div>
    <?php elseif ($nota>=7 && $nota<8.75): ?>
        <div class='alert alert-info'><?php echo $nota?> Notable</div>
    <?php elseif ($nota>=8.75 && $nota<10): ?>
        <div class='alert alert-success'><?php echo $nota?> Sobresaliente</div>
    <?php elseif ($nota==10): ?>
        <div class='alert alert-success'><?php echo $nota?> Matricula</div>
    <?php endif;
?>





