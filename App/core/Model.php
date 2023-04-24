<?php

/** Trait model */
trait Model
{
    use Database;

    /** Pagination limit */
    protected $limit        = 10;

    /** Pagination offset */
    protected $offset       = 0;

    /** Descending order type */
    protected $order_type   = 'desc';

    /** Order column */
    protected $order_column = 'id';

    /** Errors */
    public $errors = [];

    /** Function to find all results */
    public function findAll()
    {
        $query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }

    /** Multiple row return function */
    public function where($data, $dataNot = [])
    {
        $keys    = array_keys($data);
        $keysNot = array_keys($dataNot);

        $query   = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keysNot as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query  = trim($query, " && ");

        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        $data   = array_merge($data, $dataNot);

        return $this->query($query, $data);
    }

    /** Single row return function */
    public function first($data, $dataNot = [])
    {
        $keys    = array_keys($data);
        $keysNot = array_keys($dataNot);

        $query   = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keysNot as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query  = trim($query, " && ");

        $query .= " limit $this->limit offset $this->offset";

        $data   = array_merge($data, $dataNot);

        $result = $this->query($query, $data);

        if ($result) {
            return $result[0];
        }
        return false;
    }

    /** Add function */
    public function insert($data)
    {
        /** Deleting unnecessary data */
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys  = array_keys($data);

        $query = "insert into $this->table (" . implode(',', $keys) . ") values (:" . implode(',:', $keys) . ")";

        $this->query($query, $data);

        return false;
    }

    /** Update function */
    public function update($id, $data, $id_column = 'id')
    {
        /** Deleting unnecessary data */
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys  = array_keys($data);

        $query = "update $this->table set ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ', ');

        $query .= " where $id_column = :$id_column";

        $data[$id_column] = $id;

        $this->query($query, $data);

        return false;
    }

    /** Delete function */
    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;

        $query = "delete from $this->table where $id_column = :$id_column";

        $this->query($query, $data);

        return false;
    }
}
