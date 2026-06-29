-- Courier dispatch uses DISPATCHED / PENDING / RETURNED on sc_status (see admin CourierController)
ALTER TABLE `student_certificates`
MODIFY COLUMN `sc_status` ENUM(
    'GENERATED',
    'ISSUED',
    'VERIFIED',
    'RECEIVED',
    'DISPATCHED',
    'PENDING',
    'RETURNED'
) NULL DEFAULT 'GENERATED';
