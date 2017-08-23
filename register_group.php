<?php
date_default_timezone_set('Africa/Nairobi');
include('database.php');
$number=count($_POST['fname']);
 $fname=$_POST['fname'];
 $nid=$_POST['nid'];
 $address=$_POST['address'];
 $phone=$_POST['phone'];
$groupname=$_POST['groupname'];
$type='group';
$amount=5000;
$date=date('Y-m-d H:i:s');
if($number>0){
	for($i=0; $i<$number; $i++){
 if(trim($fname[$i]!='') || trim($nid[$i]!='')|| trim($address[$i]!='') ||trim($phone[$i]!='')){
$sql=$con->prepare("INSERT INTO members(fname,nid,address,phone,membership_type) VALUES(:fname,:nid,:address,:phone,:type)");
$sql->execute(array(":fname"=>$fname[$i], ":nid"=>$nid[$i],":address"=>$address[$i],":phone"=>$phone[$i],"type"=>$type));
$q=$con->prepare("INSERT INTO groups(groupname,nid) VALUES(:groupname,:nid)");
$q->execute(array(":groupname"=>$groupname,":nid"=>$nid[$i]));
 }
}
$query=$con->prepare("SELECT groupname FROM groups ORDER BY id DESC LIMIT 1");
$query->execute();
$data=$query->fetch();
$id = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['groupname'])));
$query2=$con->prepare("INSERT INTO fees(groupname,amount,date_paid)VALUES(:id,:amount,:date_paid)");
$query2->execute(array(":id"=>$id,":amount"=>$amount,":date_paid"=>$date));
echo "Group registered successfully!";
}


 
