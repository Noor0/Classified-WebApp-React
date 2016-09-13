<?php 
	if($_POST){
		if(isset($_POST['category'])){
			if (preg_match("/[\d]*/",$_POST['category'])) {
				$con = new mysqli("127.0.0.1","root","","classified");
				if($con){
					$res=$con->query("SELECT * FROM post WHERE category=".$_POST['category']." ORDER BY post_id DESC");
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

							$send.="{\"user_id\":".$row['user_id'].",\"post_id\":".$row['post_id'].",\"title\":\"".$row['title']."\",\"description\":\"".$row['description']."\",\"image_loc\":\"".$row['image_loc']."\",\"city\":\"".$ccc."\",\"number\":\"".$row['number']."\",\"email\":\"".$row['email']."\",\"price\":".$row['price'].",\"name\":".$_SESSION['name']."}";

							if($i!=$res->num_rows-1)
								$send.=",";
						}
						$send.="]";
						echo $send;
					}
				}
			}
		}
	}
?>