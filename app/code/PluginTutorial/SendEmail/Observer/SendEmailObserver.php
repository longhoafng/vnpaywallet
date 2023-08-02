<?php

namespace PluginTutorial\SendEmail\Observer;

use Magento\Framework\Event\ObserverInterface;
use PluginTutorial\SendEmail\Helper\Email;

class SendEmailObserver implements ObserverInterface
{
    private $helperEmail;

    public function __construct(Email $helperEmail)
    {
        $this->helperEmail = $helperEmail;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
//        $customer = $observer->getEvent()->getCustomer();
        $customer = $observer->getData('customer');

        return $this->helperEmail->sendEmail($customer);
    }
}
