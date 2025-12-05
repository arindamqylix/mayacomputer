-- Add Course Eligibility column to cms_course table
ALTER TABLE `cms_course`
ADD `course_eligibility` VARCHAR(255) NULL AFTER `c_duration`;




