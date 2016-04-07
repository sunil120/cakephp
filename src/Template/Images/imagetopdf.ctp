<?php
$html = $this->Html->image($image->thumb_link);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, 14, PDF_MARGIN_RIGHT,true);
$pdf->AddPage();
@$pdf->writeHTML($html);
$pdf->Output($image->name.'.pdf', 'D');
