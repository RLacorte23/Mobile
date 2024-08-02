<?php
class Get {
    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getLastSensorData() {
        $sqlString = "SELECT * FROM gas_sensor 
                        ORDER BY created_at DESC
                        LIMIT 1;";

        $data = [];

        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute();
            $res = $stmt->fetchAll();
            $data = $res;
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
        return array("code"=>404, "message"=>"ERROR");
    }

    public function getSensorData() {
        $sqlString = "SELECT * FROM gas_sensor 
                        ORDER BY created_at DESC;";

        $data = [];

        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute();
            $res = $stmt->fetchAll();
            $data = $res;
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
        return array("code"=>404, "message"=>"ERROR");
    }

}
