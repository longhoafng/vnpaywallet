<?php

namespace Pulsestorm\RepositoryTutorial\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State;
use Magento\TestFramework\Helper\Bootstrap;

class Examples extends Command
{
    protected $objectManager;
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        $name=null
    )
    {
        $this->objectManager = $objectManager;
        parent::__construct($name);
    }
    protected function configure()
    {
        $this->setName("ps:examples");
        $this->setDescription("A command the programmer was too lazy to enter a description for.");
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $appState = Bootstrap::getObjectManager()
            ->create(State::class);
        $appState->setAreaCode('frontend');
         
        //create our filter
        $filter = $this->objectManager->create('Magento\Framework\Api\Filter');
        $filter->setData('field', 'sku');
        $filter->setData('value', 'WSH11%');
        $filter->setData('condition_type', 'like');

        //add our filter(s) to a group
        $filter_group = $this->objectManager->create('Magento\Framework\Api\Search\FilterGroup');
        $filter_group->setData('filters', [$filter]);

        //add the group(s) to the search criteria object
        $search_criteria = $this->objectManager->create('Magento\Framework\Api\SearchCriteriaInterface');
        $search_criteria->setFilterGroups([$filter_group]);

        //query the repository for the object(s)
        $repo = $this->objectManager->get('Magento\Catalog\Model\ProductRepository');
        $result = $repo->getList($search_criteria);
        $products = $result->getItems();
        foreach ($products as $product) {
            echo $product->getSku(), "\n";
        }
    }
}
