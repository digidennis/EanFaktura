<?php
class Digidennis_EanFaktura_Block_Payment_Form extends Mage_Payment_Block_Form
{

    protected function _construct()
    {
        $this->setTemplate('digidennis/eanfaktura/payment/form.phtml');
        parent::_construct();
    }

}
