<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;
use PDO;

class TrabajadorModel extends BaseDbModel
{
    private const string SELECT_FROM = "SELECT t.*, art.nombre_rol, ac.country_name FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country ";
    private const string SELECT_COUNT = "SELECT COUNT(*) FROM trabajadores t LEFT JOIN aux_rol_trabajador art ON art.id_rol = t.id_rol LEFT JOIN aux_countries ac ON ac.id = t.id_country ";
    private const array ORDER_FIELDS = ['t.username', 't.salarioBruto', 't.retencionIRPF', 'nombre_rol', 'country_name'];
    private const DEFAULT_ORDER_INDEX = 1;
    private const DEFAULT_ORDER_PAGES = 1;
    private const NUMBER_OF_ITEMS_IN_PAGE = 20;

    public function getFilterby(array $filtros): array
    {

        $values = [];
        $allConditionsFilter = [];
        if (!empty($filtros['username'])) {
            $allConditionsFilter[] = " username LIKE :username";
            $values["username"] = "%" . $filtros['username'] . "%";
        }
        if (!empty($filtros['rol'])) {
            $allConditionsFilter[] = "t.id_rol = :id_rol";
            $values["id_rol"] = $filtros['rol'];
        }if (!empty($filtros['salarioMinBruto'])) {
            $allConditionsFilter[] = "salarioBruto >= :min_salarioBruto";
            $values["min_salarioBruto"] = $filtros['salarioMinBruto'];
        }if (!empty($filtros['salarioMaximoBruto'])) {
            $allConditionsFilter[] = "salarioBruto <= :max_salarioBruto";
            $values["max_salarioBruto"] = $filtros['salarioMaximoBruto'];
        }if (!empty($filtros['retencionMin'])) {
            $allConditionsFilter[] = "retencionIRPF >= :min_retencionIRPF";
            $values["min_retencionIRPF"] = $filtros['retencionMin'];
        }if (!empty($filtros['retencionMax'])) {
            $allConditionsFilter[] = "retencionIRPF <= :max_retencionIRPF";
            $values["max_retencionIRPF"] = $filtros['retencionMax'];
        }if (!empty($filtros['idCountry']) && is_array($filtros['idCountry'])) {
            $countries = [];
            $i = 1;
            foreach ($filtros['idCountry'] as $idCountry) {
                $countries[":id_country{$i}"] = $idCountry;
                $i++;
            }
            $claves = array_keys($countries);
            $allConditionsFilter[] = "t.id_country IN (" . implode(", ", $claves) . ")";
            $values = array_merge($values, $countries);
        }
        $sql = self::SELECT_FROM;
        $sqlCount = self :: SELECT_COUNT;
        if($allConditionsFilter !== []){
            $whereClauses = " WHERE " . implode(" AND ", $allConditionsFilter);;
            $sql .=  $whereClauses;
            $sqlCount .= $whereClauses;
        }


        $pages = $this->getPages($filtros,$sqlCount,$values);
        $iniciolimit = ($pages['currentPage'] - 1)*self::NUMBER_OF_ITEMS_IN_PAGE;
        $sentido = !empty($filtros['sentido']) && $filtros['sentido'] === 'desc' ? 'DESC' : 'ASC';
        $sql .= " ORDER BY " . self::ORDER_FIELDS[$this->getOrderIndex($filtros) - 1] . " $sentido";
        $sql .= " LIMIT ". $iniciolimit ." , ". self::NUMBER_OF_ITEMS_IN_PAGE;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    public function getOrderIndex(array $filtros): int
    {
        if (empty($filtros['order'])) {
            return self::DEFAULT_ORDER_INDEX;
        } elseif (filter_var($filtros['order'], FILTER_VALIDATE_INT) === false || $filtros['order'] < 1 || $filtros['order'] > count(self::ORDER_FIELDS)) {
            return self::DEFAULT_ORDER_INDEX;
        } else {
            return (int)$filtros['order'];
        }
    }


    public function getPages(array $filtros,$sqlCount='',$values=[]): array
    {
        $page = $filtros['page'] ?? self::DEFAULT_ORDER_PAGES;
        $lastPages= PHP_INT_MAX;
        if (filter_var($page, FILTER_VALIDATE_INT) === false || $page < 1) {
            return self::DEFAULT_ORDER_PAGES;
        }
        if($sqlCount !== ''){
            $stmtCount = $this->pdo->prepare($sqlCount);
            $stmtCount->execute($values);
            $totalRegistros = (int)$stmtCount->fetchColumn();
            $lastPages = (int)ceil($totalRegistros / self::NUMBER_OF_ITEMS_IN_PAGE);
        }
        if($page>$lastPages){
            $page = $lastPages;
        }
        if($lastPages < 1){
            $lastPages = 1;
        }

        return [
            'currentPage'=>(int)$page
            ,'lastPage'=>(int)$lastPages
        ];
    }



    public function getTrabajadores():array{
            $sql = self::SELECT_FROM;
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll();
   }


    public function whereName($username):array{
        $sql = self::SELECT_FROM . " WHERE username LIKE :username";
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