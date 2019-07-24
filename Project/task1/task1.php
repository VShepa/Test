<?php

final class init {
    
    private $mysqli;
	
    function __construct($host = 'localhost', $user = 'root',$password = '111', $dbname = 'test' )
    {
			
        try
        {
            $this->mysqli= new mysqli($host,$user,$password,$dbname);
        }
        catch (Exception $ex) {
            exit($ex->getMessage());
        }
        $this->create();
        $this->fill();
    } 
    
	private function create(){
        $queryCreateTable = "CREATE TABLE IF NOT EXISTS `test` (`id` INT  NOT NULL AUTO_INCREMENT,`script_name` VARCHAR(25) NOT NULL,`script_time` INT NOT NULL,`end_time` INT NOT NULL,`result` SET('normal','illegal','failed','success') NOT NULL, PRIMARY KEY(`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
        try 
        {
            $this->mysqli->query($queryCreateTable);
        } 
        catch (Exception $ex) { 
			exit($ex->getMessage());
		}
	}
	
	private function fill(){
	    for ($i =0; $i < 10; ++$i){
                $script_name = str_shuffle(substr($str ='t32432432432325326rrfewrewrfwrewrdwedrewrdewrew',1,25));
	    	$result = array_rand(["normal"=>"1", "illegal"=>"2", "failed"=>"3", "success"=>"4"],1);
                $queryFill = "INSERT INTO `test` (`script_name`,`script_time`,`end_time`,`result`) VALUES ('".$script_name."',".rand(1,10).",".rand(1,10).",'".$result."');";
                try 
                {
                    $this->mysqli->query($queryFill);
                } 
                catch (Exception $ex) { }
            }		
        }
	
	public function get($result){
            if ($result === "normal" || $result === "success")
            {
                $queryGet = "SELECT * FROM `test` WHERE `result`='".$result."'";
                try 
                {
                    $preResult = $this->mysqli->query($queryGet);
                    return $preResult->fetch_row();
                } catch (Exception $ex) 
                { 
                   exit($ex->getMessage());
                }
            }
            else 
            {
                throw new \Exception("Параметры могут быть 'normal' или 'success'!");
            }
	}
}
