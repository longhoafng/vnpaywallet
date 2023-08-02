<?php

namespace PluginTutorial\LogData\Plugin;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository;
use PluginTutorial\LogData\Logger\Logger;


class LogCustomerData
{
    /**
     * Logging instance
     * @var Logger
     */
    protected Logger $logger;

    /**
     * constructor
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Plugin after
     * @param CustomerRepository $subject
     * @param CustomerInterface $result
     * @return CustomerInterface
     */
    public function afterSave(CustomerRepository $subject, CustomerInterface $result): CustomerInterface
    {
        $this->logger->info('Customer ' . $result->getId() . ': ' . $result->getFirstname() . ', '
        . $result->getLastname() . ', ' . $result->getEmail() . ', '
        . date("Y-m-d h:i:sa"));

        return $result;
    }
}
