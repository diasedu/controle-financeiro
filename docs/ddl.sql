CREATE TABLE conta (
    id_conta INT AUTO_INCREMENT PRIMARY KEY,
    desc_conta VARCHAR(150) NOT NULL,
    valor_conta DECIMAL(10, 2) NOT NULL,
    sta_conta CHAR(1) NOT NULL,
    tipo_conta VARCHAR(150) NOT NULL
);
--
ALTER TABLE conta ADD COLUMN dia_venct INT;
