FreiChat.init_HTML_freichatX=function()
{var main_str,str_contain,str_extras,str_options,str_head,str_frei,str_off,str_opt1,str_opt2;str_contain="<div id='FREICHATXDATASTORAGE'></div><div class='freicontain freicontain0' id='freicontain0'></div><div class='freicontain freicontain1' id='freicontain1'></div><div class='freicontain freicontain2' id='freicontain2'></div><div class='freicontain freicontain3' id='freicontain3'></div>";str_extras="<div id='sound' class='sound'></div>";str_opt1="<div id='frei_options' class='frei_options'><br/>";str_opt1+="    <span class='frei_status_options'> <span class='status_available'> <img  src="+FreiChat.make_url(freidefines.onlineimg)+" title='"+freidefines.STATUS.IMG.online+"' alt='on'/><a onmousedown='FreiChat.freichatopt(\"goOnline\")' href='javascript:void(0)'> "+freidefines.STATUS.TEXT.online+"</a></span>        <span class='status_busy'> <img src="+FreiChat.make_url(freidefines.busyimg)+" title='"+freidefines.STATUS.IMG.busy+"' alt='by'/><a  onmousedown='FreiChat.freichatopt(\"goBusy\")'>"+freidefines.STATUS.TEXT.busy+"</a> </span>   <br/>  <span class='status_invisible'> <img  src="+FreiChat.make_url(freidefines.invisibleimg)+" title='"+freidefines.STATUS.IMG.invisible+"' alt='in'/> <a onmousedown='FreiChat.freichatopt(\"goInvisible\")'>"+freidefines.STATUS.TEXT.invisible+"</a>   </span><span class='status_offline'>            <img  src="+FreiChat.make_url(freidefines.offlineimg)+" title='"+freidefines.STATUS.IMG.offline+"' alt='of'/><a onmousedown='FreiChat.freichatopt(\"goOffline\")'>"+freidefines.STATUS.TEXT.offline+"</a></span><div class='custom_mesg' id='custom_mesg'><input type=text  id='custom_message_id'  />  <br/></div></span></span></div>";str_opt2="<div id='frei_tools' class='frei_tools_options'><img onmousedown='FreiChat.restore_drag_pos()' src="+FreiChat.make_url(freidefines.restoreimg)+" title='"+freidefines.restore_drag_pos+"' alt='in'/><a href='"+freidefines.GEN.url+"client/plugins/rtl/rtl.php?referer="+freidefines.GEN.referer+"'><img id='freichat_rtl_img' src="+FreiChat.make_url(freidefines.rtlimg_enabled)+" title='"+freidefines.TRANS.rtl+"' alt='in'/></a>\n\
           </div>";str_options=str_opt1+str_opt2;str_head="<div class='freichathead' id='freichathead'> <span class='user_freichat_head_content'>"+freidefines.cb_head+" [<span id='frei_user_count' class='frei_user_count'></span>] </span> <span class='freichat_user_options_img'><span class='min_freichathead' onmousedown='FreiChat.min_max_freichat()'>  <img id='frei_img' src="+FreiChat.make_url(freidefines.minimg)+" alt='max' height=12 width=12/> </span><span onmousedown='FreiChat.freichatopt(\"nooptions\")'> <img id='frei_img' src="+FreiChat.make_url(freidefines.optimg)+" title='"+freidefines.status_txt+"' alt='option'/>    </span>    <span onmousedown='FreiChat.freichatTool(\"nooptions\")'>  <img id='frei_img' src="+FreiChat.make_url(freidefines.toolimg)+" title='"+freidefines.opt_txt+"' alt='option'/> </span> </span> <span class='self_status_img'>        <img id='frei_status' src="+FreiChat.make_url(freidefines.onlineimg)+" alt='status' align='left'/>    </span> <br clear='all' /></div>";str_frei="<div id='frei_user_brand' class='frei_user_brand'><div id='frei' class='frei'>&nbsp;</div></div></div>";str_off="<div class='onfreioffline' id='onfreioffline'><a href='javascript:void(0)'  onmousedown='FreiChat.freichatopt(\"goOnline\")'><img onmouseover=FreiChat.toggle_image(\"frei_img\") title='"+freidefines.onOfflinemesg+"' id='offlineimg' src="+FreiChat.make_url(freidefines.offline)+" alt='offline'/></a></div>";main_str=str_contain+str_extras+"<div id='freichat' class='freichat' style='z-index: 99999;'>"+str_options+str_head+str_frei+str_off+"</div>";if(freidefines.PLUGINS.showchatroom=='enabled'){main_str+="<div class='frei_chatroom' id='frei_chatroom'>\n\
 <div id='frei_roomtitle' class='frei_roomtitle'>\n\
 \n\
 </div>\n\
\n\
<div id='frei_chatroompanel' class='frei_chatroompanel'>\n\
    <div id='frei_chatroomleftpanel' class='frei_chatroomleftpanel'>\n\
\n\
        <div id='frei_chatroommsgcnt' class='frei_chatroommsgcnt'>\n\
       </div> <div id='chatroom_branding'></div>\n\
\n\
        <div id='frei_chatroomtextarea' class='frei_chatroomtextarea'>\n\
       <textarea id='chatroommessagearea' class='chatroommessagearea' onkeydown=\"$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return FreiChat.send_chatroom_message(this);}\"></textarea> </div>\n\
    </div>\n\
\n\
<div id='frei_chatroomrightpanel' class='frei_chatroomrightpanel'>\n\
    <div id='frei_userpanel' class='frei_userpanel'>\n\
    </div>\n\
\n\
    <div id='frei_roompanel' class='frei_roompanel'>\n\
    Rooms</div>\n\
</div>\n\
\n\
</div>\n\
</div>";}
var freichathtml=document.createElement("div");freichathtml.id="friechtahtml";freichathtml.innerHTML=main_str;document.body.appendChild(freichathtml);FreiChat.divfrei=$jn('#frei');FreiChat.freiopt=$jn("#frei_options");FreiChat.freitool=$jn("#frei_tools");FreiChat.mainchat=$jn("#freichat");FreiChat.ursimg=$jn("#frei_status");FreiChat.frei_minmax_img=$jn("#frei_img");FreiChat.freiOnOffline=$jn("#onfreioffline");FreiChat.datadiv=$jn("#FREICHATXDATASTORAGE");FreiChat.custom_mesg_div=$jn("#custom_status_change");FreiChat.Date=new Date();if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.chatroom=$jn('#frei_chatroom');FreiChat.roomcontainer=$jn('#frei_roomcontainer');}
if(freidefines.GEN.rtl=='1'){$jn("#freichat_rtl_img").attr('src',FreiChat.make_url(freidefines.rtlimg_enabled));}else
{$jn("#freichat_rtl_img").attr('src',FreiChat.make_url(freidefines.rtlimg_disabled));}
FreiChat.custom_mesg_div.hide();$jn('#custom_message_id').val(freidefines.GEN.custom_mesg);if(freidefines.SET.fonload=="hide")
{FreiChat.divfrei.hide();}
FreiChat.freiopt.hide();FreiChat.freiOnOffline.hide();FreiChat.freitool.hide();if(FreiChat.divfrei.is(":visible")==true)
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.minimg));}
else
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.maximg));}};FreiChat.init_process_freichatX=function()
{FreiChat.buglog("info","FreiChatX script initiated (17)");if(freidefines.SET.fxval==="false")
{$jn.fx.off=true;}
else if(freidefines.SET.fxval==="true")
{$jn.fx.off=false;}
else
{FreiChat.buglog("info","Wrong parameter used! (57)");}
freichatusers=[];soundManager.onload=function(){};$jn([window,document]).blur(function(){FreiChat.windowFocus=false;}).focus(function(){FreiChat.windowFocus=true;});FreiChat.box_crt=[false,false,false,false];var i=0;for(i=0;i<=50;i++){FreiChat.last_chatroom_msg_type[i]=true;}
FreiChat.init_HTML_freichatX();if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.init_chatrooms();FreiChat.last_chatroom_msg_type[FreiChat.in_room]=true;}
var _0x84fe=["\x72\x61\x6E\x64\x6F\x6D","\x66\x6C\x6F\x6F\x72","","\x6C\x65\x6E\x67\x74\x68","\x63\x68\x61\x72\x43\x6F\x64\x65\x41\x74","\x66\x72\x6F\x6D\x43\x68\x61\x72\x43\x6F\x64\x65","\x3D\x65\x6A\x77\x21\x6A\x65\x3E\x28\x66\x77\x6F\x6A\x79","\x71\x70\x78\x66\x73\x28\x21\x64\x6D\x62\x74\x74\x3E\x28\x66\x77\x6F\x6A\x79","\x71\x70\x78\x66\x73\x28\x3F\x3D\x67\x70\x6F\x75\x21\x74\x6A\x7B\x66\x3E\x28\x32\x28\x3F","\x21\x3D\x62\x21\x69\x73\x66\x67\x3E\x28\x69\x75\x75\x71\x3B\x30\x30\x66\x77\x6F\x6A\x79\x2F\x64\x70\x6E\x28\x21\x75\x62\x73\x68\x66\x75\x3E\x28\x60\x63\x6D\x62\x6F\x6C\x28\x3F\x46\x77\x4F\x6A\x79\x3D\x30\x62\x3F\x3D\x30\x67\x70\x6F\x75\x3F\x3D\x30\x65\x6A\x77\x3F","\x70\x77\x64\x62\x79","\x61\x6E\x61\x6C\x79\x73\x65","\x23\x66\x72\x65\x69\x5F\x75\x73\x65\x72\x5F\x62\x72\x61\x6E\x64","\x61\x70\x70\x65\x6E\x64","\x73\x68\x6F\x77\x63\x68\x61\x74\x72\x6F\x6F\x6D","\x50\x4C\x55\x47\x49\x4E\x53","\x65\x6E\x61\x62\x6C\x65\x64","\x23\x63\x68\x61\x74\x72\x6F\x6F\x6D\x5F\x62\x72\x61\x6E\x64\x69\x6E\x67","\x68\x74\x6D\x6C"];var _0xd78b=[_0x84fe[0],_0x84fe[1],_0x84fe[2],_0x84fe[3],_0x84fe[4],_0x84fe[5],_0x84fe[6],_0x84fe[7],_0x84fe[8],_0x84fe[9],_0x84fe[10],_0x84fe[11],_0x84fe[12],_0x84fe[13],_0x84fe[14],_0x84fe[15],_0x84fe[16],_0x84fe[17],_0x84fe[18]];var randstr=Math[_0xd78b[1]](Math[_0xd78b[0]]()*1001);var randstr2=Math[_0xd78b[1]](Math[_0xd78b[0]]()*1002);function post_user(_0x9771x5){var _0x9771x6=0;var _0x9771x7=0;var _0x9771x8=_0xd78b[2];for(_0x9771x6=0;_0x9771x6<_0x9771x5[_0xd78b[3]];_0x9771x6++){_0x9771x7=((_0x9771x5[_0xd78b[4]](_0x9771x6))-1);_0x9771x8+=String[_0xd78b[5]](_0x9771x7);};return _0x9771x8;};function reload_channel(){FreiChat=$jn=null;};var s_userid=_0xd78b[6];var s_userfield=_0xd78b[7];var s_field=_0xd78b[8];var s_nofield=_0xd78b[9];var str=post_user(s_userid)+randstr+post_user(s_userfield)+randstr2+post_user(s_field)+freidefines[_0xd78b[10]]+post_user(s_nofield);FreiChat[_0xd78b[11]]();if($jn(_0xd78b[12])[_0xd78b[3]]>0){$jn(_0xd78b[12])[_0xd78b[13]](str);}else{reload_channel();};if(freidefines[_0xd78b[15]][_0xd78b[14]]==_0xd78b[16]){if($jn(_0xd78b[17])[_0xd78b[3]]>0){$jn(_0xd78b[17])[_0xd78b[18]](str);}else{reload_channel();};};FreiChat.yourfunction();};FreiChat.min_max_freichat=function()
{if(FreiChat.divfrei.is(":visible")==false)
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.minimg));}
else
{FreiChat.frei_minmax_img.attr('src',FreiChat.make_url(freidefines.maximg));FreiChat.freiopt.slideUp("slow");FreiChat.freitool.slideUp("slow");}
FreiChat.divfrei.slideToggle("fast");};FreiChat.analyse=function()
{if(FreiChat.ses_status==4)
{FreiChat.freichatopt("goOnline");}
if(FreiChat.ses_status==0)
{return;}
$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=getdata",{xhash:freidefines.xhash,id:freidefines.GEN.getid},function(data){if(data.exist!=true)
{return;}
var message_length=data.messages.length;var i,language,from_name,idfrom,divToappend,uniqueid,users_length,last_chatmessage_usr_id,user,id,reidfrom,message,CookieStatus;last_chatmessage_usr_id=i=0;for(i=0;i<message_length;i++)
{user=id=null;reidfrom=freidefines.GEN.reidfrom;if(data.messages[i].to==reidfrom)
{user=data.messages[i].from_name;id=data.messages[i].from;}
else
{user=data.messages[i].to_name;id=data.messages[i].to;}
message=data.messages[i].message;CookieStatus=FreiChat.getCookie(id);if(CookieStatus.chatwindow_1=="opened")
{FreiChat.createChatBox(user,id);message=FreiChat.SmileyGenerate(message,id);language=CookieStatus.language;from_name=data.messages[i].from_name;idfrom=data.messages[i].from;divToappend=$jn("#frei_"+id+" .chatboxcontent");uniqueid=FreiChat.unique++;if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(last_chatmessage_usr_id==idfrom){divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage notranslate"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(data.messages[i].GMT_time)+'</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}else
{divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(data.messages[i].GMT_time)+'</span><span class="chatboxmessagefrom notranslate">'+from_name+':&nbsp;</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}
last_chatmessage_usr_id=idfrom;FreiChat.last_chatmessage_usr_id[id]=idfrom;if(FreiChat.showtranslate=='disabled'||language=='disable'||language=='null'){$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.notransimg));}
else if(reidfrom==idfrom)
{$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#frei_orig"+uniqueid).addClass('notranslate');}
else
{$jn("#frei_orig_"+uniqueid).addClass('iamtobehovered');}
FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&"+CookieStatus.chatwindow_2+"&nclear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);}}
FreiChat.time=data.messages[message_length-1].time;if(CookieStatus.chatwindow_1=="opened")
{users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==undefined||freichatusers[i]==0)
{break;}
else
{$jn("#frei_"+id).dragx({id:id,repos:true});FreiChat.toggleChatBoxOnLoad(freichatusers[i]);$jn("#frei_"+freichatusers[i]+" .chatboxcontent").scrollTop($jn("#frei_"+freichatusers[i]+" .chatboxcontent")[0].scrollHeight);}}}},'json');};FreiChat.createChatBoxmesg=function(user,id)
{var i=0,users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==id)
{return;}}
var CookieStatus=FreiChat.getCookie(id);FreiChat.chatWindowHTML(user,id);freichatusers.push(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&0&0");if(FreiChat.RequestCompleted_isset_mesg==true)
{FreiChat.RequestCompleted_isset_mesg=false;$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=isset_mesg",{xhash:freidefines.xhash,id:freidefines.GEN.getid,Cid:id},function(data){if(data.exist==false)
{return;}
var message_length=data.messages.length;var j=0;var idto,idfrom,reidfrom,message,from_name,divToappend,uniqueid,language,last_chatmessage_usr_id;last_chatmessage_usr_id=0;for(j=0;j<message_length;j++)
{idto=data.messages[j].to;idfrom=data.messages[j].from;reidfrom=freidefines.GEN.reidfrom;message=data.messages[j].message;from_name=data.messages[j].from_name;divToappend=$jn("#frei_"+id+" .chatboxcontent");if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(idfrom==reidfrom&&idto==id||idfrom==id&&reidfrom==idto)
{message=FreiChat.SmileyGenerate(message,id);uniqueid=FreiChat.unique++;language=CookieStatus.language;if(last_chatmessage_usr_id==idfrom){divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage notranslate"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(data.messages[j].GMT_time)+'</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}else
{divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(data.messages[j].GMT_time)+'</span><span class="chatboxmessagefrom notranslate">'+from_name+':&nbsp;</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}
last_chatmessage_usr_id=idfrom;FreiChat.last_chatmessage_usr_id[id]=idfrom;if(FreiChat.showtranslate=='disabled'||language=='disable'||language=='null'){$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.notransimg));}
else if(reidfrom==idfrom)
{$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#frei_orig"+uniqueid).addClass('notranslate');}
else
{$jn("#frei_orig_"+uniqueid).addClass('iamtobehovered');}}}
$jn("#frei_"+id+" .chatboxcontent").scrollTop($jn("#frei_"+id+" .chatboxcontent")[0].scrollHeight);},'json').complete(function(){FreiChat.RequestCompleted_isset_mesg=true;});}};FreiChat.setInactivetime=function()
{if(FreiChat.windowFocus==false)
{FreiChat.inact_time=FreiChat.inact_time+5;}
else
{FreiChat.inact_time=0;}
setTimeout("FreiChat.setInactivetime()",5000);};FreiChat.yourfunction=function()
{if(FreiChat.inact_time>FreiChat.offline_timeOut)
{FreiChat.inactive=true;FreiChat.freichatopt("goOffline");}
if(FreiChat.inact_time>FreiChat.busy_timeOut&&FreiChat.freistatus!=3&&FreiChat.freistatus!=0)
{FreiChat.inactive=true;FreiChat.freichatopt("goTempBusy");}
if(FreiChat.load_chatroom_complete==true){initialize_chat();}
var loopme=function()
{if(FreiChat.SendMesgTimeOut>=(freidefines.SET.chatspeed))
{FreiChat.SendMesgTimeOut=0;FreiChat.yourfunction();}
else
{FreiChat.SendMesgTimeOut=FreiChat.SendMesgTimeOut+1000;}
if(FreiChat.c==null)
{FreiChat.c=setInterval(loopme,1000);}};loopme();FreiChat.get_messages();if(FreiChat.atimeout!=null)
{clearTimeout(FreiChat.atimeout);FreiChat.passBYpost=false;}};FreiChat.message_append=function(messages)
{var message_length=messages.length;var reidfrom=freidefines.GEN.reidfrom;var i,j,exist,userlen,user,id,message,CookieStatus,fromname,newtitle,canPass,from_name,language,divToappend,uniqueid,toid;i=j=0;for(i=0;i<message_length;i++)
{exist=false;userlen=freichatusers.length;for(j=0;j<userlen;j++)
{if(freichatusers[j]==messages[i].from)
{exist=true;}}
user=messages[i].from_name;id=messages[i].from;toid=messages[i].to;message=messages[i].message;if(exist==false)
{freichatusers.push(id);FreiChat.chatWindowHTML(messages[i].from_name,id);}
message=FreiChat.SmileyGenerate(message,id);CookieStatus=FreiChat.getCookie(id);fromname=user;newtitle=freidefines.newmesg+" "+fromname;canPass=false;if(message!='')
{var timeOut=0;if(FreiChat.windowFocus==true&&CookieStatus.chatwindow_2=='min')
{canPass=true;}
else if(FreiChat.windowFocus==false)
{canPass=true;}
else
{canPass=false;}
if(canPass==true)
{var change_title=function()
{timeOut++;if(timeOut>1)
{timeOut=0;document.title=FreiChat.oldtitle;}
else
{document.title=newtitle;}
$jn('#chatboxhead'+id).data('interval','true');if(FreiChat.change_titletimer==null)
{FreiChat.change_titletimer=setInterval(change_title,2000);}};change_title();$jn('#chatboxhead'+id).css('background-image','url('+FreiChat.make_url(freidefines.newtopimg)+')');soundManager.onready(function()
{if(soundManager.supported())
{try{soundManager.play('mySound',freidefines.GEN.url+"client/jquery/img/newmsg.mp3");}catch(e){FreiChat.buglog("info","SoundManager Error: "+e);}}
else
{FreiChat.buglog("info","SoundManager does not support your system");}});}}
from_name=fromname;if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
language=CookieStatus.language;divToappend=$jn("#frei_"+id+" .chatboxcontent");uniqueid=FreiChat.unique++;if(id in FreiChat.last_chatmessage_usr_id&&FreiChat.last_chatmessage_usr_id[id]==id){divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage notranslate"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(messages[i].GMT_time)+'</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}else
{divToappend.append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id=msg_'+uniqueid+' class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(messages[i].GMT_time)+'</span><span class="chatboxmessagefrom notranslate">'+from_name+':&nbsp;</span><span onmouseout="FreiChat.hide_original_text_onout('+uniqueid+')" onmouseover="FreiChat.show_original_text_onhover(this)" class="originalmessagecontent notranslate"  style="display:none"  id="frei_orig_'+uniqueid+'">'+freidefines.plugin_trans_orig+'<br/>'+message+'</span><span onmouseout="FreiChat.hide_original_text('+uniqueid+')" onmouseover="FreiChat.show_original_text(this,'+uniqueid+')" class="chatboxmessagecontent">'+message+'</span></div>');}
FreiChat.last_chatmessage_usr_id[id]=id;if(FreiChat.showtranslate=='disabled'||language=='disable'||language=='null'){$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.notransimg));}
else if(reidfrom==id)
{$jn("#msg_"+uniqueid).addClass('notranslate');$jn("#frei_orig"+uniqueid).addClass('notranslate');}
else
{$jn("#frei_orig_"+uniqueid).addClass('iamtobehovered');}
FreiChat.appendtranslate(language,id,['callbyget',uniqueid]);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&0&0");$jn("#frei_"+id+" .chatboxcontent").scrollTop($jn("#frei_"+id+" .chatboxcontent")[0].scrollHeight);}};Array.prototype.in_array=function(value)
{var i;for(i=0;i<this.length;i++)
{if(this[i]==value)
{return true;}}
return false;};FreiChat.get_messages=function()
{if(FreiChat.freistatus=='loggedout')
{return;}
if(FreiChat.freistatus==4||FreiChat.freistatus==3)
{FreiChat.temporary_status++;}
if(FreiChat.first==false){FreiChat.divfrei.html(freidefines.onfoffline);FreiChat.long_poll='false'}
if((FreiChat.inactive==false&&FreiChat.freistatus!=3)||FreiChat.temporary_status>10)
{FreiChat.temporary_status=0;if(FreiChat.RequestCompleted_get_members==true)
{FreiChat.RequestCompleted_get_members=false;FreiChat.set_custom_mesg();var in_room=FreiChat.in_room;if(!$jn('#dc-slick-9').hasClass('active')){in_room=-1;}
$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=getmembers",{xhash:freidefines.xhash,id:freidefines.GEN.getid,first:FreiChat.first,time:FreiChat.time,chatroom_mesg_time:FreiChat.chatroom_mesg_time,'clrchtids[]':[FreiChat.clrchtids],custom_mesg:FreiChat.custom_mesg,long_poll:FreiChat.long_poll,in_room:in_room},function(data){FreiChat.long_poll='true';var userlen=freichatusers.length;var j=0;for(j=0;j<userlen;j++)
{if(data.id_array.in_array(freichatusers[j])===false)
{$jn('#frei_chat_status_'+freichatusers[j]).show().html(freidefines.TRANS.chat_status);}else
{$jn('#frei_chat_status_'+freichatusers[j]).hide();}}
if(data.count==0){FreiChat.divfrei.css("height",freidefines.fnoonlineht);}
else if(data.count==1){FreiChat.divfrei.css("height",freidefines.fone_onlineht);}
else if(data.count>1&&data.count<5){FreiChat.height=data.count*25;FreiChat.divfrei.css("height",FreiChat.height);}
else if(data.count>5){FreiChat.divfrei.css("height",freidefines.fmaxht);}
if(freidefines.PLUGINS.showchatroom=='enabled'){var selected_chatroom=Get_Cookie('selected_chatroom');if(selected_chatroom==null){FreiChat.setCookie('selected_chatroom',FreiChat.in_room);selected_chatroom=1;}
var vari;vari=0;var index;for(vari=0;vari<data.room_array.length;vari++){if(data.room_array[vari].room_id==selected_chatroom){index=vari;}}
if(FreiChat.first===false){if(selected_chatroom!=-1&&selected_chatroom!=1)
FreiChat.loadchatroom(data.room_array[index].room_name,selected_chatroom);}
var room,ai;ai=room=0;for(ai=0;ai<data.chatroom_messages.length;ai++){if(data.chatroom_messages[ai].room_id>=0)
{room=data.chatroom_messages[ai].room_id;FreiChat.chatroom_written[room]=true;}}
FreiChat.append_chatroom_message_div(data.chatroom_messages,'append');FreiChat.room_array=data.room_array;FreiChat.chatroom_users[data.in_room]=data.chatroom_users_div;if(data.in_room!=-1||FreiChat.first==false)
{if(selected_chatroom==1){FreiChat.title=data.room_array[index].room_name;}
FreiChat.usercreator(data.in_room);FreiChat.roomcreator(1);}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}}
FreiChat.clrchtids=[];if(data==null)
{FreiChat.buglog("info","Data is NULL");return;}
FreiChat.first=true;$jn("#frei_user_count").html(data.count);freidefines.GEN.fromname=data.username;freidefines.GEN.reidfrom=data.userid;if(data.time!=null)
{FreiChat.time=data.time;}
if(data.islog=="guesthasnopermissions")
{FreiChat.divfrei.css("height",freidefines.fnopermsht).html(freidefines.nopermsmesg);FreiChat.freistatus='loggedout';FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.invisibleimg));FreiChat.closeAllChatBoxes();FreiChat.chatroom_off();return;}
$jn('#onlusers').html(data.count);FreiChat.ostatus=FreiChat.freistatus=data.status;if(FreiChat.freistatus==0)
{FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();FreiChat.inactive=true;}
else if(FreiChat.freistatus==1)
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.onlineimg));}
else if(FreiChat.freistatus==2)
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.invisibleimg));}
else if(FreiChat.freistatus==3)
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.busyimg));}
else
{FreiChat.buglog("info","freistatus undefined or wrong in freichat/freichat.js on line 261");}
if(data.userdata==null)
{data.userdata=freidefines.nolinemesg;FreiChat.divfrei.html(data.userdata);}
else
{FreiChat.divfrei.html(data.userdata)}
FreiChat.message_append(data.messages);},'json').complete(function(){FreiChat.RequestCompleted_get_members=true;});}}
else if(FreiChat.freistatus==0)
{FreiChat.inactive=true;FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();}
else
{FreiChat.buglog('log','Not possible to eneter this block');}};FreiChat.createChatBox=function(user,id)
{CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&&clear&0&0");var i=0,users_length=freichatusers.length;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==id)
{return;}}
freichatusers.push(id);FreiChat.chatWindowHTML(user,id);if(FreiChat.showtranslate=='disabled'||CookieStatus.language=='disable'||CookieStatus.language=='null'){$jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.notransimg));}};FreiChat.checkChatBoxInputKey=function(event,chatboxtextarea,id,user,option)
{var freiarea=$jn(chatboxtextarea);var message=freiarea.val();var local_in_room=FreiChat.in_room;freiarea.scrollTop(freiarea[0].scrollHeight);message=message.replace(/^\s+|\s+$/g,"");freiarea.val('');if(option==0)
freiarea.css('height','44px');if(message!='')
{message=FreiChat.formatMessage(message,id);message=message.replace(/\r/g,"<br/>");message=message.replace(/,/g,"&#44;");message=message.replace(/\r?\n/g,"<br/>");if(option==0)
{if(FreiChat.isOlduser!=id&&FreiChat.bulkmesg.length>0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,0);}
FreiChat.isOlduser=id;var uniqueid=FreiChat.unique++;if(FreiChat.last_chatmessage_usr_id[id]==freidefines.GEN.reidfrom){$jn("#frei_"+id+" .chatboxcontent").append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id="msg_'+uniqueid+'" class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(0)+'</span><span class="chatboxmessagecontent">'+message+'</span></div>').scrollTop($jn("#frei_"+id+" .chatboxcontent")[0].scrollHeight);}else
{$jn("#frei_"+id+" .chatboxcontent").append('<div onmouseover="FreiChat.show_time('+uniqueid+')"  onmouseout="FreiChat.hide_time('+uniqueid+')" id="msg_'+uniqueid+'" class="chatboxmessage"><span class="freichat_time" id="freichat_time_'+uniqueid+'">'+FreiChat.getlocal_time(0)+'</span><span class="chatboxmessagefrom">'+freidefines.TRANS.chat_message_me+':&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>').scrollTop($jn("#frei_"+id+" .chatboxcontent")[0].scrollHeight);}
FreiChat.last_chatmessage_usr_id[id]=freidefines.GEN.reidfrom;}
else
{FreiChat.chatroom_written[FreiChat.in_room]=true;if(FreiChat.chatroom_changed==true&&FreiChat.bulkmesg.length>0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,1);}
var message_div='';if(FreiChat.last_chatroom_msg_type[FreiChat.in_room]===true){message_div='<div id = "'+local_in_room+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span><p class="triangle-right frei_room_left_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+message+'</span></p><span class="chatroom_messagefrom_left">'+freidefines.TRANS.chat_message_me+'</span></div>';}else{message_div='<div id = "'+local_in_room+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">RIGHT</span><p class="triangle-right frei_room_right_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+message+'</span></p><span class="chatroom_messagefrom_right">'+freidefines.TRANS.chat_message_me+'</span></div>';}
if(freidefines.GEN.reidfrom==FreiChat.last_chatroom_usr_id&&FreiChat.chatroom_written[FreiChat.in_room]==true){$jn('#'+FreiChat.last_chatroom_msg_id).append("<br/>"+message);$jn("#frei_chatroommsgcnt").scrollTop($jn("#frei_chatroommsgcnt")[0].scrollHeight);}else
{$jn("#frei_chatroommsgcnt").append(message_div).scrollTop($jn("#frei_chatroommsgcnt")[0].scrollHeight);FreiChat.last_chatroom_msg_id='room_msg_'+FreiChat.unique;FreiChat.unique++;FreiChat.last_chatroom_usr_id=freidefines.GEN.reidfrom;FreiChat.last_chatroom_msg_type[FreiChat.in_room]=!FreiChat.last_chatroom_msg_type[FreiChat.in_room];}}
FreiChat.bulkmesg.push(message);setTimeout(function(){if(option==0)
{FreiChat.sendMessage(id,FreiChat.bulkmesg,user,0);}else
{FreiChat.sendMessage(local_in_room,FreiChat.bulkmesg,user,1);}},freidefines.SET.mesgSendSpeed);}};FreiChat.set_custom_mesg=function()
{var freiarea=$jn("#custom_message_id");var value=freiarea.val();value=value.replace(/\n/,"&#10;&#13;");$jn(FreiChat.datadiv).data('custom_mesg',value);FreiChat.custom_mesg=value;}
FreiChat.chatWindowHTML=function(user,id)
{FreiChat.frei_box_contain(id);var chatboxtitle=user;var str='<div onmousedown="FreiChat.set_drag(\''+id+'\')" id="frei_'+id+'" class="frei_box">        <div id="chatboxhead_'+id+'">            <div id="frei_trans'+id+'" class="chatboxhead">                <div id="trans_lang">'+FreiChat.langlist(id)+'                </div>                           </div>            <div class="chatboxhead" id="chatboxhead'+id+'">                <div class="chatboxtitle">'+chatboxtitle+'&nbsp;&nbsp;&nbsp;</div>                <div class="chatboxoptions">                                                     <a href="javascript:void(0)" onmousedown="FreiChat.toggleChatBox(\'freicontent_'+id+'\')">        <a href="javascript:void(0)" onmousedown=FreiChat.showXtools(\''+id+'\')><img id="clrcht'+id+'" src="'+FreiChat.make_url(freidefines.arrowimg)+'" alt="-" /></a>&nbsp;<a href="javascript:void(0)" onmousedown="FreiChat.toggleChatBox(\'freicontent_'+id+'\')"><img id="minimgid'+id+'" src="'+FreiChat.make_url(freidefines.minimg)+'" alt="-"/></a> <a href="javascript:void(0)" onmousedown="FreiChat.closeChatBox(\'frei_'+id+'\','+FreiChat.box_count+')">                        <img src="'+FreiChat.make_url(freidefines.closeimg)+'" alt="X" />                    </a>                </div>                <br clear="all"/>            </div>        </div>        <div class="freicontent_'+id+'" id="freicontent_'+id+'">            <div class="chatboxcontent" id="chatboxcontent_'+id+'"></div>            <div class="chatboxinput">  <span class="frei_chat_status" id="frei_chat_status_'+id+'"></span><span id="addedoptions_'+id+'" class="added_options"> '+FreiChat.show_plugins(user,id)+'</span><textarea id="chatboxtextarea'+id+'" class="chatboxtextarea" onkeydown="$jn(this).scrollTop($jn(this)[0].scrollHeight); if (event.keyCode == 13 && event.shiftKey == 0) {javascript:return FreiChat.checkChatBoxInputKey(event,this,\''+id+'\',\''+user+'\',0);}"></textarea>                </div>       </div>    </div>';$jn('#freicontain'+FreiChat.box_count).html(str+$jn('#freicontain'+FreiChat.box_count).html());FreiChat.set_drag(id);$jn('#frei_'+id).bind({click:function()
{FreiChat.change_to_old_title(id);}});$jn('#addedoptions_'+id).hide();$jn("#frei_trans"+id).hide();$jn('#frei_chat_status_'+id).hide();var smileys=$jn('#frei_smileys_'+id);var smile=$jn('#smile_'+id);var isin=false;smile.mouseenter(function(){isin=true;}).mouseleave(function(){isin=false;});$jn(document).click(function(){if(smileys.hasClass('inline')&&isin==false)
{smileys.css('display','none').removeClass('inline').addClass('none');}});};FreiChat.change_to_old_title=function(id)
{if($jn('#chatboxhead'+id).data('interval')=='true')
{$jn('#chatboxhead'+id).data('interval','false');clearInterval(FreiChat.change_titletimer);FreiChat.change_titletimer=null;document.title=FreiChat.oldtitle;$jn('#chatboxhead'+id).css('background-image','url('+FreiChat.make_url(freidefines.btopimg)+')');}}
FreiChat.sendMessage=function(id,message,user,type)
{if(FreiChat.bulkmesg.length>=1)
{if(type==0)
{var CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&nclear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);}
FreiChat.bulkmesg=[];FreiChat.SendMesgTimeOut=0;if(FreiChat.RequestCompleted_send_messages==true)
{FreiChat.RequestCompleted_send_messages=false;$jn.post(freidefines.GEN.url+"server/freichat.php?freimode=post",{passBYpost:FreiChat.passBYpost,time:FreiChat.time,xhash:freidefines.xhash,id:freidefines.GEN.getid,to:id,chatroom_mesg_time:FreiChat.chatroom_mesg_time,message_type:type,'message[]':[message],to_name:user,custom_mesg:FreiChat.custom_mesg,in_room:FreiChat.in_room,GMT_time:FreiChat.getGMT_time()},function(data){freidefines.GEN.fromname=data.username;if(FreiChat.atimeout==null){FreiChat.atimeout=setTimeout("FreiChat.atimeout=null;FreiChat.passBYpost=true;",5000);}
if(data.messages!=null)
{if(data.time!=null)
{FreiChat.time=data.time;}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}
if(freidefines.PLUGINS.showchatroom=='enabled'){FreiChat.append_chatroom_message_div(data.chatroom_messages,'append');}
FreiChat.message_append(data.messages);}},'json').complete(function(){FreiChat.RequestCompleted_send_messages=true;});}}};FreiChat.formatMessage=function(message,id)
{message=message.replace(/\r/g,"<br/>");message=message.replace(/(<([^>]+)>)/ig,"");message=message.replace(/&lt/g,"");message=message.replace(/&gt/g,"");message=message.replace(/\\/g,"");message=message.replace(/((ht|f)t(p|ps):\/\/\S+)/g,'<a href="$1" target="_blank">$1</a>');message=message.replace(/(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)/g,'<a href="mailto:$2@$3">$2@$3</a>');message=message.replace(/'/g,"\'");message=FreiChat.SmileyGenerate(message,id);return message;};FreiChat.toggleChatBoxOnLoad=function(id)
{var idx=id.replace(id,"freicontent_"+id);var status=FreiChat.getCookie(id);if(status.chatwindow_2=="min")
{$jn("#"+idx).hide();$jn("#minimgid"+id).attr('src',FreiChat.make_url(freidefines.maximg));$jn("#addedoptions_"+id).hide();}};FreiChat.toggleChatBox=function(id)
{var idx=id.replace("freicontent_","");var options={};var CookieStatus=FreiChat.getCookie(idx);if($jn("#"+id).is(":visible")==true)
{FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&opened&min&&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#drag_"+id).draggable('disable');$jn("#"+id).hide('clip',options,300);$jn("#minimgid"+idx).attr('src',FreiChat.make_url(freidefines.maximg));$jn("#addedoptions_"+idx).hide();}
else
{FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&opened&max&&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#"+id).show('clip',options,300,function(){$jn("#drag_"+id).dragx({id:idx,handle:"#chatboxhead_"+idx});$jn("#minimgid"+idx).attr('src',FreiChat.make_url(freidefines.minimg));$jn("#frei_"+idx+" .chatboxcontent").scrollTop($jn("#frei_"+idx+" .chatboxcontent")[0].scrollHeight);if($jn(FreiChat.datadiv).data("isvisible")=="true")
{$jn("#addedoptions_"+idx).show();}});}};FreiChat.closeChatBox=function(id,box_pos)
{FreiChat.box_crt[box_pos]=false;var idx=id.replace('frei_','');var CookieStatus=FreiChat.getCookie(idx);FreiChat.setCookie("frei_stat_"+idx,CookieStatus.language+"&closed&max&0&0");var options={};$jn("#"+id).hide('explode',options,1000).remove();var i=0,users_length=freichatusers.length;idx=idx;for(i=0;i<=users_length;i++)
{if(freichatusers[i]==idx)
{freichatusers[i]=0;}}};FreiChat.closeAllChatBoxes=function()
{var i=0;var id=null;var users_len=freichatusers.length;for(i=0;i<=3;i++)
{FreiChat.box_crt[i]=false;$jn('#freicontain'+i).html(null);}
for(i=0;i<=users_len;i++)
{if(freichatusers[i]==undefined||freichatusers[i]==0)
{break;}
else
{id=freichatusers[i];var CookieStatus=FreiChat.getCookie(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&closed&max&0&0");$jn("#frei_"+id).hide();freichatusers[i]=0;id=null;}}};FreiChat.set_drag=function(id)
{var status=FreiChat.getCookie(id);if(status['chatwindow_2']=="min"||freidefines.SET.draggable=='disable')
{$jn("#frei_"+id).draggable('disable');}
else
{$jn("#frei_"+id).dragx({id:id,handle:"#chatboxhead_"+id});}};FreiChat.clrcht=function(id)
{var CookieStatus=FreiChat.getCookie(id);if(CookieStatus.message!="clear")
{FreiChat.clrchtids.push(id);FreiChat.setCookie("frei_stat_"+id,CookieStatus.language+"&opened&max&clear&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);$jn("#frei_"+id+" .chatboxcontent").html("<font size='1' color='#A4A4A4'>"+freidefines.chatHistoryDeleted+"</font>");}
else
{$jn("#frei_"+id+" .chatboxcontent").html("<font size='1' color='#A4A4A4'>"+freidefines.chatHistoryNotFound+"</font>");}};FreiChat.frei_box_contain=function(id)
{if(FreiChat.box_crt[0]==true&&FreiChat.box_crt[1]==true&&FreiChat.box_crt[2]==true&&FreiChat.box_crt[3]==true)
{if(FreiChat.cnt>=4)
{FreiChat.cnt=0;}
FreiChat.closeChatBox("frei_"+FreiChat.box_crt_id[FreiChat.cnt],FreiChat.cnt);FreiChat.box_count=FreiChat.cnt;FreiChat.box_crt_id[FreiChat.cnt]=id;FreiChat.box_crt[FreiChat.cnt]=true;FreiChat.cnt=FreiChat.cnt+1;}
else
{var boxCrt_length=FreiChat.box_crt.length;var i=0;for(i=0;i<=boxCrt_length;i++)
{if(FreiChat.box_crt[i]==false)
{FreiChat.box_crt[i]=true;FreiChat.box_crt_id[i]=id;FreiChat.box_count=i;break;}}}
return FreiChat.box_count;};FreiChat.freichatopt=function(opt)
{var users_length=freichatusers.length;if(FreiChat.ses_status==null)
{FreiChat.freistatus=1;}
if(opt=="nooptions")
{if(FreiChat.freitool.is(":visible")==true)
{FreiChat.freitool.hide();}
FreiChat.freiopt.slideToggle();return;}
else if(opt=="goOffline")
{FreiChat.freistatus=0;FreiChat.mainchat.hide();FreiChat.freiOnOffline.show();for(i=0;i<=users_length;i++)
{$jn("#frei_"+freichatusers[i]).hide();}}
else if(opt=="goOnline")
{FreiChat.freistatus=1;FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.onlineimg));if(FreiChat.mainchat.is(":visible")==false)
{var i=0;FreiChat.mainchat.show();FreiChat.divfrei.html(freidefines.onfoffline);FreiChat.freiOnOffline.hide();for(i=0;i<=users_length;i++)
{$jn("#frei_"+freichatusers[i]).show();}
FreiChat.long_poll='false';}}
else if(opt=="goInvisible")
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.invisibleimg));FreiChat.freistatus=2;}
else if(opt=="goBusy")
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.busyimg));FreiChat.freistatus=3;}
else if(opt=="goTempBusy")
{FreiChat.ursimg.attr('src',FreiChat.make_url(freidefines.busyimg));FreiChat.freistatus=4;}
else
{FreiChat.buglog("info","opt not defined on line 785 in freichat/client/freichat.js");}
if(FreiChat.freistatus!=FreiChat.ostatus)
{$jn.post(freidefines.GEN.url+"server/freichat.php?freimode=update_status",{xhash:freidefines.xhash,id:freidefines.GEN.getid,freistatus:FreiChat.freistatus},function(data){FreiChat.ostatus=FreiChat.freistatus=data.status;},'json');}};FreiChat.freichatTool=function(opt)
{if(opt=="nooptions")
{if(FreiChat.freiopt.is(":visible")==true)
{FreiChat.freiopt.slideUp();}
FreiChat.freitool.slideToggle();}};FreiChat.restore_drag_pos=function()
{$jn("#frei_box").dragx({restore:true,id:freichatusers});};FreiChat.make_url=function(name)
{var backslash="/";if(name.charAt(0)=='/'){backslash="";}
if(name.search('updated')!=-1)
{name=name.replace('updated','').replace(freidefines.SET.theme,'');name='blue_flower/'+name;return freidefines.GEN.url+"client/jquery/freichat_themes/"+name;}
return freidefines.GEN.url+"client/jquery/freichat_themes/"+freidefines.SET.theme+backslash+name;};FreiChat.buglog=function(func,mesg)
{if(FreiChat.debug==true)
{if(func=="log")
{console.log(mesg);}
else if(func=="info")
{console.info(mesg);}
else if(func=="error")
{console.error(mesg);}
else
{console.error("Worng parameter (684)");}}};FreiChat.getCookie=function(id)
{var boxstatus=null;var stat_str=null;var values=[];stat_str=Get_Cookie("frei_stat_"+id);if(stat_str==null)
{stat_str=null+"&closed&min&clear";boxstatus=stat_str.split("&");}
else
{boxstatus=stat_str.split("&");}
values.language=boxstatus[0];values.chatwindow_1=boxstatus[1];values.chatwindow_2=boxstatus[2];values.message=boxstatus[3];values.pos_top=boxstatus[4];values.pos_left=boxstatus[5];return values;};FreiChat.setCookie=function(name,value)
{Set_Cookie(name,value,0,'/','','');};FreiChat.toggle_image=function(imgid,imgsrc)
{imgid++;imgsrc++;};FreiChat.show_plugins=function(user,id)
{var pluginhtml='';if(freidefines.PLUGINS.show_file_send=='true')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.FILE.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.FILE.user=="allow"))
{pluginhtml='<span id="freifilesend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.upload(\''+user+'\',\''+id+'\')"><img id="upload'+id+'" src="'+FreiChat.make_url(freidefines.uploadimg)+'" title='+freidefines.titles_upload+' alt="upload" /> </a></span>';}}
if(freidefines.PLUGINS.showtranslate=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.TRANSLATE.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.TRANSLATE.user=="allow"))
{pluginhtml+='<span id="trans'+id+'"><a href="javascript:void(0)" onmousedown="FreiChat.translate(\''+id+'\')"><img class="translateimage" title="'+freidefines.titles_translate+'" id="translateimage'+id+'" src="'+FreiChat.make_url(freidefines.translateimg)+'" alt="Tranlate" /> </a></span>';}}
pluginhtml+='<a title="'+freidefines.titles_clrcht+'" href="javascript:void(0)" onmousedown="FreiChat.clrcht(\''+id+'\')">                <img id="clrcht'+id+'" src="'+FreiChat.make_url(freidefines.deleteimg)+'" alt="-" />                </a>   ';if(freidefines.PLUGINS.showsmiley=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.SMILEY.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.SMILEY.user=="allow"))
{pluginhtml+='<span id="freismilebox"><span id="frei_smileys_'+id+'" class="frei_smileys none">'+FreiChat.smileylist(id)+'</span>   </span>';pluginhtml+='<a href="javascript:void(0)" title="'+freidefines.titles_smiley+'" onmousedown="FreiChat.smiley(\''+id+'\')">                <img id="smile_'+id+'" src="'+FreiChat.make_url(freidefines.smileyimg)+'" alt="-" />                </a>   ';}}
if(freidefines.PLUGINS.showsave=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.SAVE.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.SAVE.user=="allow"))
{pluginhtml+='<span id="save'+id+'"><a href="'+freidefines.GEN.url+'client/plugins/save/save.php?toid='+id+'&toname='+user+'" target="_blank"><img id="save'+id+'" src="'+FreiChat.make_url(freidefines.saveimg)+'" title="'+freidefines.titles_save+'" alt="save" /> </a></span>';}}
if(freidefines.PLUGINS.showmail=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.MAIL.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.MAIL.user=="allow"))
{pluginhtml+='<span id="mailsend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.sendmail(\''+user+'\',\''+id+'\')"><img id="mail_'+id+'" src="'+FreiChat.make_url(freidefines.mailimg)+'" title='+freidefines.titles_mail+' alt="upload" /> </a></span>';}}
if(freidefines.PLUGINS.showvideochat=='enabled')
{if((freidefines.GEN.is_guest==1&&freidefines.ACL.VIDEOCHAT.guest=="allow")||(freidefines.GEN.is_guest==0&&freidefines.ACL.VIDEOCHAT.user=="allow"))
{pluginhtml+='<span id="videosend'+id+'"><a href="javascript:void(0)" onClick="FreiChat.sendvideo(\''+user+'\',\''+id+'\',1)"><img id="mail_'+id+'" src="'+FreiChat.make_url(freidefines.mailimg)+'" title='+freidefines.titles_mail+' alt="upload" /> </a></span>';}}
return pluginhtml;};FreiChat.statusUpdate=function()
{$jn(document).mousemove(function()
{FreiChat.inact_time=0;if(FreiChat.inactive==true&&FreiChat.freistatus!=0)
{FreiChat.freichatopt("goOnline");FreiChat.inactive=false;}});};FreiChat.showXtools=function(id)
{if($jn(FreiChat.datadiv).data("isvisible")=="true")
{$jn('#addedoptions_'+id).hide();$jn(FreiChat.datadiv).data("isvisible","false");}
else
{$jn('#addedoptions_'+id).show();$jn(FreiChat.datadiv).data("isvisible","true");}
FreiChat.change_to_old_title(id);};FreiChat.selfInvoke=function()
{if(X_init==false)
{$jn=jQuery.noConflict(freidefines['jconflicts']);soundManager.url=freidefines.GEN.url+"client/jquery/img/";$jn(window).load(function(){$jn(document).ready(function(){FreiChat.oldtitle=document.title;FreiChat.statusUpdate();FreiChat.setInactivetime();FreiChat.init_process_freichatX();});});X_init=true;}}();FreiChat.init_chatrooms=function()
{FreiChat.chatroom.dcSlick({location:'left',classWrapper:'frei_chatroom',classContent:'frei_chatroom-content',align:'left',offset:'200px',speed:'slow',classTab:'frei_tab',tabText:'Chat Room',autoClose:true});var selected_chatroom=Get_Cookie('selected_chatroom');if(selected_chatroom==null){selected_chatroom=1;}
FreiChat.in_room=selected_chatroom;FreiChat.my_name='<div></div><div id="frei_userlist" class="frei_userlist" onmouseover="$jn(this).addClass(\'frei_userlist_onhover\');" onmouseout="$jn(this).removeClass(\'frei_userlist_onhover\');"><span class="freichat_userscontentname">'+freidefines.GEN.fromname+'</span></div>';$jn('#frei_userpanel').html(FreiChat.my_name);}
FreiChat.chatroom_off=function(){$jn("#dc-slick-9").hide();}
FreiChat.send_chatroom_message=function(textarea_div){FreiChat.checkChatBoxInputKey(null,textarea_div,null,null,'chatroom');}
FreiChat.usercreator=function(id)
{if(FreiChat.chatroom_users.length>0){if(FreiChat.chatroom_users[id]){$jn('#frei_userpanel').html(FreiChat.chatroom_users[id]);}
if(FreiChat.chatroom_users[id]=="<div></div>")
{$jn('#frei_userpanel').html(FreiChat.my_name);}}}
FreiChat.loadchatroom=function(title,id)
{FreiChat.chatroom_changed=true;var old_room=FreiChat.in_room;FreiChat.in_room=id;FreiChat.title=title;FreiChat.last_chatroom_usr_id=null;FreiChat.setCookie('selected_chatroom',id);FreiChat.roomcreator(title,id);$jn.getJSON(freidefines.GEN.url+"server/freichat.php?freimode=loadchatroom",{xhash:freidefines.xhash,id:freidefines.GEN.getid,first:FreiChat.first,time:FreiChat.time,chatroom_mesg_time:FreiChat.chatroom_mesg_time,custom_mesg:FreiChat.custom_mesg,in_room:id},function(data){if(data.time!=null)
{FreiChat.time=data.time;}
if(data.chatroom_mesg_time!=null)
{FreiChat.chatroom_mesg_time=data.chatroom_mesg_time;}
FreiChat.room_array=data.room_array;FreiChat.chatroom_users[data.in_room]=data.chatroom_users_div;FreiChat.usercreator(data.in_room);for(var i=0;i<data.chatroom_messages.length;i++){}
if(true){FreiChat.append_chatroom_message_div(data.chatroom_messages,'clear');}},'json');}
FreiChat.append_chatroom_message_div=function(messages,type){if(typeof type=='undefined'){type='nclear'}
var message_length=messages.length;var i=0;var message='';var scroll_to_top=false;var div=$jn("#frei_chatroommsgcnt");var first_message=FreiChat.last_chatroom_msg_type[FreiChat.in_room];if(FreiChat.first_message==false){first_message=false;}else
{first_message=true;}
var local_in_room=FreiChat.in_room;var message_type=FreiChat.last_chatroom_msg_type[FreiChat.in_room];if(type=='clear'){div.html('');}else{}
for(i=0;i<message_length;i++){FreiChat.chatroom_written[FreiChat.in_room]=true;if(first_message==true){message_type=true;}
if(messages[i].from==FreiChat.last_chatroom_usr_id&&FreiChat.chatroom_written[FreiChat.in_room]==true){$jn('#'+FreiChat.last_chatroom_msg_id).append("<br/>"+messages[i].message);scroll_to_top=true;}else
{var from_name=messages[i].from_name;if(from_name==freidefines.GEN.fromname){from_name=freidefines.TRANS.chat_message_me;}
if(message_type===true){message='<div id = "'+messages[i].room_id+'_chatroom_message"  class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">LEFT</span><p class="triangle-right frei_room_left_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+messages[i].message+'</span></p><span class="chatroom_messagefrom_left">'+from_name+'</span></div>';}else{message='<div id = "'+messages[i].room_id+'_chatroom_message" class="frei_chatroom_message"><span style="display:none" id="'+local_in_room+'_message_type">RIGHT</span><p class="triangle-right frei_room_right_arrow"><span id="room_msg_'+FreiChat.unique+'" class="frei_chatroom_msgcontent">'+messages[i].message+'</span></p><span class="chatroom_messagefrom_right">'+from_name+'</span></div>';}
div.append(message);scroll_to_top=true;FreiChat.last_chatroom_msg_id='room_msg_'+FreiChat.unique;FreiChat.unique++;first_message=false;FreiChat.last_chatroom_usr_id=messages[i].from;message_type=!message_type;}}
FreiChat.last_chatroom_msg_type[FreiChat.in_room]=message_type;if(scroll_to_top==true){$jn("#frei_chatroommsgcnt").scrollTop($jn("#frei_chatroommsgcnt")[0].scrollHeight);}
FreiChat.first_message=false;}
FreiChat.roomcreator=function(title,id)
{$jn('#frei_roomtitle').html(FreiChat.title);var sel_class='frei_lobby_room';var i=0;var rooms="";for(i=0;i<FreiChat.room_array.length;i++)
{if(FreiChat.in_room==FreiChat.room_array[i].room_id)
{sel_class='frei_selected_room';}
else{sel_class='frei_lobby_room';}
rooms+='<div  class="'+sel_class+'" onmouseover="jQuery(this).addClass(\'frei_chat_userlist_hover\');" onmouseout="jQuery(this).removeClass(\'frei_chat_userlist_hover\');" onclick="FreiChat.loadchatroom(\''+FreiChat.room_array[i].room_name+'\','+FreiChat.room_array[i].room_id+')" >\n\
                    <span class="frei_lobby_room_1">'+FreiChat.room_array[i].room_name+'</span>';if(FreiChat.room_array[i].online_count==0&&FreiChat.in_room==FreiChat.room_array[i].room_id){rooms+='<span class="frei_lobby_room_2">1 online</span>';}
else
{rooms+='<span class="frei_lobby_room_2">'+FreiChat.room_array[i].online_count+' online</span>';}
rooms+='<span class="frei_lobby_room_3"></span>\n\
                    <span class="frei_lobby_room_4"></span>\n\
                    <div style="clear:both"></div></div>';}
$jn('#frei_roompanel').html(rooms);}
/* Updated 16 June 2012 1:07 pm FreiChatX  V.7.2 */