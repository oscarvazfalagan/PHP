
<?php
    if($sueldoFinal>2000):
        echo "<div class='alert alert-success'>Felicidades, tienes un salario por encima de la media.</div>";
    endif;
    echo "Tienes un sueldo base: ".$sueldoBase."€ que te queda en ".$sueldoFinal."€";
?>
