
<?php
session_start();
include("lib/db.php");
//mailchip api class include
include("lib/MailChimp.php");

use \DrewM\MailChimp\MailChimp;
// mailchip api key and serial
$api ="b8e52a865a4680054d065cbcefa0f202-us17";
$list ="86efe5ac5f";
// api key and serial
// data submision....
if(isset($_POST['submit']))
{
//data validation condition.......
  if(isset($_POST['Name']) && isset($_POST['mobile']) && isset($_POST['Email'])){
    // value indexing
    $user_name =   $_POST['Name'];
     $division  = $_POST['division'];
     $district  = $_POST['district'];
     $upzilla = $_POST['upzilla'];
     $mobile  = $_POST['mobile'];
     $Email   = $_POST['Email'];
     $empid   = $_POST['empid'];
     $Cwoner  = $_POST['cwoner'];
     $contactsource =$_POST['contactsource'];

    $div1 = "SELECT Division_name FROM division where Division_id=$division";
         $result1 = mysqli_query($connection, $div1);
         if (mysqli_num_rows($result1)) {
            while($row = mysqli_fetch_assoc($result1)) {
                $div= $row["Division_name"];
            }
         } 
    $dis1 = "SELECT District_name FROM district where District_id=$district";
         $result2 = mysqli_query($connection, $dis1);
         if (mysqli_num_rows($result2)) {
            while($row = mysqli_fetch_assoc($result2)) {
                 $dis= $row["District_name"];
            }
         } 
         $up1 = "SELECT Upzilla_name FROM upzilla where Upzilla_id =$upzilla";
         $result3 = mysqli_query($connection, $up1);
         if (mysqli_num_rows($result3)) {
            while($row = mysqli_fetch_assoc($result3)) {
                $up= $row["Upzilla_name"];
            }
         } 
         $newmob="+88".$mobile;
         $newmobile="88".$mobile;
    $check1 = "SELECT Phone, Email FROM contact_info Where Phone = $mobile OR Phone=$newmob OR Phone=$newmobile OR Email='$Email'";
         $result4 = mysqli_query($connection, $check1);
         if (mysqli_num_rows($result4)) {
          $_SESSION['allreadymember'] =1;
            }
            else{
    //image..............
    $picture_name     = $_FILES['user_image']['name'];
    $picture_type     = $_FILES['user_image']['type'];
    $picture_tmp_name = $_FILES['user_image']['tmp_name'];
    $picture_size     = $_FILES['user_image']['size'];
    if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png")
      {
          if($picture_size<=50000000)
          {
            $pic_name=$user_name."_".$picture_name;
            move_uploaded_file($picture_tmp_name,"images/".$pic_name);

            mysqli_query($connection,"insert into contact_info (Name, Division_id, District_id, Upzilla_id ,Phone,Email, empid,cwoner,contactsource,photo) values ('$user_name','$division','$district','$upzilla','$mobile','$Email','$empid', '$Cwoner','$contactsource', '$pic_name')");
            
              //mailchip api 
              $MailChimp = new MailChimp($api);
              $list_id = $list;
              $result = $MailChimp->post("lists/$list_id/members", [
                      'merge_fields' => ['NAME'=>$user_name,'PHONE'=>$mobile,'DIVISION'=>$div, 'DISTRICT'=>$dis, 'UPZILLA'=>$up, 'COWNER'=>$Cwoner,'OWNERID'=>$empid,'CSOURCE'=>$contactsource, 'PHOTO'=>"https://wayhousing.com/registration/images/".$pic_name],
                      'email_address' => $Email,
                      'status'        => 'subscribed',
                    ]);

              if ($MailChimp->success()) {
                //print_r($result); 
              } else {
                echo $MailChimp->getLastError();
              }
              //mailchip api 
              //sms api
               $to = $mobile;
              $token = "e98aca0860bd5b273c27adc744f2d1fa";
              $message = "Welcome TO Way housing Pvt. Ltd";

              $url = "http://api.greenweb.com.bd/api.php";

              $data= array(
              'to'=>"$to",
              'message'=>"$message",
              'token'=>"$token"
              ); // Add parameters in key value
              $ch = curl_init(); // Initialize cURL
              curl_setopt($ch, CURLOPT_URL,$url);
              curl_setopt($ch, CURLOPT_ENCODING, '');
              curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $smsresult = curl_exec($ch);

              //Result
              //echo $smsresult;

              //Error Display
              //echo curl_error($ch);
                $_SESSION['success'] =1;
             
             
          }
      } }

  }
  else{
    $_SESSION['error'] =1;
  }
  header("location:https://wayhousing.com/registration.php");
  mysqli_close($connection);
}
?>