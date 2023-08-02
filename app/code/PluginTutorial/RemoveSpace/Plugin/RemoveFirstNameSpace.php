<?php

namespace PluginTutorial\RemoveSpace\Plugin;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository;

class RemoveFirstNameSpace
{
    public function beforeSave(CustomerRepository $subject, CustomerInterface $customer, $passwordHash = null): array
    {
        if ($customer->getId() && $customer->getFirstname()) {
            $firstName = str_replace(' ', '', $customer->getFirstname());
            $customer->setFirstname($firstName);
        }

        return [$customer, $passwordHash];
    }
}
