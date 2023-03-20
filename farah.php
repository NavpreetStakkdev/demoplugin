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