-- Add missing column for admin manual center recharge
ALTER TABLE `center_recharge`
  ADD COLUMN `cr_deposit_by` VARCHAR(255) NULL DEFAULT NULL AFTER `cr_type`;
