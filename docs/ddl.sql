CREATE TABLE conta (
    id_conta INT AUTO_INCREMENT PRIMARY KEY,
    desc_conta VARCHAR(150) NOT NULL,
    valor_conta DECIMAL(10, 2) NOT NULL,
    sta_conta CHAR(1) NOT NULL,
    tipo_conta VARCHAR(150) NOT NULL
);
--
ALTER TABLE conta ADD COLUMN dia_venct INT;
--
CREATE TABLE pagador (
    id_paga INT(3) NOT NULL PRIMARY KEY, 
    nome_paga VARCHAR(150) NOT NULL, 
    sta_paga CHAR(1) NOT NULL 
);