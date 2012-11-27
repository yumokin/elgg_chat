<html>
    <head>
        <title>
	Send Conversation as Electronic mail
        </title>
    </head>
    <body>
        <h4> FreiChatX Electonic mail transfer of your conversation </h4>
        <br/>
        <form name="upload" action="sendmail.php" method="post">

            Your email subject : <br/>
            <input size="50px" type="text" id="subject" name="subject" value=""/>

            <input id ="fromid" type="hidden" name="fromid"/>
            <input id="fromname" type="hidden" name="fromname"/>
            <input id="toid" type="hidden" name="toid"/>
            <input id="toname" type="hidden" name="toname"/>

            <br/><br/> Enter the receiver's email address :<br/>
            <input size="50px" type="text" id="mailto" name="mailto"/>

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

    freiVal("subject","RE: Conversation with "+opener.FreiChat.touser);
    freiVal("toid",opener.FreiChat.toid);
    freiVal("fromid",opener.freidefines.reidfrom);
    freiVal("toname",opener.FreiChat.touser);
    freiVal("fromname",opener.freidefines.fromname);
</script>