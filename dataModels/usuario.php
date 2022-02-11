<?php
require_once "dataModelBase.php";

class Usuario extends DataModelBase{
    private $email;
    private $nome;
    private $urlFoto;
 
    public function setEmail(string $email):void{
        $this->email = $email;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function setNome(string $nome):void{
        $this->nome = $nome;
    }

    public function getNome():string{
        return $this->nome;
    }

    public function setUrlFoto(string $urlFoto):void{
        $this->urlFoto = $urlFoto;
    }

    public function getUrlFoto():string{
        return $this->urlFoto;
    }


  
    public function post() :array{
        $con = $this->connection();
        $stmt = $con->prepare("SELECT * FROM usuario WHERE email = :_email");
        $stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
        print($stmt->execute());
        
        if($stmt->execute()){
            if($stmt->fetchAll(\PDO::FETCH_ASSOC)->ob_get_length() > 0){
                $stmt2 = $con->prepare("INSERT INTO usuario VALUES (NULL, :_nome)");
                $stmt2->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);

                if ($stmt->execute()){
                    $this->setemail($con->lastInsertId());
                    return $this->get();
                }
                return [];
            }
            
            return [];
        }
       
        return [];
    }

    public function get() :array{
        $con = $this->connection();

        if($this->getEmail() != "" || $this->getEmail != null){
            $stmt = $con->prepare("SELECT * FROM usuario WHERE email = :_email");
            $stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
        if ($stmt->execute()){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        return [];

        }else if ($this->getEmail() === ""){
            $stmt = $con->prepare("SELECT * FROM usuario");
        if ($stmt->execute()){
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            //return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        return [];
        }
        
    }

    public function put() :array{
        $con = $this->connection();
        $stmt = $con->prepare("UPDATE usuario SET nome = :_nome, urlFoto = :_urlFoto WHERE email = :_email");
        $stmt->bindValue(":_nome", $this->getNome(), \PDO::PARAM_STR);
         $stmt->bindValue(":_urlFoto", $this->getUrlFoto(), \PDO::PARAM_STR);
         $stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
        if ($stmt->execute()){
            return $this->get();
        }
        return [];
    }

        public function delete() :array{
        $person = $this->get();
        $con = $this->connection();
        $stmt = $con->prepare("DELETE FROM usuario WHERE email = :_email");
         $stmt->bindValue(":_email", $this->getEmail(), \PDO::PARAM_STR);
        if ($stmt->execute()){
            return $person;
        }
        return [];
    }
}

?>