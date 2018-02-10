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

    // Perhaps this can be used to make payments before the order is created
    public function createFormBlock($name)
    {
        $block = $this->getLayout()
            ->createBlock('quickpaypayment/payment_form', $name)
            ->setMethod('quickpaypayment_payment')
            ->setPayment($this->getPayment())
            ->setTemplate('quickpaypayment/payment/form.phtml');

        return $block;
    }

    /*validate the currency code is avaialable to use for Quickpay or not*/
    public function validate()
    {
        parent::validate();
        return $this;
    }
}
