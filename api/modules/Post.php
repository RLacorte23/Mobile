<?php
class Post {
    protected $pdo, $get;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
        $this->get = new Get($pdo);
    }

    public function addRecord($param) {
        $sqlString = "INSERT INTO tbl_info(fld_fname, fld_mname, fld_lname, fld_age) VALUES (?, ?, ?, ?);";
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$param->fname, $param->mname, $param->lname, $param->age]);
            // return $get->getRecords(null);
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
    }

    public function updateRecord($param) {
        $sqlString = "UPDATE tbl_info SET fld_fname=?, fld_mname=?, fld_lname=?, fld_age=? WHERE fld_recno=?";
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$param->fname, $param->mname, $param->lname, $param->age, $param->recno]);
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
    }

    public function setArchiveRecord($param) {
        // $sqlString = "UPDATE tbl_info SET fld_isdeleted=? WHERE fld_recno=?";
        $sqlString = "CALL SetArchive(?,?)";
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$param->isdeleted, $param->recno]);
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
        // $values = [$param->isdeleted, $param->recno];
        // return executeQuery($sqlString, $values);
    }

    public function deleteRecord($param) {
        $sqlString = "DELETE FROM tbl_info WHERE fld_recno=?";
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$param->recno]);
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
    }

    private function executeQuery($sql, $values) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($values);
            return array("code"=>200, "data"=>$data);
        } catch (\PDOException $er) {
            return array("code"=>404, "message"=>$er->getMessage());
        } 
    }
}
