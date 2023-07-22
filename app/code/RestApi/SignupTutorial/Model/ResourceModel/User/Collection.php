<?php

namespace RestApi\SignupTutorial\Model\ResourceModel\User;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("RestApi\SignupTutorial\Model\User","RestApi\SignupTutorial\Model\ResourceModel\User");
	}
}
