
<?php
    if($bisiesto):
        echo "Tu año : ".$año."<br> <div class='alert alert-success'>Es un año bisiesto </div>";
    else:
        echo "Tu año : ".$año."<br> <div class='alert alert-danger'>No es bisiesto </div>";
    endif;
?>