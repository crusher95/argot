/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M               (c) 2014-2015

FILE DESCRIPTION: EMAIL SUBMISSION SCRIPT v.1.0.4 (CLIENT-SIDE)

*/

(function($){

    "use strict";

    $(document).ready(function() {

        /*** CONFIGURATION ***/

        var contactForm      = $("#contact_form");       // ENTER CONTACT FORM ID/CLASS                
        var contactScript    = "contact.php";            // ENTER PHP CONTACT SCRIPT FILENAME 

        var req_fields       = "Please fill in all the fields.";
        var successStyle     = {"border-color":"green"};
        var failureStyle     = {"border-color":"red"};
        var neutralStyle     = {"border-color":"none"};
        var warningClass     = "alert alert-warning alert-dismissable";
        var warningFadeSpeed = 500;
        var debugMode        = false;                    // CHANGE TO true TO TURN DEBUGGING ON
        var debugDev         = false;                    // CHANGE TO true FOR ADVANCED DEBUGGING. debugMode MUST ALSO true 
        var enableCaptcha    = false;

        /*********************/
                   
        var submitButton     = contactForm.find("#submit_btn");       
        var user_name        = $('#name');             
        var user_email       = $('#email');            
        var user_subject     = $('#subject');          
        var user_message     = $('#message');          
        var user_captcha     = $('#captcha');
        var notice           = $("#notice");   

        /*** DEBUG ***/ if ( debugMode ) console.log( "====== DEBUG MODE ENABLED ======" );     /*** DEBUG ****/

        submitButton.click(function(event){ 

            event.preventDefault();

            var user_name_val    = user_name.val(); 
            var user_email_val   = user_email.val();
            var user_subject_val = user_subject.val();
            var user_message_val = user_message.val();
            var user_captcha_val = user_captcha.val();

            /*** DEBUG ***/ if ( debugMode ) console.log( "[OK] SUBMIT BUTTON CLICKED" );     /*** DEBUG ****/
            /*** DEBUG ***/ if ( debugMode ) { if ( user_name_val == undefined || user_email_val == undefined || user_subject_val == undefined || user_message_val == undefined ) { console.log( "[ERROR] INPUT FIELDS NOT FOUND" ); return false; } } /*** DEBUG ***/

            var output;

            // SIMPLE VALIDATION AT CLIENT'S END 

            var proceed         = true;
            
            if ( notice.is(":visible") ) notice.hide();

            if ( "" == user_name_val || "" == user_email_val || "" == user_subject_val || "" == user_message_val ){

                    /*** DEBUG ***/ if ( debugMode ) console.log( "[WARN] FIELDS ARE EMPTY" );     /*** DEBUG ****/
                   notice.removeClass().html( req_fields ).addClass( warningClass ).fadeIn( warningFadeSpeed );
                   proceed = false;

              }
            
            if ( user_name_val    == "" ) { user_name.css( failureStyle ); proceed = false; } else { user_name.css( successStyle ); }
            if ( user_email_val   == "" || user_email_val.match(/^\S+@\S+\.\S{2,}$/) == null ) { user_email.css( failureStyle ); proceed = false; } else { user_email.css( successStyle ); }
            if ( user_subject_val == "" ) { user_subject.css( failureStyle ); proceed = false; } else { user_subject.css( successStyle ); }
            if ( user_message_val == "" || user_message_val.length < 5 ) { user_message.css( failureStyle ); proceed = false; } else { user_message.css( successStyle ); }
            if ( enableCaptcha ){ if( user_captcha_val == "" ){ user_captcha.css( failureStyle ); proceed = false; } else { user_captcha.css( successStyle ); } };

            // LOOKS GOOD! PROCEED
            if( proceed ) 
            {

                if ( !debugDev ){

                /*** USING $.post() ***/

                    /*** DEBUG ***/ if ( debugMode ) console.log( "[OK] PROCEED WITH AJAX POST" );     /*** DEBUG ***/
                    // DATA TO BE SENT TO SERVER SCRIPT
                    var post_data = {
                        'userName'    : user_name_val, 
                        'userEmail'   : user_email_val, 
                        'userSubject' : user_subject_val, 
                        'userMessage' : user_message_val
                    };
                    if ( enableCaptcha ){ post_data.userCaptcha = user_captcha_val; }

                    // AJAX POST TO SERVER
                    $.post( contactScript, post_data, function(response, status, xhr){  
                        /*** DEBUG ***/ if ( debugMode ) console.log( "STATUS: ", status );     /*** DEBUG ***/
                        /*** DEBUG ***/ if ( debugMode ) console.log( "RESPONSE: ", response ); /*** DEBUG ***/

                        // LOAD JSON DATA FROM SERVER AND OUTPUT MESSAGE
                        if ( response === null ) {
                            /*** DEBUG ***/ if ( debugMode ) console.log( "[ERROR] RESPONSE TYPE: null" );     /*** DEBUG ***/
                            throw new Error("Response null");
                            return false;
                        }
                        if ( response.type == 'error' )
                        {
                            output = response.text;
                            /*** DEBUG ***/ if ( debugMode ) console.log( "[ERROR] RESPONSE TYPE: error. OUTPUT: ", output );     /*** DEBUG ***/
                            notice.removeClass().html(output).addClass( warningClass ).fadeIn( warningFadeSpeed );

                        } else {

                            output = response.text;
                            /*** DEBUG ***/ if ( debugMode ) console.log( "[OK] RESPONSE TYPE: success. OUTPUT: ", output );     /*** DEBUG ***/
                            // RESET ALL INPUT FIELD VALUES
                            contactForm.find("input[type!='submit'], textarea").val("").css( neutralStyle );
                            notice.removeClass().html( output ).addClass( warningClass ).fadeIn( warningFadeSpeed );
                        }
                    }, 'json')
                        .error(function( jqXHR, textStatus, error ){ 
                            /*** DEBUG ***/ if ( debugMode ){
                            console.log("======ERROR======"); 
                            console.log ( "[jqXHR] ->\n", jqXHR, "\n[ TEXT STATUS]->\n", textStatus, "\n[ ERROR THROWN ]->\n", error  ); 
                            console.log("======ERROR======\n");
                            }
                        })
                        .fail(function(data){ 
                            /*** DEBUG ***/ if ( debugMode ) { 
                                console.log( "[ RESPONSE TEXT ]->\n", data.responseText, "\n[ STATUS ]->\n", data.status, data.statusText ); 
                            } 
                        });

                } else {

                /*** USING $.ajax() [DEBUG MODE] ***/

                    console.log( "[OK] PROCEED WITH AJAX POST" );
                    // DATA TO BE SENT TO SERVER SCRIPT
                    var post_data = {
                        'userName'    : user_name_val, 
                        'userEmail'   : user_email_val, 
                        'userSubject' : user_subject_val, 
                        'userMessage' : user_message_val
                    };
                    if ( enableCaptcha ){ post_data.userCaptcha = user_captcha_val; }

                    $.ajax({
                        type: "POST",
                        url: contactScript,
                        data: post_data,
                        dataFilter: function( data, type ){
                            console.log( "\n====== dataFilter ======" );
                            console.log( "dataFilter:", data );
                            console.log( "========================\n" );
                            return data;
                        },
                        success: function(response, status, xhr){  
                            console.log( "\nSTATUS: ", status );     
                            console.log( "RESPONSE: ", response ); 

                            // LOAD JSON DATA FROM SERVER AND OUTPUT MESSAGE
                            if ( response === null ) {
                                console.log( "[ERROR] RESPONSE TYPE: null" );     
                                throw new Error("Response null");
                                return false;
                            }
                            if ( response.type == 'error' )
                            {
                                output = response.text;
                                console.log( "[ERROR] RESPONSE TYPE: error. OUTPUT: ", output );
                                notice.removeClass().html(output).addClass( warningClass ).fadeIn( warningFadeSpeed );

                            } else {

                                output = response.text;
                                if ( debugMode ) console.log( "[OK] RESPONSE TYPE: success. OUTPUT: ", output );
                                // RESET ALL INPUT FIELD VALUES
                                contactForm.find("input[type!='submit'], textarea").val("").css( neutralStyle );
                                notice.removeClass().html( output ).addClass( warningClass ).fadeIn( warningFadeSpeed );
                            }
                        },
                        dataType: 'json'
                    });

                }
                
            } else {
                /*** DEBUG ***/ if ( debugMode ) console.log( "[ERROR] COULD NOT PROCEED WITH AJAX POST" );     /*** DEBUG ***/
            }
        });
        
        // RESET PREVIOUSLY SET BORDER COLORS AND HIDE MESSAGE ON .keyup()
        contactForm.find("input[type!='submit'], textarea").keyup(function(e) { 
            $(this).css( neutralStyle ); 
        });
        
    });

}(jQuery));
