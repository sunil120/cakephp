<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;
class EmailsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('General');
    }
    
    public function index()
    {
        //$this->viewBuilder()->layout(false);
        //$this->autoRender = false;
        //echo 1;
		$imapPath = '{sg2plcpnl0245.prod.sin2.secureserver.net:993/imap/ssl/novalidate-cert}INBOX';
		$username = 'sunil.kumar@zeksta.com';
		$password = 'Sunil@zeksta';

		// try to connect
		$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
		
		// search and get unseen emails, function will return email ids
		$emails = imap_search($inbox,'UNSEEN');
		$output = '';
		foreach($emails as $mail) {

			$headerInfo = imap_headerinfo($inbox,$mail);
			$output .= $headerInfo->subject.'<br/>';
			$output .= $headerInfo->toaddress.'<br/>';
			$output .= $headerInfo->date.'<br/>';
			$output .= $headerInfo->fromaddress.'<br/>';
			$output .= $headerInfo->reply_toaddress.'<br/>';
			$emailStructure = imap_fetchstructure($inbox,$mail);
			//var_dump($emailStructure->parts);
			if(isset($emailStructure->parts)) {
				 $output .= imap_body($inbox, $mail, FT_PEEK);
			} else {
				//    
			}
		   echo $output;
		   die;
		   $output = '';
		}
		// colse the connection
		imap_expunge($inbox);
		imap_close($inbox);
		print_r($inbox); die;
    }
    
     /**
     * @author: ARS, Gurgaon
     * @method: __concatEmailAddress()
     * @param: email object, 
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: concat all email address comma separated
    **/
    
    public function __concatEmailAddress($data)
    {
        $result = array();
        foreach($data as $key=>$value){
            $result[] = $value->mailbox . '@' . $value->host;
        }
        return implode(',',$result);
    }   
    /**
     * @author: ARS, Gurgaon
     * @method: flatten_parts()
     * @param: $message_parts, $flattened_parts, $prefix, $index, $full_prefix, 
     * @created: 31 March, 2017
     * @createdBy: Anuj Mishra
     * @modified: 31 March, 2017
     * @purpose: it will download only attachments not logo icons etc
    **/
    
    public function flatten_parts($message_parts, $flattened_parts = array(), $prefix = '', $index = 1, $full_prefix = true)
    {
	
        foreach($message_parts as $part)
	{
	    $flattened_parts[$prefix.$index] = $part;
	    if(isset($part->parts))
	    {
		if($part->type == 2)
		{
		    $flattened_parts = $this->flatten_parts($part->parts, $flattened_parts, $prefix.$index.'.', 0, false);
		}
		elseif($full_prefix)
		{
		    $flattened_parts = $this->flatten_parts($part->parts, $flattened_parts, $prefix.$index.'.');
		}
		else
		{
		    $flattened_parts = $this->flatten_parts($part->parts, $flattened_parts, $prefix);
		}
		unset($flattened_parts[$prefix.$index]->parts);
	    }
	    $index++;
	}
	return $flattened_parts;
    }
    
    /**
     * @author: ARS, Gurgaon
     * @method: get_part()
     * @param: $connection, $message_number, $part_number, $encoding, 
     * @created: 31 March, 2017
     * @createdBy: Anuj Mishra
     * @modified: 31 March, 2017
     * @purpose: get_part 
    **/
    
    public function get_part($connection, $message_number, $part_number, $encoding)
    {
	$data = imap_fetchbody($connection, $message_number, $part_number);
	switch($encoding)
	{
	    case 0: return $data; // 7BIT
	    case 1: return $data; // 8BIT
	    case 2: return $data; // BINARY
	    case 3: return base64_decode($data); // BASE64
	    case 4: return quoted_printable_decode($data); // QUOTED_PRINTABLE
	    case 5: return $data; // OTHER
	}
    }
    
    /**
     * @author: ARS, Gurgaon
     * @method: get_filename_from_part()
     * @param: $part, 
     * @created: 31 March, 2017
     * @createdBy: Mudit mohan tyagi
     * @modified: 31 March, 2017
     * @purpose: get_filename_from_part 
    **/
    
    public function get_filename_from_part($part)
    {
        $filename = '';	
        if($part->ifdparameters && $part->ifdparameters && $part->disposition=='ATTACHMENT')
	{
	    foreach($part->dparameters as $object)
	    {
		if(strtolower($object->attribute) == 'filename')
		{
		    $filename = $object->value;
		}
	    }
	}
	if(!$filename && $part->ifparameters && $part->ifdparameters && $part->disposition=='ATTACHMENT')
	{
	    foreach($part->parameters as $object)
	    {
		if(strtolower($object->attribute) == 'name')
		{
		    $filename = $object->value;
		}
	    }
	}
	return $filename;
    }

    public function save_attachment( $content , $filename , $directory_path )
    {
	$file = fopen($directory_path.$filename, 'w');
	fwrite($file, $content);
	fclose($file);
    }    
    
    
    /**
     * @author: ARS, Gurgaon
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: Client Email case download and manipulation
    **/
    public function downloadClientDocumentEmails()
    {

        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        $emailConfig = Configure::read('EMAIL_CONFIG.CLIENT_EMAILED_CASES');       
        $result = $this->moveEmailsFromOneLabelToAnother($emailConfig); 
        $this->downloadEmails($emailConfig);   
        $this->DocEmailHeaders = TableRegistry::get('DocEmailHeaders');
        $this->Client = TableRegistry::get('Client');
        $this->Company = TableRegistry::get('Company');
        $this->loadComponent('MasterFunction');
        $this->loadComponent('General');
        $conditions =  array('EMAIL_TYPE'=>$emailConfig['EMAIL_TYPE'],'STATUS'=>ACTIVE_STATUS);
        $emailHeaderData = $this->DocEmailHeaders->getEmailByConditions($conditions  , $select = ALL);
        if(!empty($emailHeaderData))
        {
            foreach ($emailHeaderData as $emailsDetails)
            {
                $imap = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}'.$emailConfig['CHANGED_LABEL'], $emailConfig['USERNAME'], $emailConfig['PASSWORD']);
                $email_number = imap_msgno($imap, $emailsDetails->EMAIL_UID);
                if($email_number)
                {
                    $domain_name = substr(strrchr($emailsDetails->EMAIL_FROM, "@"), 1);
                    $clientDetails = $this->Client->clientDetailByConditions(array('DOMAIN_NAME'=>$domain_name) , array('CLIENT_ID'));
                    if(!empty($clientDetails))
                    {
                        $client_name = $this->Company->getClientName($clientDetails->CLIENT_ID);
                        $client_name = $this->MasterFunction->removeSpecailCharater($client_name);
                        $directory_path = TMP.time().rand(1,100).DS;
                        exec('mkdir -m 0777 -p "'.$directory_path.'"');
                        $target_path = EMAIL_PORTAL_PATH.$client_name.DS;
                        if($client_name !=''  && is_dir($directory_path) && is_dir($target_path))
                        {
                            $prefix = EMAIL_PORTAL_ATTACHMENT_PREFIX;
                            $response = $this->downloadImap($imap,$email_number,$directory_path , $prefix);
                            if(!empty($response))
                            {
                                $api_responce = $this->General->generateImageApi($directory_path, $target_path);
                                if($api_responce)
                                {
                                    $emailsDetails->STATUS = 2;
                                    $this->DocEmailHeaders->save($emailsDetails);
                                }
                            }
                        }
                        exec("rm -rf {$directory_path}");
                    }
                }
            }
        }
    }

    /**
     * @author: ARS, Gurgaon
     * @method: moveSignOffEmailHeadersIntoDiffrentLabel()
     * @param: No, 
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: Move all email of inbox into another label
    **/
    public function moveEmailsIntoDiffrentLabel()
    {
        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        $emailConfig = Configure::read('EMAIL_CONFIG.SIGNOFF_EMAIL_HEADER');
        $result = $this->moveEmailsFromOneLabelToAnother($emailConfig);
        echo $result;
        exit();
    }
    
    /**
     * @author: ARS, Gurgaon
     * @method: docsEmailHeaders()
     * @param: No, 
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: read all subject from a label of email id and save it into db then move to other label
    **/
    public function signOffEmailHeaders()
    {
        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        $emailConfig = Configure::read('EMAIL_CONFIG.SIGNOFF_EMAIL_HEADER');
        $result = $this->downloadEmails($emailConfig);
        echo $result;
        exit();
    }

    /**
     * @author: ARS, Gurgaon
     * @method: moveEmailsIntoDiffrentLabelInsuff()
     * @param: No, 
     * @created: 07 March, 2016
     * @createdBy: Mudit mohan tyagi
     * @modified: 07 March, 2016
     * @purpose: Move all email of inbox into another label,(this is capypast/edited code,moveEmailsIntoDiffrentLabel)
    **/
    public function moveEmailsIntoDiffrentLabelInsuff()
    {
        // insuff crone one
        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        $emailConfig = Configure::read('EMAIL_CONFIG.INSUFFCIENCY_EMAIL_HEADER');
        $result = $this->moveEmailsFromOneLabelToAnother($emailConfig);
        echo $result;
        exit();
    }
    /**
     * @author: ARS, Gurgaon
     * @method: insuffEmailHeaders()
     * @param: No, 
     * @created: 07 Mar, 2016
     * @createdBy: Anuj Mishra
     * @modified: #
     * @purpose: read all subject from a label of email id and save it into db then move to other label(this is capypast/edited code)
    **/
    public function insuffEmailHeaders()
    {  //this is crone 2
        $this->viewBuilder()->layout(false);
        $this->autoRender = false;
        $emailConfig = Configure::read('EMAIL_CONFIG.INSUFFCIENCY_EMAIL_HEADER');
        $result = $this->downloadEmails($emailConfig);
        echo $result;
        exit();
    }    
     /**
     * @author: ARS, Gurgaon
     * @method: moveSignOffEmailHeadersIntoDiffrentLabel()
     * @param: No, 
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: Move all email of inbox into another label
    **/
    
    public function moveEmailsFromOneLabelToAnother($emailConfig = array())
    {
        $imap = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}'.$emailConfig['ORIGINAL_LABEL'], $emailConfig['USERNAME'], $emailConfig['PASSWORD']);
        $emails = imap_search($imap,'ALL');  
        if(!empty($emails))
	{
            rsort($emails);
            $counter = 0;
            foreach($emails as $email_number)
	    {
                // mark as unread email
                imap_clearflag_full($imap,$email_number, "\\Seen \\Flagged");
                //move email to diffrent label
                imap_mail_move($imap, $email_number, $emailConfig['CHANGED_LABEL']);
                $counter++;      
                
            }
            
            $msg = $counter . " Mails has been moved from label " . $emailConfig['ORIGINAL_LABEL'] . " to label " . $emailConfig['CHANGED_LABEL'];
           
        }
        else
        {
            
            $msg = "No Unread Mail Found";
            
        }
        imap_close($imap,CL_EXPUNGE);
        
        return $msg;
    }
    
    
    
    /**
     * @author: ARS, Gurgaon
     * @method: docsEmailHeaders()
     * @param: No, 
     * @created: 16 Feb, 2017
     * @createdBy: Anuj Mishra
     * @modified: 16 Feb, 2017
     * @purpose: read all subject from a label of email id and save it into db then move to other label
    **/
    
    public function downloadEmails($emailConfig = array())
    {
        $emailConfig = Configure::read('EMAIL_CONFIG.CLIENT_EMAILED_CASES'); 
        $imap = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}'.$emailConfig['ORIGINAL_LABEL'], $emailConfig['USERNAME'], $emailConfig['PASSWORD']);
        $emails = imap_search($imap, 'ALL');
        $counter = 0;
        if(!empty($emails))
	{
            //put the newest emails on top
            //rsort($emails);
            $time = new Time();
            $current_date = $time->format('Y-m-d H:i:s'); 
            $docEmailHeadersTable = TableRegistry::get('DocEmailHeaders');            
            foreach($emails as $email_number)
	    {
                $overview = imap_fetch_overview($imap, $email_number, 0);
                //pr($overview); 
                $header = imap_headerinfo($imap, $email_number); 
               // pr($header); 
                 $structure = imap_fetchstructure($imap, $email_number);
                 $encoding = $structure->encoding;
                  $message = imap_fetchbody($imap, $email_number, 1.2);
                  //echo $message; die;
                  if($message == "")
                  {
                      $message = imap_body($imap, $email_number);
                      if($encoding == 3)
                      {
                          $message = base64_decode($message);
                      }
                      else if($encoding == 4)
                      {
                          $message = quoted_printable_decode($message);
                      }
                  }
               
                $this->set(compact('output'));
                $this->viewBuilder()->templatePath('Element/default');
                $mail_content = $this->render('print_mail_screen');
                $content = $mail_content->body();
                $content = $mail_content->body();
                $header = null;
                $footer = null;
                $html = preg_replace(array('/[^\r\n\t\x20-\x7E\xA0-\xFF]*/'), '', $content);
                $html= str_replace(chr(194),"",$html);         
                //generate html

                $tmp_html_file = "/opt/lampp/htdocs/bridge2.0/webroot/img/test.html";
                $fh = fopen($tmp_html_file, 'w'); //$fh ~~ File Handler
                fwrite($fh, $content);
                
                fclose($fh);
                die;
                $saveData = array();                
                $saveData['MESSAGE_ID'] = $overview[0]->message_id;
                //$saveData['EMAIL_MSGNO'] = $email_number;
                $saveData['EMAIL_UID'] = $overview[0]->uid;
                $saveData['EMAIL_FROM'] = $this->__concatEmailAddress($header->from);
                $saveData['EMAIL_TO'] = $this->__concatEmailAddress($header->to);
                $saveData['EMAIL_CC'] = isset($header->cc) ? $this->__concatEmailAddress($header->to) : NULL;
                $saveData['EMAIL_SUBJECT'] = isset($header->subject) ? $header->subject : "";
                $saveData['EMAIL_RECEIVED_TIME'] = $header->date;
                $saveData['EMAIL_TYPE'] = $emailConfig['EMAIL_TYPE'];
                $saveData['SYNC_DATE_TIME'] = $current_date;               
                $saveData['ORIGINAL_LABEL'] = $emailConfig['ORIGINAL_LABEL']; 
                $saveData['CHANGED_LABEL'] = $emailConfig['CHANGED_LABEL'];
                $docEmailHeaderEntity = $docEmailHeadersTable->newEntity();
                $docEmailHeaderEntity = $docEmailHeadersTable->patchEntity($docEmailHeaderEntity, $saveData);
                //pr($saveData);die;
                if($docEmailHeadersTable->save($docEmailHeaderEntity))
                {
                    // Setting flag from un-seen email to seen on emails ID.
                    imap_setflag_full($imap,$email_number, "\\Seen \\Flagged");
                    $counter++;
                }
            }
        }
        imap_close($imap);
        $result = $counter . " Emails has been downloaded";
        return $result;
    }
    
    /**
     * @author: ARS, Gurgaon
     * @method: emailAttachment()
     * @param: $uid, 
     * @created: 10 March, 2016
     * @createdBy: Mudit mohan tyagi
     * @modified: #
     * @purpose: download,email attachments,unzip ziped attachment and convert all files in pdf then convert that  pdf to jpg img and attachthem to a case
    **/  
   public function emailAttachment($uid,$ars_no)
   {
      $this->viewBuilder()->layout(false);
      $this->autoRender = false;
      $this->loadModel('CaseMaster');
      
      $emailConfig = Configure::read('EMAIL_CONFIG.INSUFFCIENCY_EMAIL_HEADER'); 

      $imap = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}'.$emailConfig['CHANGED_LABEL'], $emailConfig['USERNAME'], $emailConfig['PASSWORD']);
      $email_number = imap_msgno($imap, $uid);
      $attachmentDirSource = RESPONSE_DOCUMENT_PATH.'insuff_attachments/'.$ars_no.'/source/';
      $attachmentDirTarget = RESPONSE_DOCUMENT_PATH.'insuff_attachments/'.$ars_no.'/target/';
      if(is_dir($attachmentDirSource))
      {
        exec('rm -Rf "'.$attachmentDirSource.'"');
        exec('mkdir -m 0777 -p "'.$attachmentDirSource.'"');
        
      }
      else
      {
         exec('mkdir -m 0777 -p "'.$attachmentDirSource.'"');
      }    
      if(is_dir($attachmentDirTarget))
      {
          exec('rm -Rf "'.$attachmentDirTarget.'"');
          exec('mkdir -m 0777 -p "'.$attachmentDirTarget.'"');
      }
      else
      {
          exec('mkdir -m 0777 -p "'.$attachmentDirTarget.'"'); 
      }    

      $response=$this->downloadImap($imap,$email_number,$attachmentDirSource);
      $api_responce = $this->General->generateImageApi($attachmentDirSource,$attachmentDirTarget);
      $case_master=$this->CaseMaster->getCaseDetailsWithChecksByCaseID($ars_no);
     
      if(!empty($case_master))
      {
         
          $this->redirect(['controller'=>'InsufficiencyManagers','action'=>'insuffFullfilEmail',$case_master['CASE_ID'],$uid]);
      }
      else
      {
          $this->Flash->error('Invalid case ars no');
          $this->redirect(['controller'=>'InsufficiencyManagers','action'=>'index']); 
        
      }    

   }
     /**
     * @author: ARS, Gurgaon
     * @method: emailAttachment()
     * @param: $uid, 
     * @created: 10 March, 2016
     * @createdBy: Mudit mohan tyagi
     * @modified: #
     * @purpose: REUABLE MULTIPURPOSE CODE:- download email html content as html and all attachments at given path
    **/  
    public function downloadImap($imap,$email_number,$attachmentDir , $prefix = '')
    {
        $output = array();
        $file_name = array();
        $filename = null;
        $tmp_html_file=null;
        $flag = 0;
        $attachments = array();
        $response_files_array = array();
        $new_file_name = time();
        $directory_path = $attachmentDir;
        if(isset($email_number) && !empty($email_number))
        {
            $header = imap_headerinfo($imap, $email_number);
            $overview = imap_fetch_overview($imap, $email_number, 0);
            $output['subject'] = '-000x';
            if(isset($overview[0]->subject))
            {
              $output['subject'] = $overview[0]->subject;
            }
            $structure = imap_fetchstructure($imap, $email_number);
            

            if(property_exists($structure, 'parts'))
            {
                $flag = 1;
                $flattened_parts = $this->flatten_parts($structure->parts);
                foreach($flattened_parts as $part_number => $part)
                {
                    switch($part->type)
                    {
                        case 0:
                            if((isset($part->subtype)=='PLAIN') && (isset($part->disposition)=='ATTACHMENT'))
                            {
                                  $part_number = 1.1;
                            }
                            else if((isset($part->subtype)=='HTML') && (isset($part->disposition)=='ATTACHMENT'))
                            {
                                  $part_number = 1.2;
                            }
                            else if(isset($part->subtype)=='HTML')
                            {
                                 $part_number = $part_number;
                            }
                            else
                            {
                                 $part_number = $part_number;
                            } 
                            $message = $this->get_part($imap, $email_number, $part_number, $part->encoding);
                       break;
                       case 1: // multi-part headers, can ignore
                       case 2: // attached message headers, can ignore
                       case 3: // application
                       case 4: // audio
                       case 5: // image
                       case 6: // video
                       case 7: // other
                       break;

                    }
                    if(isset($part->disposition) || isset($part->subtype) == "OCTET-STREAM")
                    {
                        $filename = $this->get_filename_from_part($part);
                        if($filename)
                        {       
                            $attchmnt = $this->get_part($imap, $email_number, $part_number, $part->encoding);
                            $file_info = pathinfo($filename);
                            $includeFiels = array('txt','rtf','png','jpeg','jpg','gif','tiff','pdf','doc','docx','xls','xlsx','ppt','odt','html','zip');
                            if(in_array(strtolower($file_info['extension']) , $includeFiels))
                            {
                                $indiFileName = $prefix.mt_rand(1000,9999).time().rand(100,999).'.'.$file_info['extension'];
                                $this->save_attachment($attchmnt, $indiFileName, $attachmentDir);
                                $file_name[] = $indiFileName;
                                $attachments[] = $attachmentDir.$indiFileName;
                            }
                        }
                    }
                }
            }
            else
            {
                  $encoding = $structure->encoding;
                  $message = imap_fetchbody($imap, $email_number, 1.2);
                  //echo $message; die;
                  if($message == "")
                  {
                      $message = imap_body($imap, $email_number);
                      if($encoding == 3)
                      {
                          $message = base64_decode($message);
                      }
                      else if($encoding == 4)
                      {
                          $message = quoted_printable_decode($message);
                      }
                  }   
            }
            $output['to'] = $this->__concatEmailAddress($header->to);
            $output['from'] = $this->__concatEmailAddress($header->from);
            $output['cc'] = isset($header->cc) ? $this->__concatEmailAddress($header->cc) : "";
            $output['reply_to'] = isset($header->reply_to) ? $this->__concatEmailAddress($header->reply_to) : "";
            $output['date'] = date('D, d M Y h:i A', strtotime($overview[0]->date));
            $output['message'] = isset($message) ? $message : "";
            $output['flag'] = $flag;
            $output['attachment'] = $file_name;         
            $this->set(compact('output'));
            $this->viewBuilder()->templatePath('Element/default');
            $mail_content = $this->render('print_mail_screen');
            $content = $mail_content->body();
            $header = null;
            $footer = null;
            $html = preg_replace(array('/[^\r\n\t\x20-\x7E\xA0-\xFF]*/'), '', $content);
            $html= str_replace(chr(194),"",$html);         
            //generate html

            $tmp_html_file = $attachmentDir.$prefix.$new_file_name.".html";
            $fh = fopen($tmp_html_file, 'w'); //$fh ~~ File Handler
            fwrite($fh, $content);
            fclose($fh);
            exec('chmod -R 0777 "'.$attachmentDir.'"');


            $pdf_file = $prefix.$new_file_name.EXT_PDF;
            $image_type = EXT_JPG; 
            exec("wkhtmltopdf -B 18 -L 15 -R 15 -T 18 $tmp_html_file ".$directory_path.$pdf_file." 2>&1", $out, $ret );
            $this->loadComponent('MasterFunction');
            $response_files_array = $this->MasterFunction->_generateImagesFromPdf($directory_path.$pdf_file, $directory_path, $prefix.$new_file_name, $image_type);
       
      }      
      $response_files_array =['generated_html_file_name'=>$pdf_file,'attachments'=>$attachments];
      return $response_files_array;
       
   }        
    
/**End**/   
}
