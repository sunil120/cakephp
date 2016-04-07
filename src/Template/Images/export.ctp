<?php
 $this->CSV->addRow('Id','Name','Link');
 foreach ($images as $image)
 {
   $line = array($image->id,$image->name , $image->link);
   $this->CSV->addRow($line);
 }
 $filename='images';
 echo  $this->CSV->render($filename);
?>