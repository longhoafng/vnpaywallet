<?php

namespace PluginTutorial\SendEmail\Plugin;

use Magento\Customer\Model\ResourceModel\CustomerRepository;
use \Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Event\ManagerInterface as EventManager;
class SendCustomerEmail
{
    private $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function afterSave(CustomerRepository $subject, CustomerInterface $result)
    {
        $this->eventManager->dispatch('customer_register_success', ['customer' => $result]);

        return $result;
    }
}
