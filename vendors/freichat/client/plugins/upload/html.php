<html>
    <title>
        File Sending Wizard
    </title>
    <body>
        <form name="upload" action="upload.php" method="post" enctype="multipart/form-data">
            <label for="file">Select Filename to send:</label><br/>


            <input id ="fromid" type="hidden" name="fromid"/>
            <input id="fromname" type="hidden" name="fromname"/>
            <input id="toid" type="hidden" name="toid"/>
            <input id="toname" type="hidden" name="toname"/>


            <input type="file" name="file" id="file" />
            <br /><br/>
            <input  type="submit" name="submit" value="Send" />
        </form>
    </body>
</html>
<script>
    function freiVal(name,value)
    {
        var element = document.getElementById(name);

        if(element != null)
        {
            element.value=value;
        }
        else
        {
            alert("element does not exists");
        }
    }

    freiVal("toid",opener.FreiChat.toid);
    freiVal("fromid",opener.freidefines.GEN.reidfrom);
    freiVal("toname",opener.FreiChat.touser);
    freiVal("fromname",opener.freidefines.GEN.fromname);
</script>
