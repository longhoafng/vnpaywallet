<?php

namespace PluginTutorial\SendEmail\Helper;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
    }

    public function sendEmail(CustomerInterface $customer)
    {
        try {
            $this->inlineTranslation->suspend();

            $sender = [
                'name'  => $this->escaper->escapeHtml('Admin Magento'),
                'email' => $this->escaper->escapeHtml('admin@magento.com'),
            ];

            $transport = $this->transportBuilder
            ->setTemplateIdentifier('email_template')
            ->setTemplateOptions(
                [
                    'area'   => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store'  => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars([
                'first_name'  => $customer->getFirstname(),
                'last_name'  => $customer->getLastname(),
                'email'  => $customer->getEmail(),
            ])
            ->setFrom($sender)
                ->addTo($customer->getEmail())
                ->setReplyTo($customer->getEmail())
            ->getTransport();

            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
