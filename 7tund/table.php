
<?php  
    require_once("functions.php");
    
    $car_array = getAllData();
	if(isset($_GET["delete"])){
		deleteCarData($_GET["delete"]);
	}

?>

<h1>Tabel</h1>
<table border=1>
<tr>
	<th>id</th>
	<th>kasutaja id</th>
	<th>auto numbrimärk</th>
	<th>värv</th>
</tr>
<?php    
    // autod ükshaaval läbi käia
    for($i = 0; $i < count($car_array); $i++){
        
        // kasutaja tahab rida muuta
        if(isset($_GET["edit"]) && $_GET["edit"] == $car_array[$i]->id){
            echo "<tr>";
            echo "<form action='table.php' method='get'>";
            // input mida välja ei näidata
            echo "<input type='hidden' name='car_id' value='".$car_array[$i]->id."'>";
            echo "<td>".$car_array[$i]->id."</td>";
            echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td><input name='number_plate' value='".$car_array[$i]->number_plate."' ></td>";
            echo "<td><input name='color' value='".$car_array[$i]->color."' ></td>";
            echo "<td><input name='update' type='submit'></td>";
            echo "<td><a href='table.php'>cancel</a></td>";
            echo "</form>";
            echo "</tr>";
        }else{
            // lihtne vaade
            echo "<tr>";
            echo "<td>".$car_array[$i]->id."</td>";
            echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td>".$car_array[$i]->number_plate."</td>";
            echo "<td>".$car_array[$i]->color."</td>";
            echo "<td><a href='?delete=".$car_array[$i]->id."'>X</a></td>";
            echo "<td><a href='?edit=".$car_array[$i]->id."'>edit</a></td>";
            echo "</tr>";
            
        }
        
        
        
        
    }
    
?>