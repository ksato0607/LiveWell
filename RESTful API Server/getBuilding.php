<?php
	//Set up for connection to database
	$db = new mysqli('mysql.cs.iastate.edu', 'dbu309la04', 'YTGUxudv7py', 'db309la04');

	//Attempts to connect to database which returns an error if unsuccessful
	if($db->connect_errno > 0 ){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	//If statement checks that HTTP request URI contains residentID parameter
	if(isset($_GET["buildingID"])){
		$buildingID = $_GET['buildingID'];

		//Sets value of $result to SQL query and returns an error otherwise
		if(!$result = $db->query("SELECT buildingID, firstName, lastName, address, numRooms, bankNum, RoutingNum, imageUrl FROM tblBuilding INNER JOIN tblOwner ON tblBuilding.ownerID = tblOwner.ownerID WHERE tblBuilding.buildingID = $buildingID")){
			die('There was an error running the query [' . $db->error . ']');
		}

		//Goes through all rows returned by query and sets the notification array to the data
		$building = array();
		while($row = $result->fetch_assoc()){
				$building[] = $row;
		}

		//Encodes the array to json and returns it as an HTTP response
		echo json_encode($building);

		//Closes the SQL connection
		$result->close();
		$db->close();
	}

	else if(isset($_GET["ownerID"])){
		$ownerID = $_GET['ownerID'];

		//Sets value of $result to SQL query and returns an error otherwise
		if(!$result = $db->query("SELECT buildingID, firstName, lastName, address, numRooms, bankNum, routingNum, imageUrl FROM tblBuilding INNER JOIN tblOwner ON tblBuilding.ownerID = tblOwner.ownerID WHERE tblBuilding.ownerID = $ownerID")){
			die('There was an error running the query [' . $db->error . ']');
		}

		//Goes through all rows returned by query and sets the building array to the data
		$building = array();
		while($row = $result->fetch_assoc()){
				$building[] = $row;
		}

		//Encodes the array to json and returns it as an HTTP response
		echo json_encode($building);

		//Closes the SQL connection
		$result->close();
		$db->close();
	}

	else if(isset($_GET["price"]) && isset($_GET["accommodationType"]) && isset($_GET["numRooms"]))
	{
		$price = $_GET['price'];
		$numRooms = $_GET['numRooms'];
		$accommodationType = $_GET['accommodationType'];

		if(!$result = $db->query("SELECT * FROM tblBuilding
		WHERE tblBuilding.price <= $price AND tblBuilding.numRooms >= $numRooms AND tblBuilding.accommodationType = '$accommodationType'")){
			die('There was an error running the query [' . $db->error . ']');
		}

		//Goes through all rows returned by query and sets the building array to the data
		$building = array();
		while($row = $result->fetch_assoc()){
				$building[] = $row;
		}

		//Encodes the array to json and returns it as an HTTP response
		echo json_encode($building);

		//Closes the SQL connection
		$result->close();
		$db->close();

	}

	else if(isset($_GET["favorite"])){
		$favorite = $_GET['favorite'];

		if(!$result = $db->query("SELECT * FROM tblBuilding
		WHERE tblBuilding.favorite = $favorite")) {
			die('There was an error running the query [' . $db->error . ']');
		}

		//Goes through all rows returned by query and sets the building array to the data
		$building = array();
		while($row = $result->fetch_assoc()){
				$building[] = $row;
		}

		//Encodes the array to json and returns it as an HTTP response
		echo json_encode($building);

		//Closes the SQL connection
		$result->close();
		$db->close();
	}

	else{
				//Sets value of $result to SQL query and returns an error otherwise
		if(!$result = $db->query("SELECT * FROM tblBuilding")){
			die('There was an error running the query [' . $db->error . ']');
		}

		//Goes through all rows returned by query and sets the building array to the data
		$building = array();
		while($row = $result->fetch_assoc()){
				$building[] = $row;
		}

		//Encodes the array to json and returns it as an HTTP response
		echo json_encode($building);

		//Closes the SQL connection
		$result->close();
		$db->close();
	}
?>
