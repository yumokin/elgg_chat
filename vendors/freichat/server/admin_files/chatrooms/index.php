<div class="parameters">

    <div id="tabs">
        <ul>
            <li><a href="#client">ChatRoom Plugin</a></li>

        </ul>
        <!-- First TAB -->
        <div id="client">




            <ol>
                <li>
                    <table class=tablex>
                        <?php
                        
                        
                        require_once '../define.php';
                        $construct = new freichatXconstruct();
                        $db=$construct->connectDB();
                        
                        
                        $result = $db->query("SELECT * FROM frei_rooms");

                        echo "<th>Name</th>
<th>Order</th>
<th>Rename</th>
<th>Delete</th>
";


                        $i = 0;
                        foreach ($result as $res) {
                            echo "<tr>";

                            echo "<td id='rname$i'>" . $res['room_name']. "</td>";

                            echo "<td id='rorder$i'>" . $res['room_order'] . "</td>";

                            echo "<td><input onmousedown='editroom(" . $res['id'] . ",\"rname" . $i . "\",\"rorder" . $i . "\")' type='button' value='Edit' /></td>";

                            echo "<td><input onmousedown='confirm_delete(" . $res['id'] . ")' type='button' value='Delete' /></td>";

                            echo "</tr>";
                            $i++;
                        }
                        ?>
                    </table>
                </li>

                <br/>
                <li>
                    <br/>
                    <form action="admin.php?freiload=chatrooms&do=create" method="post">
                        Name:<input type="text" name="room_name" value="ChatRoomName" /> 
                        Order:<input type="text" name="room_order" value="1"/>
                        <input id="paramsubmit2" type="submit" value="Create Room" />
                    </form>
                </li>

            </ol>


        </div>


    </div>

</div>


<br/>

<div id="editroom">
    <form action="admin.php?freiload=chatrooms&do=edit" method="post">
        Name:<input type="text" name="room_name" id='eroom_name'/> 
        Order:<input type="text" name="room_order" id='eroom_order'/>
        <input type="hidden" name="room_id" id="eroom_id"/>
        <input id="paramsubmit3" type="submit" value="Save Room" />
    </form>
</div>
