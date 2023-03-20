<?php
function send_email($to=[],$cc=[],$bcc=[],$subject='',$body='',$attachment=[]){
    if(empty($to)){
        return 'please specify to whom i send';
    }
    $smtp=$this->connect();
    foreach($to as $address){
    $smtp=$smtp->addTo($address);
    }
    foreach($cc as $address){
        $smtp=$smtp->addCC($address);
    }
    foreach($bcc as $address){
        $smtp=$smtp->addBCC($address);
    }

    if($subject!=''){
        $smtp= $smtp->setSubject('Welcome!'); //check if prev value has to be stored and given as object or not
    }
    if($body!=''){
        $smtp= $smtp->setBody('Hello you!');
    }
    $smtp= $smtp->send(); //check if msg is send or not see return value of it
    $smtp->disconnect();

}

//pop3
//get email list
//input-none
//output-return list of all emails present in all folders

// problem-you may want to get email list of specific folder but pop3 does not work on folder structure and does not have any inbuilt function for it
// solution- use my custom function get_email_list_folder

//get email list folder
// input- string of folder name (optional, default folder is Inbox) eg INBOX for inbox folder, Inbox.sents for sent folder, INBOX.drafts for Drafts and so on
// output- return email list of certain folder

//problem- pop3 does not understand folders. hence we can not get folder list in it. 
// solution- Use my custom function get_folder_list. U only get those folders in return which has atleast one email in it. Therefore to get all folders, u need to put dummy email in each folder.

//get email content
//input- unique identifier of email msg ie id (required)
// output- return email contents in associative array format if email is present else return 'email not present'

//get folder list
// input- none
// output- return folders which has atleast one email in it.



//imap
//get email list
// input- string of folder name(optional, default folder is Inbox) eg INBOX for inbox folder, Inbox.sents for sent folder, INBOX.drafts for Drafts and so on
// output- return email list of certain folder


//get email content
//input- unique identifier of email msg ie id (required)
// output- return email contents in associative array format if email is present else return 'email not present'

//get folder list. as imap knows about folders in mail server. therefore this function uses inbuilt function of imap to get folder list and exactly those values
// input- none
// output- return folders list .



//smtp
// input- array of reciever email addresses(required ie at least one address has to be present), 
//        array of addresses to which carbon copy of this msg is sent(pass empty array if not any),
//        array of addresses to which blind carbon copy of this msg is sent(pass empty array if not any),
//        subject-string, 
//        body-string,
//        array of files absolute path in file system to add those files as attachments
// output-        





