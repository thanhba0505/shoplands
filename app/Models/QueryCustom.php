<?php

require_once 'app/Models/ConnectDatabase.php';

class QueryCustom extends ConnectDatabase
{
    private $query;
    private $params;

    public function __construct()
    {
        parent::__construct();
        $this->query = '';
        $this->params = [];
    }

    public function select($columns = '*')
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }
        $this->query .= "SELECT $columns ";
        return $this;
    }

    public function from($table)
    {
        $this->query .= "FROM $table ";
        return $this;
    }

    public function join($table, $on, $type = 'INNER')
    {
        $this->query .= "$type JOIN $table ON $on ";
        return $this;
    }

    public function joinSubQuery($subQuery, $alias, $on, $type = 'INNER')
    {
        $this->query .= "$type JOIN ($subQuery) AS $alias ON $on ";
        return $this;
    }

    public function where($condition, $params = [])
    {
        $this->query .= "WHERE $condition ";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function andWhere($condition, $params = [])
    {
        $this->query .= "AND $condition ";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function orWhere($condition, $params = [])
    {
        $this->query .= "OR $condition ";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function orderBy($columns)
    {
        $this->query .= "ORDER BY $columns ";
        return $this;
    }

    public function limit($limit)
    {
        $this->query .= "LIMIT $limit ";
        return $this;
    }

    public function build()
    {
        return ['sql' => trim($this->query), 'params' => $this->params];
    }

    public function all()
    {
        $queryData = $this->build();
        $stmt = $this->query($queryData['sql'], $queryData['params']);
        return $stmt->fetchAll();
    }

    public function first()
    {
        $queryData = $this->build();
        $stmt = $this->query($queryData['sql'], $queryData['params']);
        return $stmt->fetch();
    }

    public function insert($table, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $this->query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->params = $data;
        $this->execute();
        return $this;
    }

    public function update($table, $data, $condition, $params = [])
    {
        $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        $this->query = "UPDATE $table SET $setClause WHERE $condition";
        $this->params = array_merge($data, $params);
        $this->execute();
        return $this;
    }

    public function delete($table, $condition, $params = [])
    {
        $this->query = "DELETE FROM $table WHERE $condition";
        $this->params = $params;
        $this->execute();
        return $this;
    }

    private function execute()
    {
        $stmt = $this->query($this->query, $this->params);
        $this->reset();
        return $stmt;
    }

    public function reset()
    {
        $this->query = '';
        $this->params = [];
        return $this;
    }
}

// Usage example:
// $queryBuilder = new QueryDatabase();
// $results = $queryBuilder->from('orders')
//                        ->select(['id', 'subtotal_price', 'payment_method'])
//                        ->where('seller_id = :sellerId', ['sellerId' => $sellerId])
//                        ->limit(10)
//                        ->all();
// print_r($results);

// $firstResult = $queryBuilder->from('orders')
//                            ->select(['id', 'subtotal_price', 'payment_method'])
//                            ->where('seller_id = :sellerId', ['sellerId' => $sellerId])
//                            ->first();
// print_r($firstResult);

// Usage example:
// $queryBuilder = new QueryDatabase();
// Insert:
// $queryBuilder->insert('orders', ['id' => 1, 'subtotal_price' => 100, 'payment_method' => 'card']);
// Update:
// $queryBuilder->update('orders', ['subtotal_price' => 200], 'id = :id', ['id' => 1]);
// Delete:
// $queryBuilder->delete('orders', 'id = :id', ['id' => 1]);

// Usage example:
// $queryBuilder = new QueryDatabase();
// Join subquery:
// $subQuery = "SELECT id, COUNT(*) AS order_count FROM orders GROUP BY id";
// $results = $queryBuilder->from('users')
//                        ->select(['users.id', 'users.name', 'o.order_count'])
//                        ->joinSubQuery($subQuery, 'o', 'users.id = o.id')
//                        ->all();
// print_r($results);