<?php
	require_once("../../../config_global.php");
	$database = if15_brenbra_1
	function logInUser(){
		$global $mysqli;
		
		if($username_error == "" && $password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$username.", email on ".$email." ja parool on ".$password;
			
                $hash = hash("sha512", $password);
                
                $stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE username=? AND email=? AND password=?");
                // küsimärkide asendus
                $stmt->bind_param("sss", $username, $email, $hash);
                //ab tulnud muutujad
                $stmt->bind_result($id_from_db, $email_from_db);
                $stmt->execute();
                
                // teeb päringu ja kui on tõene (st et ab oli see väärtus)
                if($stmt->fetch()){
                    
                    // Kasutaja email ja parool õiged
                    echo "Kasutaja logis sisse id=".$id_from_db;
                    
                }else{
                    echo "Wrong credentials!";
                }
                
                $stmt->close();
				
				$mysqli->close();
                
            
            
		}
	}
	function createUser(){
		$global $mysqli;
		
		if($create_username_error =="" && $create_email_error == "" && $create_password_error == "" && $confirm_password_error == ""){
				echo hash("sha512", $create_password);
                echo "Võib kasutajat luua! Kasutajanimi on ".$create_username.", email on ".$create_email." ja parool on ".$create_password;
                
                // tekitan parooliräsi
                $hash = hash("sha512", $create_password);
                
                //salvestan andmebaasi
                $stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
                
                //kirjutan välja error
                //echo $stmt->error;
                //echo $mysqli->error;
                
                // paneme muutujad küsimärkide asemel
                // ss - s string, iga muutuja koht 1 täht
                $stmt->bind_param("ss", $create_email, $hash);
                
                //käivitab sisestuse
                $stmt->execute();
                $stmt->close();
				
				$mysqli->close();
                
                
        }
	}

?>