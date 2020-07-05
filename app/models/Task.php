<?php

require_once 'app/core/BaseActiveRecord.php';

/**
 * Class User
 */
class Task extends BaseActiveRecord
{

    /**
     * @var string
     */
    public static $table ="task";

    /**
     * @return array
     */
    public function getFieldNames()
    {
        return [
            'id', 'name', 'email', 'text', 'status',
        ];
    }



}