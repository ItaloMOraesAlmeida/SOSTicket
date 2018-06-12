<?php

/******************************************************************************************
 *                        INTERFACE DE ACESSO A CALSSE DE CONEXÃO                         *
 * Versão: 1.0                                                                            *
 * Autor: Italo Moraes                                                                    *
 * Pacote: NULL                                                                           *
 * Empresa: MySoftware                                                                    *
 * Descrição:                                                                             *
 *      Resposavel pelo encapsulamento das conesões da classe Conexao.                    *                            *
 *                                                                                        *
 * OBS: CONCLUÍDO                                                                         *
 *                                                                                        *
 * ---------------------------------------------------------------------------------------*
 * |                                    LICENÇA PRIVADA                                  |*
 * ---------------------------------------------------------------------------------------*
 ******************************************************************************************/

    interface Conn{
        public function conectarDb();
        public function autenticar($usuario,$senha);
    }