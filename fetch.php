<?php
if(isset($_POST['id'])){
    $college_id = $_POST['id'];
    
    $conn = new mysqli('localhost', 'root', '', 'unicounsel'); // Update with your actual database credentials
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM program WHERE college_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $college_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $output = '<option value="" disabled selected hidden>-- Select --</option>';
    while($row = $result->fetch_assoc()){
        $output .= '<option value="'.$row['program_id'].'">'.$row['program_name'].'</option>';
    }
    
    echo $output;
    
    $stmt->close();
    $conn->close();
}
?>
