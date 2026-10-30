<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

use PDO;
class AuxRol extends BaseDbModel
{
    public function getAllRoles() :array
    {
        $roles = $this->pdo->query('SELECT * FROM aux_rol') -> fetchAll();
        return $roles;
    }
}