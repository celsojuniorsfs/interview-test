CREATE TABLE `fornecedor` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL DEFAULT 'Não possui',
  `desde` date DEFAULT NULL,
  `observacao` text,
  `ativo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fornecedor_id`),
  UNIQUE KEY `fornecedor_id` (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `unidade` varchar(15) NOT NULL,
  `valor_medio` decimal(6,2) NOT NULL DEFAULT '0.00',
  `ativo` int(11) NOT NULL,
  PRIMARY KEY (`material_id`),
  UNIQUE KEY `descricao` (`descricao`),
  UNIQUE KEY `material_id_UNIQUE` (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `material_entrada` (
  `material_entrada_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `material_entrada_marca` varchar(30) NOT NULL,
  `fornecedor_id` int(11) DEFAULT NULL,
  `material_entrada_valor_compra` decimal(6,2) NOT NULL,
  `material_entrada_valor_venda` decimal(6,2) NOT NULL,
  `material_entrada_quantidade` int(11) NOT NULL,
  `material_entrada_data` datetime NOT NULL,
  `material_entrada_data_pagamento` datetime DEFAULT NULL,
  `ativo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`material_entrada_id`),
  KEY `-_idx` (`material_id`),
  KEY `fornecedor_id` (`fornecedor_id`),
  CONSTRAINT `IBFK_Material_entrada` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  CONSTRAINT `material_entrada_ibfk_1` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `material_lote` (
  `material_lote_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `material_entrada_id` int(11) NOT NULL,
  `lote` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `validade` date NOT NULL,
  `saldo` int(11) unsigned NOT NULL,
  PRIMARY KEY (`material_lote_id`),
  UNIQUE KEY `lote_validade_material_id` (`lote`,`validade`,`material_id`),
  KEY `material_id` (`material_id`),
  CONSTRAINT `material_lote_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Faça uma consulta SQL que retorne as seguintes informações:
 material descricao
 material unidade
 marca
 valor compra
 valor venda
 entrada quantidade
 entrada data
 lote
 validade
 nome fornecedor
 fornecedor id
*/