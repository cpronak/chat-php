<!DOCTYPE html><!--[if lt IE 7 ]><html lang="en" id="top" class="no-js ie6"><![endif]--><!--[if IE 7 ]><html lang="en" id="top" class="no-js ie7"><![endif]--><!--[if IE 8 ]><html lang="en" id="top" class="no-js ie8"><![endif]--><!--[if IE 9 ]><html lang="en" id="top" class="no-js ie9"><![endif]--><!--[if (gt IE 9)|!(IE)]><!--><html lang="en" id="top" class="no-js"><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lessohome Live Chat</title>
	<meta name="description" content="Lessohome Live Chat" />
	<meta name="keywords" content="Lessohome Live Chat" />
	<meta name="robots" content="NOINDEX,NOFOLLOW" />
	<link rel="stylesheet" href="<?php echo base_url('skin/front/css/common.css'); ?>">
	<script src="<?php echo base_url('skin/front/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('skin/front/js/common.js'); ?>"></script>
</head>
<body>
<div id="LiveHelpEmbedded" class="online opened" style="display: block;">
    <div class="sprite embed LiveChatIcon">
        <div class="LiveHelpOnlineIcon" style="display: block;">
            <div class="OperatorImage"></div>
        </div>
    </div>
    <div class="LiveHelpOperator">
        <div class="OperatorImage"></div>
    </div>
    <div class="icon-chat">
        <svg class="nc-icon outline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="22px" viewBox="0 0 48 48"><g transform="translate(0, 0)">
                <path stroke-linecap="butt" stroke-linejoin="miter" data-cap="butt" data-color="color-2" stroke-width="2" stroke-miterlimit="10" d="M15.665,33.167l-0.068,0.034
                      C18.183,37.22,23.652,40,30,40c1.179,0,2.326-0.102,3.432-0.284L42,44v-8.081c2.482-2.114,4-4.881,4-7.919
                      c0-3.104-1.57-5.91-4.148-8.041"></path>
                <path stroke-linejoin="miter" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M22,2
                      C10.954,2,2,9.163,2,18c0,3.594,1.499,6.9,4,9.571V38l9.665-4.833C17.658,33.7,19.783,34,22,34c11.046,0,20-7.163,20-16
                      S33.046,2,22,2z"></path>
            </g></svg>
    </div>
    <div id="LiveHelpStatusText" class="light">Live Chat</div>
    <div id="LiveHelpLogo"></div>
    <div id="LiveHelpCampaign"></div>
    <div class="right-sideclose">
        <div id="LiveHelpCloseButton" title="Close" class="CloseButton embed light collapse" style="display: block;">        
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="27px" height="30px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
                <g transform="translate(0, 0)">
                    <line fill="none" stroke="#999999" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="39.333" y1="24" x2="8.667" y2="24"></line>
                </g>
            </svg>               
        </div>
        <div id="LiveHelpCloseBlockedButton" class="close">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
                <g transform="translate(0, 0)">
                    <line fill="none" stroke="#999999" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="36.75" y1="11.25" x2="11.25" y2="36.75"></line>
                    <line fill="none" stroke="#999999" stroke-width="3" stroke-linecap="square" stroke-miterlimit="10" x1="36.75" y1="36.75" x2="11.25" y2="11.25"></line>
                </g>
            </svg>
        </div>
    </div>

    <div id="LiveHelpNotification" class="sprite Notification"><span></span></div>
    <div id="LiveHelpTab" class="TabBackground" style="background-color: rgb(38, 194, 129); width: 100%;">

    </div>
    <div class="OperatorBackground">
        <div id="LiveHelpOperatorImage"></div>
        <div class="sprite OperatorForeground"></div>
        <div id="LiveHelpOperatorNameBackground">
            <div id="LiveHelpOperatorName"></div>
            <div id="LiveHelpOperatorDepartment"></div>
        </div>
    </div>
    <div id="LiveHelpBody">
        <div id="LiveHelpBackground" class="ChatBackground"></div>
        <div id="LiveHelpCollapseButton" title="Expand" class="sprite Expand"></div>
        <div id="LiveHelpSignedIn">
            <div id="LiveHelpScroll">
                <div id="LiveHelpWaiting" data-lang-key="thankyoupatience" style="display: none;">Please wait, connecting you with one of our team members now.</div>
                <div id="LiveHelpMessages"></div>
                <div id="LiveHelpMessagesEnd">
                    <div id="LiveHelpClosedChatMessage">Chat Closed <a href="#">Restart Chat</a></div>
                </div>
            </div>
        </div>
        <div id="LiveHelpConnecting">
            <div class="connecting-container">
                <div class="connecting-text">Connecting</div>
            </div>
        </div>
        <div id="LiveHelpSignIn">
            <!--<div id="LiveHelpSignInDetails">Welcome! Please continue to start chatting.<br/>Please enter your details below to continue.</div>-->
            <div id="LiveHelpBlockedChatDetails" style="display:none">Your chat session has been blocked by the customer representative.</div>
            <div id="LiveHelpDeptOfflineMsg" style="display:none;color:red"></div>
            <div id="LiveHelpError">
                <div id="LiveHelpErrorIcon" class="sprite Cross"></div>
                <div id="LiveHelpErrorText">Invalid Email Address.</div>
            </div>
            <div id="LiveHelpLogin" class="LiveHelpLogin">
                <div id="Inputs">
                    <div class="NameLabel">
                        <div class="LiveHelpInput">
                            <input id="LiveHelpNameInput" type="text" tabindex="100" placeholder="Full Name">
                            <div id="LiveHelpNameError" title="Name Required" class="sprite InputError"></div>
                        </div>
                    </div>
                    <div class="EmailLabel">
                        <div class="LiveHelpInput">
                            <input id="LiveHelpEmailInput" type="text" tabindex="101" placeholder="Email">
                            <div id="LiveHelpEmailError" title="Email Required" class="sprite InputError"></div>
                        </div>
                    </div>
                    <div id="LiveHelpDepartmentLabel"><div class="deparment-box">Department<br>
                            <div class="LiveHelpDepartment" style="margin-top: 5px;">                            
                                <div id="LiveHelpDepartmentRadioContainer"><div class="lievchat-Offline deptbox0"><input type="radio" value="LessoHome" name="LiveHelpDepartmentInputRadio" id="LiveHelpDepartmentInputRadioId_0" class="LiveHelpDepartmentclass" style="width:10px !important;" checked="checked"><label for="LiveHelpDepartmentInputRadioId_0" id="LiveHelpDepartmentInputRadioId_0_label">LessoHome</label><span class="online_offline">Offline</span></div><div class="lievchat-Online deptbox1"><input type="radio" value="Procurement" name="LiveHelpDepartmentInputRadio" id="LiveHelpDepartmentInputRadioId_1" class="LiveHelpDepartmentclass" style="width:10px !important;"><label for="LiveHelpDepartmentInputRadioId_1" id="LiveHelpDepartmentInputRadioId_1_label">Procurement</label><span class="online_offline">Online</span></div><div class="lievchat-Offline deptbox2"><input type="radio" value="Trade Guarantee" name="LiveHelpDepartmentInputRadio" id="LiveHelpDepartmentInputRadioId_2" class="LiveHelpDepartmentclass" style="width:10px !important;"><label for="LiveHelpDepartmentInputRadioId_2" id="LiveHelpDepartmentInputRadioId_2_label">Trade Guarantee</label><span class="online_offline">Offline</span></div></div>
                                <div id="LiveHelpDepartmentError" title="Department Required" class="sprite InputError"></div>
                            </div><br></div>
                    
                    <div class="QuestionLabel">
                        <div class="LiveHelpInput">
                            <textarea id="LiveHelpQuestionInput" tabindex="103" placeholder="Question?"></textarea>
                            <div id="QuestionError" title="Question Required" class="sprite InputError"></div>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 10px">
                        <div id="LiveHelpConnectButton" class="button" tabindex="104">START CHATTING</div>
                        <!--<div id="LiveHelpConnectButton" class="button" tabindex="104">Connect</div>-->
                    </div>
                </div>
                <div id="BlockedChat" style="display:none; text-align:center">
                    <div style="margin-top:5px; left:15px">
                        <div style="font-family: 'Source Sans Pro', sans-serif; padding:5px 0; text-shadow:0 0 1px #ccc; letter-spacing:-1px; font-size:22px; line-height:normal; color:#999">Access Denied<br>Blocked Chat Session</div>
                        <div style="text-align: center; margin: 10px 0">
                            <div id="LiveHelpCloseBlockedButton" class="button">Close Chat</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div id="LiveHelpSocialLogin">
                <div>or</div>
                <div id="LiveHelpTwitterButton" class="sprite Twitter"></div><br/><div id="LiveHelpFacebookButton" class="sprite Facebook"></div>
            </div>-->
            <a href="https://www.chatstack.com" target="_blank" class="brand" style="display: none"><div></div></a>
        </div>
    </div>
    <div id="LiveHelpToolbar">
        <div id="LiveHelpEmailChatToolbarButton" title="Email Chat" class="sprite Email"></div>
        <div id="LiveHelpSoundToolbarButton" title="Toggle Sound" class="sprite SoundOn"></div>
        <div id="LiveHelpSwitchPopupToolbarButton" title="Switch to Popup Window" class="sprite Popup"></div>
        <div id="LiveHelpFeedbackToolbarButton" title="Feedback" class="sprite Feedback"></div>
        <div id="LiveHelpDisconnectToolbarButton" title="Disconnect" class="sprite Disconnect"></div>
    </div>
    <div id="LiveHelpInput" class="MessageBackground">
        <div id="LiveHelpTyping">
            <div class="sprite Typing"></div>
            <span></span>
        </div>
        <textarea id="LiveHelpMessageTextarea" placeholder="Type your message and press Enter to send"></textarea>
        <div id="LiveHelpSmiliesButton" title="Smilies" class="sprite SmilieButton"></div>
        <div id="LiveHelpSendFileButton" class="sprite SmilieButton"></div>
        <div id="LiveHelpSendButton" class="sprite SendButton">
            <div>Send</div>
        </div>
        <a href="https://www.chatstack.com" target="_blank" class="brand" style="display: none"><div></div></a>
    </div>
    <div id="SmiliesTooltip"><div><span title="Laugh" class="sprite Laugh"></span><span title="Smile" class="sprite Smile"></span><span title="Sad" class="sprite Sad"></span><span title="Money" class="sprite Money"></span><span title="Impish" class="sprite Impish"></span><span title="Sweat" class="sprite Sweat"></span><span title="Cool" class="sprite Cool"></span><br><span title="Frown" class="sprite Frown"></span><span title="Wink" class="sprite Wink"></span><span title="Surprise" class="sprite Surprise"></span><span title="Woo" class="sprite Woo"></span><span title="Tired" class="sprite Tired"></span><span title="Shock" class="sprite Shock"></span><span title="Hysterical" class="sprite Hysterical"></span><br><span title="Kissed" class="sprite Kissed"></span><span title="Dizzy" class="sprite Dizzy"></span><span title="Celebrate" class="sprite Celebrate"></span><span title="Angry" class="sprite Angry"></span><span title="Adore" class="sprite Adore"></span><span title="Sleep" class="sprite Sleep"></span><span title="Quiet" class="sprite Stop"></span></div></div>
    <iframe id="LiveHelpFileDownload" name="FileDownload" frameborder="0" height="0" width="0"></iframe>
    <div id="LiveHelpFileTransfer"><div id="FileTransferActionText" class="sprite FileTransferActionText"></div><div class="FileTransferDropTarget"><div id="FileTransferText"></div></div></div>
    <div id="LiveHelpDisconnect">
        <div id="LiveHelpDisconnectTitle">Are you sure that you wish to disconnect?</div><br>
        <span>Disconnecting will close the current chat session.  You can request a new chat from the Online / Offline chat button if you have further questions at a later time.</span>
        <div id="LiveHelpDisconnectButton" class="flat-button blue">Disconnect</div>
        <div id="LiveHelpCancelButton" class="flat-button white">Cancel</div>
    </div>
</div></div>
</body>
</html>


<?php /* <h1>Login</h1>
<?php echo validation_errors(); ?>
<?php echo form_open('user') ?>
  User Name : <input type="input" name="name"/><br />
  Email : <input type="input" name="email"/><br />
  Department : <input type="radio" value="LessoHome" name="department" />LessoHome</t>
  <input type="radio" value="Procurement" name="department" />Procurement</t>
  <input type="radio" value="Trade Guarantee" name="department" />Trade Guarantee</br>
  <input type="submit" name="submit" value="Log in"/>
<?php echo form_close(); ?>
*/ ?>