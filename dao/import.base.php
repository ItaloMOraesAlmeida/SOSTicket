<?php
    require_once "../model/class.conexao.php";

    class ImpBase {
        Private $base;
        Private $pdo;

        public function __construct(){
            $this -> setBase(new Conexao());
        }
        
        public function ImpbaseMysql(){
            $this -> setPdo($this -> getBase() -> conectarDb());
            $this-> getPdo() -> prepare("
            Create Table If Not Exists SOSTicket.tCargo(
                codCar Int Not Null Auto_Increment Comment 'Identificador do cargo',
                carNom Varchar(100) Not Null Comment 'Nome do cargo',
                carSit TinyInt Not Null Comment 'Situação do cargo',
                carDca DateTime Not Null Comment 'Data de cadastro do cargo',
                carDfi DateTime Default Null Comment 'Data de fim do cargo',
                Primary Key (codCar)
            );
            Create Table If Not Exists SOSTicket.tLocal(
                codLoc Int Not Null Auto_Increment comment 'Identificação do local',
                locNom Varchar(100) Not Null comment 'Nome do local',
                locSit TinyInt Not Null comment 'Tipo da situação do local',
                locDca DateTime Not Null comment 'Data de cadastro do local',
                locDfi DateTime Default Null comment 'Data de fim do local',
                Primary Key (codLoc)
            );
            Create Table SOSTicket.tEmpresa(
                codEmp Int Not Null Auto_Increment Comment 'Identificador da empresa',
                empNom Varchar (100) Not Null Comment 'Nome da empresa',
                empSit TinYInt Not Null Comment 'Situação da empresa',
                empDca DateTime Not Null Comment 'Data de cadastro da empresa',
                empDfi DateTime Default Null Comment 'Data de fim da empresa',
                Primary Key (codEmp)
            );
            Create Table If Not Exists SOSTicket.tPerfil(
                codPer Int Not Null Auto_Increment Comment 'Identificador do perfil',
                perNom Varchar (100) Not Null Comment 'Nome do perfil',
                perSit TinyInt Not Null Comment 'Situação do prefil',
                perDca DateTime Not Null Comment 'Data de cadastro do perfil',
                perDfi DateTime Default Null Comment 'Data de fim do perfil',
                Primary Key (codPer)
            );
            Create Table If Not Exists SOSTicket.tSituacao(
                codSit Int not Null Auto_Increment Comment 'Identificador da situação',
                sitNom Varchar (100) Not Null Comment 'Nom da situação',
                sitSit TinyInt not Null Comment 'Situação da Situação',
                sitDca DateTime Not Null Comment 'Data de cadastro da situação',
                sitDfi DateTime Default Null Comment 'Data de fim da situação',
                Primary Key (codSit)
            );
            Create Table SOSTicket.tUsuario(
                codUsu Int Not Null Auto_Increment Comment 'Identificação do usuário',
                usuNom Varchar (20) Not Null Comment 'Primeiro nome do usuário',
                usuSno Varchar (100) Not Null Comment 'Segundo nome do usuário',
                usuEma Varchar (150) Not Null Comment 'Email do usuário',
                usuLog Varchar (100) Not Null Comment 'Login do usuário',
                UsuSen Varchar (100) Not Null Comment 'Senha do usuário',
                usuCpf Varchar (11) Not Null Comment 'CPF do usuário',
                usuDna DateTime Not Null Comment 'Data de nascimento do usuário',
                usuTel Int Not Null Comment 'Número do telefone do usuário',
                usuSex Char (1) Not Null Comment 'Sexo do usuário',
                usuDca DateTime not Null Comment 'Data de cadastro do usuário',
                usuDaf DateTime Default Null Comment 'Data de afastamento do usuário',
                codCar Int Not Null Comment 'Identificador do cargo do usuário',
                codLoc Int Not Null Comment 'Identificador do local do usuário',
                codEmp Int Not Null Comment 'Identificação da empresa do usuário',
                codPer Int Not Null Comment 'Identificação do perfil do usuário',
                codSit Int Not Null Comment 'Identificação da situação do usuário',
                Primary Key (codUsu)
            );
            Create Table If Not Exists SOSTicket.tAnexoOds (
                codAnx Int Not Null Auto_Increment Comment 'Identificador do anexo',
                anxNom Varchar (50) Not Null Comment 'Nomde do anexo',
                anxLoc Varchar (50) Not Null Comment 'Local do anexo',
                anxTam Double (7,3) Not Null Comment 'Tamanho do anexo em bytes',
                anxDca DateTime Not Null Comment 'Data de cadastro do anexo',
                codOds Int Not Null Comment 'Identificado da ordem de servico',
                Primary Key (codAnx)
            );
            Create Table If Not Exists SOSTicket.tAnexoCom (
                codAnx Int Not Null Auto_Increment Comment 'Identificador do anexo',
                anxNom Varchar (50) Not Null Comment 'Nomde do anexo',
                anxLoc Varchar (50) Not Null Comment 'Local do anexo',
                anxTam Double (7,3) Not Null Comment 'Tamanho do anexo em bytes',
                anxDca DateTime Not Null Comment 'Data de cadastro do anexo',
                Primary Key (codAnx)
            );
            Create Table If Not Exists SOSTicket.tAnexoOrc (
                codAnx Int Not Null Auto_Increment Comment 'Identificador do anexo',
                anxNom Varchar (50) Not Null Comment 'Nomde do anexo',
                anxLoc Varchar (50) Not Null Comment 'Local do anexo',
                anxTam Double (7,3) Not Null Comment 'Tamanho do anexo em bytes',
                anxDca DateTime Not Null Comment 'Data de cadastro do anexo',
                codOrc Int Not Null Comment 'Identificador do orçamento',
                Primary Key (codAnx)
            );
            Create Table If Not Exists SOSTicket.tEstado (
                codEst Int Not Null Auto_Increment Comment 'Identificador do estado',
                estNom Varchar (50) Not Null Comment 'Nome do estado',
                estSit TinyInt Not Null Comment 'Situação do estado',
                estDca DateTime Not Null Comment 'Data de cadastro do estado',
                estDfi DateTime Default Null Comment 'Data de fim do estado',
                Primary Key (codEst)
            );
            Create Table If Not Exists SOSTicket.tPrioridade (
                codPrd Int Not Null Auto_Increment Comment 'Identificador da prioridade',
                prdNom Varchar (50) Not Null Comment 'Nomde da prioridade',
                prdSit TinyInt Not Null Comment 'Situação da prioridade',
                prdDca DateTime Not Null Comment 'Data de cadastro da prioridade',
                prdDfi DateTime Null Comment 'Data e fim da prioridade',
                Primary Key (codPrd)
            );
            Create Table If Not Exists SOSTicket.tTempoConclusao (
                codTco Int Not Null Auto_Increment Comment 'Identificador do tempo de conclusão da orden de serviço',
                tcoNom Varchar (20) Not Null Comment 'Nome do tempo de conclusão',
                tcoSit TinyInt Not Null Comment 'Situação do tempo de conclusão',
                tcoDca DateTime Not Null Comment 'Data de cadastro do tempo de conclusão',
                tcoDfi DateTime Default Null Comment 'Data de fim do tempo de conclusão',
                Primary Key (codTco)
            );
            Create Table If Not Exists SOSTicket.tServico (
                codSer Int Not Null Auto_Increment Comment 'Identificador do tempo de serviço',
                serNom Varchar (100) Not Null Comment 'Nome do tempo de serviço',
                serSit TinyInt Not Null Comment 'Situação do serviço',
                setDca DateTime Not Null Comment 'Data de cadstro do serviço',
                serDfi DateTime Null Comment 'Data de fim do serviço',
                codTco Int Not Null Comment 'Identificador do tempo de conclusão',
                codLoc Int Not Null Comment 'Identificado do local do serviço',
                Primary Key (codSer)
            );
            Create Table If Not Exists SOSTicket.tOrdemServico (
                codOds Int Not Null Auto_increment Comment 'Identificador da ordem de serviço',
                odsTit Varchar (100) Not Null Comment 'Titulo da ordem de serviço',
                odsAss Varchar (300) Not Null Comment 'Assunto da ordem de serviço',
                odsTel Int Not Null Comment 'Telfone para contato da ordem de serviço',
                odsDab DateTime Not Null Comment 'Data da abertura da ordem de serviço',
                odsDag DateTime Default Null Comment 'Data de agendamento da ordem de serviço',
                odsDen DateTime Default Null Comment 'Data de encerramento da ordem de serviço',
                codLoc Int Not Null Comment 'Identificador do local da ordem de serviço',
                codAtd Int Not Null Comment 'Identificador do atendente da ordem de serviço',
                codEst Int Not Null Comment 'Identificação do estado da ordem de serviço',
                codPrd Int Not Null Comment 'Identificação da prioridade da ordem de servoço',
                codEmp Int Not Null Comment 'Identificador da Empresa da ordem de serviço',
                codCli Int Not Null Comment 'Identificador do cliente',
                codCar Int Not Null Comment 'Identificador do cargo do cliente',
                codSer Int Not Null Comment 'Identificador do serviço da ordem de serviço',
                Primary Key (codOds)
            );
            Create Table If Not Exists SOSTicket.tComentario (
                codOds Int Not Null Comment 'Identificador da ordem de serviço',
                codUsu Int Not Null Comment 'Identificador do usuário',
                codAnx Int Null Comment 'Identificador(es) do(s) Anexo(s)',
                comDes Varchar (300) Not Null Comment 'Descrição do comentário',
                comDca DateTime Not Null Comment 'Data de cadastro do comentário',
                Primary Key (codOds, codUsu, codAnx)
            );
            Create Table If Not Exists SOSTicket.tOrcamento (
                codOrc Int Not Null Auto_Increment Comment 'Identificador do orçamento da compra',
                orcEmp Varchar (100) Not Null Comment 'Nome da empresa do orçamento da compra',
                codCop Int Not Null Comment 'Identificador da compra',
                Primary Key (codOrc)
            );
            Create Table If Not Exists SOSTicket.tCompra (
                codCop Int Not Null Auto_Increment Comment 'Identificador da compra',
                copTit Varchar(100) Not Null Comment 'Titulo da compra',
                copAss Varchar(300) Not Null Comment 'Assunto da compra',
                copTel Int Not Null Comment 'Telefone do cliente da compra',
                copDab DateTime Not Null Comment 'Data de abertura da compra',
                copDag DateTime Default Null Comment 'Data de agendamento da compra',
                copDen DateTime Default Null Comment 'Data de encerramento da compra',
                codAtd Int Not Null Comment 'Identificador do atendente da compra',
                codSer Int Not null comment 'Identificador do serviço da compra',
                codEst Int Not Null Comment 'Identificador do estado da compra',
                codPrd Int Not Null Comment 'Identificador da prioridade da compra',
                codEmp Int Not null comment 'Identificador da empresa da compra',
                codLoc Int Not Null Comment 'Identificador do local da compra',
                codCli Int Not Null Comment 'Identificador do cliente da compra',
                codCar Int Not Null Comment 'Identificador do cargo do cliente da compra',
                Primary Key (codCop)
            );
            Alter table SOSTicket.tUsuario Add Constraint FK_tUsuario_tCargo Foreign Key (codCar) References SOSTicket.tCargo (codCar);
            Alter table SOSTicket.tUsuario Add Constraint FK_tUsuario_tLocal Foreign Key (codLoc) References SOSTicket.tLocal (codLoc);
            Alter table SOSTicket.tUsuario Add Constraint FK_tUsuario_tEmpresa Foreign Key (codEmp) References SOSTicket.tEmpresa (codEmp);
            Alter table SOSTicket.tUsuario Add Constraint FK_tUsuario_tSituacao Foreign Key (codSit) References SOSTicket.tSituacao (codSit);
            ALter Table SOSTicket.tServico Add Constraint FK_tServico_tTempoConclusao Foreign Key (codTco) References tTempoConclusao (codTco);
            ALter Table SOSTicket.tServico Add Constraint FK_tServico_tLocal Foreign Key (codLoc) References tLocal (codLoc);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tLocal Foreign Key (codLoc) References SOSTicket.tLocal (codLoc);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tUsuario_Atendente Foreign Key (codAtd) References SOSTicket.tUsuario (codUsu);
            Alter Table SOSTicket.tAnexoOds Add Constraint FK_tAnexoOds_tOrdemServico Foreign Key (codOds) References SOSTicket.tOrdemServico (codOds);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tEstado Foreign Key (codEst) References SOSTicket.tEstado (codEst);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tPrioridade Foreign Key (codPrd) References SOSTicket.tPrioridade (codPrd);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tEmpresa Foreign Key (codEmp) References SOSTicket.tEmpresa (codEmp);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tUsuario_Cliente Foreign Key (codCli) References SOSTicket.tUsuario (codUsu);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tCargo Foreign Key (codCar) References SOSTicket.tCargo (codCar);
            Alter Table SOSTicket.tOrdemServico Add Constraint FK_tOrdemServico_tServico Foreign Key (codSer) References SOSTicket.tServico (codSer);
            Alter Table SOSTicket.tComentario Add Constraint FK_tComentario_tOrdemServico Foreign Key (codOds) References SOSTicket.tOrdemServico (codOds);
            Alter Table SOSTicket.tComentario Add Constraint FK_tComentario_tUsuario Foreign Key (codUsu) References SOSTicket.tUsuario (codUsu);
            Alter table SOSTicket.tComentario Add Constraint FK_tComentario_tAnexoCom Foreign Key (codAnx) References SOSTicket.tAnexoCom (codAnx);
            Alter Table SOSTicket.tAnexoOrc Add Constraint FKtAnexoOrc_tOrcamento Foreign Key (codOrc) References SOSTicket.tOrcamento (codOrc);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tUsuario_Atendente Foreign Key (codAtd) References SOSTicket.tUsuario (codUsu);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tServico Foreign Key (codSer) References SOSTicket.tServico (codSer);
            Alter Table SOSTicket.tOrcamento Add Constraint FK_tOrcamento_tCompra Foreign Key (codCop) References SOSTicket.tCompra (codCop);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tEstado Foreign Key (codEst) References SOSTicket.tEstado (codEst);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tPrioridade Foreign Key (codPrd) References SOSTicket.tPrioridade (codPrd);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tEmpresa Foreign Key (codEmp) References SOSTicket.tEmpresa (codEmp);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tLocal Foreign Key (codLoc) References SOSTicket.tLocal (codLoc);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tUsuario_Cliente Foreign Key (codCli) References SOSTicket.tUsuario (codUsu);
            Alter Table SOSTicket.tCompra Add Constraint FK_tCompra_tCargo Foreign Key (codCar) References SOSTicket.tCargo (codCar);
            Insert into tPerfil Values	('Administrador',1,GetDate(),null),
                                        ('Cliente',1,GetDate(),null),
                                        ('Atendente',1,GetDate(),null),
                                        ('Cliente-Atendente',1,GetDate(),null);
            Insert Into tTempoConclusao Values	('1 Hora',1,GetDate(),null),
                                                ('5 Horas',1,GetDate(),null),
                                                ('1 Dia',1,GetDate(),null),
                                                ('3 Dias',1,GetDate(),null),
                                                ('1 Semana',1,GetDate(),null);
            Insert Into tPrioridade Values	('Baixa',1,GetDate(),null),
                                            ('Média',1,GetDate(),Null),
                                            ('Alta',1,GetDate(),null);
            Insert into tEstado Values	('Aberto',1,GetDate(),null),
                                        ('Em Atendimento',1,GetDate(),null),
                                        ('Aguardando Retorno',1,GetDate(),null),
                                        ('Resolvido',1,GetDate(),null),
                                        ('Fechado',1,GetDate(),null),
                                        ('Agendado',1,GetDate(),null),
                                        ('Compra Efetuada',1,GetDate(),null);
            Insert Into tSituacao Values    ('Trabalhando',1,GetDate(),null),
                                            ('Férias',1,GetDate(),null),
                                            ('Folga',1,GetDate(),null),
                                            ('Demitido',1,GetDate(),null),
                                            ('Afastado',1,GetDate(),null),
                                            ('Afastado-Licença Médica(15 Dias)',1,GetDate(),null),
                                            ('Afastado-Licença Médica(30 Dias)',1,GetDate(),null),
                                            ('Afastado-Licença Maternidade',1,GetDate(),null);
            ");
            $ret = $this -> getPdo() -> execute();
            return $ret;
        }

        public function ImpbaseSqlserver(){
            $this -> setPdo($this -> getBase() -> conectarDb());
            $this -> getPdo() -> prepare("
            Create Table tCargo(
                codCar Int Not Null Identity,
                carNom Varchar(100) Not Null,
                carSit TinyInt Not Null,
                carDca DateTime Not Null,
                carDfi DateTime Default Null,
                Primary Key (codCar)
            );
            Create Table tLocal(
                codLoc Int Not Null Identity,
                locNom Varchar(100) Not Null,
                locSit TinyInt Not Null,
                locDca DateTime Not Null,
                locDfi DateTime Default Null,
                Primary Key (codLoc)
            );
            Create Table tEmpresa(
                codEmp Int Not Null Identity,
                empNom Varchar (100) Not Null,
                empSit TinYInt Not Null,
                empDca DateTime Not Null,
                empDfi DateTime Default Null,
                Primary Key (codEmp)
            );
            Create Table tPerfil(
                codPer Int Not Null Identity,
                perNom Varchar (100) Not Null,
                perSit TinyInt Not Null,
                perDca DateTime Not Null,
                perDfi DateTime Default Null,
                Primary Key (codPer)
            );
            Create Table tSituacao(
                codSit Int not Null Identity,
                sitNom Varchar (100) Not Null,
                sitSit TinyInt not Null,
                sitDca DateTime Not Null,
                sitDfi DateTime Default Null,
                Primary Key (codSit)
            );
            Create Table tUsuario(
                codUsu Int Not Null Identity,
                usuNom Varchar (20) Not Null,
                usuSno Varchar (100) Not Null,
                usuEma Varchar (150) Not Null,
                usuLog Varchar (100) Not Null,
                UsuSen Varchar (100) Not Null,
                usuCpf Varchar (11) Not Null,
                usuDna DateTime Not Null,
                usuTel Int Not Null,
                usuSex Char (1) Not Null,
                usuDca DateTime not Null,
                usuDaf DateTime Default Null,
                codCar Int Not Null,
                codLoc Int Not Null,
                codEmp Int Not Null,
                codPer Int Not Null,
                codSit Int Not Null,
                Primary Key (codUsu)
            );
            Create Table tAnexoOds (
                codAnx Int Not Null Identity,
                anxNom Varchar (50) Not Null,
                anxLoc Varchar (50) Not Null,
                anxTam Numeric (7,3) Not Null,
                anxDca DateTime Not Null,
                codOds Int Not Null,
                Primary Key (codAnx)
            );
            Create Table tAnexoCom (
                codAnx Int Not Null identity,
                anxNom Varchar (50) Not Null,
                anxLoc Varchar (50) Not Null,
                anxTam Numeric (7,3) Not Null,
                anxDca DateTime Not Null,
                Primary Key (codAnx)
            );
            Create Table tAnexoOrc (
                codAnx Int Not Null Identity,
                anxNom Varchar (50) Not Null,
                anxLoc Varchar (50) Not Null,
                anxTam Numeric (7,3) Not Null,
                anxDca DateTime Not Null,
                codOrc Int Not Null,
                Primary Key (codAnx)
            );
            Create Table tEstado (
                codEst Int Not Null Identity,
                estNom Varchar (50) Not Null,
                estSit TinyInt Not Null,
                estDca DateTime Not Null,
                estDfi DateTime Default Null,
                Primary Key (codEst)
            );
            Create Table tPrioridade (
                codPrd Int Not Null Identity,
                prdNom Varchar (50) Not Null,
                prdSit TinyInt Not Null,
                prdDca DateTime Not Null,
                prdDfi DateTime Null,
                Primary Key (codPrd)
            );
            Create Table tTempoConclusao (
                codTco Int Not Null Identity,
                tcoNom Varchar (20) Not Null,
                tcoSit TinyInt Not Null,
                tcoDca DateTime Not Null,
                tcoDfi DateTime Default Null,
                Primary Key (codTco)
            );
            Create Table tServico (
                codSer Int Not Null Identity,
                serNom Varchar (100) Not Null,
                serSit TinyInt Not Null,
                setDca DateTime Not Null,
                serDfi DateTime Null,
                codTco Int Not Null,
                codLoc Int Not Null,
                Primary Key (codSer)
            );
            Create Table tOrdemServico (
                codOds Int Not Null Identity,
                odsTit Varchar (100) Not Null,
                odsAss Varchar (300) Not Null,
                odsTel Int Not Null,
                odsDab DateTime Not Null,
                odsDag DateTime Default Null,
                odsDen DateTime Default Null,
                codLoc Int Not Null,
                codAtd Int Not Null,
                codEst Int Not Null,
                codPrd Int Not Null,
                codEmp Int Not Null,
                codCli Int Not Null,
                codCar Int Not Null,
                codSer Int Not Null,
                Primary Key (codOds)
            );
            Create Table tComentario (
                codOds Int Not Null,
                codUsu Int Not Null,
                codAnx Int Default Null,
                comDes Varchar (300) Not Null,
                comDca DateTime Not Null,
                Primary Key (codAnx, codOds, codUsu)
            );
            Create Table tOrcamento (
                codOrc Int Not Null Identity,
                orcEmp Varchar (100) Not Null,
                codCop Int Not Null,
                Primary Key (codOrc)
            );
            Create Table tCompra (
                codCop Int Not Null Identity,
                copTit Varchar(100) Not Null,
                copAss Varchar(300) Not Null,
                copTel Int Not Null,
                copDab DateTime Not Null,
                copDag DateTime Default Null,
                copDen DateTime Default Null,
                codAtd Int Not Null,
                codSer Int Not null,
                codEst Int Not Null,
                codPrd Int Not Null,
                codEmp Int Not null,
                codLoc Int Not Null,
                codCli Int Not Null,
                codCar Int Not Null,
                PRIMARY KEY (codCop)
            );
            Alter table tUsuario Add Constraint FK_tUsuario_tCargo Foreign Key (codCar) References tCargo (codCar);
            Alter table tUsuario Add Constraint FK_tUsuario_tLocal Foreign Key (codLoc) References tLocal (codLoc);
            Alter table tUsuario Add Constraint FK_tUsuario_tEmpresa Foreign Key (codEmp) References tEmpresa (codEmp);
            Alter table tUsuario Add Constraint FK_tUsuario_tSituacao Foreign Key (codSit) References tSituacao (codSit);
            ALter Table tServico Add Constraint FK_tServico_tTempoConclusao Foreign Key (codTco) References tTempoConclusao (codTco);
            ALter Table tServico Add Constraint FK_tServico_tLocal Foreign Key (codLoc) References tLocal (codLoc);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tLocal Foreign Key (codLoc) References tLocal (codLoc);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tUsuario_Atendente Foreign Key (codAtd) References tUsuario (codUsu);
            Alter table tAnexoOds Add Constraint FK_tAnexoOds_tOrdemServico Foreign Key (codOds) References tOrdemServico (codOds);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tEstado Foreign Key (codEst) References tEstado (codEst);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tPrioridade Foreign Key (codPrd) References tPrioridade (codPrd);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tEmpresa Foreign Key (codEmp) References tEmpresa (codEmp);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tUsuario_Cliente Foreign Key (codCli) References tUsuario (codUsu);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tCargo Foreign Key (codCar) References tCargo (codCar);
            Alter Table tOrdemServico Add Constraint FK_tOrdemServico_tServico Foreign Key (codSer) References tServico (codSer);
            Alter Table tComentario Add Constraint FK_tComentario_tOrdemServico Foreign Key (codOds) References tOrdemServico (codOds);
            Alter Table tComentario Add Constraint FK_tComentario_tUsuario Foreign Key (codUsu) References tUsuario (codUsu);
            Alter table tComentario Add Constraint FK_tComentario_tAnexoCom Foreign Key (codAnx) References tAnexoCom (codAnx);
            Alter table tAnexoOrc Add Constraint FK_tAnexoOrc_tOrcamento Foreign Key (codOrc) References tOrcamento (codOrc);
            Alter Table tCompra Add Constraint FK_tCompra_tUsuario_Atendente Foreign Key (codAtd) References tUsuario (codUsu);
            Alter Table tCompra Add Constraint FK_tCompra_tServico Foreign Key (codSer) References tServico (codSer);
            Alter Table tOrcamento Add Constraint FK_tOrcamento_tCompra Foreign Key (codCop) References tCompra (codCop);
            Alter Table tCompra Add Constraint FK_tCompra_tEstado Foreign Key (codEst) References tEstado (codEst);
            Alter Table tCompra Add Constraint FK_tCompra_tPrioridade Foreign Key (codPrd) References tPrioridade (codPrd);
            Alter Table tCompra Add Constraint FK_tCompra_tEmpresa Foreign Key (codEmp) References tEmpresa (codEmp);
            Alter Table tCompra Add Constraint FK_tCompra_tLocal Foreign Key (codLoc) References tLocal (codLoc);
            Alter Table tCompra Add Constraint FK_tCompra_tUsuario_Cliente Foreign Key (codCli) References tUsuario (codUsu);
            Alter Table tCompra Add Constraint FK_tCompra_tCargo Foreign Key (codCar) References tCargo (codCar);
            Insert into tPerfil Values	('Administrador',1,GetDate(),null),
									    ('Cliente',1,GetDate(),null),
									    ('Atendente',1,GetDate(),null),
									    ('Cliente-Atendente',1,GetDate(),null);
            Insert Into tTempoConclusao Values	('1 Hora',1,GetDate(),null),
                                                ('5 Horas',1,GetDate(),null),
                                                ('1 Dia',1,GetDate(),null),
                                                ('3 Dias',1,GetDate(),null),
                                                ('1 Semana',1,GetDate(),null);
            Insert Into tPrioridade Values	('Baixa',1,GetDate(),null),
                                            ('Média',1,GetDate(),Null),
                                            ('Alta',1,GetDate(),null);
            Insert into tEstado Values	('Aberto',1,GetDate(),null),
                                        ('Em Atendimento',1,GetDate(),null),
                                        ('Aguardando Retorno',1,GetDate(),null),
                                        ('Resolvido',1,GetDate(),null),
                                        ('Fechado',1,GetDate(),null),
                                        ('Agendado',1,GetDate(),null),
                                        ('Compra Efetuada',1,GetDate(),null);
            Insert Into tSituacao Values	('Trabalhando',1,GetDate(),null),
                                            ('Férias',1,GetDate(),null),
                                            ('Folga',1,GetDate(),null),
                                            ('Demitido',1,GetDate(),null),
                                            ('Afastado',1,GetDate(),null),
                                            ('Afastado-Licença Médica(15 Dias)',1,GetDate(),null),
                                            ('Afastado-Licença Médica(30 Dias)',1,GetDate(),null),
                                            ('Afastado-Licença Maternidade',1,GetDate(),null);
            ");
            $ret = $this -> getPdo() -> execute();
            return $ret;
        }

        Private function setBase($base){
            $this -> base = $base;
        }

        Private function getBase(){
            return $this -> base;
        }

        Private function setPdo($pdo){
            $this -> pdo = $pdo;
        }

        Private function getPdo(){
            return $this -> pdo;
        }
    }