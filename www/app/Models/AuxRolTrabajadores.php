<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class AuxRolTrabajadores extends BaseDbModel
{
    public function getRoles():array{
        $roles = $this->pdo->query('SELECT * FROM aux_rol_trabajador')->fetchAll();
        return $roles;
    }

}