<?php
class Digidennis_EanFaktura_Block_Info_Quickpay extends Mage_Payment_Block_Info
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('digidennis/eanfaktura/info/default.phtml');
    }

}
