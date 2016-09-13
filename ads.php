<?php
session_start();
if(empty($_SESSION) || !isset($_SESSION['userId'])){
	echo "NO";
	die("");
}
else
if($_POST){
	if($_SESSION['userId']==$_POST['Theid']){
	if (isset($_POST['Theid'])) {
		if(preg_match("/[\d]*/",$_POST['Theid'])){
			$con = new mysqli("127.0.0.1","root","","classified");
			if($con){
				$res = $con->query("SELECT * FROM post WHERE user_id=".$_POST['Theid']." ORDER BY post_id DESC");
				if($res->num_rows > 0){
					$send="[";
					for ($i=0; $i < $res->num_rows; $i++) { 
						$res->data_seek($i);
						$row = $res->fetch_array(MYSQLI_ASSOC);
						switch($row['city']){
							case 1:
								$ccc="Karachi";
								break;
							case 2:
								$ccc="Lahore";
								break;
							case 3:
								$ccc="Islamabad";
								break;
							case 4:
								$ccc="Quetta";
								break;
							case 5:
								$ccc="Peshawar";
								break;
						}

						$send.="{\"user_id\":".$row['user_id'].",\"post_id\":".$row['post_id'].",\"title\":\"".$row['title']."\",\"description\":\"".$row['description']."\",\"image_loc\":\"".$row['image_loc']."\",\"city\":\"".$ccc."\",\"number\":\"".$row['number']."\",\"email\":\"".$row['email']."\",\"price\":".$row['price']."}";

						if($i!=$res->num_rows-1)
							$send.=",";
					}
					$send.="]";
					echo $send;
				}
			}
			else
				die("");
		}
	}
	}
}
?>