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
--
create table saida (
    id_conta int not null,
    mes varchar(2) not null,
    ano int(4) not null,
    id_paga int (2) not null,
    dt_paga date not null,
    dt_venc date not null,
    primary key(id_conta, mes, ano),
    foreign key (id_conta) references conta(id_conta),
    foreign key (id_paga) references pagador(id_paga)
);