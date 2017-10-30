<?php

/**
 * Class vs_MageFaker_Block_Adminhtml_Faker_Edit_Tabs_Remove.
 */
class Ovs_Magefaker_Block_Adminhtml_Faker_Edit_Tabs_Remove extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Generate form from config xml.
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();

        // categories remove
        $category = $form->addFieldset('category_remove', [
            'legend' => $this->__('Categories'),
        ]);

        $category->addField('categories_remove', 'checkbox', [
            'label'              => $this->__('Remove all MageFaker categories'),
            'name'               => 'categories_remove',
            'value'              => 'categories_remove',
            'after_element_html' => '</td><td><small><em>'.$this->__("This will remove all categories with the 'magefaker-' prefix in the url").'</em></small>',
        ]);

        // products remove
        $products = $form->addFieldset('product_remove', [
            'legend' => $this->__('Products'),
        ]);

        $products->addField('products_remove', 'checkbox', [
            'label'              => $this->__('Remove all MageFaker products'),
            'name'               => 'products_remove',
            'value'              => 'products_remove',
            'after_element_html' => '</td><td><small><em>'.$this->__("This will remove all the products with the 'magefaker-' prefix in the sku").'</em></small>',
        ]);

        $form->setUseContainer(false);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Remove');
    }

    /**
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Remove');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
