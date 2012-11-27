
            <div class="dd" style="text-align:center">
            <a href='admin.php?freiload=home'><span onmouseover="mcolor(this)"  onmouseout="mblack(this)" class="container sprite-general_b" title="General Settings"></span></a>
            <a href='admin.php?freiload=_send_conv'><span onmouseover="mcolor(this)"  onmouseout="mblack(this)" class="container sprite-mail_b" title="Mail settings"></span></a>
            <a href='admin.php?freiload=chatrooms'><span onmouseover="mcolor(this)"  onmouseout="mblack(this)" class="container sprite-chatroom_b" title="Chatroom Settings"></span></a>
            <a href='admin.php?freiload=_file_send'><span onmouseover="mcolor(this)"  onmouseout="mblack(this)" class="container sprite-file1_b" title="File Sending Options"></span></a>
            <a href='admin.php?freiload=theme_maker'><span onmouseover="mcolor(this)"  onmouseout="mblack(this)" class="container sprite-theme_maker_b" title="Edit themes"></span></a>
        </div>
        
        <script type="text/javascript">
            
            function mcolor(ele){
                
             //   console.log($(ele).attr('class'));
             $(ele).attr('class',$(ele).attr('class').replace('_b',''));

            }
            
            function mblack(ele){

             $(ele).attr('class',$(ele).attr('class')+"_b");

            }
            
            
            
            </script>
        

            <div style="position: fixed;bottom: 0px;text-align: center;margin: 0px auto;width:60%;font-size:small;">
                             <div style="text-align:center;font-size: small;">
                

           
                <div style="text-align:left;width:150px;margin: 0px auto">
                
                Total Messages:<?php $x=$db->query("SELECT count(*) as cnt from frei_chat");$y=$x->fetchAll(); echo $y[0]['cnt'];?><br/>
                Current Version: 7.2<br/>
                Latest Version: <img src="http://evnix.com/drupal2/latest_ver.png" style="display: inline;height:10px"/><br/>

                 Powered By <a target="_blank" style="color:blue" href="http://evnix.com">EvNiX</a>
               
                                  </div>
                
            
            </div>
            </div>