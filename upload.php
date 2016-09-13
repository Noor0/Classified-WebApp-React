<?php
session_start();
if(isset($_SESSION['userId']) && isset($_POST['poster']))
if ($_POST['poster'] === $_SESSION['userId'])
if ($_POST) {
	print_r($_POST);
	if (isset($_POST['number'])) {
		if(preg_match("/[\d]*/",$_POST['number'])){
			if (isset($_POST['email'])) {
				if (preg_match("/(.*)@(.*)\.(.*)/",$_POST['email'])) {
					if(isset($_POST["title"])){
						if (preg_match("/[\d]*/",$_POST['category'])) {
							if(preg_match("/[\D]*/",$_POST['city'])){
								if($_FILES['image']['type']=="image/jpeg" || $_FILES['image']['type']=="image/png"){
									if(preg_match("/[\d]*/",$_POST['price'])){
										$con=new mysqli("185.27.134.10","basep_16604240","h45vcny2","basep_16604240_classified");
										if ($con) {
											$stm=$con->prepare("INSERT INTO post VALUES(?,?,?,?,?,?,?,?,?,?)");
											$post_id=null;
											$number=$con->real_escape_string($_POST['number']);
											$email=$con->real_escape_string($_POST['email']);
											$title=$con->real_escape_string($_POST['title']);
											$category=$con->real_escape_string($_POST['category']);
											$desc=$con->real_escape_string($_POST['desc']);
											$loc="images/".$_FILES['image']['name'];
											$price=$con->real_escape_string($_POST['price']);
											move_uploaded_file($_FILES['image']['tmp_name'], $loc);
											$city;
											switch ($_POST['city']) {
												case "Karachi":
													$city=1;
													break;
												case "Lahore":
													$city=2;
													break;
												case "Islamabad":
													$city=3;
													break;
												case "Quetta":
													$city=4;
													break;	
												case "Peshawar":
													$city=5;
													break;						
											}
											$id=$_SESSION['userId'];
											
											$stm->bind_param("iisssissii",$id,$post_id,$title,$desc,$loc,$city,$number,$email,$price,$category);
											$stm->execute();
										}
									}
								}else{echo "7";die("asd");}
							}else{echo "6";die("123");}
						}else{echo "5";die("456");}
					}else{echo "4";die("789");}
				}else{echo "3";die("989");}
			}else{echo "3";die("7878");}
		}else{ echo "2"; die("6666");}
	}else{ echo "2"; die("5555");}
}
?>