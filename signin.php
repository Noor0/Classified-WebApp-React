<?php 
	$db=new mysqli("185.27.134.10","basep_16604240","h45vcny2","basep_16604240_classified");
	// $stmt=db->prepare("INSERT INTO user VALUES(?,?,?,?)");
	// $pwStmt=db->prepare("INSERT INTO user VALUES(?,?)");
	$row=null;
	try{
	if(!empty($_POST)){
		if(isset($_POST['email']) && isset($_POST['pwd'])){
			if(preg_match("/(.*)@(.*)\.(.*)/",$_POST['email'])){
				$res=$db->query("SELECT * FROM user WHERE email='".$_POST['email']."'");
				if($res->num_rows >= 1){
					$row=$res->fetch_array(MYSQLI_ASSOC);
					$pwdRes=$db->query("SELECT * FROM password WHERE id=".$row['id']);
					$pwdRow=$pwdRes->fetch_array(MYSQLI_ASSOC);
					$hashed=hash("ripemd128","salt".$_POST['pwd']);
					if($hashed == $pwdRow['pass']){
						session_start();
						$_SESSION['userId']=$row['id'];
						$_SESSION['name']=$row['fname']." ".$row['lname'];
						echo "{\"name\":\"".$_SESSION['name']."\",\"id\":".$_SESSION['userId']."}";
					}
					else
						echo "4";	
				}
				else{
					echo "2";
					throw new Exception("");
				}
			}
			else
				echo "1";				
		}
		else
			echo "1";
	}
	}catch(Exception $e){}
	finally{
		$res->close();
		$db->close();
	}
?>