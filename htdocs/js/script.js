/*
 * Author: Kyle Vermeulen <kyle@source-lab.co.za>
 * Date: Created - 2012/09/05
 * Description: Accordian slider and all form validation + AJAX POST request.
 * 
 */

//ORDER FORM FUNCTIONS-------------------------------------------------------------------- kyle
function get_total(){
    // declare/reset grandtotal on every change of the quantities, this prevents it from growing indefinitly larger when values are removed or edited
    var grandtotal = 0;

    //loop through every quantity input box
    $(".userQTY").each(function(){
        //multiply price per unit (stored in 'data-price' attribute) with total number of units entered. Finally add this to grandtotal
        grandtotal += $(this).val() * $(this).data("price");
    })

    //display grandtotal results
    $("#rands").html("R" + grandtotal.toFixed(2));
}

function disable_alpha_chars(event){
    // allow only backspace (8), delete (46), tab (9), all numerics (48-57), and numeric numpad (96-105) buttons
    exceptions = new Array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 46, 8, 9);
    
    for(i in exceptions){
        //always assume keypress is not allowed unless an exception is found
        allow_key = false;
        
        //determine if the keypress is allowed based on the array of exceptions
        if(event.keyCode == exceptions[i]){
            allow_key = true; 
            //if an exception is found kill the loop here and continue the function
            break
        }
    }
    
    if(!allow_key){
        event.preventDefault(); // ensure that it one of the keypress exceptions or stop the keypress
    }
}

function default_if_empty(){
    // reset value to 0 if input is left empty
    if ($(this).val() == "") { $(this).val(0); }
}

function reset_order_form(){
    $(".userQTY").each(function(){
        $(this).val(0);
    });

    $("#ordername").val("Name:");
    $("#ordercompany").val("Company Name:");
    $("#ordernumber").val("Contact Number:");
    $("#orderemail").val("Email Address:");
    $("#orderaddress").val("Delivery Address:");
}

// SETUP FUNCTIONS------------------------------------------------------------------------------------------ kyle
function hide_all_steps(){
    $(".stepsholder").children().each(function(){
        $(this).hide();
    })
}

function all_btns_grey(){
    $(".stepscontrolsholder ul").children().each(function(){
        $(this).css("background", "#766E61");
    })    
}

function this_btn_orange(){
    $(this).css("background", "#ff6600");
}

function show_related_step(){
    $( $(this).data("rel") ).show();
}

//DOM READY >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
$(document).ready(function() {
    // ACCORDIAN --------------------------------------------------------------------------------- tyrone
    $(".kwicks").kwicks({
        min : 104,
        spacing : 0,
        sticky : true,
        event : 'click'
    });
    
    // SETUP EVENT HANDLERS--------------------------------------------------------------------------- kyle
    $(".stepscontrolsholder ul").children().each(function(){
        $(this).click(function(){
            // there has to be a better way to do this, this feels like brute forcing it into working
            
            all_btns_grey();                            // make all the buttons grey
            $(this).css("background", "#ff6600");      // then make the clicked button orange
            hide_all_steps();                           // hide all of the steps
            $( $(this).data("rel") ).show();           // then show the step related to the clicked button
            
        })
    })
    
    // ORDER FORM EVENT HANDLERS---------------------------------------------------------------------- kyle
    // data typed into form inputs stays when quick refreshing the page in FF & IE7, 8, 9
    // this get_total call calculates a price based on what was previously entered to avoid displaying R0.00 on page refresh
    get_total(); 
    
    $(".userQTY")
        .bind("keyup paste", get_total)
        .bind("keydown", disable_alpha_chars)
        .bind("blur", default_if_empty)
    ;
    
    // only allow numeric characters in the telephone number field
    $("#ordernumber").bind("keydown", disable_alpha_chars);
    
    // clear form fields on focus, and default back when left empty
    clear_focus("ordername", "Name:");
    clear_focus("ordercompany", "Company Name:");
    clear_focus("ordernumber", "Contact Number:");
    clear_focus("orderemail", "Email Address:");
    clear_focus("orderaddress", "Delivery Address:");
    
    
    //validation-------------------------------------------------------------------------------------- kyle
    $(".submitbtn").click(function(){
        console.log('clicked');
        validName =     validate("ordername", "Name:");
        validCompanyName =     validate("ordercompany", "Company Name:");
        validNumber =   validate("ordernumber", "Contact Number:");
        validEmail =    validate_email("orderemail", "Email Address:");
        validAddress =  validate("orderaddress", "Delivery Address:");
        
        if(validName && validCompanyName && validNumber && validEmail && validAddress){
            console.log('form valid');
            // assume no products have being added until conditional check inside of the loop
            has_products = false;
            
            $(".userQTY").each(function(){
                if($(this).val() != 0){
                    // if a field is found to have products, make has_products = true and break the loop
                    has_products = true;
                    return;
                }
            });
            
            if(has_products){
		console.log('has product');
                // form submit------------------------------------------------------------------- kyle
                $.post("process.php", $("#orderform").serialize(), function(data){
                    result = data.trim();
                    
                    console.log(result);
                    
                    if(result == 'success'){
                        reset_order_form();
                        alert('Thank you. Your order is currently being processed. You will receive a confirmation email including payment details shortly.');
                    }
                });
                
            }else{
                // error 2
                alert('Please add a product to your order before submiting your details.');
            }
        }else{
            // error 1
            alert('Please fill out the required form fields correctly.');
        }
    })//$(".submitbtn").click end
        
});
