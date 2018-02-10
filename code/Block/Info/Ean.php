<?php
class Digidennis_EanFaktura_Block_Info_Ean extends Mage_Payment_Block_Info
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('digidennis/eanfaktura/info/default.phtml');
    }

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation)
        {
            return $this->_paymentSpecificInformation;
        }

        $data = array();
        if ($this->getInfo()->getCustomFieldOne())
        {
            $data[Mage::helper('payment')->__('EAN Nummer')] = $this->getInfo()->getEanNummer();
        }

        if ($this->getInfo()->getCustomFieldTwo())
        {
            $data[Mage::helper('payment')->__('Afstemt')] = $this->getInfo()->getAfstemt();
        }

        $transport = parent::_prepareSpecificInformation($transport);

        return $transport->setData(array_merge($data, $transport->getData()));
    }

}
