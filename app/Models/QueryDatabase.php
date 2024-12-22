<?php

require_once 'app/Models/ConnectDatabase.php';

class QueryDatabase extends ConnectDatabase
{
    protected $table;

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->query($sql)->fetchAll();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->query($sql, ['id' => $id])->fetch();
    }

    public function create($data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        return $this->query($sql, $data);
    }

    public function update($id, $data)
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        return $this->query($sql, $data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->query($sql, ['id' => $id]);
    }
}
