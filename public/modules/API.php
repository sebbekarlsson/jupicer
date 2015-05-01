<?php
	
	session_start();

	$ini = parse_ini_file(("../config.ini"), true);
	$resizor_location = $ini["database"]["resizor_location"];
	$db = new PDO('mysql:host='.$ini["database"]["host"].';dbname='.$ini["database"]["dbname"].';', $ini["database"]["username"], $ini["database"]["password"]);

	if(is_loggedin()){
		$USER = new User($_SESSION['userID']);
		$USER->fetch_build();
	}

	function random_string($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	function is_loggedin(){
		return isset($_SESSION['userID']);
	}

	function logout(){
		unset($_SESSION['userID']);
	}

	function folder_get_images($folder){
		global $db;
		$images = array();

		$result = $db->prepare("SELECT * FROM images WHERE folderName='$folder' ORDER BY imageDate DESC");
		$result->execute();
		while(($row = $result->fetch()) != false){
			array_push($images, $row);
		}

		return $images;
	}

	function folders_get_images_latest($limit){
		global $db;
		$images = array();

		$result = $db->prepare("SELECT * FROM images ORDER BY imageDate DESC LIMIT $limit");
		$result->execute();
		while(($row = $result->fetch()) != false){
			array_push($images, $row);
		}

		return $images;
	}

	function folders_fetch($limit){
		$folders = array();
		global $db;

		$result = $db->prepare("SELECT * FROM folders ORDER BY folderName ASC LIMIT $limit");
		$result->execute();
		while(($row = $result->fetch()) != false){
			$folder = new Folder($row['folderName']);
			$folder->fetch_build();
			array_push($folders, $folder);
		}

		return $folders;
	}

	function user_email_exists($email){
		global $db;

		$result = $db->prepare("SELECT * FROM users WHERE userEmail='$email'");
		$result->execute();
		$count = 0;
		while(($row = $result->fetch()) != false){
			$count++;
		}

		return ($count > 0);
	}

	function user_name_exists($name){
		global $db;

		$result = $db->prepare("SELECT * FROM users WHERE userName='$name'");
		$result->execute();
		$count = 0;
		while(($row = $result->fetch()) != false){
			$count++;
		}

		return ($count > 0);
	}

	class Folder{
		var $name;
		var $date;
		var $userID;

		function __construct($name){
			$this->name = $name;
		}

		function fetch_build(){
			global $db;

			$result = $db->prepare("SELECT * FROM folders WHERE folderName='$this->name'");
			$result->execute();
			while(($row = $result->fetch()) != false){
				$this->date = $row["date"];
				$this->userID = $row["userID"];
			}
		}

		function make(){
			global $db;

			$result = $db->prepare("REPLACE INTO folders (folderName, userID) VALUES('$this->name', $this->userID)");
			$result->execute();
		}

		function get_size(){
			global $db;
			$size = 0;

			$result = $db->prepare("SELECT * FROM images WHERE folderName='$this->name'");
			$result->execute();
			while(($row = $result->fetch()) != false){
				$size++;
			}

			return $size;
		}
	}

	class User{
		var $id;
		var $username;
		var $email;
		var $password;

		function __construct($id){
			$this->id = $id;
		}

		function fetch_build(){
			global $db;

			$result = $db->prepare("SELECT * FROM users WHERE userID=$this->id");
			$result->execute();
			while(($row = $result->fetch()) != false){
				$this->username = $row['userName'];
				$this->email = $row['userEmail'];
				$this->password = $row['userPassword'];
			}
		}

		function register(){
			global $db;

			$result = $db->query("INSERT INTO users (userName, userEmail, userPassword) VALUES('$this->username', '$this->email', '$this->password')");
			$result->execute();
		}

		function login(){
			global $db;

			$result = $db->prepare("SELECT * FROM users WHERE userName='$this->username'");
			$result->execute();
			while(($row = $result->fetch()) != false){
				$realpass = $row['userPassword'];
				$id = $row['userID'];
			}

			if($this->password != $realpass){
				return false;
			}

			$_SESSION['userID'] = $id;
			return true;
		}
	}

	class Comment{
		var $id;
		var $userID;
		var $imageID;
		var $date;
		var $text;

		function __construct($id){
			$this->id = $id;
		}

		function fetch_build(){
			global $db;

			$result = $db->prepare("SELECT * FROM comments WHERE commentID=$this->id");
			$result->execute();
			while(($row = $result->fetch()) != false){
				$this->userID = $row['userID'];
				$this->imageID = $row['imageID'];
				$this->date = $row['commentDate'];
				$this->text = $row['commentText'];
			}
		}

		function publish(){
			global $db;

			$result = $db->prepare("INSERT INTO comments (userID, imageID, commentText) VALUES($this->userID, $this->imageID, '$this->text')");
			$result->execute();
		}
	}



?>