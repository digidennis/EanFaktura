<?php

class Digidennis_EanFaktura_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);

        if (!$order->getId()) {
            $this->_getSession()->addError($this->__('This order no longer exists.'));
            $this->_redirect('*/*/');
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        Mage::register('sales_order', $order);
        Mage::register('current_order', $order);
        return $order;
    }


    public function completeAction()
    {
        if ($order = $this->_initOrder()) {
            try {
                $order->setState('complete', true)
                    ->save();
                $this->_getSession()->addSuccess(
                    $this->__('The order state has been changed.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($this->__('The order state has not been changed.'));
                Mage::logException($e);
            }
            $this->_redirect('adminhtml/sales_order/view', array('order_id' => $order->getId()));
        }

    }
}