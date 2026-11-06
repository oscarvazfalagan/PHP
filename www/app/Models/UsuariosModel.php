<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

class UsuariosModel extends BaseDbModel
{
    private const string SELECT_ALL = "SELECT usr.* , aux.rol FROM usuario_sistema usr LEFT JOIN aux_rol  aux ON usr.id_rol = aux.id_rol";
    private const string SELECT_COUNT = "SELECT COUNT(*) FROM usuario_sistema usr LEFT JOIN aux_rol  aux ON usr.id_rol = aux.id_rol ";
    private const int DEFAULT_ORDER = 1;
    private const int DEFAULT_PAGE = 1;
    private const int ELEMENTS_FOR_PAGE = 20;
    private const array ORDER_FIELDS= ['aux.rol','usr.email','usr.nombre','usr.idioma','usr.last_date'];
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
            $sqlCount = self :: SELECT_COUNT;
            if(!empty($allConditionsFilter)){
                $conditions = " WHERE " . implode(" AND ", $allConditionsFilter);
                $sql .= $conditions;
                $sqlCount = $conditions;
            }
            $stmtCount = $this->pdo->prepare($sqlCount);
            $stmtCount->execute($values);
            $totalRegistros = (int)$stmtCount->fetchColumn();
            $lastPages = (int)ceil($totalRegistros / self::ELEMENTS_FOR_PAGE);
            $page = $this->getPage();
            if($page>$lastPages){
                $page = $lastPages;
            }
            if($lastPages < 1){
                $lastPages = 1;
            }
            $limit = ($page-1) *  self::ELEMENTS_FOR_PAGE;

            $sentido = !empty($filtros['sentido']) && $filtros['sentido'] === 'desc' ? 'DESC' : 'ASC';
            $sql .= " ORDER BY " . self::ORDER_FIELDS[$this->getOrder($filtros) - 1] . " $sentido";
            $sql .= " LIMIT ".$limit.", ".self::ELEMENTS_FOR_PAGE;
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return [
               'usuarios' => $stmt->fetchAll(),
                'lastPage' => $lastPages
            ];
    }

    public function getIdiomas() :array{
        $idiomas = $this->pdo->query('SELECT DISTINCT idioma FROM usuario_sistema')->fetchAll();
        return $idiomas;
    }

    public function getOrder(array $filtros) :int{
        if(empty($filtros['order'])){
            return self::DEFAULT_ORDER;
        }elseif (filter_var($filtros['order'], FILTER_VALIDATE_INT) === false || $filtros['order'] < 1 || $filtros['order'] > count(self::ORDER_FIELDS)) {
            return self::DEFAULT_ORDER;
        }else{
            return  (int)$filtros['order'];
        }
    }

    public function getPage() :int{
        if(empty($filtros['page'])){
            return self::DEFAULT_PAGE;
        }elseif (filter_var($filtros['order'], FILTER_VALIDATE_INT) === false || $filtros['order'] < 1){
            return self::DEFAULT_ORDER;
        }else{
            return(int)$filtros['page'];
        }
    }


}