<?php

/*
 * Author: Kyle Vermeulen, Fishgate
 * Date: Created - 2012/09/06
 * Dependencies: PHP 5
 * Description: Sending of confirmation email to the end user and to Boxyfile. Also stores a record of all requests sent,
 *              this is just for safe keeping and possible future development.
 * TODO:    - Nothing yet!
 * 
 */

//print_r($_POST);

// DB connection-------------------------------------------------------------------------------
require_once 'includes/mysqlcon.inc.php';

// Setup array of all products and thier associated prices ------------------------------------
$products = array (
    'Small File'            => array( 'qty' => $_POST['Small_File'], 'price' => 10.00 ),
    'Large File'            => array( 'qty' => $_POST['Large_File'], 'price' => 16.00 ),
    'Small File Set'        => array( 'qty' => $_POST['Small_File_Set'], 'price' => 120.00 ),
    'Large File Set'        => array( 'qty' => $_POST['Large_File_Set'], 'price' => 120.00 ),
    'Holder Box'            => array( 'qty' => $_POST['Holder_Box'], 'price' => 20.00 ),
    'Document Holder Sheet' => array( 'qty' => $_POST['Document_Holder_Sheet'], 'price' => 0 ),
    'Inside Folder'         => array( 'qty' => $_POST['Inside_Folder'], 'price' => 1.50 ),
    'Temporary Divider'     => array( 'qty' => $_POST['Temporary_Divider'], 'price' => 1.00  )
);

// functions-----------------------------------------------------------------------------------
function twodecimal($number){
    return number_format($number, 2, '.', '');
}

function generate_ref_number(){
    return strtoupper(substr(md5(rand(0, 999)), 0, 6));
}

function get_order_rows($products){
    foreach($products as $prod => $data){
        if($data['qty'] != 0){
            $this_total = $data['price'] * $data['qty'];

            $order_rows .= '
                <tr>
                    <td valign="top">'.$data['qty'].'</td>
                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">'.$prod.'</td>
                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">R'.twodecimal($this_total).'</td>
                </tr>
            ';
        }
    }
    
    return $order_rows;
}

function get_grand_total($products){
    global $grand_total;
    
    // reset grand total for every function call so the number does not increase indefinitly
    $grand_total = 0;
    
    foreach($products as $data){
        $this_total = $data['price']*$data['qty'];
        $grand_total += $this_total;
    }
    
    return twodecimal($grand_total);
}


function get_order_summery($products){
    foreach($products as $prod => $data){
        if($data['qty'] != 0){
            $this_total = $data['price'] * $data['qty'];

            $order_rows .= $data['qty'].' x '.$prod.' = R'.twodecimal($this_total) . '\n';
        }
    }
    
    return $order_rows;
}


// generate ref number-------------------------------------------------------------------------
$ref = generate_ref_number();

// generate order table------------------------------------------------------------------------
//$order_rows = generate_order_rows();

// end user email------------------------------------------------------------------------------
$user_headers = "From: order@boxyfile.co.za" . "\r\n";
$user_headers .= "Reply-To: order@boxyfile.co.za" . "\r\n";
$user_headers .= "MIME-Version: 1.0\r\n";
$user_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$user_to = $_POST['Email_Address'];
$user_subject = 'Boxyfile Order Confirmation – Ref #' . $ref;

$user_message = '
    <table style="width: 100%; background-color:#fff;">
        <tr>
            <td>
                <table style="width: 600px; background-color: #A19885; border: 1px solid #3C332C;" align="center">
                    <tr>
                        <td>
                            <img src="http://i.imgur.com/lz6RX.jpg" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 16px; font-weight:bold; text-align:center; color: #f1f1f1">Thank you for ordering from Boxyfile!</p>
                            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; text-align:center; color: #3C332C; margin: 0; padding: 0;">Your order will be processed once payment is received through either an EFT<br />or direct deposit to the following account:</p>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center" border="1">
                                <tr>
                                    <td style="background-color:#3c332c; padding: 10px; color: #f1f1f1;;" colspan="2">Order Reference #'.$ref.'</td>
                                </tr>
                                
                                <tr>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Account holder:</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">Boxyfile</td>
                                </tr>
                        
                                <tr>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Account number:</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">4077725526</td>
                                </tr>
                        
                                <tr>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Account type:</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">Cheque</td>
                                </tr>
                        
                                <tr>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Bank:</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">ABSA</td>
                                </tr>
                        
                                <tr>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Branch code:</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">63005</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center" border="1">
                                <tr>
                                    <td style="background-color:#3c332c; padding: 10px; color: #f1f1f1;;" colspan="3">Your Order</td>
                                </tr>
         
                                '.get_order_rows($products).'
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><strong>TOTAL:</strong><br /><span style="color: #f1f1f1; font-family:Arial, Helvetica, sans-serif; font-weight: bold;">R'.get_grand_total($products).'</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="background-color:#3c332c; padding: 5px; color: #f1f1f1; text-align:center;">
                            <em>Please use your Order number as reference when making the payment.</em>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding: 5px;">
                            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; text-align:center; color: #3C332C">If you have any queries pertaining to your order, please phone Boxyfile on 0860 105234<br />from Monday to Friday between 8:00 and 16:00,<br />or send an email to <a style="color: #f1f1f1;" href="mailto:order@boxyfile.co.za">order@boxyfile.co.za</a></p>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding: 5px;">
                            <p style="font-family:Arial, Helvetica, sans-serif; font-size: 14px; text-align:center; color: #3C332C">
                                <strong>Kind regards</strong>,<br />The Boxyfile team
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
	</tr>
    </table>
';

// boxyfile email------------------------------------------------------------------------------
$boxy_headers = "From: " . $_POST['Email_Address'] . "\r\n";
$boxy_headers .= "Reply-To: " . $_POST['Email_Address'] . "\r\n";
$boxy_headers .= "MIME-Version: 1.0\r\n";
$boxy_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$boxy_to = 'order@boxyfile.co.za';
//$boxy_to = 'tyrone@fishgate.co.za';
$boxy_subject = 'Boxyfile Order Received – Ref #' . $ref;

$boxy_message = '    
    <table style="width: 100%; background-color:#fff;">
        <tr>
            <td>
                <table style="width: 600px; background-color: #A19885; border: 1px solid #3C332C;" align="center">
                    <tr>
                        <td>
                            <img src="http://i.imgur.com/lz6RX.jpg" />
                        </td>
                    </tr>
           
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center" border="1">
                                <tr>
                                    <td style="background-color:#3c332c; padding: 10px; color: #f1f1f1;;" colspan="2">Client Details</td>
                                </tr>
                        
                                <tr>
                                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Name</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">'.$_POST['Name'].'</td>
                                </tr>
                        
                                <tr>
                                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Phone number</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">'.$_POST['Contact_Number'].'</td>
                                </tr>
                        
                                <tr>
                                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Email Address</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">'.$_POST['Email_Address'].'</td>
                                </tr>
                        
                                <tr>
                                    <td valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#3C332C;">Delivery Address</td>
                                    <td style="font-family:Arial, Helvetica, sans-serif; font-size: 13px; color:#f1f1f1;">'.nl2br($_POST['Delivery_Address']).'</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center" border="1">
                                <tr>
                                    <td style="background-color:#3c332c; padding: 10px; color: #f1f1f1;;" colspan="3">Order Reference #'.$ref.'</td>
                                </tr>
                                
                                '.get_order_rows($products).'
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="padding-bottom: 15px; padding-top: 15px;">
                            <table style="width: 40%;" align="center">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align:right;"><strong>TOTAL:</strong><br /><span style="color: #f1f1f1; font-family:Arial, Helvetica, sans-serif; font-weight: bold;">R'.get_grand_total($products).'</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                    <tr>
                        <td style="background-color:#3c332c; padding-top: 10px; padding-bottom: 10px; color: #f1f1f1; text-align:center;">
                        <em>Please follow up with the client to assist them in paying, so the order can be finalised.</em>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
';

// DB query------------------------------------------------------------------------------------
$query = 'INSERT INTO orders ( 
    ref, 
    name, 
    contact_number, 
    email_address, 
    delivery_address, 
    order_summery, 
    total, 
    date, 
    unix 
) VALUES ( 
    "#'.$ref.'", 
    "'.$_POST['Name'].'", 
    "'.$_POST['Contact_Number'].'", 
    "'.$_POST['Email_Address'].'", 
    "'.$_POST['Delivery_Address'].'", 
    "'.get_order_summery($products).'", 
    "R'.get_grand_total($products).'", 
    "'.date("Y-m-d").'", 
    "'.time().'" 
)';

$result = mysql_query($query) or die(mysql_error());

if($result){
    mail($boxy_to, $boxy_subject, $boxy_message, $user_headers);
    mail($user_to, $user_subject, $user_message, $boxy_headers);
    echo 'success';
}else{
    echo 'fail';
}

?>