

<style type="text/css">
                      
                    .tablex {
border-top-width: 3px;
border-right-width: 3px;
border-bottom-width: 3px;
border-left-width: 3px;
border-top-left-radius: 16px 16px;
border-top-right-radius: 16px 16px;
border-bottom-right-radius: 16px 16px;
border-bottom-left-radius: 16px 16px;
padding-top: 8px;
padding-right: 8px;
padding-bottom: 8px;
padding-left: 8px;
margin-top: 0px;
margin-right: 8px;
margin-bottom: 8px;
margin-left: 8px;

height: auto;
border: solid white;
}

td {
    padding:5px;
border-top: solid 1px #EFEFEF;
}

th {
    width:300px;
background-color: #08F;
padding:5px;
color:white;
background-color: rgba(0, 136, 255, 1);
}
</style>
<script> 
    
    $(window).load(function(){
 
        $('#paramsubmit2').button();
        $('#tabs').tabs({selected:0})
        $('#editroom').dialog({ autoOpen: false,title:"Edit Room" })
    });
	
	
    function editroom(id,rnameid,rorderid){
	
        $('#editroom').dialog('open');
        var name=$('#'+rnameid).html();
        var order=$('#'+rorderid).html();
        $('#eroom_name').val(name);
        $('#eroom_order').val(order);
        $('#eroom_id').val(id);
    }
	
	
    function confirm_delete(id) {
        var answer = confirm("Sure you want to Delete?")
        if (answer){
            //alert("Deleted!");
            window.location="admin.php?freiload=chatrooms&do=delete&id="+id;
		
        }
        else{
            alert("cancelled");
        }
    }
<?php
require_once '../define.php';
$construct = new freichatXconstruct();
$db = $construct->connectDB();


//-----create room    
if (isset($_GET['do']) && $_GET['do'] == 'create') {
    if (isset($_POST['room_name'])) {
        if ($_POST['room_name'] == "" || $_POST['room_order'] == "") {

            echo "alert('Error: Fields cannot be left empty!');";
        } else {
            $order = (int) $_POST['room_order'];
                $room_name=$_POST['room_name'];

            $room_name = htmlentities($room_name, ENT_QUOTES, "UTF-8");  
            $qry = "INSERT INTO frei_rooms(room_name,room_order) VALUES(" . $db->quote($room_name) . "," . $order . ")";
            $result = $db->query($qry);
            echo "//$qry";
            echo "\n alert('Chatroom was successfully created.');";
        }
    }
}

//---edit room
if (isset($_GET['do']) && $_GET['do'] == 'edit') {

    if (!isset($_POST['room_id'])) {

        echo "alert('Error: EDIT Fields cannot be left empty!');";
    } else {
        if (isset($_POST['room_name']) && isset($_POST['room_name'])) {
            if ($_POST['room_name'] == "" || $_POST['room_order'] == "") {
                echo "alert('Error: Fields cannot be left empty!');";
            } else {
                $order = (int) $_POST['room_order'];
                $id = (int) $_POST['room_id'];
                $room_name=$_POST['room_name'];
                $room_name = htmlentities($room_name, ENT_QUOTES, "UTF-8");              
                $qry = "UPDATE frei_rooms SET room_name=" . $db->quote($room_name) . ", room_order=" . $order . " WHERE id=" . $id;
                $db->query($qry);
                echo "//$qry";
                echo "\n alert('Chatroom was successfully edited');";
            }
        }
    }
}

//---delete rooom
if (isset($_GET['do']) && $_GET['do'] == 'delete') {

    if (!isset($_GET['id'])) {

        echo "alert('Error: DEL Fields cannot be left empty!');";
    } else {
        $id = (int) $_GET['id'];
        //$room_name=str_replace("'"," ",$_POST['room_name']);
        if ($id == 1) {
            echo "alert('Error: DEL This chatroom cannot be deleted.');";
        } else {
            $qry = "DELETE FROM frei_rooms WHERE id=$id";
            $result = $db->query($qry);
            echo "\n//$qry";
            echo "\n alert('Chatroom was successfully Deleted.');";
        }
    }
}
?>
</script>
