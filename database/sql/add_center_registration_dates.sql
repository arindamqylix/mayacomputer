-- Add registration date and valid till date fields to center_login table
ALTER TABLE `center_login`
ADD COLUMN `cl_registration_date` DATE NULL DEFAULT '2024-04-01' AFTER `cl_account_status`,
ADD COLUMN `cl_valid_till` DATE NULL DEFAULT '2029-04-01' AFTER `cl_registration_date`;

-- Update existing centers to have default registration date and valid till date
UPDATE `center_login` 
SET 
    `cl_registration_date` = '2024-04-01',
    `cl_valid_till` = '2029-04-01'
WHERE `cl_registration_date` IS NULL OR `cl_valid_till` IS NULL;

