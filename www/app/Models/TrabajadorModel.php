<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadorModel extends BaseDbModel
{
    private const string SELECT_FROM = "SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country";

    public function getTrabajadores():array{
            $sql = self::SELECT_FROM;
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();

   }

   public function getRoles():array{
       $roles = $this->pdo->query('SELECT * FROM aux_rol_trabajador')->fetchAll();
       return $roles;
    }
    public function whereName($username):array{
        $sql = 'SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country WHERE username LIKE :username';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => "%{$username}%"]);
        return $stmt->fetchAll();
    }

    public function whereIdRol($idRol):array{
        $sql = 'SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country WHERE art.id_rol = :idRol';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idRol' => "$idRol"]);
        return $stmt->fetchAll();
    }


}