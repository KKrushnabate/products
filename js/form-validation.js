/***************     custom js for validation     ******************/


/******common function to display error message*************************/
var close_error_html = '<a href="#" class="alertclose" onclick="javascript:remove_error_box();"><i class="fa fa-times"></i></a>';

function display_error_box(containerid,adderror) {
    var erroralert=adderror.join("<br>");
    if( !$(".alert-box").length ) {
        $('#'+containerid).prepend('<div class="clearfix"></div><div data-alert="" class="alert-box alert"></div>');
    }
    $(".alert-box").show();
    $(".alert-box").addClass( "alert" );
    $(".alert-box").html(erroralert);
    $(".alert-box").prepend(close_error_html);
}
function remove_error_box() {
    $(".alert-box").hide();
}

//End of error message function
/*** function to not allow only zero values in filed *****/ 
function check_iszero(obj){
    
    var data = parseInt($(obj).val());
    
    if(data == 0) {
        $(obj).val("");
    }
    //alert(data);
}



//End of error message function
/*** function to not allow only blank values in filed *****/ 
function iszero(obj){
    var data = $(obj).val();
    if(data == '')
    {
         $(obj).val("0");
    }
    //alert(data);
}


    function displayErrorBoxForField(containerid,adderror,para) {
        var erroralert=adderror.join("<br>");
        if( !$(".alert-box"+para).length ) {
            $('#'+containerid).prepend('<div class="clearfix"></div><div data-alert="" class="alert-box alert-box'+para+' alert'+para+' alert"></div>');
        }
        $(".alert-box"+para).show();
        $(".alert-box"+para).addClass( "alert" );
        var close_error_html = '<a href="#" class="alertclose" onclick="javascript:removeErrorBoxForField(this);"><i class="fa fa-times"></i></a>';
        $(".alert-box"+para).html(erroralert);
        $(".alert-box"+para).prepend(close_error_html); 
    }
    function removeErrorBoxForField(para) {
        $(para).parent().hide();
    }
/*** function to allow only 2 decimal place ****/

function check_isammount(e,obj){
 
        if($.inArray(e.keyCode, [110, 190]) != -1 ){
            var data = $(obj).val();
            var arrdata = data.split(".");//alert(JSON.stringify(arrdata));
            if(data.charAt(0)=="."){
                $(obj).val("0.");
            }
                if( arrdata.length == 0 || arrdata.length>2 ) {
                if(arrdata.length > 2) {
                   // data = data.substr(0, a);
                    data = arrdata[0]+'.'+arrdata[1].substr(0, 2);
                    $(obj).val(data);
                }
            }
                return false;
            
        }else{
            
           var data = $(obj).val();
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                 // Allow: Ctrl+C
                (e.keyCode == 67 && e.ctrlKey === true) ||
                 // Allow: Ctrl+X
                (e.keyCode == 88 && e.ctrlKey === true) ||
                 // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                     // let it happen, don't do anything
                     return;
            }
                        
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || e.keyCode == 32  || data.indexOf('.')) {
                for(var i = data.length-1; i >=  0 ;i--)
                {
                    
                    var len = data.length;
            var index = data.indexOf('.');
            
            if (index > 0) {
            var charAfterdot = (len + 1) - index;
            if (charAfterdot > 4) { 
                var a = data.lastIndexOf(data.charAt(i));
                        if( a != -1 ) {
                            var newdata = data.substr(0, a)+data.substr(a+1);

                            $(obj).val(newdata);data = newdata;
                        }
                //return false;
            }}
                    
                    data = data.split(' ').join('');
                    if ($.isNumeric(data.charAt(i))== false && data.charAt(i) != '.') {
                        //alert(data);
                        var a = data.lastIndexOf(data.charAt(i));
                        if( a != -1 ) {
                            var newdata = data.substr(0, a)+data.substr(a+1);//data.split(data.charAt(i));
                            $(obj).val(newdata);data = newdata;
                        }
                        
                        
                    } 
                    
                }
                
            }
        
        }
    
  }
 
/**** function to allow only alpha numeric values ****/
 
function check_isalphanumeric(e,obj)
{
    var data = $(obj).val();
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
         // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    var regx = /^[a-zA-Z0-9]+$/;
    
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) && (e.keyCode < 65 || e.keyCode > 90) && (e.keyCode < 97 || e.keyCode > 122) || e.keyCode == 32 || e.keyCode == 110 ||e.keyCode == 190 ) {
        
        
        for(var i = data.length-1; i >=  0 ;i--)
        {
            
            data = data.split(' ').join(' ');
            if (!regx.test(data)) {
                //alert(data);
                
                var a = data.lastIndexOf(data.charAt(i));
                if( a != -1 ) {
                    var newdata = data.substr(0, a)+data.substr(a+1);//data.split(data.charAt(i));
                    $(obj).val(newdata);data = newdata;
                }
            }
        }
        
    }

}


//This functions checks last character is dot
function sanitize_float(e,obj)
{      
    var data = $(obj).val();
    if(data == '')
    {
        data = '0';
    }
    if(data.charAt(parseInt(data.length) - 1) == '.')
    {
        newdata = data+'00';
        $(obj).val(newdata);
    }
    else if( (data.indexOf('.') == -1) || parseInt(data) == 0 ) {
        check_iszero(obj);
        if(parseFloat(data)>0) {
        newdata = parseFloat(data).toFixed(2);    
        } else {
        newdata = parseFloat('0.00').toFixed(2);
        }
        $(obj).val(newdata);
    }
    
    
}

//this function to check ';','^' in string
function check_gernalstring(e,obj){
 
    var data = $(obj).val();
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
         // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ( e.keyCode == 59 ||e.keyCode == 54 ) {

        for(var i = data.length-1; i >=  0 ;i--) {
            
            data = data.split(' ').join(' ');
            if (data.charAt(i)==";" || data.charAt(i)=="^") {
            
                var a = data.lastIndexOf(data.charAt(i));
                if( a != -1 ) {
                    var newdata = data.substr(0, a)+data.substr(a+1);//data.split(data.charAt(i));
                    $(obj).val(newdata);data = newdata;
                }
            }
        }
        
    }
}


//This function check the values for only numeric character
function check_isnumeric(e,obj,flag){

    //$(obj).keyup(function (e) {
    //var e = event;
    var allow_int = 1;
    allow_int = (flag == 1 ) ? 1 : 0;
    
    if($.inArray(e.keyCode, [110, 190]) !== -1 ){
        var data = $(obj).val();
        var arrdata = data.split(".");//alert(JSON.stringify(arrdata));    
        if(allow_int == '1'){
            data = arrdata[0];
            $(obj).val(data);
            
        }else{
            if(data.charAt(0) == '.')
            {
                newdata = "0"+data;
                $(obj).val(newdata);
            }
            if( arrdata.length == 0 || arrdata.length>2 ) {
            if(arrdata.length > 2) {
                data = arrdata[0]+'.'+arrdata[1];
                $(obj).val(data);
            }
        }
            return false;
        }
    }else{
        
       var data = $(obj).val();
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || e.keyCode == 32 ) {
            
            for(var i = data.length-1; i >=  0 ;i--)
            {
                data = data.split(' ').join('');
                if ($.isNumeric(data.charAt(i))== false && data.charAt(i) != '.') {
                    //alert(data);
                    var a = data.lastIndexOf(data.charAt(i));
                    if( a != -1 ) {
                        var newdata = data.substr(0, a)+data.substr(a+1);//data.split(data.charAt(i));
                        $(obj).val(newdata);data = newdata;
                    }
                } 
            }
            
        }
    
    }
    
//});
}
   
  
//This function check the values for Mobile Number (Not in use)
function check_ismobile(e,obj){

    var Number =  $(obj).val();
    var filedid = obj.id;
    var IndNum = /^[+91]?[0]?[789]\d{9}$/;
    if(IndNum.test(Number)){
        //do Nothing
    }

    else{
       alert("Please Enter Valid Mobile Number");
       $(obj).val("");
       $("#" + filedid +"_errorlabel").html("Please enter valid Mobile");
       $("#" + filedid).focus();
       return false;
    }
  
}

// This function check the values for Email address 
  
function check_isemail(obj) {
    var email =  $(obj).val();
    var emailid = $(obj).attr('id');
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test(email)) {
        //$(obj).val("");
        $("#" + emailid +"_errorlabel").html("Please enter valid email id");
        $("#" + emailid).focus();
        event.preventDefault();
        return false;
    } else {
        //do Nothing
        return true;
    }
}
 

//add bulk email
function bulk_isemail(email) {
    //var email =  $(obj).val();

    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test(email)) {
        return 1;
    } else {
       return 0;
    }
} 
  
     
// comman validation function for empty field checkeing 
  
$(document).ready(function () {
   
	$("button[type=submit]").click(function(event){
        
        var fields_nf_focus;
        var postval  = $(this).val();
        var postname = $(this).attr("name");
        var formId  = $(this).closest("form").attr('id');
        
        var bulkfrm = ["frmSocUnitsAdd"];
        var error = false;
        var postData = 'null';
        var method = "POST";
        var sucessCallBack = "";
        var failCallBack = "";
        var timeout = "10";
        
        if (formId && $.inArray( formId, bulkfrm)) {
            var alert_msg = "";
            var fields_nf = [];
            var obj_mand  = $('#' + formId).find(":input.mandatory-field");
            var fld_id    = "";
            $('#' + formId).find(":input.mandatory-field").each(function( index ) {
                if ($.trim(obj_mand.eq(index).val()) == "" || $.trim(obj_mand.eq(index).val()) == "0") {
                    fields_nf_focus = obj_mand.eq(index).attr("id");
                    return false;
                }
            }); 
            
            $('#' + formId).find(":input.mandatory-field").each(function( index ) {
                
                var msg_txt = "";
                var msg_re  = "";
                
                var fld_id    = obj_mand.eq(index).attr("id");
                var name = obj_mand.eq(index).attr("name");
                
                var fld_label = $('#' + formId).find("label[for=\"" + fld_id + "\"]").text();
                
                if (fld_label) {
                    var msg_txt = " " + fld_label;
                    var msg_re  = msg_txt.replace('*', '');
                } else {
                    var msg_txt = obj_mand.eq(index).attr("placeholder");
                    var msg_re  = msg_txt.replace('Enter', '');
                }
                    
                if ($.trim(obj_mand.eq(index).val()) != "") {
                    fields_nf = obj_mand.eq(index).attr("id");
                    
                    var data = $('#'+fields_nf).val();
                    $("#" + fields_nf+"_errorlabel").html("");
                }
                    
                    
                if ($.trim(obj_mand.eq(index).val()) == "") 
                {
                    fields_nf = obj_mand.eq(index).attr("id");
                    var data = $('#'+fields_nf).val();
                    
                    
                    $("#" + fields_nf+"_errorlabel").html("Please enter "+msg_re.toLowerCase());
                    error = 'true';
                    
                    $("#" + fields_nf_focus).focus();
                    event.preventDefault();
                }
                else {
                    // email validation
                    if( (name.toLowerCase()).indexOf('email') > -1 && $.trim(obj_mand.eq(index).val()) != "" ) {
                        var email_valid = check_isemail(obj_mand.eq(index));
                        if(email_valid == false){
                            error = 'true';
                        }
                    }
                }
            });

            if (alert_msg != "") {
                alert("Please fill the following mandatory field(s) \n" + alert_msg);
                $("#" + fields_nf[0]).focus();
                event.preventDefault();
            }
            //alert(error);
            if (error == false) {
                event.preventDefault();
                var postData = $("#"+formId).serializeArray();
                ajaxCall(formId, postData, method, sucessCallBack, failCallBack, timeout);
            }
        }
    });


    $(document).on('click','.delete', function(e){
        e.preventDefault();
        if(confirm("Are you sure you want to delete!")){
           var controllername   = $("#controllername").val();
           
           var delete_id = $(this).prop("id");
           var deleteid = delete_id.split("_")[1];
           var uri = $("#baseUrl").val()+"/"+controllername+"/delete/"+deleteid;
            $.ajax({
                url: uri,
                method: 'POST',
                crossDomain: true,
                success: function (data) {
                    var arrErrorMessages = jQuery.parseJSON(data);
                    alert(arrErrorMessages['success']);
                    if(arrErrorMessages['success'] == true) {
                        location.reload();
                    } else {
                        if(arrErrorMessages["error_message"].length > 0){
                        $("#deletemessage").html(arrErrorMessages['error_message'].join("<br/>"));
                }
            }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        }
    });
});

function defaultFail(req, error) {
	if (error === 'error') {
		error = req.statusText;
	}
	var errormsg = 'There was a communication error: ' + error;
	if (window.console) { console.log(errormsg);}	
}

/**
 * Wrapper method to make ajax call
 * 
 * @param id -
 *            In case of form id of form else null
 * @param url -
 *            Required, URL to make ajax request
 * @param sucessCallBack -
 *            Optional, success responce handler method name required one
 *            parameter
 * @param postData -
 *            Optional, Data to submit through get and post i.e.
 *            key=value&key1=value1&.....
 * @param method -
 *            Optional, POST/GET default GET
 * @param failCallBack -
 *            Optional, call fail handler method name needed three params
 * @param timeout
 *            Optional, default is 3*3000 millisecond
 * @return callback
 */
function ajaxCall(id, postData, method, sucessCallBack, failCallBack, timeout) {
	
	var sucessCall = sucessCallBack != 'null' ? sucessCallBack : defaultSuccess;
	var pData = postData != 'null' ? postData : '';
	var methodType = method != 'null' ? method : 'GET';
	var failCall = failCallBack != 'null' ? failCallBack : defaultFail;
	var time = timeout != 'null' ? timeout : (3 * 3000);
	var data = [];
	if (pData != '') {
		$.each(pData, function(index, value) {
			var dataObj = new Object;
			dataObj.name = index;
			dataObj.value = value;
			data.push(dataObj);
		});
	}
    
	if (id != 'null') {
		data = $('#' + id).serializeArray();
	}

    var obj = array.filter(function(obj){
        return obj.name === id
    })[0];
	
    var uri = obj['value'];

    $.ajax({
        url: uri,
        method: 'POST',
        crossDomain: true,
        data: data,
        beforeSend: function (xhr) {
            $('.icon'+id).addClass('ace-icon fa fa-spinner fa-spin orange bigger-125');
        },
        success: function (data) {
            var arrErrorMessages = jQuery.parseJSON(data);
                
            if(arrErrorMessages['success'] == true) {
                location.href = obj['redirect'];
                
            /*$('.icon'+id).removeClass('ace-icon fa fa-spinner fa-spin orange bigger-125');
            $('.alert-box').html('<div class="alert alert-block alert-success">\
                    <button type="button" class="close" data-dismiss="alert">\
                        <i class="ace-icon fa fa-times"></i>\
                    </button>\
                    <p>\
                        <strong>\
                            '+data.successMsg+'\
                        </strong>\
                    </p>\
                </div>');
                $("#"+id)[0].reset();*/
            } else {
                if(arrErrorMessages["error_message"].length > 0){
                    $("#"+id).find(".error_show").html(arrErrorMessages['error_message'].join("<br/>"));
                }
                /*$('.icon'+id).removeClass('ace-icon fa fa-spinner fa-spin orange bigger-125');
                $('.alert-box').html('<div class="alert alert-block alert-danger">\
                    <button type="button" class="close" data-dismiss="alert">\
                        <i class="ace-icon fa fa-times"></i>\
                    </button>\
                    <p>\
                        <strong>\
                            '+arrErrorMessages['error_message']+'\
                        </strong>\
                    </p>\
                </div>');*/
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr, ajaxOptions+"<br>"+ thrownError);
        }
    });
}

//to get max date in dd/mm/yy format for transaction module
function get_date() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    return today = dd+'/'+mm+'/'+yyyy;
}

//to change min date in dd/mm/yy format for transaction module

function change_format(min_date) {
    var dateAr = min_date.split('-');
    var  newDate = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
    return newDate;
}
