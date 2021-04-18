<?php

namespace fixedyour\Core\Database;

use fixedyour\Core\Utilities;
use PDO;
use Throwable;

abstract class Row
{
    private $rowData = [];
    /**
     * Row constructor.
     * @var $DP Database
     */
    private $DP;

    const Q_KEY = 'key';
    const Q_OPERATOR = 'opreator';
    const Q_VALUE = 'value';    const FETCH_ALL = 'all';
    const FETCH_ONE = 'one';

    const LEFT_JOIN = 'left';
    const OUTER_JOIN = 'outer';
    const INNER_JOIN = 'inner';

    const VALID_JOINS = [
      self::LEFT_JOIN => 'LEFT',
      self::OUTER_JOIN => 'INNER',
      self::INNER_JOIN => 'OUTER',
    ];

    private $select = [];
    private $from = '';
    private $where = [];
    private $join = [];
    private $order_by = [];
    private $limit = 10;
    private $sql;

    private $tableName = '';
//    private VALID_WHERE_TYPES = [
//        ]

    /**
     * Row constructor.
     * @param $dataProviderObject
     */
    public function __construct($dataProviderObject){
        $this->DP = $dataProviderObject;
    }

    public function setTable($table){
        $this->tableName = $table;
    }

    public function getTable(){
        return $this->tableName;
    }
    public function setWhereType(){

    }

    public function select($val){
        if(is_null($val)){
            $this->select = [];
        } elseif(is_array($val)){
            $this->select = array_merge($this->select, $val);
        } else {
            $this->select[] = $val;
        }
        return $this;
    }

    public function from($val){
        if(is_string($val)){
            $this->from = $val;
        }
        return $this;
    }

    public function where($key, $val=null, $operator=null){
        if(is_null($val)){
            $this->where = [];
        }
        $this->where[][self::Q_KEY] = $key;
        $this->where[count($this->where)-1][self::Q_VALUE] = $val;
        $this->where[count($this->where)-1][self::Q_OPERATOR] = $operator ?? '=';
//        if(isset($keyval[0]) && is_array($keyval[0])){
//            $this->where = $keyval;
//        } elseif(is_array($keyval)){
//            $this->where[] = $keyval;
//        }
//        Utilities::debug($this->where);
        return $this;
    }

    public function join($table=null, $statement=null, $type='left'){
        if(is_null($table) || is_null($statement)){
            $this->join = [];
        }
        $this->join[] = [
            'table' => $table,
            'statement' => $statement,
            'type' => self::VALID_JOINS[$type] ?? 'LEFT'
        ];
        return $this;
    }


    public function sql($sql){
        $this->sql = $sql;
        return $this;
    }

    public function order_by($col){
        $this->order_by[] = $col;
        return $this;
    }

    public function limit($nr){
        $this->limit = $nr;
        return $this;
    }

    function get($fetch = self::FETCH_ALL, $limit=null){
        $sql = 'SELECT '.implode(', ', $this->select).' FROM '.$this->from;
        $data = [];

        foreach ($this->join ?? [] as $idx => $join) {
            $sql .= ' ' . $join['type'] . ' JOIN ' . $join['table'] . ' ON ' . $join['statement'];
        }

        if(!empty($this->where)){
            $sql.= ' WHERE';
            foreach($this->where as $idx => $arr){
                $safekey = ':'.str_replace(['.',' '], '', $arr[self::Q_KEY]);
                if(isset($data[':'.$safekey])){
                    $safekey.=rand(0,1000);
                }
                $sub = is_string($arr[self::Q_VALUE]) ? ''.$safekey.' ': ' '.$safekey.' ';
                $sql.= ' '.$arr[self::Q_KEY].' '.($arr[self::Q_OPERATOR] ?? '=').$sub;

                $data[$safekey] = $arr[self::Q_VALUE];
            }
//            Utilities::debug($data);
        }

        if($this->order_by && !empty($this->order_by)){
            $sql.= ' ORDER BY '.implode(',', $this->order_by);
        }

        if($limit || $this->limit){
            $sql.=' LIMIT '. (is_numeric($limit) ? $limit : $this->limit);
        }



//        echo "\n";
//        print_r($sql);
//        echo "\n";
//        print_r($data);
//        echo "\n";
//        die();

        $statement = $this->DP->prepare($sql);
//        Utilities::debug($statement->debugDumpParams());
//        die();
        $statement->execute($data);

        try{

            switch ($fetch){
                case self::FETCH_ONE:
                    return $statement->fetch(PDO::FETCH_ASSOC);
                case self::FETCH_ALL:
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                default:
                    return [];
            }
        } catch(Throwable $t){
            print_r($t);
        }

    }

}