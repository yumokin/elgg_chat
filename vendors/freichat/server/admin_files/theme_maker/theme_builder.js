                 
$('document').ready(function(){
    //------------------------------------------------------------------------------------------------      
    //menu     
    var str_new_theme,str_contain,str_container,str_opt1,str_opt2,str_options,str_head,str_frei,str_off,main_str;  
      
    var str_rename_theme = "<div id='notification'></div><span class='label upload_div' id='upload_div'>    <div id='close_upload_div' class='close_upload_div'><a><em>X</em></a></div>  <span class='saveas_theme_font'>Upload image to replace:</span>  <form action='' name='upload' method='post' enctype='multipart/form-data'><label class='file-upload'><span><strong>Select image</strong></span><input id='file_input_upload' accept='"+freidefines.file_exts+"' type='file' name='file' /> </label><input id='file-upload-status' disabled='disabled' class='saveas_theme_input'></span><span id='progress_upload_file'></span><span class='theme_button upload_submit_button' onclick='return FreiChat.file_upload();'>Replace</span></form></span>";  
    
    
    str_contain = str_rename_theme+"<div id='style_rules' class='style_rules themelist_div' id='parameters'><div id='style_header'><div class='theme_button add_new_style' id='add_new_style'>add new style</div><div id='close_style_rules_div' class='close_upload_div'><a><em>X</em></a></div></div><div id='style_rules_content'></div></div>";
        
    str_contain +="<div id='theme_menu' class='theme_menu'><div class='theme_button theme_mode' id='theme_mode'></div><div class='theme_button' id='chatroom_switch'>chatroom</div><a href='http://www.youtube.com/watch?v=wPCbg3ZYcCQ' target='_blank'><div class='theme_button' id='help'>help</div></a><div class='theme_button' id='restore'>undo changes</div><div id='save_theme'  class='theme_button' id='save'>save</div></div>";



    //------------------------------------------------------------------------------------------------

    //chat_switch

    str_container = "<div class='freicontain freicontain0' id='freicontain0'></div><div class='freicontain freicontain1' id='freicontain1'></div>";
  
    str_opt1 = "<span class='label status_options_label'>status options</span><div id='frei_options' class='frei_options'><br/><span class='frei_status_options'> <span id='status_online' class='status_available'> <img id='online_img'  src="+FreiChat.make_url(freidefines.onlineimg)+" alt='on'/><a onmousedown='' href='javascript:void(0)'> online </a></span>        <span id='status_busy' class='status_busy'> <img id='busy_img' src="+FreiChat.make_url(freidefines.busyimg)+" alt='by'/><a  onmousedown=''>busy</a> </span>   <br/>  <span id='status_invisible' class='status_invisible'> <img id='invisible_img' src="+FreiChat.make_url(freidefines.invisibleimg)+"  alt='in'/> <a onmousedown=''>invisible</a>   </span><span id='status_offline' class='status_offline'>            <img id='offline_img' src="+FreiChat.make_url(freidefines.offlineimg)+" alt='of'/><a>offline</a></span><div class='custom_mesg' id='custom_mesg'><input type=text  id='custom_message_id'  />  <br/></div></span></span></div>";
    
    str_opt2 = "<span class='label additional_options_label'>additional options</span><div id='frei_tools' class='frei_tools_options'><img id='restore_img' src="+FreiChat.make_url(freidefines.restoreimg)+" alt='in'/><a><img id='rtlimg_enabled' src="+FreiChat.make_url(freidefines.rtlimg_enabled)+"  alt='in'/></a><a><img id='rtlimg_disabled' src="+FreiChat.make_url(freidefines.rtlimg_disabled)+"  alt='in'/></a></div>"

    str_options=str_opt1+str_opt2;
    //------------------------------------------------------------------------------------------------------
    // Contains FreiChatX head DIV
    str_head="<div  class='freichathead' id='freichathead'> <span class='user_freichat_head_content'>Users [<span id='frei_user_count' class='frei_user_count'>1</span>] </span> <span class='freichat_user_options_img'><span class='min_freichathead' onmousedown=''>  <img  id='frei_img_min' src="+FreiChat.make_url(freidefines.minimg)+" alt='max' height=12 width=12/> </span><span onmousedown=> <img id='frei_img_opt' src="+FreiChat.make_url(freidefines.optimg)+"  alt='option'/>    </span>    <span onmousedown=''>  <img id='frei_img_tool' src="+FreiChat.make_url(freidefines.toolimg)+"  alt='option'/> </span> </span> <span class='self_status_img'>        <img id='frei_status' src="+FreiChat.make_url(freidefines.onlineimg)+" alt='status' align='left'/>    </span> <br clear='all' /></div>";

    str_frei="<div id='frei_user_brand' class='frei_user_brand'><div id='frei' class='frei'><div id='freichat_user_1'   onmousedown='' class='freichat_userlist' onmouseover='' onmouseout=''> <span class='freichat_userscontentname'>test user 1</span></div></div></div></div>";
    // Contains the DIV that appears when offline
    str_off="<div class='onoffline' id='onfreioffline'><a href='javascript:void(0)'  onmousedown=''><img onmouseover= id='offlineimg' src="+FreiChat.make_url(freidefines.offline)+" alt='offline'/></a></div>";
    //-------------------------------------------------------------------------------------------------------
    // Contains the main DIV that combines the others!



    main_str=str_contain+"<div id='chat_switch_div'>"+str_container+"<span class='freichat'><div id='freichat' class='freichat' style='z-index: 99999;'><span class='label chatbox_label'>chatbox</span><span class='label offline_label'>offline image</span><span class='label chatwindow_label_max'>chat window  [maximized]</span><span class='label chatwindow_label_min'>chat window [minimized]</span>"+str_options+str_off+str_head+str_frei+"</div></span></div>";    
    
    
    
    
    
    main_str +="<div id='chatroom_switch_div'><div class='frei_chatroom' id='frei_chatroom'>\n\
	<div id='frei_roomtitle' class='frei_roomtitle'>test chatroom\n\
	\n\
	</div>\n\
\n\
<div id='frei_chatroompanel' class='frei_chatroompanel'>\n\
    <div id='frei_chatroomleftpanel' class='frei_chatroomleftpanel'>\n\
\n\
        <div id='frei_chatroommsgcnt' class='frei_chatroommsgcnt'>\n\
       Messages</div> <div id='chatroom_branding'></div>\n\
\n\
        <div id='frei_chatroomtextarea' class='frei_chatroomtextarea'>\n\
       <textarea id='chatroommessagearea' class='chatroommessagearea' onkeydown=\"$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return;}\"></textarea> </div>\n\
    </div>\n\
\n\
<div id='frei_chatroomrightpanel' class='frei_chatroomrightpanel'>\n\
    <div id='frei_userpanel' class='frei_userpanel'><div id='frei_userlist' class='frei_userlist'><span class='freichat_userscontentname'>test user1</span></div>\n\
    </div>\n\
\n\
    <div id='frei_roompanel' class='frei_roompanel'><div class='frei_lobby_room' >\n\
                    <span class='frei_lobby_room_1'>test room 1</span><span class='frei_lobby_room_2'>0 online</span><span class='frei_lobby_room_3'></span>\n\
                    <span class='frei_lobby_room_4'></span>\n\
                    <div style='clear:both'></div></div>\n\
   <div id='frei_selected_room' class='frei_selected_room' >\n\
                    <span class='frei_lobby_room_1'>test room 1</span><span class='frei_lobby_room_2'>0 online</span><span class='frei_lobby_room_3'></span>\n\
                    <span class='frei_lobby_room_4'></span>\n\
                    <div style='clear:both'></div></div>\n\
\n\
    Rooms</div>\n\
</div>\n\
\n\
</div>\n\
</div></div>";

    
    
    var freichathtml = document.createElement("div");
    freichathtml.id = "freichathtml";
    freichathtml.innerHTML = main_str;
    document.body.appendChild(freichathtml);
    
    /* <span id="addedoptions_'+id+'" class="added_options"> '+FreiChat.show_plugins(user,id)+'</span>*/
    var id =1;
    var str='<div onmousedown="" id="frei_'+id+'" class="frei_box">        <div id="chatboxhead_'+id+'">   <div class="chatboxhead" id="chatboxhead'+id+'">                <div class="chatboxtitle">test user 1&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">         <a href="javascript:void(0)" ><img id="xtools'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" ><img id="minimgid'+id+'" src="'+FreiChat.make_url(freidefines.minimg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown="">                        <img id="closeimg" src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" />                    </a>                </div>                <br clear="all"/>            </div>        </div>        <div class="freicontent_'+id+'" id="freicontent_'+id+'">            <div class="chatboxcontent" id="chatboxcontent_'+id+'"><span class="chatboxmessagefrom">Me:&nbsp;</span><span class="chatboxmessagecontent">hi, how are you ?</span></div>            <div class="chatboxinput">  <span class="frei_chat_status" id="frei_chat_status_'+id+'"></span><textarea id="chatboxtextarea'+id+'" class="chatboxtextarea" onkeydown="$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return;}"></textarea>                </div>       </div>    </div>';
    var str2 = '<div class="chatboxhead_max" id="chatboxhead_'+id+'">  <div class="chatboxhead" id="chatboxhead_max'+id+'">   <div class="chatboxtitle">test user 1&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">   <a href="javascript:void(0)" ><img id="xtools_max'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" ><img id="maximgid'+id+'" src="'+FreiChat.make_url(freidefines.maximg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown=""> <img id="closeimg_max" src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" /> </a>    </div>  <br clear="all"/>    </div></div>';
    $('#freicontain0').html(str+str2);
 
 
    var pluginhtml;
    pluginhtml = '<span id="freifilesend"><a href="javascript:void(0)" ><img id="upload" src="'+FreiChat.make_url(freidefines.uploadimg)+'"  alt="upload" /> </a></span>';
    pluginhtml+= '<a href="javascript:void(0)" >  <img id="clrcht" src="'+FreiChat.make_url(freidefines.deleteimg)+'" alt="-" /> </a>';
    pluginhtml += '<a href="javascript:void(0)" >                <img id="smile" src="'+FreiChat.make_url(freidefines.smileyimg)+'" alt="-" />                </a>   ';
    pluginhtml += '<span id="savespan"><a href="javascript:void(0)"><img id="save" src="'+FreiChat.make_url(freidefines.saveimg)+'" alt="save" /> </a></span>';
    pluginhtml += '<span id="mailsend"><a href="javascript:void(0)"><img id="mail" src="'+FreiChat.make_url(freidefines.mailimg)+'" alt="upload" /> </a></span>';
 
    var tools = '<span class="label added_options_label">plugins</span><span class=X_tools><span class="added_options">'+pluginhtml+'</span></span>';
    
    
    str = '<span class="label smiley_list_label">smileys</span><span id="frei_smileys" class="frei_smileys">'+FreiChat.smileylist(1)+'</span>';
    
    $('#freicontain1').html(tools+str);
      
    //------------------------------------------------------------------------------------------------

    //chatroom
     

    
    FreiChat.roll_button('freichat_switch',['chat','edit chat'],['chatroom','edit chatroom'],['chat_switch_div','chatroom_switch_div','chatroom_switch']);
    FreiChat.roll_button('theme_mode',['image','edit images'],['parameters','edit CSS'],[false,false,'theme_mode']);
    $('#theme_mode').show();

    FreiChat.divfrei = $('#frei');   
    FreiChat.height = 1*25;
    FreiChat.divfrei.css("height",FreiChat.height);

  //  FreiChat.get_theme_names('ol','themelist_div');
  //  FreiChat.get_theme_names('select','theme_list_import');

    $('#upload_div').hide().draggable({
        containment:'window'
    });  
    $('#file-upload-status').val('no image selected yet!');
    $('#close_upload_div').click(function(){
        $('#upload_div').hide('slow');  
        $('#file-upload-status').val('no image selected yet!');
        FreiChat.allow_upload = false;
       // $('#progress_upload_file').html('');
    });
    
    $('#close_style_rules_div').click(function(){
        $('#style_rules').hide('slow'); 
    });

    $('#file_input_upload').change(function(){
        var filename = $(this).val();
        filename = filename.replace(/^.*(\\|\/|\:)/, '');
        $('#file-upload-status').val(filename).show();
        FreiChat.allow_upload = true;
    });



    if(sessionStorage.theme_mode != 'image') {
    //$('#save_style_changes').show();
    }else{
        $('#save_style_changes').hide();
    }
    
    $('#save_style_changes').click(function(){
        FreiChat.save_style_changes();
    });
    
    $('#add_new_style').click(function(){
        $('#property_add_style').val('');
        $('#value_add_style').val('');
        $('#add_new_style_content').show();
    });
    
    
    $('#style_rules').append('<div id="add_new_style_content" class="themelist_div add_new_style_content"><span class="saveas_theme_font style_theme_font">property:</span><input class="input_add_style" id="property_add_style" type="text"/> <br/><span class="saveas_theme_font style_theme_font"> value:</span><input class="input_add_style" id="value_add_style" type="text"/> <span id="add_style_button">add style</span><span id="cancel_style_button">cancel</span></div>');
    $('#add_style_button').button().click(function(){
        FreiChat.add_new_style();
    });
    $('#cancel_style_button').button().click(function(){
        $('#add_new_style_content').hide();
   });
    $('.ui-button-text').css('font-size','10px');
    $('#add_new_style_content').hide();
    
    FreiChat.get_css_array(); //Build the css array by parsing css.php
        
    $('#notification').hide();
    //FreiChat.notify('Click image to replace ');

    //--------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------
    $('#save_theme').click(function(){
        FreiChat.save_theme();
    });
    //--------------------------------------------------------------------------------
    $('#restore').click(function(){
        FreiChat.restore_defaults(); 
    });

    //parameters: variable(definitions.js) , id(to select img) , type , [ php variable(argument.php) , js variable(defintions.js) ]
    /* chatroom */
    $('#frei_roomtitle').click(function(){
        FreiChat.rep_img(freidefines.chatroom_head,'frei_roomtitle','bg',['chatroom_head','chatroom_head'],'.frei_roomtitle');
    });
    
    $('#frei_chatroompanel').click(function(){
        FreiChat.rep_img(freidefines.chatroomimg,'frei_chatroompanel','bg',['chatroomimg','chatroomimg'],'.frei_chatroompanel');   
    });
    
    $('#frei_selected_room').click(function(j){
        FreiChat.rep_img(freidefines.chatroom_selected,'frei_selected_room','bg',['chatroom_selected','chatroom_selected'],'.frei_selected_room');   
        j.stopPropagation();
    });
    
    /* smileys */
    $('#frei_smileys').click(function(j){
        FreiChat.rep_img(freidefines.freismileyimg,'frei_smileys','bg',['freismileyimg','freismileyimg'],'.frei_smileys img');
    });

    $('#smile__1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_smileimg,'smile__1','img',['smiley_smileimg','smiley_smileimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#cry_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_cryimg,'cry_1','img',['smiley_cryimg','smiley_cryimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#cool_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_coolimg,'cool_1','img',['smiley_coolimg','smiley_coolimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#sad_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_sadimg,'sad_1','img',['smiley_sadimg','smiley_sadimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#laughing_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_laughingimg,'laughing_1','img',['smiley_laughingimg','smiley_laughingimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#cheerful_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_cheerfulimg,'cheerful_1','img',['smiley_cheerfulimg','smiley_cheerfulimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#wink_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_winkimg,'wink_1','img',['smiley_winkimg','smiley_winkimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#tongue_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_tongueimg,'tongue_1','img',['smiley_tongueimg','smiley_tongueimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#angry_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_angryimg,'angry_1','img',['smiley_angryimg','smiley_angryimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#unsure_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_unsureimg,'unsure_1','img',['smiley_unsureimg','smiley_unsureimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#shocked_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_shockedimg,'shocked_1','img',['smiley_shockedimg','smiley_shockedimg'],'.frei_smileys img');
        j.stopPropagation();
    });

    $('#wassat_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_wassatimg,'wassat_1','img',['smiley_wassatimg','smiley_wassatimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#ermm_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_ermmimg,'ermm_1','img',['smiley_ermmimg','smiley_ermmimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#grin_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_grinimg,'grin_1','img',['smiley_grinimg','smiley_grinimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#silly_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_sillyimg,'silly_1','img',['smiley_sillyimg','smiley_sillyimg'],'.frei_smileys img');
        j.stopPropagation();
    });
    
    $('#w00t_1').click(function(j){
        FreiChat.rep_img(freidefines.smiley_w00timg,'w00t_1','img',['smiley_w00timg','smiley_w00timg'],'.frei_smileys img');
        j.stopPropagation();
    });
          
    /* plugins */
   
    $('#upload').click(function(){
        FreiChat.rep_img(freidefines.uploadimg,"upload",'img',['uploadimg','uploadimg'],'.added_options img');
    });
   
    $('#clrcht').click(function(){
        FreiChat.rep_img(freidefines.deleteimg,"clrcht",'img',['deleteimg','deleteimg'],'.added_options img');
    });
   
    $('#save').click(function(){
        FreiChat.rep_img(freidefines.saveimg,"save",'img',['saveimg','saveimg'],'.added_options img');
    });
    
    $('#smile').click(function(){
        FreiChat.rep_img(freidefines.smileyimg,"smile",'img',['smileyimg','smileyimg'],'.added_options img');
    });
   
    $('#mail').click(function(){
        FreiChat.rep_img(freidefines.mailimg,"mail",'img',['mailimg','mailimg'],'.added_options img');
    });   
    /* chat window */

    $('#chatboxcontent_1').click(function(){
        FreiChat.rep_img(freidefines.bmidimg,"chatboxcontent_1",'bg',['bmidimg','bmidimg'],'.chatboxcontent');
    });

    /*window head[minimized]*/
    $('#chatboxhead_max1').click(function(i){
        FreiChat.rep_img(freidefines.btopimg,"chatboxhead_max1",'bg',['btopimg','btopimg','chatboxhead1'],'.chatboxhead');
    });

    $('#xtools_max1').click(function(i){
        FreiChat.rep_img(freidefines.arrowimg,"xtools_max1",'img',['arrowimg','arrowimg','xtools1'],'.chatboxhead img');
        i.stopPropagation();
    });

    $('#maximgid1').click(function(i){
        FreiChat.rep_img(freidefines.maximg,"maximgid1",'img',['maximg','maximg'],'.chatboxhead img');
        i.stopPropagation();
    });

    $('#closeimg_max').click(function(i){
        FreiChat.rep_img(freidefines.closeimg,"closeimg_max",'img',['closeimg','closeimg','closeimg'],'.chatboxhead img');
        i.stopPropagation();
    });



    /*window head[maximized]*/
    $('#chatboxhead1').click(function(h){
        FreiChat.rep_img(freidefines.btopimg,"chatboxhead1",'bg',['btopimg','btopimg','chatboxhead_max1'],'.chatboxhead');
    });

    $('#xtools1').click(function(h){
        FreiChat.rep_img(freidefines.arrowimg,"xtools1",'img',['arrowimg','arrowimg','xtools_max1'],'.chatboxhead img');
        h.stopPropagation();
    });

    $('#minimgid1').click(function(h){
        FreiChat.rep_img(freidefines.minimg,"minimgid1",'img',['minimg','minimg','frei_img_min'],'.chatboxhead img');
        h.stopPropagation();
    });

    $('#closeimg').click(function(h){
        FreiChat.rep_img(freidefines.closeimg,"closeimg",'img',['closeimg','closeimg','closeimg_max'],'.chatboxhead img');
        h.stopPropagation();
    });

    $('.chatboxinput').click(function(){
        FreiChat.rep_img(false,".chatboxinput",'img',[false,false,false],'.chatboxinput');

    });

    /*window content*/




    /*offline image*/

    $('#onfreioffline').click(function(){
        FreiChat.rep_img(freidefines.offline,"offlineimg",'img',['offline','offline'],'.onfreioffline');
    });

    /* frei tools */
    $('#frei_tools').click(function(g){
        FreiChat.rep_img(freidefines.frei_tools_optionsimg,"frei_tools",'bg',['frei_tools_optionsimg','frei_tools_optionsimg'],'.frei_tools_options');
    });

    $('#restore_img').click(function(g){
        FreiChat.rep_img(freidefines.restoreimg,"restore_img",'img',['restoreimg','restoreimg'],'.frei_tools_options img');
        g.stopPropagation();
    });

    $('#rtlimg_enabled').click(function(g){
        FreiChat.rep_img(freidefines.rtlimg_enabled,"rtlimg_enabled",'img',['rtlimg_enabled','rtlimg_enabled'],'.frei_tools_options img');
        g.stopPropagation();
    });

    $('#rtlimg_disabled').click(function(g){
        FreiChat.rep_img(freidefines.rtlimg_disabled,"rtlimg_disabled",'img',['rtlimg_disabled','rtlimg_disabled'],'.frei_tools_options img');
        g.stopPropagation();
    });
    /* status options */


    $('#frei_options').click(function(f){
        FreiChat.rep_img(freidefines.frei_optionsimg,"frei_options",'bg',['frei_optionsimg','frei_optionsimg'],'.frei_options');
    });


    $('#status_online').click(function(f){
        FreiChat.rep_img(freidefines.onlineimg,"online_img",'img',['onlineimg','onlineimg','frei_status'],'.frei_status_options img');
        f.stopPropagation();
    });

    $('#status_busy').click(function(f){
        FreiChat.rep_img(freidefines.busyimg,"busy_img",'img',['busyimg','busyimg'],'.frei_status_options img');
        f.stopPropagation();    
    });

    $('#status_invisible').click(function(f){
        FreiChat.rep_img(freidefines.invisibleimg,"invisible_img",'img',['invisibleimg','invisibleimg'],'.frei_status_options img');
        f.stopPropagation();    
    });

    $('#status_offline').click(function(f){
        FreiChat.rep_img(freidefines.offlineimg,"offline_img",'img',['offlineimg','offlineimg'],'.frei_status_options img');
        f.stopPropagation();    
    });

    /* freichathead*/

    $('#freichathead').click(function(e){
        FreiChat.rep_img(freidefines.freichatheadimg,"freichathead",'bg',['freichatheadimg','freichatheadimg'],'.freichathead');
    });
    $('#frei_img_min').click(function(e){
        FreiChat.rep_img(freidefines.minimg,"frei_img_min",'img',['minimg','minimg','minimgid1'],'.freichathead img');
        e.stopPropagation();
    });
    $('#frei_img_opt').click(function(e){
        FreiChat.rep_img(freidefines.optimg,"frei_img_opt",'img',['optimg','optimg'],'.freichathead img');
        e.stopPropagation();
    });
    $('#frei_img_tool').click(function(e){
        FreiChat.rep_img(freidefines.toolimg,"frei_img_tool",'img',['toolimg','toolimg'],'.freichathead img');
        e.stopPropagation();
    });
    $('#frei_status').click(function(e){
        FreiChat.rep_img(freidefines.onlineimg,"frei_status",'img',['onlineimg','onlineimg','status_online'],'.freichathead img');
        e.stopPropagation();
    });
    /* freichathead*/


    /*frei*/
    $('#frei').click(function(f){
        FreiChat.rep_img(freidefines.freiuserbrandimg,"frei",'bg',['frei_user_brandimg','freiuserbrandimg'],'.frei'); 
    });
    
/*frei*/

});     