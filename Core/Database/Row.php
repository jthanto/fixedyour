<?php

namespace fixedyour\Core\Database;

abstract class Row
{

    private $rowData = [];
    private $DP;

    /**
     * Row constructor.
     * @param $dataProviderObject
     */
    public function __construct($dataProviderObject){
        $this->DP = $dataProviderObject;
    }

    /**
     * @param $parameter
     * @return mixed|null
     */
    public function get($parameter){
        if(isset($this->rowData[$parameter])){
            return $this->rowData[$parameter];
        }
        return null;
    }


}