<?php

$installer = $this;
$installer->startSetup();
$installer->run("
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` 
ADD `ean_nummer` VARCHAR( 255 ) NOT NULL,
ADD `afstemt` BOOLEAN;
  
ALTER TABLE `{$installer->getTable('sales/order_payment')}` 
ADD `ean_nummer` VARCHAR( 255 ) NOT NULL,
ADD `afstemt` BOOLEAN;
");
$installer->endSetup();