<style>
    .theme_list {
        color:black;
    }
</style>


<?php
/*
if (!defined('FREI_ADMIN')) {
    die("no direct access");
}
if (isset($_REQUEST['do']) && $_REQUEST['do'] == 'edit') {

    echo '
<script language="javascript" type="text/javascript" src="../client/jquery/js/edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
	id : "textarea_1"		// textarea id
	,syntax: "css"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
});
editAreaLoader.init({
	id : "textarea_2"		// textarea id
	,syntax: "php"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
});
</script>


';

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        if ($action == "savearg" && isset($_POST['arg'])) {
            file_put_contents('../client/jquery/freichat_themes/' . $_REQUEST['theme'] . '/argument.php', $_POST['arg']);
            echo'<script type="text/javascript">alert("saved!")</script>';
        } else if ($action == "savecss" && isset($_POST['css'])) {

            file_put_contents('../client/jquery/freichat_themes/' . $_REQUEST['theme'] . '/css.php', $_POST['css']);
            echo'<script type="text/javascript">alert("saved!")</script>';
        } else if ($action == "deletefile" && isset($_GET['file'])) {
            @unlink('../client/jquery/freichat_themes/' . $_REQUEST['theme'] . '/' . $_GET['file']);
            echo'<script type="text/javascript">alert("Deleted!")</script>';
        } else if ($action == "uploadfile" && isset($_FILES['myfile'])) {
            $uploaddir = '../client/jquery/freichat_themes/' . $_REQUEST['theme'] . '/';
            $uploadfile = $uploaddir . basename($_FILES['myfile']['name']);
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
                echo '<script type="text/javascript">alert("File is valid, and was successfully uploaded")</script>';
            } else {
                echo '<script type="text/javascript">alert("error in upload")</script>';
            }
        }
    }
}*/
?>