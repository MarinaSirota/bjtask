<?php

require_once 'app/core/BaseActiveRecord.php';

/**
 * Class User
 */
class User extends BaseActiveRecord
{

    /**
     * @var string
     */
    public static $table ="user";

    /**
     * @return array
     */
    public function getFieldNames()
    {
        return [
            'id', 'email','password'
        ];
    }



}