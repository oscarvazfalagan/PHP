
<?php
    if($x > $y && $x>$z):
        echo "Tus numeros ".$z." y ".$y." son menores que <strong>".$x."</strong>";
    elseif($y > $z ):
        echo "Tus numeros ".$z." y ".$x." son menores que <strong>".$y."</strong>";
    else:
        echo "Tus numeros ".$x." y ".$y." son menores que <strong>".$z."</strong>";
    endif;
?>