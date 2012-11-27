<?php
session_start();

/* Make me secure */


if (!isset($_SESSION['FREIX']) || $_SESSION['FREIX'] != 'authenticated' || isset($_POST["Deny"]) == true || !isset($_GET[$_SESSION['index']])) {
    header("Location:index.php");
    exit;
}

/* Now i am secure */

require("header.php");
?>
<br/>
<br/>
<br/>
<div style="font-family: 'Sonsie One', cursive;font-size: 18pt;text-align: center">
<p>Choose Integration Type</p>
</div>

<br/>
<br/>
<br/>
<div style="text-align: center">
    <form name="cms" action="info.php" method="POST" id="sform">
        <select id="CMS" name='cms' id="cms" style="font-family: 'Changa One', cursive;font-size: 16px">
            <option selected="selected"></option>
            <option name="ccms" value="Joomla">Joomla</option>
            <option name="ccms" value="JCB">Joomla with CB</option>
            <option name="ccms" value="JSocial">Joomla with JomSocial</option>
            <option id="CBE_option" name="ccms" value="CBE">Joomla with CBE</option>
            <option name="ccms" value="Drupal">Drupal</option>
            <option name="ccms" value="WordPress">WordPress</option>
            <option name="ccms" value="Elgg">Elgg</option>
            <option name="ccms" value="Phpbb">Phpbb</option>
            <option name="ccms" value="Sugarcrm">Sugarcrm</option>
            <option name="ccms" value="Phpvms">PhpVMS</option>
            <option name="ccms" value="Phpfox">PhpFox</option>
            <option name="ccms" value="Phpfusion">PhpFusion</option>
            <option name="ccms" value="Custom">Customized</option>
        </select>
        <br/>
        <br/>
        <div id="CBE_ver_div" style="font-family: 'Changa One', cursive;font-size: 16px">
            Please select the appropriate version of CBE installed<br/><br/>
            <select name="CBE_ver" style="font-family: 'Changa One', cursive;font-size: 16px">
                <option name="CBE_ver_" value="1"> CBE 1.5.x </option>
                <option name="CBE_ver_" value="2"> CBE 2.5.x </option>
            </select>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
<p>
    <a href="JavaScript:void(0)" class="nextbutton" onclick="submit_form()">Next</a>
</p>
</div>
        
<script type="text/javascript">
   
   $(document).ready(function(){
       
      var div =  $('#CBE_ver_div');
      div.hide();
      $('#CMS').change(function(){//alert("f");
          if($(this).find(":selected").val() == "CBE") {
              div.show();
          }else{
              div.hide();
          }
          
      });
      
   });
   
   function submit_form(){
       
       if($('#cms option:selected').val()!=""){
           
            $('#sform').submit();
           
       }
       else{
           alert('Please Select an integration type!');
       }
   }
    
</script>
        
        
    </form>

    
    
<?php

require 'footer.php';

?>