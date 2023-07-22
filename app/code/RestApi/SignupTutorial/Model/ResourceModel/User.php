<?php

declare(strict_types=1);

namespace RestApi\SignupTutorial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class User extends AbstractDb 
{
    private const TABLE_NAME = 'user';
    private const PRIMARY_KEY = 'id';

    public function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}