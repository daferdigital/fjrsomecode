DROP USER IF EXISTS 'lm_biopsia_user'@'%';
CREATE USER 'lm_biopsia_user'@'%' IDENTIFIED BY 'lm0ntUs3rB10ps1a';
GRANT ALL ON lmont_biopsia.* TO 'lm_biopsia_user'@'%';