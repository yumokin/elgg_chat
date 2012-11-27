<?php
session_start();

//Security check
if (!isset($_SESSION['FREIX']) || $_SESSION['FREIX'] != 'authenticated') {
    header("Location:index.php");
    exit;
}


class Configure {

    public function getCONF() {


            $cname=$_SESSION['cms'];
            require 'integ/'.$_SESSION['cms'].'.php';
            $cls=new $cname();
            $config = $cls->get_config();

        return $config;
    }

    public function run_me() {
        $conf = $this->getCONF();
        return $conf;
    }

}

$configure = new Configure();
$conf = $configure->run_me();

require 'header.php';
?>
<style type="text/css">
    table.center {
    width:70%; 
    margin-left:15%; 
    margin-right:15%;
  }
  td{
    text-align:right;  
  }
  
  .zentrum{
      text-align: center;
  }
    
</style>

<?php

$p_only=false;
$chng_name="";
$sentence='Choose a Password';
$disp="";

if($_SESSION['cms']=='Custom'){
    
    $p_only=false;
    $sentence='Fill in the blanks';
    $chng_name="";
    $disp='block';
    
}else{
    $chng_name="dasds333";
    $p_only=true;
    $disp='none';
}

?>

<div id='Finfo' style="text-align: center">
    <br/>
    <p id="sentence" style="font-family: 'Sonsie One', cursive;font-size: 18pt;"><?php echo $sentence; ?></p>
    <form name="input" action="install.php" method="POST" id="paramform">
        <p >
            <br/>
            <br/>
            <br/>
        <table border="0" id="tble" class="center" style="display:<?php echo $disp; ?>">	 

           

            <tr>
                <td>D/B Host :</td>
                <td class="zentrum"><input name="host" id="host" size="30px" type="text" value="<?php echo $conf[0]; ?>" /></td>
            </tr>

            <tr>
                <td>D/B Username :</td>
                <td class="zentrum"><input name="muser" id="muser" size="30px" type="text" value="<?php echo $conf[1]; ?>" /></td>
            </tr>

            <tr>
                <td>D/B Password :</td>
                <td class="zentrum"><input name="mpass" id="mpass" size="30px" type="text" value="<?php echo htmlentities($conf[2], ENT_QUOTES); ?>" /></td>
            </tr>

            <tr>
                <td>D/B Database Name :</td>
                <td class="zentrum"><input name="dbname" id="dbname" size="30px" type="text" value="<?php echo $conf[3]; ?>" /></td>
            </tr>

            <tr>
                <td>Table Prefix :</td>
                <td class="zentrum"><input name="dbprefix" size="30px" type="text" value="<?php echo $conf[4]; ?>" /></td>
            </tr>

            <tr>
                <td>Integrates With :</td>
                <td class="zentrum"><input name="driver" size="30px" type="text" value="<?php echo $_SESSION['cms']; ?>" /></td>
            </tr>

            <tr>
                <td>Freichat Admin Password:</td>
                <td class="zentrum"><input id="am1" name="adminpass<?php echo $chng_name; ?>" size="30px" type="text" value="adminpass" /></td>
            </tr> 


        </table>
<?php
        if($p_only==true){
            echo '<input id="am2" name="adminpass" style="font-family: \'Exo\', sans-serif;font-weight:600 ;font-style:italic;width:500px;font-size:18pt;text-align:center" size="30px" type="text" value="adminpass" />';
        }
?>   
        <input name="freichat_to_path" size="30px" type="hidden" value="freichat" />

        </p>
        <br/>
        <br/>
        <a href="JavaScript:void(0)" class="nextbutton" onclick="to_install()">Proceed</a>
    </form>
</div>
<script type="text/javascript">
    
function to_install(){
    
        $.post('testconnection.php', {host:$('#host').val(),dbname:$('#dbname').val(),
            muser:$('#muser').val(),mpass:$('#mpass').val()},function(data){
            
            if(data=='works'){
                
               $('#paramform').submit();
            }
            else{
                alert(data);
                $('#am2').remove();
                $('#am1').attr('name','adminpass');
                $('#sentence').html('is this correct?');
                $('#tble').show();
            }
            
        });
    
       // 
    
}

</script>
<?php
require "footer.php";
?>
