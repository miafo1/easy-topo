<?php

//include('authenticate.php'); until problem solved
include('config/dbcon.php');
// ADD USER    ++++++++++++++++++++++++++
if (isset($_POST['add_btn'])) {

    // $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $password = sha1($_POST['password']);
    $role_as = $_POST['role_as'];
    $idregion = $_POST['idregion'];
    $idtown = $_POST['idtown'];
    $iddistrict = $_POST['iddistrict'];
    $status = $_POST['status'] == true ? '1' : '0';
// File upload for user image
$image = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
$image_path = 'uploads/' . $image;
move_uploaded_file($image_temp, $image_path);  // Move file to the uploads directory

    $query = "INSERT INTO user (fname, lname, email, phone, password, role_as, photo, idregion, idtown, iddistrict, status) VALUES ('$fname', '$lname', '$email', '$telephone', '$password', '$role_as', '$image_path', '$idregion', '$idtown', '$iddistrict', '$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "User Added Successfully";
        header('location: viewregister.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: viewregister.php');
        exit(0);
    }
}

// UPDATE  USER@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST['update_btn'])) {

    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1' : '0';

    // New fields for region, town, and district
    $idregion = $_POST['idregion'];
    $idtown = $_POST['idtown'];
    $iddistrict = $_POST['iddistrict'];

    // Update query
    $query = "UPDATE user SET fname='$fname', lname='$lname', email='$email', password='$password', role_as='$role_as', status='$status', idregion='$idregion', idtown='$idtown', iddistrict='$iddistrict'
              WHERE id='$user_id'";

    $query_run = mysqli_query($con, $query);

    // Image upload logic
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image = $_FILES['image']['name'];
        $path = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    
        $query = "UPDATE user SET photo='$image' WHERE id='$user_id'";
        mysqli_query($con, $query);
    }

    // Check if the update was successful
    if ($query_run) {
        $_SESSION['message'] = "Update Successful";
        header('Location: viewregister.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Update Failed";
        header('Location: registeredit.php?id=' . $user_id);
        exit(0);
    }
}


// DELETE USER   *****************************
if (isset($_POST['delete_btn'])) {

    $user_id = $_POST['delete_btn'];

    $query = "DELETE FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "User Deleted Successfully";
        header('location: viewregister.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: viewregister.php');
        exit(0);
    }
}
//ADD A LAND   +++++++++++++++++++++++++++++++++
if (isset($_POST['categoryadd'])) {
    $idregion = $_POST['idregion'];
    $idtown = $_POST['idtown'];
    $iddistrict = $_POST['iddistrict'];
    $uniteprice = $_POST['uniteprice'];
    $totalprice = $_POST['totalprice'];
    $landtitle = $_POST['titleland'];
    $landsize = $_POST['size'];
    $landpurpose = $_POST['landpurpose'];
    $landtype = $_POST['landtype'];

    $description = $_POST['description'];
    $image = $_FILES['imageland']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;
    $location = $_POST['locationland'];
    
    // Check if the status checkbox is checked, otherwise set to 'reserved'
    $status = isset($_POST['status']) ? 'reserved' : 'available';

    $query = "INSERT INTO land (idregion, idtown, iddistrict, uniteprice, totalprice, titleland, size, land_purpose, land_type, descriptionland, imageland, locationland, statusland) 
              VALUES ('$idregion', '$idtown', '$iddistrict', '$uniteprice', '$totalprice', '$landtitle', '$landsize', '$landpurpose', '$landtype', '$description', '$filename', '$location', '$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        move_uploaded_file($_FILES['imageland']['tmp_name'], 'uploads/posts/' . $filename);
        $_SESSION['message'] = "Land Added Successfully";
        header('location: categoryadd.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: categoryadd.php');
        exit(0);
    }
}


// LAND UPDATE  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST['categoryupdate'])) {
    $land_id = $_POST['id'];
    $idregion = $_POST['idregion'];
    $idtown = $_POST['idtown'];
    $iddistrict = $_POST['iddistrict'];
    $uniteprice = $_POST['uniteprice'];
    $totalprice = $_POST['totalprice'];
    $landtitle = $_POST['titleland'];
    $landsize = $_POST['size'];
    $landpurpose = $_POST['landpurpose'];
    $landtype = $_POST['landtype'];

    $description = $_POST['description'];
    $old_filename = $_POST['old_image'];
    $image = $_FILES['imageland']['name'];
    $update_filename = "";
    //Rename this image
    if ($image != NULL) {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_extension;
        $update_filename = $filename;
    } else {
        $update_filename = $old_filename;
    }

    $location = $_POST['locationland'];
    $status = isset($_POST['statusland']) && $_POST['statusland'] == 'reserved' ? 'reserved' : 'available';
    $query = "UPDATE land SET idregion='$idregion', idtown='$idtown', iddistrict='$iddistrict',  uniteprice='$uniteprice', totalprice='$totalprice', titleland='$landtitle', size='$landsize', land_purpose='$landpurpose', land_type='$landtype', descriptionland=' $description', imageland='$update_filename', locationland=' $location', statusland='$status' WHERE idland='$land_id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('uploads/posts/' . $old_filename)) {
                unlink("uploads/posts/' . $old_filename");
            }
            move_uploaded_file($_FILES['imageland']['tmp_name'], 'uploads/posts/' . $update_filename);
        }

        $_SESSION['message'] = "Updated Successfully!!!!";
        header('location: categoryedit.php?id=' . $land_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong.!!!";
        header('location: categoryedit.php?id=' . $land_id);
        exit(0);
    }
}
// DELETE LAND   *****************************
if (isset($_POST['categorydelete'])) {

    $category_id = $_POST['categorydelete'];

//    $query = "UPDATE land SET statusland = '2' WHERE idland =' $category_id' LIMIT 1";
//    $query_run = mysqli_query($con, $query);
    $check_img_query = "SELECT * FROM land WHERE idland = '$category_id' LIMIT 1";
    $img_result = mysqli_query($con, $check_img_query);
    $result_data = mysqli_fetch_array($img_result);
    $image = $result_data['imageland'];
    $query = "DELETE FROM land WHERE idland='$category_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        if (file_exists('uploads/posts/' . $image)) {
            unlink("uploads/posts/" . $image);
        }

        $_SESSION['message'] = "land deleted Successfully!!!!";
        header('location: categoryview.php?id=' . $land_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong.!!!";
        header('location: categoryview.php?id=' . $land_id);
        exit(0);
    }
}
//ADD A REGION   +++++++++++++++++++++++++++++++++
if (isset($_POST['regionadd'])) {

    $regionname = $_POST['nameregion'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO region (nameregion,statusregion) VALUES ('$regionname', '$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Pegion Added Successfully";
        header('location:regionadd.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: regionadd.php');
        exit(0);
    }
}
// REGION UPDATE  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST['regionupdate'])) {
    $region_id = $_POST['id'];
    $regionname = $_POST['nameregion'];

    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE region SET nameregion='$regionname', statusregion='$status'
                    WHERE idregion='$region_id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $_SESSION['message'] = "Updated Successfully!!!!";
        header('location: regionadd.php' . $region_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong.!!!";
        header('location: regionedit.php?id=1' . $region_id);
        exit(0);
    }
}
// DELETE REGION   *****************************
if (isset($_POST['regiondelete'])) {

    $region_id = $_POST['regiondelete'];

    $query = "UPDATE region SET statusregion = '2' WHERE idregion ='$region_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Region Deleted Successfully";
        header('location: regionview.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: regionview.php');
        exit(0);
    }
}
//ADD A TOWN   +++++++++++++++++++++++++++++++++
if (isset($_POST['townadd'])) {
    $idregion = $_POST['idregion'];
    $townname = $_POST['nametown'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO town (idregion,nametown,statustown) VALUES ('$idregion','$townname', '$statustown')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Town Added Successfully";
        header('location:townadd.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: townadd.php');
        exit(0);
    }
}
// TOWN UPDATE  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST['townupdate'])) {
    $town_id = $_POST['id'];
    $townname = $_POST['nametown'];

    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE town SET nametown='$townname', statustown='$status'
                    WHERE idtown='$town_id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $_SESSION['message'] = "Updated Successfully!!!!";
        header('location: townadd.php' . $region_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong.!!!";
        header('location: townedit.php?id=1' . $region_id);
        exit(0);
    }
}
// DELETE TOWN   *****************************
if (isset($_POST['towndelete'])) {

    $town_id = $_POST['towndelete'];

    $query = "UPDATE town SET statustown = '2' WHERE idtown ='$town_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Town Deleted Successfully";
        header('location: townview.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: townview.php');
        exit(0);
    }
}


//ADD A DISREICT  +++++++++++++++++++++++++++++++++
if (isset($_POST['districtadd'])) {
    $idtown = $_POST['idtown']; 
    $districtname = $_POST['namedistrict'];
    $status = $_POST['status'] == true ? '1' : '0';

    $query = "INSERT INTO district (idtown,namedistrict,statusdistrict) VALUES ('$idtown','$districtname', '$statusdistrict')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "District Added Successfully";
        header('location:districtadd.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: districtadd.php');
        exit(0);
    }
}
// TOWN DISTRICT  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST['districtupdate'])) {
    $district_id = $_POST['id'];
    $districtname = $_POST['districttown'];

    $status = $_POST['status'] == true ? '1' : '0';

    $query = "UPDATE district SET namedistrict='$districtname', statusdistrict='$status'
                    WHERE iddistrict='$district_id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        $_SESSION['message'] = "Updated Successfully!!!!";
        header('location: districtadd.php' . $town_id);
        exit(0);
    } else {
        $_SESSION['message'] = "Something Went Wrong.!!!";
        header('location: districtedit.php?id=1' . $town_id);
        exit(0);
    }
}
// DELETE DISTRICT   *****************************
if (isset($_POST['districtdelete'])) {

    $district_id = $_POST['districtdelete'];

    $query = "UPDATE district SET statusdistrict = '2' WHERE iddistrict ='$district_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "District Deleted Successfully";
        header('location: districtview.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: districtview.php');
        exit(0);
    }
}

// Reservation delet   *****************************
if (isset($_POST['reservationdelete'])) {

    $town_id = $_POST['reservationdelete'];

    $query = "UPDATE transactions SET id = 'NULL' WHERE transactionid ='$town_id' LIMIT 1";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Town Deleted Successfully";
        header('location: landbookview.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: landbookview.php');
        exit(0);
    }
}


// SUrveyor sending land delet   *****************************
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $description = $_POST['description'];
    $surveyor_id = 1; // You should retrieve the surveyor's ID based on the logged-in user
    $idregion = $_POST['idregion'];
    $idtown = $_POST['idtown'];
    $iddistrict = $_POST['iddistrict'];
    $uniteprice = $_POST['uniteprice'];
    $totalprice = $_POST['totalprice'];
    $landtitle = $_POST['titleland'];
    $landsize = $_POST['size'];
    $landpurpose = $_POST['landpurpose'];
    $landtype = $_POST['landtype'];
    // Handle image upload
    $image = $_FILES['imageland']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;
    $location = $_POST['locationland'];

    // Insert data into pending_land table
    $sql = "INSERT INTO pending_land (surveyor_id, latitude, longitude, idregion, idtown, iddistrict, uniteprice, totalprice, titleland, size, land_purpose, land_type, description, imageland, locationland)
                       VALUES ('$surveyor_id', '$latitude', '$longitude', '$idregion', '$idtown', '$iddistrict', '$uniteprice', '$totalprice', '$landtitle', '$landsize', '$landpurpose', '$landtype', '$description', '$filename', '$location')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        move_uploaded_file($_FILES['imageland']['tmp_name'], 'uploads/posts/' . $filename);
        $_SESSION['message'] = "Land Added Successfully";
        header('location: categoryadd.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Something went wrong";
        header('location: categoryadd.php');
        exit(0);
    }
         

}

// Approval Land Logic 
// Approval Land Logic 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idpending = $_POST['idpending'];

    // Fetch the pending land data
    $sql = "SELECT * FROM pending_land WHERE idpending = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $idpending);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


        // Insert into the 'land' table after admin validation
        $sql_insert = "INSERT INTO land (idregion, idtown, idaddress, iddistrict, districtname, uniteprice, totalprice, titleland, descriptionland, imageland, locationland, statusland, land_type, land_purpose)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_insert = $con->prepare($sql_insert);
// Adjust this with real values
$stmt_insert->bind_param("iiiiisssssss", $row['idregion'], $row['idtown'], $row['idaddress'], $row['iddistrict'], $row['districtname'], $row['uniteprice'], $row['totalprice'], $row['titleland'], $row['descriptionland'], $row['imageland'], $row['locationland'], 'available', $row['land_type'], $row['land_purpose']);
$stmt_insert->execute();

// Mark the pending land as approved
$sql_update = "UPDATE pending_land SET status = 'approved' WHERE id = ?";
$stmt_update = $con->prepare($sql_update);
$stmt_update->bind_param("i", $land_id);
$stmt_update->execute();

echo "Land has been successfully approved!";

    // If insert is successful, delete from pending_land
    if ($stmt_insert->execute()) {
        $sql_delete = "DELETE FROM pending_land WHERE idpending = ?";
        $stmt_delete = $con->prepare($sql_delete);
        $stmt_delete->bind_param("i", $idpending);
        $stmt_delete->execute();
        echo "Land approved and moved to land table.";
    } else {
        echo "Error approving land.";
    }

    // Close statements and connection
    $stmt->close();
    $stmt_insert->close(); // Close the insert statement
    $stmt_delete->close(); // Close the delete statement
    $con->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idland = $_POST['idland'];

    // Update land status to 'available'
    $update_query = "UPDATE land SET statusland = 'available' WHERE idland = '$idland'";
    $result = mysqli_query($con, $update_query);

    if ($result) {
        header("Location: resevationview.php?success=Land enabled successfully");
    } else {
        echo "Error updating land status: " . mysqli_error($con);
    }
}


?>

