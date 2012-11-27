//------------------------------------------------------------------------------
/*  The SMILEY plugin !*/
FreiChat.smiley = function(id)
{

    var smileys = $jn('#frei_smileys_'+id);

    if(smileys.hasClass('none'))
    {
        smileys.css('display','inline')
        .removeClass('none')
        .addClass('inline');
    }
    else
    {
        smileys.css('display','none')
        .removeClass('inline')
        .addClass('none');
    }
};
//------------------------------------------------------------------------------
FreiChat.smileylist = function(id)
{
    var str;
    if(freidefines.thememaker == true) {
         str= '<span class="langlist">'+FreiChat.mksmileyurl([':)',':(',':B',':\')',':laugh:',':cheer:',';)',':P',':angry:',':unsure:',':ohmy:',':huh:',':dry:',':lol:',':silly:',':woohoo:'], id)+'</span>';
    }else{
     str= '<span class="langlist">'+FreiChat.mksmileyurl([':)',':(',':B',':\')',':laugh:',':cheer:',';)',':P',':angry:',':unsure:',':ohmy:',':huh:',':o',':0',':dry:',':lol:',':D',':silly:',':woohoo:'], id)+'</span>';
    }
    return str;

};
//------------------------------------------------------------------------------
FreiChat.mksmileyurl = function(name,id)
{
    var namelen = name.length;
    var i=0;
    var str = '<tr>';
    var j=0;

    for(i=0; i<=namelen; i++)
    {
        if(name[i] == null || name[i] == undefined)
        {
            break;
        }

        if(j>=5)
        {
            str+='</tr><tr>';
            j=0;
        }
        
        var action;
        
        if(freidefines.thememaker == true) {
             action = ''
        }else{
             action = 'onmousedown=FreiChat.appendsmiley("'+name[i]+'","'+id+'")';
        }

        str += '<a href="javascript:void(0)" '+action+' >'+FreiChat.SmileyGenerate(name[i],id)+'</a>&nbsp;';
        j++
    }
    //alert('<table><td>'+str+'</td></table>');
    return '<table><td>'+str+'</td></table>';
};
//------------------------------------------------------------------------------
FreiChat.appendsmiley = function(name,id)
{
    var area = $jn('#chatboxtextarea'+id);

    $jn('#frei_smileys_'+id).css('display','none')
    .removeClass('inline')
    .addClass('none');

    area.val(area.val()+name+" ");
};



FreiChat.SmileyGenerate = function(messages,id)
{
    var replaced_mesg=messages;

    replaced_mesg = replaced_mesg.replace(/:\)/g,'<img id="smile__'+id+'" src="'+FreiChat.make_url(freidefines.smiley_smileimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:\'\)/g,'<img id="cry_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_cryimg)+'" alt="samile" />');
    replaced_mesg = replaced_mesg.replace(/B\)/g,'<img id="cool_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_coolimg)+'" alt="samile" />');
    replaced_mesg = replaced_mesg.replace(/:B/g,'<img id="cool_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_coolimg)+'" alt="samile" />');
    replaced_mesg = replaced_mesg.replace(/:\(/g,'<img id="sad_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_sadimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:laugh:/g,'<img id="laughing_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_laughingimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:cheer:/g,'<img id="cheerful_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_cheerfulimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/;\)/g,'<img id="wink_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_winkimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:P/g,'<img id="tongue_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_tongueimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:angry:/g,'<img id="angry_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_angryimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:unsure:/g,'<img id="unsure_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_unsureimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:ohmy:/g,'<img id="shocked_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_shockedimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:huh:/g,'<img id="wassat_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_wassatimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:o/g,'<img id="shocked_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_shockedimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:0/g,'<img id="shocked_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_shockedimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:dry:/g,'<img id="ermm_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_ermmimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:lol:/g,'<img id="grin_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_grinimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:D/g,'<img id="grin_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_grinimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:silly:/g,'<img id="silly_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_sillyimg)+'" alt="smile" />');
    replaced_mesg = replaced_mesg.replace(/:woohoo:/g,'<img id="w00t_'+id+'" src="'+FreiChat.make_url(freidefines.smiley_w00timg)+'" alt="smile" />');

    return replaced_mesg;
};
/*  The SMILEY plugin !*/
//------------------------------------------------------------------------------
/*  The MAIL plugin !*/

FreiChat.sendmail = function(user,id)
{
    FreiChat.toid=id;
    FreiChat.touser=user;

    var left   = (screen.width  - 450)/2;
    var top    = (screen.height - 250)/2;

    window.open(freidefines.GEN.url+"client/plugins/mail/html.php",'mailWindow','width=450,height=250,top='+top+',left='+left);
};
/*  The MAIL plugin !*/
//------------------------------------------------------------------------------
/*  The TRANSLATE plugin !*/
FreiChat.changelang = function (lang,id)
{
    var CookieStatus = FreiChat.getCookie(id);

    if(lang == 'disable')
    {
        FreiChat.setCookie( "frei_stat_"+id, "disable&opened&"+CookieStatus.chatwindow_2+"&"+CookieStatus.message+"&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);
        $jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.notransimg));
        $jn("#frei_trans"+id).slideToggle('slow');
    }
    else
    {
        $jn("#translateimage"+id).attr('src',FreiChat.make_url(freidefines.translateimg));
        FreiChat.setCookie( "frei_stat_"+id, lang+"&opened&"+CookieStatus.chatwindow_2+"&"+CookieStatus.message+"&"+CookieStatus.pos_top+"&"+CookieStatus.pos_left);
        $jn("#frei_trans"+id).slideToggle('slow');
    }
};
//------------------------------------------------------------------------------
FreiChat.translate = function(id)
{
    $jn("#frei_trans"+id).slideToggle();
};
//------------------------------------------------------------------------------
FreiChat.langlist = function(id)
{
    var str= '<span class="langlist">'+FreiChat.makelangurl(['en','de','zh','cy','tr','uk','ru','it','ja','el','iw','fr','gl','ar'], id)+'<br/><a href="javascript:void(0)" onmousedown=FreiChat.changelang("disable",\''+id+'\')>'+freidefines.plugin_trans_disable+'</a>&nbsp;</span>';
    return str;
};
//------------------------------------------------------------------------------
FreiChat.makelangurl = function(name,id)
{
    var namelen = name.length;
    var i=0;
    var str = '';
    for(i=0; i<=namelen; i++)
    {
        if(name[i] == null || name[i] == undefined)
        {
            break;
        }
        str += '<a href="javascript:void(0)" onmousedown=FreiChat.changelang("'+name[i]+'",\''+id+'\')>'+name[i]+'</a>&nbsp;';
    }
    return str;
};
//------------------------------------------------------------------------------
FreiChat.appendtranslate = function(language,id,arr)
{
    var div = null;
    if(arr[0] == 'callbyget')
    {
        div = $jn('#msg_'+arr[1]);
        div.translate(language,{
            not:'.notranslate'
        });
    }
    else
    {
        div = $jn("#frei_"+id+" .chatboxcontent");
        if(arr == null || arr == '')
        {
            div.translate(language,{
                not:'.notranslate'
            });
        }
        else
        {
            div.translate(language,{
                not:'.notranslate'
            });

        }

    }

};
//------------------------------------------------------------------------------
FreiChat.show_original_text = function(me,id)
{
    var show_by_delaying = function(){

        var pos = $jn(me).position();

        if($jn("#frei_orig_"+id).hasClass('iamtobehovered'))
        {
            $jn("#frei_orig_"+id).css( {
                "left": (pos.left-30) + "px",
                "top":(pos.top-50)+"px" ,
                "display" : "block"
            } );
        }
    };

    FreiChat.timer = setTimeout(show_by_delaying,500);
};
//------------------------------------------------------------------------------
FreiChat.show_original_text_onhover = function(me)
{
    if($jn(me).hasClass('iamtobehovered'))
    {
        $jn(me).addClass('iambeinghovered');
    }
    
 
};
//------------------------------------------------------------------------------
FreiChat.hide_original_text = function(id)
{
    var a = function(){
        if(!$jn("#frei_orig_"+id).hasClass('iambeinghovered'))

        {
            $jn("#frei_orig_"+id).css("display","none");
        }
    };
    setTimeout(a,500);
    clearTimeout(FreiChat.timer);
};
//------------------------------------------------------------------------------
FreiChat.hide_original_text_onout = function(id)
{

    var hide_by_delaying= function(){

        $jn("#frei_orig_"+id).removeClass('iambeinghovered');
        $jn("#frei_orig_"+id).css("display","none");
    };

    setTimeout(hide_by_delaying,500);

};
/*  The TRANSLATE plugin !*/
//------------------------------------------------------------------------------
/*  The UPLOAD plugin !*/
FreiChat.upload = function(user,id)
{
    FreiChat.toid=id;
    FreiChat.touser=user;
    var left   = (screen.width  - 400)/2;
    var top    = (screen.height - 200)/2;

    window.open(freidefines.GEN.url+"client/plugins/upload/html.php",'uploadWindow','width=400,height=200,top='+top+',left='+left);
};
/*  The UPLOAD plugin !*/
//------------------------------------------------------------------------------
/*  The VIDEO plugin !*/
FreiChat.sendvideo = function(user , id, accept)
{
    var message="";
    if(accept==1){
        message ='This is a video chat request <a href="#" target="_blank" onClick=\'FreiChat.sendvideo("'+freidefines.GEN.fromname+'","'+freidefines.GEN.reidfrom+'")\' >Click here to accept</a>';
        $jn("#frei_"+id+" .chatboxcontent")
        .append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+freidefines.GEN.fromname+':&nbsp;</span><span class="chatboxmessagecontent">A video chat request has been sent</span></div>')
        .scrollTop($jn("#frei_"+id+" .chatboxcontent")[0].scrollHeight);

    }
    else{
        message ='Video chat request has been accepted <a href="#"  target="_blank" >Click here to chat</a>';
    }

    //alert(message);




    $jn.post(freidefines.GEN.url+"server/freichat.php?freimode=post", {
        passBYpost:FreiChat.passBYpost,
        time:FreiChat.time,
        xhash:freidefines.xhash,
        id:freidefines.GEN.getid,
        to: id,
        message_type:1,
        'message[]': [message],
        to_name: user,
        custom_mesg:FreiChat.custom_mesg
    } , function(data){
        freidefines.GEN.fromname = data.username;

    },'json');


}
/*  The VIDEO plugin !*/
//-------------------------------------------------------------------------------
/* Time */

FreiChat.getlocal_time = function(GMT_time) {
    
    
    
    if(GMT_time == 0){
        GMT_time = FreiChat.getGMT_time();   
    }    
       
    var d = FreiChat.Date;
    var offset = d.getTimezoneOffset()*60000;
    var timestamp = GMT_time - offset;
        
    var dTime = new Date(timestamp);
    var hours = dTime.getHours();
    var minute = dTime.getMinutes();
    
    if(minute < 10) {
        minute = "0"+minute;
    }
    /*
    var period = "AM";
    if (hours > 12) {
        period = "PM"
    }
    else {
        period = "AM";
    }*/
    //hours = ((hours > 12) ? hours - 12 : hours)
    return hours + ":" + minute + " ";// + period
}
//-----------------------------------------------------------------------------------------------
FreiChat.getGMT_time = function() {
    
    var d = new Date();
    var localtime = d.getTime();
    var offset = d.getTimezoneOffset()*60000;
    return localtime + offset;
}
//-----------------------------------------------------------------------------------------------
FreiChat.show_time = function(id){
    $jn("#freichat_time_"+id).css("visibility","visible");
}
//-----------------------------------------------------------------------------------------------
FreiChat.hide_time = function(id){
    $jn("#freichat_time_"+id).css("visibility","hidden");
}
//-----------------------------------------------------------------------------------------------
/* Time */
/* profile link */

FreiChat.show_profilelink = function(id) {
   $jn("#freichat_profile_link_"+id).css("visibility","visible");
   $jn("#freichat_user_"+id).addClass('freichat_userlist_hover');
}
FreiChat.hide_profilelink = function(id) {
   $jn("#freichat_user_"+id).removeClass('freichat_userlist_hover'); 
   $jn("#freichat_profile_link_"+id).css("visibility","hidden");
}


/* profile link */