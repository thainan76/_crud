<?php

    /**
    *  Classe para conexão do banco de dados e seus métodos (Adicionar, Remover, Editar e Visualizar)  
    */

    class conexao {

        public $host = 'localhost';
        public $user = 'root';
        public $password = '';
        public $database = 'crud';
        
        /**
         * Método conectandoBanco
         * É um método para fazer a conexão com o banco de dados
         * @param string $HOST Servidor a onde está o banco de dados
         * @param string $USER Usuário do banco de dados
         * @param string $PASSWORD Senha do banco de dados
         * @param string $DATABASE Nome do banco de dados
         * @param return  Objetos do MySQLI com suas funções
        */

        public function conectandoBanco($HOST, $USER, $PASSWORD, $DATABASE){
            
            $mysqli = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);

            if ($mysqli->connect_errno) {
                printf("Conexão falhada: %s\n", $mysqli->connect_error);
                exit();
            }

            if (!$mysqli->set_charset("utf8")) {
                printf("Erro de setar o utf8: %s\n", $mysqli->error);
                exit();
            }
            return $mysqli;
        }
        
        /**
         * Método getClientes
         * É um método para trazer todos os clientes
         * @param return true
        */

        public function getClientes(){
            return mysqli_query($this->conectandoBanco($this->host, $this->user, $this->password, $this->database), "SELECT * FROM Clientes");
        }

        /**
         * Método addClientes
         * É um método para inserir um cliente no banco de dados
         * @param Object $dados Objeto de informações do cliente
         * @param return true
        */

        public function addClientes($dados){

            $insert = "INSERT INTO clientes (nome, email, telefone, endereco, bairro) VALUES ('$dados->nome', '$dados->email', '$dados->telefone', '$dados->endereco', '$dados->bairro')";

            return mysqli_query($this->conectandoBanco($this->host, $this->user, $this->password, $this->database), $insert);
        }

         /**
         * Método updateClientes
         * É um método para editar/atualizar alguma informação do cliente
         * @param Object $dados Objeto de informações do cliente
         * @param return true
        */

        public function updateClientes($dados){

            $update = "UPDATE clientes SET nome = '$dados->nome', email = '$dados->email', telefone = '$dados->telefone', endereco = '$dados->endereco', bairro = '$dados->bairro' WHERE id = $dados->id ";
            
            return mysqli_query($this->conectandoBanco($this->host, $this->user, $this->password, $this->database), $update);
        }

         /**
         * Método deleteClientes
         * É um método para remover o cliente do banco de dados
         * @param string $id Identificador do cliente
         * @param return true
        */

        public function deleteClientes($id){
            return mysqli_query($this->conectandoBanco($this->host, $this->user, $this->password, $this->database), "DELETE FROM clientes WHERE id = '$id' ");
        }

    } 
?>