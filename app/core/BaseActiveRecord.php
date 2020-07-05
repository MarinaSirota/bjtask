<?php

/**
 * Class BaseActiveRecord
 */
abstract class BaseActiveRecord
{
    // объект для доступа к PDO
    /**
     * @var
     */
    public static $pdo;
    /**
     * @var array
     */
    private   $fields  =[];
    /**
     * @var array
     */
    protected $orderBy = ['id' => 'ASC'];

    abstract function getFieldNames();

    /**
     * @param $name
     * @param $value
     * @return null
     */
    public function __set($name, $value)
    {
        if(!in_array($name, $this->getFieldNames())) {
            return null;
        }
        $this->fields[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if(isset($this->fields[$name])) {
            return $this->fields[$name];
        }
        return null;
    }

    /**
     * @param $order
     */
    public function orderBy($order)
    {
        $this->orderBy = $order;
    }

    /**
     * @return bool
     */
    public function save() {
        $fields = implode(',', array_keys($this->fields));
        if($this->id==null){
            $values = ':' . implode(',:', array_keys($this->fields));
            $query = 'INSERT INTO '.static::$table."($fields) VALUES ($values)";
        } else {
            $tmpArray = array_diff(array_keys($this->fields), ['id']);
            array_walk($tmpArray, function (&$item){
                $item = "$item = :$item";
            });

            $query = 'UPDATE '.static::$table." SET ".implode(',', $tmpArray) ." WHERE id=:id";
        }
        $s = self::$pdo->prepare($query);
        foreach ($this->fields as $key => $value) {
            $s->bindParam(':' .$key, $this->fields[$key]);
        }
        if($s->execute()) {
            if(is_null($this->id)) {
                $this->id = self::$pdo->lastInsertId();
            }
            return true;
        }
        return false;
    }
    public function delete() {
        $query = 'DELETE * FROM '.static::$table.' WHERE id = :id';
        $s = self::$pdo->prepare($query);
        $s->bindParam(':id', $this->id);
        return $s->execute();
    }

    /**
     * @param $id
     * @return static|null
     */
    public static function find($id)
    {
        // подготавливаем SQL запрос
        $query = 'SELECT * FROM '.static::$table.' WHERE id = :id';
        $s = self::$pdo->prepare($query);

        // подставляем в запрос идентификатор записи,
        // которую необходимо извлечь из БД
        $s->bindParam(':id', $id);

        // получаем запись из БД в виде ассоциативного массива
        $s->execute();
        $row = $s->fetch(PDO::FETCH_ASSOC);

        // если ничего не найдено, то возвращаем NULL
        if (!$row) {
            return null;
        }
        $ar = new static();
        foreach ($row as $key => $value) {
            $ar->$key = $value;
        }
        return $ar;
    }

    /**
     * @param array $params
     * @return array
     */
    public static function findAll($params = []) {
        $query = 'SELECT * FROM '.static::$table;
        if(count($params) > 0) {
            $query .= ' WHERE ';
            $tmpArray = array_keys($params);
            array_walk($tmpArray, function (&$item){
                $item = "$item = :$item";
            });
            $query .= implode(' AND ', $tmpArray);
            $s = self::$pdo->prepare($query);
            foreach ($params as $key => $value) {
                $s->bindParam(':' .$key, $value);
            }
        } else {
            $s = self::$pdo->prepare($query);
        }

        $s->execute();
        $rows = $s->fetchAll(PDO::FETCH_ASSOC);
        $activeRecords=[];
        foreach ($rows as $row){
            $ar = new static();
            foreach ($row as $key => $value) {
                $ar->$key = $value;
            }
            $activeRecords[] = $ar;
        }
        return $activeRecords;
    }

    /**
     * @param $page
     * @param $perPage
     * @param array $orderBy
     * @return array
     */
    public static function findAllLimit($page, $perPage, $orderBy =['id' => 'ASC']){

        // вычисляем первый операнд для LIMIT
        $page = $page - 1;
        $start=abs($page*$perPage);

        $totalRowsQuery = "SELECT COUNT(*) FROM ".static::$table;
        $s = self::$pdo->prepare($totalRowsQuery);
        $s->execute();
        $totalRows = $s->fetchColumn();


        $query = "SELECT * FROM ".static::$table." ORDER BY ".key($orderBy) . " ".current($orderBy) ." LIMIT $start, $perPage";
        $s = self::$pdo->prepare($query);
        $s->execute();
        $rows = $s->fetchAll(PDO::FETCH_ASSOC);
        $activeRecords=[];
        foreach ($rows as $row){
            $ar = new static();
            foreach ($row as $key => $value) {
                $ar->$key = $value;
            }
            $activeRecords[] = $ar;
        }
        return [
            'objects' => $activeRecords,
            'totalRows' => $totalRows
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        foreach ($this->getFieldNames() as $field) {
            $data[$field] = $this->$field;
        }
        return $data;
    }
}
