<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadorModel extends BaseDbModel
{
   public function getTrabajadores():array{
       $trabajadores = $this ->pdo -> query('SELECT * FROM trabajadores') -> fetchAll();
              return $trabajadores;
   }
}