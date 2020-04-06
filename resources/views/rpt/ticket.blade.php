<?php

        class MYPDF extends TCPDF
        {

            public function Footer() {
                // Position at 15 mm from bottom
                $this->SetY(-15);
                // Set font
                $this->SetFont('helvetica', 'I', 8);
                // Page number
                $this->Cell(0, 10, '           Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            }

        }

        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Maika Kanaka');
        $pdf->SetTitle('HelpdeskReport');
        $pdf->SetSubject("");

        // remove default header/footer
        $pdf->setPrintHeader(false);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();

        $html = "
            <h1> Report Helpdesk </h1>

            <table border=\"1\" cellspacing='0' cellpadding='1'>
                <thead>
                    <tr>
                        <th> Code </th>
                        <th> Date Request </th>
                        <th> Category </th>
                        <th> Subject </th>
                        <th> Description </th>
                        <th> Priority </th>
                        <th> Status </th>
                    </tr>
                </thead>

                <tbody>
        ";

        foreach ($tickets as $key => $value) {
            $html .= "
                <tr>
                    <td> ". $value->ticket_code ." </td>
                    <td> ". $value->created_at ." </td>
                    <td> ". $value->category_name ." </td>
                    <td> ". $value->ticket_title ." </td>
                    <td> ". $value->ticket_desc ." </td>
                    <td> ". $value->ticket_priority ." </td>
                    <td> ". $value->ticket_status ." </td>
                </tr>
            ";
        }

        $html .= "
                </tbody>
            </table>
        ";

        $pdf->writeHTML($html, true, false, false, false, '');

        // // content
        // $first_word_old = '';
        // foreach($guests as $kg => $vg)
        // {
        //     $first_word = substr($vg->fullname, 0, 1);
        //     if($first_word_old != $first_word){
        //         if($kg != 0){
        //             $pdf->Ln(9);
        //         }

        //         $pdf->SetFont($ubuntuFontBold, '', 22, '', false);
        //         $pdf->SetTextColor(94, 167, 230);
        //         $html = "~ " . strtoupper( $first_word );
        //         $pdf->writeHTMLCell(0, 14, '', '', $html, 0, 1, 0, true, '', true);
        //     }
        //     $first_word_old = $first_word;

        //     $pdf->SetFont($ubuntuFontBold, '', 12, '', false);
        //     $pdf->SetTextColor(119, 119, 119);
        //     $html = $vg->fullname;
        //     $html .= !empty($vg->address) ? " ~ " . $vg->address : "";
        //     $pdf->writeHTML($html, false, false, true, false);
        //     $pdf->SetFont($ubuntuFontReguler, '', 12, '', false);
        //     $msg = !empty($vg->impression) ? $vg->impression : 'no message';
        //     $html = ":&nbsp;&nbsp; ``$msg``";

        //     if($show_donation == 'show'){
        //         $pdf->writeHTML($html, false, false, true, false);
        //     }else{
        //         $pdf->writeHTML($html, true, false, true, false);
        //     }

        //     if($show_donation == 'show'){
        //         $pdf->SetFont($ubuntuFontUnderline, '', 12, '', false);
        //         $html = "&nbsp;&nbsp; Rp. ". number_format($vg->donation, 0, ",", ".");
        //         $pdf->writeHTML($html, true, false, true, false);
        //     }

        //     $pdf->Ln(2);
        // }

        $pdf->Output('guest_report.pdf', 'I');
        exit;
