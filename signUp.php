<?php 
try{
	if ($_POST) {
		$c=0;	
		if (isset($_POST['email'])) {
			if (preg_match("/(.*)@(.*)\.(.*)/",$_POST['email'])) {
				$c++;
			}else echo "1";
		}else echo "1";

		if (isset($_POST['pwd'])) {
			if (preg_match("/[\S]*/",$_POST['pwd']) && !strlen($_POST['pwd'])<=5) {
				$c++;
			}else echo "2";
		}else echo "2";

		if (isset($_POST['fname'])) {
			if (preg_match("/[\D]*/",$_POST['fname'])) {
				$c++;
			}else echo "3";
		}else echo "3";

		if (isset($_POST['lname'])) {
			if (preg_match("/[\D]*/",$_POST['lname'])) {
				$c++;
			}else echo "4";
		}else echo "4";

		if($c==4){
			$con=new mysqli("185.27.134.10","basep_16604240","h45vcny2","basep_16604240_classified");
			if($con){
				$stmt=$con->prepare("INSERT INTO user VALUES(?,?,?,?)");
				$pwdStmt=$con->prepare("INSERT INTO password VALUES(?,?)");

				$id=null;
				$fname=$con->real_escape_string($_POST['fname']);
				$lname=$con->real_escape_string($_POST['lname']);
				$email=$con->real_escape_string($_POST['email']);
				
				$stmt->bind_param("ssis",$fname,$lname,$id,$email);
				$stmt->execute();
				
				$pwd=$con->real_escape_string($_POST['pwd']);
				$pwd=hash("ripemd128","salt".$pwd);
				$id=$stmt->insert_id;
				
				$pwdStmt->bind_param("si",$pwd,$id);
				$pwdStmt->execute();

				echo "5";
			}
		}
	}
}catch(Exception $e){
}
finally{
	$con->close();
}
?>