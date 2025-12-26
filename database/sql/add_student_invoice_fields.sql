-- Add invoice flag to set_fee table
ALTER TABLE `set_fee` 
ADD COLUMN `sf_invoice_generated` TINYINT(1) DEFAULT 0 COMMENT '1 if invoice generated, 0 if not' AFTER `sf_due`,
ADD COLUMN `sf_invoice_id` INT(11) DEFAULT NULL COMMENT 'Reference to fees_payment.fp_id for the invoice' AFTER `sf_invoice_generated`;

-- Add invoice flag to fees_payment table
ALTER TABLE `fees_payment` 
ADD COLUMN `fp_is_invoice` TINYINT(1) DEFAULT 0 COMMENT '1 if this payment record is the invoice, 0 if just a payment' AFTER `fp_remarks`;

