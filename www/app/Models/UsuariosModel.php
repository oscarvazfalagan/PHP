<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuariosModel extends BaseDbModel
{
    private const string SELECT_ALL = "SELECT usr.* , aux.rol FROM usuario_sistema usr LEFT JOIN aux_rol  aux ON usr.id_rol = aux.id_rol";
    public function getUsuarios(array $filtros) :array{
            $values = [];
            $allConditionsFilter = [];
            if(!empty($filtros['email'])){
                $allConditionsFilter[] = " usr.email LIKE :email";
                $values["email"] = "%".$filtros['email']."%";
            }
            if(!empty($filtros['nombre'])){
                $allConditionsFilter[] = " usr.nombre LIKE :nombre";
                $values["nombre"] = "%".$filtros['nombre']."%";
            }
            if(!empty($filtros['idioma'])){
                $allConditionsFilter[] = " usr.idioma LIKE :idioma";
                $values["idioma"] = "%".$filtros['idioma']."%";
            }

            if(!empty($filtros['idRol']) && is_array($filtros['idRol'])){
                $roles = [];
                $i = 1;
                foreach ($filtros['idRol'] as $idRol) {
                    $roles[":id_rol{$i}"] = $idRol;
                    $i++;
                }
                $claves = array_keys($roles);
                $allConditionsFilter[] = "usr.id_rol IN (" . implode(", ", $claves) . ")";
                $values = array_merge($values, $roles);
            }

            $sql = self :: SELECT_ALL;
            if(!empty($allConditionsFilter)){
                $sql .= " WHERE " . implode(" AND ", $allConditionsFilter);
            }

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return $stmt->fetchAll();
    }

    public function getIdiomas() :array{
        $idiomas = $this->pdo->query('SELECT DISTINCT idioma FROM usuario_sistema')->fetchAll();
        return $idiomas;
    }
}