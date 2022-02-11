<?php
require_once "dataModelBase.php";

class Cidade extends DataModelBase{
    private $codCidade;
    private $nome;

    public function setCodCidade(int $codCidade):void{
        $this->codCidade = $codCidade;
    }

    public function getCodCidade():int{
        return $this->codCidade;
    }

    public function setNome(string $nome):void{
        $this->nome = $nome;
    }

    public function getNome():string{
        return $this->nome;
    }

  
    public function post() :array{
        $con = $this->connection();
        $stmt = $con->prepare("INSERT INTO cidade VALUES (NULL, :_nome)");
        $stmt->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);

        if ($stmt->execute()){
            $this->setCodCidade($con->lastInsertId());
            return $this->get();
        }
        return [];
    }

    public function get() :array{
        $con = $this->connection();

        if($this->getCodCidade() > 0){
            $stmt = $con->prepare("SELECT * FROM cidade WHERE codCidade = :_codCidade");
            $stmt->bindValue(":_codCidade", $this->getCodCidade(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        return [];

        }else if ($this->getCodCidade() === 0){
            $stmt = $con->prepare("SELECT * FROM cidade");
        if ($stmt->execute()){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        return [];
        }
        
    }

    public function put() :array{
        $con = $this->connection();
        $stmt = $con->prepare("UPDATE cidade SET nome = :_nome WHERE codCidade = :_codCidade");
        $stmt->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);
         $stmt->bindValue(":_codCidade", $this->getCodCidade(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            return $this->get();
        }
        return [];
    }

        public function delete() :array{
        $person = $this->get();
        $con = $this->connection();
        $stmt = $con->prepare("DELETE FROM cidade WHERE codCidade = :_codCidade");
         $stmt->bindValue(":_codCidade", $this->getCodCidade(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            return $person;
        }
        return [];
    }
}

?>