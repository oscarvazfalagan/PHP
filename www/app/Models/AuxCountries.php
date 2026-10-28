<?php
declare(strict_types=1);

namespace Com\Daw2\Models;

use Com\Daw2\Core\BaseDbModel;

use PDO;

class AuxCountries extends BaseDbModel
{
    public function getCountries():array{
        $roles = $this->pdo->query('SELECT * FROM aux_countries')->fetchAll();
        return $roles;
    }

}