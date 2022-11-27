DROP TABLE IF EXISTS atendimentos;

CREATE TABLE `atendimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(60) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO atendimentos VALUES("1","Cirurgia Plástica","1500.00");
INSERT INTO atendimentos VALUES("2","Consulta Pediatra","80.00");


DROP TABLE IF EXISTS cargos;

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO cargos VALUES("1","Médico");
INSERT INTO cargos VALUES("2","Recepcionista");
INSERT INTO cargos VALUES("3","Tesoureiro");
INSERT INTO cargos VALUES("4","Administrador");
INSERT INTO cargos VALUES("5","Faxineiro");
INSERT INTO cargos VALUES("6","Farmacêutico");


DROP TABLE IF EXISTS chamadas;

CREATE TABLE `chamadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paciente` int(11) NOT NULL,
  `consultorio` varchar(30) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente` (`paciente`),
  CONSTRAINT `chamadas_ibfk_1` FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO chamadas VALUES("1","1",NULL,"a Aguardar");


DROP TABLE IF EXISTS consultas;

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `paciente` int(11) DEFAULT NULL,
  `tipo_atendimento` int(11) DEFAULT NULL,
  `medico` int(11) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `estado_pagamento` varchar(15) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `atestado` int(11) DEFAULT NULL,
  `prescricao` varchar(10) DEFAULT NULL,
  `receita` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medico` (`medico`),
  KEY `paciente` (`paciente`),
  KEY `tipo_atendimento` (`tipo_atendimento`),
  CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`medico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`paciente`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `consultas_ibfk_3` FOREIGN KEY (`tipo_atendimento`) REFERENCES `atendimentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS contas_pagar;

CREATE TABLE `contas_pagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(40) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `vencimento` date NOT NULL,
  `pagamento` date DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario` (`funcionario`),
  CONSTRAINT `contas_pagar_ibfk_1` FOREIGN KEY (`funcionario`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO contas_pagar VALUES("1","Compra do/a Aspirina","25.00","2020-11-24","2020-11-24","Sim","4","sem-foto.png");


DROP TABLE IF EXISTS contas_receber;

CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` int(11) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `vencimento` date NOT NULL,
  `data_baixa` date DEFAULT NULL,
  `forma_pagamento` varchar(25) DEFAULT NULL,
  `tipo_pagamento` varchar(30) DEFAULT NULL,
  `tesoureiro` int(11) DEFAULT NULL,
  `id_consulta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tesoureiro` (`tesoureiro`),
  KEY `id_consulta` (`id_consulta`),
  KEY `descricao` (`descricao`),
  CONSTRAINT `contas_receber_ibfk_1` FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contas_receber_ibfk_2` FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contas_receber_ibfk_3` FOREIGN KEY (`descricao`) REFERENCES `atendimentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS entradas_remedios;

CREATE TABLE `entradas_remedios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remedio` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `farmaceutico` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fornecedor` (`fornecedor`),
  KEY `farmaceutico` (`farmaceutico`),
  KEY `remedio` (`remedio`),
  CONSTRAINT `entradas_remedios_ibfk_1` FOREIGN KEY (`fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `entradas_remedios_ibfk_2` FOREIGN KEY (`farmaceutico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `entradas_remedios_ibfk_3` FOREIGN KEY (`remedio`) REFERENCES `remedios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO entradas_remedios VALUES("1","1","5","5.00","1","6","2020-11-24");


DROP TABLE IF EXISTS especialidades;

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO especialidades VALUES("1","Pediatria");
INSERT INTO especialidades VALUES("2","Obstetrícia");
INSERT INTO especialidades VALUES("3","Medicina Familiar");
INSERT INTO especialidades VALUES("4","Cirurgia");
INSERT INTO especialidades VALUES("5","Cardiologia");


DROP TABLE IF EXISTS fornecedores;

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `telefone` varchar(35) NOT NULL,
  `remedios` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `remedios` (`remedios`),
  CONSTRAINT `fornecedores_ibfk_1` FOREIGN KEY (`remedios`) REFERENCES `remedios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO fornecedores VALUES("1","Fornecedor","634.567.564","fornecedor@gmail.com","(+643) 574568745","1");


DROP TABLE IF EXISTS funcionarios;

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `cc` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_entrada` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `cargo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo` (`cargo`),
  CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO funcionarios VALUES("1","HospSYSAdmin","000.000.000","00000","(+000) 000000000","2002-02-22","2002-02-22","hospsys@gmail.com","4");
INSERT INTO funcionarios VALUES("2","Maria Jesus","234.365.675","45645","(+345) 645747456","2002-02-22","2002-02-22","maria@gmail.com","5");
INSERT INTO funcionarios VALUES("3","Recepcionista","666.666.666","66666","(+666) 666666666","2002-02-22","2002-02-22","recepcionista@gmail.com","2");
INSERT INTO funcionarios VALUES("4","Tesoureiro","777.777.777","77777","(+777) 777777777","2002-02-22","2002-02-22","tesoureiro@gmail.com","3");
INSERT INTO funcionarios VALUES("5","António","111.111.111","11111","(+111) 111111111","2002-02-22","2002-02-22","medico@gmail.com","1");
INSERT INTO funcionarios VALUES("6","Farmacêutico","333.333.333","33333","(+333) 333333333","2002-02-22","2002-02-22","farmaceutico@gmail.com","6");
INSERT INTO funcionarios VALUES("7","João Mendes","345.363.755","34532","(+754) 675467457","2002-02-22","2002-02-22","joao@gmail.com","1");


DROP TABLE IF EXISTS messages;

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `incoming_msg_id` (`incoming_msg_id`),
  KEY `outgoing_msg_id` (`outgoing_msg_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS movimentacoes;

CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  `movimento` varchar(30) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tesoureiro` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  `id_receber` int(11) DEFAULT NULL,
  `id_pagar` int(11) DEFAULT NULL,
  `id_pagamentos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tesoureiro` (`tesoureiro`),
  KEY `id_receber` (`id_receber`),
  KEY `id_pagar` (`id_pagar`),
  KEY `id_pagamentos` (`id_pagamentos`),
  CONSTRAINT `movimentacoes_ibfk_1` FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `movimentacoes_ibfk_2` FOREIGN KEY (`id_receber`) REFERENCES `contas_receber` (`id`) ON DELETE CASCADE,
  CONSTRAINT `movimentacoes_ibfk_3` FOREIGN KEY (`id_pagar`) REFERENCES `contas_pagar` (`id`) ON DELETE CASCADE,
  CONSTRAINT `movimentacoes_ibfk_4` FOREIGN KEY (`id_pagamentos`) REFERENCES `pagamentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO movimentacoes VALUES("1","Saída","Compra do/a Aspirina","25.00","3","2020-11-24",NULL,"1",NULL);
INSERT INTO movimentacoes VALUES("2","Saída","Salário dos Funcionários","12345.00","3","2020-11-29",NULL,NULL,"1");


DROP TABLE IF EXISTS pacientes;

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `cc` varchar(20) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(35) NOT NULL,
  `data_nascimento` date NOT NULL,
  `idade` int(11) NOT NULL,
  `estado_civil` varchar(15) DEFAULT NULL,
  `sexo` varchar(15) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `obs` varchar(350) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO pacientes VALUES("1","Paciente","222.222.222","2222","(+546) 43563456","pacienteuti@gmail.com","2002-02-22","18","Solteiro","Masculino","fsdafsdf","202cb962ac59075b964b07152d234b70","gsdfgsdg");
INSERT INTO pacientes VALUES("2","Ricardo","235.345.345","345345345","(+345) 34534535","fgdfg@gmail.com","2002-02-22","18","Solteiro","Masculino","zxczz","25f9e794323b453885f5181f1b624d0b",NULL);
INSERT INTO pacientes VALUES("3","André","234.426.353","345346356","(+454) 65435634","gdfgdg@gmail.com","2000-11-01","20","Solteiro","Masculino","RSDHUFSDJGLDQ",NULL,NULL);


DROP TABLE IF EXISTS pagamentos;

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario` int(11) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tesoureiro` int(11) DEFAULT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario` (`funcionario`),
  KEY `tesoureiro` (`tesoureiro`),
  CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`funcionario`) REFERENCES `funcionarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pagamentos_ibfk_3` FOREIGN KEY (`tesoureiro`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO pagamentos VALUES("1","2","12345.00","4","2020-11-29");


DROP TABLE IF EXISTS prescricao;

CREATE TABLE `prescricao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_consulta` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `remedio` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_consulta` (`id_consulta`),
  CONSTRAINT `prescricao_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consultas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS remedios;

CREATE TABLE `remedios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO remedios VALUES("1","Aspirina","25mg","5");
INSERT INTO remedios VALUES("2","Pílula","15mg",NULL);


DROP TABLE IF EXISTS saidas_remedios;

CREATE TABLE `saidas_remedios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remedio` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `farmaceutico` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `remedio` (`remedio`),
  KEY `farmaceutico` (`farmaceutico`),
  CONSTRAINT `saidas_remedios_ibfk_1` FOREIGN KEY (`remedio`) REFERENCES `remedios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `saidas_remedios_ibfk_2` FOREIGN KEY (`farmaceutico`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



DROP TABLE IF EXISTS utilizadores;

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nif` varchar(20) NOT NULL,
  `cc` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_entrada` date DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `especialidade` int(11) DEFAULT NULL,
  `consultorio` varchar(40) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nivel` varchar(25) NOT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `code` int(50) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `estado_conta` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `especialidade` (`especialidade`),
  CONSTRAINT `utilizadores_ibfk_1` FOREIGN KEY (`especialidade`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO utilizadores VALUES("1","HospSYSAdmin","hospsys@gmail.com","000.000.000","00000","(+000) 000000000","2002-09-25","2002-02-22",NULL,NULL,NULL,"25d55ad283aa400af464c76d713c07ad","Admin","7112260bf4b8bfec008141c99e0f296a7951355br1-736-736v2_hq.jpg",NULL,"Online","Ativo");
INSERT INTO utilizadores VALUES("2","Recepcionista","recepcionista@gmail.com","666.666.666","66666","(+666) 666666666","2002-02-22","2002-02-22",NULL,NULL,NULL,"9f0863dd5f0256b0f586a7b523f8cfe8","Recepcionista","sem-foto.png",NULL,"Offline","Ativo");
INSERT INTO utilizadores VALUES("3","Tesoureiro","tesoureiro@gmail.com","777.777.777","77777","(+777) 777777777","2002-02-22","2002-02-22",NULL,NULL,NULL,"ca94efe2a58c27168edf3d35102dbb6d","Tesoureiro","sem-foto.png",NULL,"Offline","Ativo");
INSERT INTO utilizadores VALUES("4","António","medico@gmail.com","111.111.111","11111","(+111) 111111111","2002-02-22","2002-02-22","000","2",NULL,"bbb8aae57c104cda40c93843ad5e6db8","Médico","sem-foto.png",NULL,"Online","Ativo");
INSERT INTO utilizadores VALUES("5","Paciente","pacienteuti@gmail.com","222.222.222","22222","(+546) 435634564","2002-02-22","2002-02-22",NULL,NULL,NULL,"202cb962ac59075b964b07152d234b70","Paciente","sem-foto.png",NULL,"Offline","Ativo");
INSERT INTO utilizadores VALUES("6","Farmacêutico","farmaceutico@gmail.com","333.333.333","33333","(+333) 333333333","2002-02-22","2002-02-22",NULL,NULL,NULL,"77c9749b451ab8c713c48037ddfbb2c4","Farmacêutico","sem-foto.png",NULL,"Offline","Ativo");
INSERT INTO utilizadores VALUES("7","sdfsdfsdfg","fgdfg@gmail.com","235.345.345","23453","(+345) 345345353","2002-02-22","2002-02-22",NULL,NULL,NULL,"25f9e794323b453885f5181f1b624d0b","Paciente","sem-foto.png",NULL,"Offline","Ativo");
INSERT INTO utilizadores VALUES("8","João Mendes","joao@gmail.com","345.363.755","54643","(+754) 675467457","2002-02-22","2002-02-22","1234","4",NULL,"7667ed4464f5ddcccb4cc208057727dc","Médico","sem-foto.png",NULL,"Offline","Ativo");


