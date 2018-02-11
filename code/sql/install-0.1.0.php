<?php

$installer = $this;
$installer->startSetup();
$installer->run("
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` 
ADD `ean_nummer` VARCHAR( 30 ) NULL,
ADD `afstemt` BOOL NULL;
  
ALTER TABLE `{$installer->getTable('sales/order_payment')}` 
ADD `ean_nummer` VARCHAR( 30 ) NULL,
ADD `afstemt` BOOL NULL;
");
$installer->endSetup();