<?php

/**
 * Class Ovs_MageFaker_Model_Faker.
 */
class Ovs_Magefaker_Model_Source_Category extends Mage_Core_Model_Abstract
{
    protected $options = [];

    /**
     * @param bool $addEmpty
     *
     * @throws Mage_Core_Exception
     *
     * @return array
     */
    public function toOptionArray($addEmpty = true)
    {
        if ($addEmpty) {
            $this->options[] = [
                'label' => Mage::helper('adminhtml')->__('-- Please Select a Category --'),
                'value' => '',
            ];
        }

        $depth = 6;
        $store = Mage::app()->getWebsite(true)->getDefaultGroup()->getDefaultStoreId();
        $rootId = Mage::app()->getStore($store)->getRootCategoryId();

        $category = Mage::getModel('catalog/category');
        $categories = $category->getCategories(($rootId - 1), $depth, true, false, true);

        foreach ($categories as $node) {
            if ($node->hasChildren()) {
                $this->options[] = [
                    'label' => $node->getName(),
                    'style' => 'font-weight:bold',
                    'value' => $node->getEntityId(),
                ];

                $this->_getChildOptions($node->getChildren());
            } else {
                $this->options[] = [
                    'label' => $node->getName(),
                    'value' => $node->getEntityId(),
                ];
            }
        }

        return $this->options;
    }

    /**
     * Makes options from child category.
     *
     * @param Varien_Data_Tree_Node_Collection $nodeCollection
     */
    protected function _getChildOptions(Varien_Data_Tree_Node_Collection $nodeCollection)
    {
        foreach ($nodeCollection as $node) {
            $times = $node->getLevel() * 2;

            if ($times <= 4) {
                $times = 2;
            }

            $indent = 3 * $times;

            if ($node->hasChildren()) {
                $this->options[] = [
                    'label' => $node->getName(),
                    'style' => 'font-weight:bold;text-indent:'.$indent.'px',
                    'value' => $node->getEntityId(),
                ];

                $this->_getChildOptions($node->getChildren());
            } else {
                $this->options[] = [
                    'label' => $node->getName(),
                    'style' => 'text-indent:'.($indent + 2).'px',
                    'value' => $node->getEntityId(),
                ];
            }
        }
    }

    /**
     * Returns first value of option array.
     *
     * @return mixed
     */
    public function getFirstValue()
    {
        $values = $this->toOptionArray(false);

        return $values[0];
    }
}
