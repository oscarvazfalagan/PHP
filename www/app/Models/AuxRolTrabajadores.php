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

    public function checkWhereID($idRol):array{
        $sql = ("SELECT  id_rol FROM aux_rol_trabajador WHERE id_rol == :idRol ");
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idRol' => $idRol]);
        return $stmt->fetchAll();
    }

}