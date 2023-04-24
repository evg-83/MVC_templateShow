<?php

/** DB trait */
trait Database
{
    /** Connect function */
    private function connect()
    {
        /** Connection itself **/
        $string = "mysql::hostname=" . DBHOST . "; dbname=" . DBNAME;
        
        /** A PDO instance creating a DB connection */
        $con = new PDO($string, DBUSER, DBPASS);

        return $con;
    }

    /** DB query function */
    public function query($query, $data=[])
    {
        $con = $this->connect();

        $stm = $con->prepare($query);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchall(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        } else {
            return false;
        }
    }

    /** Function for getting a row to the DB */
    public function getRow($query, $data=[])
    {
        $con = $this->connect();

        $stm = $con->prepare($query);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchall(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        }
        return false;
    }
}

