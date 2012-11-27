var FreiChat = {
    
    anim_inprogress:false,
    mesg:'',
    anim_notify_progress:false,
    notify_disappear_time:5000,
    allow_upload:false,
    css_array:[]
}      
//alert(freidefines.GEN.url);
freidefines.GEN.url = freidefines.GEN.url.replace("server/admin.php","");  

FreiChat.make_url = function(name) {
    
    var url = freidefines.GEN.url;  
    var path  = url+"client/jquery/freichat_themes/"+freidefines.GEN.curr_theme+"/"+name;
    return  path;
}

//-------------------------------------------------------------------------------------

FreiChat.rep_img = function(name,id,type,variable,class_sel) {
    
  if(sessionStorage.theme_mode == 'image') {
      if(name == false)return;
    var id2;
    if(variable[2] !== undefined) {
        id2 = variable[2];
    }else{
        id2 = id;
    }
    
  
    $('#upload_div').show().center().data("data",{
        "originalfilename":name,
        "imgid":id,
        "type":type,
        "variable_php":variable[0],
        "variable_js":variable[1],
        "imgid2":id2
    });
    
   // $('#file_input_upload').show().focus(function(){this.click()}).change(function(){
     //   FreiChat.file_upload();
    //});
    
  }else{
  if(class_sel == undefined){alert("class_sel is undefined");return;}
  id = class_sel;
  FreiChat.selected_class = class_sel;
  var arr = FreiChat.css_array;var k_arr;

  if(typeof arr[id] != undefined) {
      k_arr = arr[id];
  }
  else{
      alert('not exists');
      return;
  }
  
  var property;
  var str='<table id ="table_add_style" >';
  //$('#style_rules_content').html('');
  
  
  for(property in k_arr) {
    
    if(k_arr[property].indexOf('<\?php') != -1) continue;     
    str += '<tr  id="tr_style_'+property+'"><td><span class="font_style_rules" >'+property+':</span></td><td><input class="input_style_rules" id="input_style_'+property+'" type="text" value="'+k_arr[property]+'" /></td><td border="none"><span id="close_style_'+property+'" class="close_style_rules"><a title="delete style">X</a></span></td></tr>';
    
    }
      $('#style_rules_content').html(str+"</table>");

  for(property in k_arr) {
    if(k_arr[property].indexOf('<\?php') != -1) continue;          
    (function(ppty){
    $('#input_style_'+property).bind('textchange', function (event, previousText) {
        FreiChat.apply_css('#input_style_'+ppty,ppty,id,previousText)     
    });
    $('#tr_style_'+property).mouseover(function(){
        $('#close_style_'+ppty).show();
    }).mouseout(function(){
        $('#close_style_'+ppty).hide();
    });
    
    $('#close_style_'+property).click(function(){
        FreiChat.delete_style(ppty);
    });
    
    })(property);
  }    
  
  
  $('#style_rules').show();
    if(FreiChat.is_obj_empty(k_arr) == true) {
      $('#table_add_style').html("No styles to display!");
  }
 
 }
}
//-------------------------------------------------------------------------------------
FreiChat.is_obj_empty = function(object) {
    var i;
    for(i in object) {
        if (object.hasOwnProperty(i))
            return false;
    }
  return true;
}
//-------------------------------------------------------------------------------------
FreiChat.delete_style = function(property) {
   $('#tr_style_'+property).css('display','none');
   delete FreiChat.css_array[FreiChat.selected_class][property];//alert(property);
   $(FreiChat.selected_class).css(property,'inherit');
}
//-------------------------------------------------------------------------------------
FreiChat.add_new_style = function() {
    var property =     $.trim($('#property_add_style').val());
    var value    =     $.trim($('#value_add_style').val());
       
    if(property == '' || value == ''){
        FreiChat.notify('you cannot leave the fields empty');
        return;
    }
    else if(FreiChat.css_array[FreiChat.selected_class][property] != undefined){
        FreiChat.notify('property already exists');alert(FreiChat.css_array[FreiChat.selected_class][property]);alert(property);
        return;
    }else{}
    
    
    
    var str = '<tr id="tr_style_'+property+'"><td><span class="font_style_rules" >'+property+':</span></td><td><input class="input_style_rules" id="input_style_'+property+'" type="text" value="'+value+'" /></td><td border="none"><span id="close_style_'+property+'" class="close_style_rules"><a title="delete style">X</a></span></td></tr>';
    $('#table_add_style  tr:last').after(str);
    
    $('#input_style_'+property).bind('textchange', function (event, previousText) {
        FreiChat.apply_css('#input_style_'+property,property,FreiChat.selected_class,previousText)     
    });
    $('#tr_style_'+property).mouseover(function(){
        $('#close_style_'+property).show();
    }).mouseout(function(){
        $('#close_style_'+property).hide();
    });
    
    $('#close_style_'+property).click(function(){
        FreiChat.delete_style(property);
    });
    
    
    FreiChat.css_array[FreiChat.selected_class][property] = value;
    $('#add_new_style_content').hide();
    $(FreiChat.selected_class).css(property,value);
}
//-------------------------------------------------------------------------------------
FreiChat.apply_css = function(div,ppty,css_div,oldval) {
    var val = $(div).val();
    if(oldval == $.trim(val))return;
    $(css_div).css(ppty,val);
    FreiChat.css_array[FreiChat.selected_class][ppty] = val;
}
//-------------------------------------------------------------------------------------
FreiChat.file_upload = function(){
             
    if(FreiChat.allow_upload == false){
        FreiChat.notify('Please select a file to upload!');
        return;
    }         
             
    var fileInput = document.getElementById('file_input_upload');
    var file = fileInput.files[0];        
    
   // $('#progress_upload_file').html('<div>'+file.name+'&nbsp;<progress id="rep_prg" value=0 max=100></progress><span id="rep_upload_status"></span></div>');
    
    //var progress=$('#rep_prg');
    //var status = $("#rep_upload_status");
    var xhr = new XMLHttpRequest();
   /* xhr.upload.addEventListener('progress', function(evt){

        var percent = evt.loaded/evt.total*100;
        $(progress.selector).val(percent);

    }, false);*/
        
    var data = $('#upload_div').data("data");

    xhr.open('POST', 'admin_files/theme_maker/upload.php', true);                       
    xhr.setRequestHeader("Cache-Control", "no-cache");  
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");  
    xhr.setRequestHeader("X-File-Name", file.name);  
    xhr.setRequestHeader("X-File-Size", file.size);  
    xhr.setRequestHeader("X-File-Type", file.type);  
    xhr.setRequestHeader("X-ORIGINAL-FILE-NAME", data.originalfilename);
    xhr.setRequestHeader("X-TYPE",data.type);
    xhr.setRequestHeader("X-VARIABLE-PHP",data.variable_php);
    xhr.setRequestHeader("Content-Type", "application/octet-stream");  
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4)  {
            return;
        }
        
        if(xhr.responseText == 'exceed') {
            FreiChat.notify('file size has exceeded the allowed limit');
        }else if (xhr.responseText == 'type') {
            FreiChat.notify('invalid file type');
        }
        else{
        
        var imgid = data.imgid;
        var imgid2 = data.imgid2;
        var type = data.type;
        var path = freidefines.GEN.url;
        path = path+"client/jquery/freichat_themes/";
        var theme = freidefines.GEN.curr_theme;
        path = path+theme+"/";
        var newimg = xhr.responseText;
        freidefines[data.variable_js] = newimg;
          //  alert(data.js_variable + "  " + freidefines[data.js_variable]  + " = " + newimg);
        if(type == 'img'){
            $('#'+imgid).attr('src',path+newimg);
            if(imgid != imgid2) {
                $('#'+imgid2).attr('src',path+newimg);
            }
        }
        else{
            $('#'+imgid).css('background-image',"url("+path+newimg+")");
            if(imgid != imgid2) {
                $('#'+imgid2).css('background-image',"url("+path+newimg+")");           
            }
        }
      }   
        //$('#upload_div').hide();
        $('#file-upload-status').val('no image selected yet!');
        FreiChat.allow_upload = false;
      
    };
    xhr.send(file);

}
//-------------------------------------------------------------------------------------
FreiChat.switch_visibility = function(current) {
    var ids = ['themelist_div','new_theme_div','rename_theme'];
    var i=0;
    $('#'+current).slideToggle(); 
    
    for(i=0;i<ids.length;i++){
        if(ids[i]  != current){
            $('#'+ids[i]).hide();
        }
    }    
}
//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------

FreiChat.notify = function(mesg) {
  if(FreiChat.anim_notify_progress == true && FreiChat.mesg == mesg)return;
    
  if(FreiChat.anim_notify_progress == true && FreiChat.mesg != mesg){
      $('#notification').html(mesg);
      FreiChat.mesg = mesg;
      FreiChat.notify_disappear_time = FreiChat.notify_disappear_time + 3000;
      return;
  }  
    
    FreiChat.anim_notify_progress = true;
    $('#notification').html(mesg).center().slideDown().css('top','0px').click(function(){
        $('#notification').slideUp();
    }).delay(FreiChat.notify_disappear_time).fadeOut(function(){FreiChat.anim_notify_progress=false;});   
    FreiChat.mesg = mesg;
}
//-------------------------------------------------------------------------------------

FreiChat.restore_defaults = function() {
    var value = confirm('This will undo all your work to your last restore point , \nAre you sure ?');
    if(value == true){
        $.get("admin_files/theme_maker/theme_maker.php?action=restore",function(data){
            window.location.reload(true);
        });
        
    }
}
//-------------------------------------------------------------------------------------

FreiChat.save_theme = function() {
    
    var value = confirm('Once saved your changes cannot be restored , \nAre you sure ?'); 
    
    FreiChat.save_style_changes();
    
    if(value == true){
        $.getJSON("admin_files/theme_maker/theme_maker.php?action=save",function(data) {
            if(data === 'success') {
                FreiChat.notify('restore point set succesfully');
            }else{
                FreiChat.notify('could not set restore point !');
            }
           
        },'json');    
    }
}
//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------
FreiChat.roll_button = function(mode,mode1,mode2,div) {
    
   if(sessionStorage[mode] == undefined) {
       sessionStorage[mode] = mode1[0];
   }

    if(sessionStorage[mode] == mode1[0]){
       if(div[1] != false)
       $('#'+div[1]).hide();         
       $('#'+div[2]).html(mode2[1]);
    }else{
        if(div[0] != false)
        $('#'+div[0]).hide()
        $('#'+div[2]).html(mode1[1]);
    }
   

    $('#'+div[2]).click(function(){
       if(FreiChat.anim_inprogress == false || div[1] == false){           
       if(div[1] !=false)
       FreiChat.anim_inprogress = true; 
       if(sessionStorage[mode] == mode1[0]){
        sessionStorage[mode] = mode2[0];           
        if(div[1] != false){   
         $('#'+div[0]).hide();
         $('#'+div[1]).show('slow',function(){FreiChat.anim_inprogress = false;}); 
         FreiChat.get_css_array();
        }else{
            $('#save_style_changes').show();
        }
        $('#'+div[2]).html(mode1[1]);        
       }else{
        sessionStorage[mode] = mode1[0];    
        if(div[1] != false) {   
         $('#'+div[1]).hide();             
         $('#'+div[0]).show('slow',function(){FreiChat.anim_inprogress = false;});
          FreiChat.get_css_array();
        }else{
            $('#save_style_changes').hide();
        }
        $('#'+div[2]).html(mode2[1]);               
       }
     }
    }); 

}
//-------------------------------------------------------------------------------------
FreiChat.get_css_array = function(){
//alert("k");
    var filename;
    if(sessionStorage.freichat_switch == 'chat') {
        filename = 'css.php';
    }else
        {
            filename = 'chatroom_css.php';
        }
    
     $.getJSON("admin_files/theme_maker/theme_maker.php?action=get_css_array",
     {
       file:filename
   },function(data){console.log(data);
        FreiChat.css_array = data;
     },'json');
  
}
//-------------------------------------------------------------------------------------
FreiChat.save_style_changes = function(){

    var filename;
    if(sessionStorage.freichat_switch == 'chat') {
        filename = 'css.php';
    }else
        {
            filename = 'chatroom_css.php';
        }


    $.post('admin_files/theme_maker/theme_maker.php?action=save_style_changes',
    {
      css_array : FreiChat.css_array,
      file:filename  
    },function(data){
        //console.log(data);
    });
}
/*------------------------------------------------------------------------------------*/