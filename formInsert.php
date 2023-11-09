
<?php 
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$bdate = $_POST['bdate'];
$nationality = $_POST['nationality'];
$gender = $_POST['gender'];
$aadhar = $_POST['aadhar'];
$degree = $_POST['degree'];
$course = $_POST['course'];
$CPI = $_POST['CPI'];


if(!empty($fname) || !empty($lname) || !empty($email) ||
!empty($phone) || !empty($address) || !empty($bdate) ||
!empty($nationality) || !empty($gender) || !empty($aadhar) ||
!empty($degree) || !empty($course) || !empty($CPI)
){
    $host = "localhost";
    $port = 4306;
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "form_assignment_3";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword,$dbname,$port);

    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    } else{
        $SELECT = "SELECT email From form Where email = ? Limit 1";
        $INSERT = "INSERT Into form (fname, lname, email, phone, address,bdate, nationality, gender,aadhar, degree, course, CPI) 
        values(?,?,?,?,?,?,?,?,?,?,?,?)";

        // Prepare Statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if($rnum==0){
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssissssissd",$fname,$lname,$email,$phone,
            $address,$bdate,$nationality,$gender,$aadhar,$degree,$course,$CPI);
            $stmt->execute();
            echo "New Record inserted sucessfully";
        }else{
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }

}else{
    echo "All field are required";
    die();
}

?>


