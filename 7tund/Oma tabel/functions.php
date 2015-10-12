<?php

    require_once("../../config_global.php");
    $database = "if15_brenbra_1";

    function getAllData($keyword=""){
		
		if($keyword == ""){
            //ei otsi
            $search = "%%";
        }else{
            //otsime
            $search = "%".$keyword."%";
        }
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);

        $stmt = $mysqli->prepare("SELECT id, user_id, homework, date FROM homeworks");
        $stmt->bind_result($id_from_db, $user_id_from_db, $homework_from_db, $date_from_db);
        $stmt->execute();
        
        // massiiv kus hoiame autosid
        $array = array();
        
        // iga rea kohta mis on ab'is teeme midagi
        while($stmt->fetch()){
            //suvaline muutuja, kus hoiame auto andmeid 
            //selle hetkeni kui lisame massiivi
               
            // tühi objekt kus hoiame väärtusi
            $homework = new StdClass();
            
            $homework->id = $id_from_db;
            $homework->homework = $homework_from_db;
			$homework->user = $user_id_from_db;
			$homework->date = $date_from_db;
            
            //lisan massiivi (auto lisan massiivi)
            array_push($array, $homework);
            //echo "<pre>";
            //var_dump($array);
            //echo "</pre>";
        }
        
        //saadan tagasi
        return $array;
			
        
        
        $stmt->close();
        $mysqli->close();
    }
	
	function deletehomeworkData($homework_id){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        
        // uuendan välja deleted, lisan praeguse date'i
        $stmt = $mysqli->prepare("UPDATE homeworks SET deleted=NOW() WHERE id=?");
        $stmt->bind_param("i", $homework_id);
        $stmt->execute();
        
        // tühjendame aadressirea
        header("Location: table.php");
        
        $stmt->close();
	}
	
	function updatehomeworkData($homework_id, $homework, $date){
        
        $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        
        $stmt = $mysqli->prepare("UPDATE homeworks SET homework=?, date=? WHERE id=?");
        $stmt->bind_param("ssi", $homework, $date, $homework_id);
        $stmt->execute();
        
        // tühjendame aadressirea
        header("Location: table.php");
        
        $stmt->close();
        $mysqli->close();
        $mysqli->close();
		
		
        
    }
    
    
 ?>