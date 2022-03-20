<?php

    namespace App\src\DAO;

    use App\core\DAO;

    class ImportDAO extends DAO
    {
        public function importData(array $data)
        {
            $sql = "INSERT INTO musique.data (group_name, origin, city, starting_year, separation_year, founder_name, member_nb, style, summary)
		            VALUES (:group_name, :origin, :city, :starting_year, :separation_year,  :founder_name, :member_nb, :style, :summary)";
            $this->creatQuery($sql, $data);
        }

        public function checkDuplicate($groupName)
        {
            $sql = 'SELECT group_name FROM musique.data WHERE group_name=:group_name ';
            $result = $this->creatQuery($sql, [
                'group_name' => $groupName
            ]);
            return $result->fetch();
        }
    }