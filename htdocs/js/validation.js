/*
 * Author:              Kyle Vermeulen, Fishgate
 * Date:                Updated - 2012/09/05
 * Dependencies:        Latest jQuery
 * TODO:                - add options to parse into the document for things like error colour, error types
 *                      - remove the smaller functions and consoldate them into their bigger purposes, e.g. validating a phone number, passwords, etc
 *                      - 
 * 
 */

function reset_all(array){
    for(i=0; i<array.length; i++){
        jQuery('#' + array[i]).val('');
        jQuery('#' + array[i] + '_error').html(''); 
    }
}

function clear_focus(target, defaultVal){
    jQuery('#' + target).focus(function(){
        if(jQuery(this).val() == defaultVal){
            //jQuery(this).css('background-color', '#FFFFFF');
            jQuery(this).val('');
        }
    });
    
    jQuery('#' + target).focusout(function(){
        if(jQuery(this).val() == ''){
            //jQuery(this).css('background-color', '#FFFFFF');
            jQuery(this).val(defaultVal);
        }
    });
}

function validate_checkboxes(target){
    var error = '<div class="bubble-left"></div><div class="bubble-inner">Please make at least 1 selection.</div><div class="bubble-right"></div>';

    jQuery('.' + target).focus(function(){
        jQuery('#' + target + '_error').html('');
    })

    jQuery('.' + target).change(function(){
        jQuery('#' + target + '_error').html('');
    })

    if(jQuery('.' + target).is(':checked')){
        return true;
    }else{
        jQuery('#' + target + '_error').html(error);
        return false;
    }
}

function validate_file(target, array){
    var error = '<div class="bubble-left"></div><div class="bubble-inner">Supported file types: JPEG, GIF, PNG</div><div class="bubble-right"></div>';
    
    jQuery('#' + target).focus(function(){
        jQuery('#' + target + '_error').html('');
    })
    
    jQuery('#' + target).change(function(){
        jQuery('#' + target + '_error').html('');
    })
    
    file = jQuery('#' + target).val();
    
    if(file != ''){
        is_valid = false;

        file_ext = file.substr(file.lastIndexOf('.') + 1);
        file_ext = file_ext.toLowerCase();

        valid_files_array = array;

        for(var i in valid_files_array){
            if(file_ext == valid_files_array[i]){
                is_valid = true;
            }
        }

        if(is_valid){
            return true;
        }else{
            jQuery('#' + target + '_error').html(error);
            return false;        
        }
    }else{
        return true;
    }
}

function validate(target, default_val){
    jQuery('#' + target).focus(function(){
        jQuery('#' + target).css('color', '#333333');
    })
    
    jQuery('#' + target).change(function(){
        jQuery('#' + target).css('color', '#333333');
    })
    
    if(jQuery('#' + target).val() != '' && jQuery('#' + target).val() != default_val){
        return true;
    }else{        
        jQuery('#' + target).css('color', 'red');
        return false;
    }    
}

function valideate_empty_tinymce(target){
    var error = '<div class="bubble-left"></div><div class="bubble-inner">This field is required.</div><div class="bubble-right"></div>';

    if(tinyMCE.get(target).getContent() != ''){
        return true;
    }else{
        jQuery('#' + target + '_error').html(error);
        return false;
    }
}

function validate_length(string, condition){
    if(string.length < condition){
        return false;
    }else{
        return true;
    }
}

function contains_num(string){
    split_string = string.split("");
    
    for(i=0; i<split_string.length; i++){
        if(!isNaN(split_string[i])){
            return true;
        }        
    }
    
    return false;
}

function contains_letter(string){
    split_string = string.split("");
    
    for(i=0; i<split_string.length; i++){
        if(isNaN(split_string[i])){
            return true;
        }        
    }
    
    return false;
}

function validate_password(target){
    var error = '<div class="bubble-left"></div><div class="bubble-inner">Password must be at least 8 characters long and must contain a combination of letters and numbers.</div><div class="bubble-right"></div>';
    
    jQuery('#' + target).focus(function(){
        jQuery('#' + target + '_error').html('');
    })
        
    if(!validate_length(jQuery('#' + target).val(), 8) || !contains_letter(jQuery('#' + target).val()) || !contains_num(jQuery('#' + target).val())){
        jQuery('#' + target + '_error').html(error);
        return false;
    }else{
        return true;
    }
}

function validate_email(target, default_val){    
    var atSymbol = jQuery('#' + target).val().indexOf('@');
    var dot = jQuery('#' + target).val().indexOf('.');
    var lastDot = jQuery('#' + target).val().lastIndexOf('.');
    var length = (jQuery('#' + target).val().length)-1;
    var secondAt = jQuery('#' + target).val().indexOf('@', (atSymbol+1));
    
    jQuery('#' + target).focus(function(){
        jQuery('#' + target).css('color', '#333333');
    })

    if(jQuery('#' + target).val() == '' || jQuery('#' + target).val() == default_val){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(atSymbol < 0){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(atSymbol == 0){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(dot < 0){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(lastDot < atSymbol){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(lastDot >= length){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else if(secondAt > 0){
        jQuery('#' + target).css('color', 'red');
        return false;
    }
    else{
        return true;
    }
}