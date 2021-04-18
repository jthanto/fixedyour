<?php


namespace fixedyour\Core\Models;

use fixedyour\Core\Database\Database;
use fixedyour\Core\Database\Row;
use fixedyour\Core\Utilities;

class Quote extends Row{
    public function __construct() {
        parent::__construct(new Database('fixedyour'));
        $this->setTable('quotes');
    }

    static function getRandomQuote(){
        $quote = new self();
        return $quote->select('*')->from($quote->getTable())->order_by('RAND()')->get(self::FETCH_ONE);
    }
}
