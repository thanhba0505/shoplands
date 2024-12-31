<?php

require_once 'app/Models/ConnectDatabase.php';

class QueryDatabase extends ConnectDatabase
{
    protected $table;
    protected $query;
    protected $params = [];
    protected $join = '';
    protected $where = '';
    protected $groupBy = '';
    protected $orderBy = '';
    protected $limit = '';


    public function select($columns = '*')
    {
        if ($columns === '*') {
            $this->query = "SELECT {$this->table}.* FROM {$this->table}";
        } else {
            $columns = array_map(function ($column) {
                return strpos($column, '.') === false ? "{$this->table}.$column" : $column;
            }, (array) $columns);
            $this->query = "SELECT " . implode(', ', $columns) . " FROM {$this->table}";
        }
        return $this;
    }

    public function joinWithSubquery($subquery, $alias, $onCondition, $joinType = 'INNER')
    {
        if (strpos($this->query, 'SELECT') !== false) {
            $this->query = preg_replace('/SELECT (.*?) FROM/', 'SELECT $1, ' . $alias . '.* FROM', $this->query);
        }
        $this->join .= " $joinType JOIN ($subquery) AS $alias ON $onCondition";
        return $this;
    }

    public function from($table)
    {
        $this->table = $table;
        return $this;
    }

    public function where($condition, ...$values)
    {
        // $this->where('status = ? AND role = ?', $status, $role)->all();

        $placeholders = [];
        foreach ($values as $value) {
            $placeholder = ':param' . count($this->params);
            $placeholders[] = $placeholder;
            $this->params[$placeholder] = $value;
        }

        if (strpos($condition, '?') !== false) {
            $condition = str_replace('?', implode(',', $placeholders), $condition);
        }

        if (empty($this->where)) {
            $this->where = " WHERE $condition";
        } else {
            $this->where .= " AND $condition";
        }

        return $this;
    }

    public function joinWithConditions(
        $tableToJoin,
        $onCondition,
        $joinColumns = '',
        $joinType = 'INNER'
    ) {
        if (!empty($joinColumns)) {
            $joinColumns = array_map(function ($column) use ($tableToJoin) {
                return strpos($column, '.') === false ? "$tableToJoin.$column" : $column;
            }, explode(',', $joinColumns));

            $joinColumnsString = implode(', ', $joinColumns);
            $this->query = preg_replace(
                '/^SELECT\s+(.*?)\s+FROM/',
                "SELECT $1, $joinColumnsString FROM",
                $this->query
            );
        }

        $this->join .= " $joinType JOIN $tableToJoin ON $onCondition";
        return $this;
    }

    public function groupBy($columns)
    {
        $this->groupBy = " GROUP BY $columns";
        return $this;
    }

    public function orderBy($columns, $direction = 'ASC')
    {
        $this->orderBy = " ORDER BY $columns $direction";
        return $this;
    }

    public function limit($limit, $offset = 0)
    {
        $this->limit = " LIMIT $offset, $limit";
        return $this;
    }

    public function buildQuery()
    {
        // Kiểm tra nếu không có cột nào được chỉ định
        if (strpos($this->query, 'SELECT') === false) {
            $this->select('*');
        }

        return $this->query
            . $this->join
            . $this->where
            . $this->groupBy
            . $this->orderBy
            . $this->limit;
    }

    public function all()
    {
        $finalQuery = $this->buildQuery();
        $stmt = $this->query($finalQuery, $this->params);
        $this->resetQuery();
        return $stmt->fetchAll();
    }

    public function first()
    {
        $finalQuery = $this->buildQuery();
        $stmt = $this->query($finalQuery, $this->params);
        $this->resetQuery();
        return $stmt->fetch();
    }

    public function count()
    {
        $this->query = str_replace('SELECT', 'SELECT COUNT(*)', $this->query);
        $stmt = $this->query($this->query, $this->params);
        $this->resetQuery();
        return $stmt->fetchColumn();
    }

    private function resetQuery()
    {
        $this->query = '';
        $this->join = '';
        $this->where = '';
        $this->groupBy = '';
        $this->orderBy = '';
        $this->limit = '';
        $this->params = [];
    }

    public function insert($data)
    {
        if (empty($data)) {
            return 0;
        }

        $columns = implode(',', array_keys($data));

        $placeholders = '(' . implode(', ', array_fill(0, count($data), '?')) . ')';
        $sql = "INSERT INTO {$this->table} ($columns) VALUES $placeholders";

        $values = array_values($data);

        $stmt = $this->query($sql, $values);
        return $stmt->rowCount();
    }


    public function insertMultiple($data)
    {
        // $data = [
        //     ['name' => 'Product A', 'price' => 100, 'description' => 'A new product'],
        //     ['name' => 'Product B', 'price' => 150, 'description' => 'Another product'],
        //     ['name' => 'Product C', 'price' => 200, 'description' => 'Yet another product']
        // ];

        if (empty($data)) {
            return 0;
        }

        $columns = implode(',', array_keys($data[0]));

        $placeholders = '(' . implode(', ', array_fill(0, count($data[0]), '?')) . ')';
        $sql = "INSERT INTO {$this->table} ($columns) VALUES " . implode(', ', array_fill(0, count($data), $placeholders));

        $values = [];
        foreach ($data as $row) {
            $values = array_merge($values, array_values($row));
        }

        $stmt = $this->query($sql, $values);
        return $stmt->rowCount();
    }


    public function updateWithConditions($data)
    {
        if (empty($this->where)) {
            throw new Exception("No WHERE condition. Please use where() before calling update.");
        }

        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :update_$key, ";
            $this->params["update_$key"] = $value;
        }
        $fields = rtrim($fields, ', ');

        $this->query = "UPDATE {$this->table} SET $fields " . $this->where;

        // Thực thi câu truy vấn
        $stmt = $this->query($this->query, $this->params);
        $this->resetQuery();
        return $stmt->rowCount();
    }


    public function deleteWithConditions()
    {
        if (empty($this->where)) {
            throw new Exception("No WHERE condition. Please use where() before calling delete.");
        }

        $this->query = "DELETE FROM {$this->table} " . $this->where;

        $stmt = $this->query($this->query, $this->params);
        $this->resetQuery();
        return $stmt->rowCount();
    }
}
