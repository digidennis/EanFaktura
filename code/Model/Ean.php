<?php
class Digidennis_EanFaktura_Model_Ean extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'digidennis_eanfaktura';
    protected $_formBlockType = 'digidennis_eanfaktura/payment_form';
    protected $_infoBlockType = 'digidennis_eanfaktura/info_ean';

    protected $_canCapture              = true;
    protected $_canRefund               = true;
    protected $_canUseCheckout          = false;
    protected $_canRefundInvoicePartial = true;
    protected $_canUseForMultishipping  = false;


    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }

    public function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }

    public function assignData($data)
    {
        $info = $this->getInfoInstance();

        if ($data->getEanNummer())
        {
            $info->setEanNummer($data->getEanNummer());
        }

        if ($data->getAfstemt())
        {
            $info->setAfstemt($data->getAfstemt());
        }

        return $this;
    }

    public function validate()
    {
        parent::validate();
        $info = $this->getInfoInstance();

        if (!$info->getEanNummer())
        {
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__("EAN Nummer er påkrævet.\n");
        }

        if ($errorMsg)
        {
            Mage::throwException($errorMsg);
        }

        return $this;
    }

    // Perhaps this can be used to make payments before the order is created
    public function createFormBlock($name)
    {
        $block = $this->getLayout()
            ->createBlock('digidennis_eanfaktura/payment_form', $name)
            ->setMethod('digidennis_eanfaktura')
            ->setPayment($this->getPayment())
            ->setTemplate('digidennis/eanfaktura/payment/form.phtml');

        return $block;
    }

}
