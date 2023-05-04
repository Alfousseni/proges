@php
use Codedge\Fpdf\Fpdf\Fpdf;
//include('/config.php');

//include('class.pdf.php');
 // En-tête
//$choix = htmlspecialchars($_GET['choix']);


     
  // $sq = mysql_query('select * from societe');
 // $lin = mysql_fetch_array($sq); extract($lin);
  
 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');
 // $lin2 = mysql_fetch_array($sql2); extract($lin2);
	
  
 class PDF extends FPDF
{
	
function Header()
{
    // Logo
    //$this->Image('',10,6,30);
    // Police Arial gras 15
    //$this->SetFont('Arial','B',15);
    // Décalage à droite
    //$this->Cell(90);
     //$this->Ln(30);   
	//$this->Cell(1);

    // Titre
    //$this->Cell(40,10,'Fiche fournisseur',1,0,'L');
    // Saut de ligne
    //$this->Ln(60);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

  //ob_end_clean();
ob_clean(); 
//ob_get_contents();
//ob_start();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->setSourceFile('../pdf/entete.pdf');
        // import page 1
    //$tplIdx = $pdf->importPage(1, '/MediaBox');
        // use the imported page and place it at point 10,10 with a width of 100 mm
    //$pdf->useTemplate($tplIdx, 0, 0, 210);
        // now write some text above the imported page 
   $LineWidth = 186;
   $LineHeight = 7;
   $xPos = 10;
   $yPos = 10;
   $colX[0]=10;
   $colX[1]=5;
   $pdf->SetFillColor ( 243, 243, 243 );
   $pdf->SetDrawColor ( 0, 0, 0 );
   $pdf->SetLineWidth(0.4);
   $pdf->setXY (15, $yPos-5);
   $pdf->SetFont ( 'TIMES','', 35);
   $pdf->Ln(10);   
   //$pdf->cell(180,7,"THIAM GENERAL BUSINESS",0,0,"C");
   
   $pdf->SetFont ( 'TIMES','BU', 18 );
   $pdf->Ln(30);   
   $pdf->cell(185,7,"Journal Caisse",0,0,'C');
   $pdf->Ln(15);   

  
   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(15,7,utf8_decode("N°"),1,0,'C');
   $pdf->cell(35,7,utf8_decode("Date "),1,0,'C');
   $pdf->cell(50,7,utf8_decode("Nom "),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Entree"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Sortie"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Montant "),1,0,'C');
   $pdf->Ln();
  
	
     $pdf->SetFont ('TIMES','', 12); 
   foreach($journals as $journal){
    $date= date("d-M-Y", strtotime($journal->created_at)); 
   $pdf->cell(15,7,utf8_decode( $journal['id']),1,0,'C');
   $pdf->cell(35,7,utf8_decode( $date),1,0,'C');
   $pdf->cell(50,7,utf8_decode( $journal['nom_prop']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $journal['montant']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $journal['montant']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $journal['montant']),1,0,'C');
   $pdf->Ln();
}  
foreach($rets as $ret){
    $date= date("d-M-Y", strtotime($ret->created_at)); 
   $pdf->cell(15,7,utf8_decode( $ret['id']),1,0,'C');
   $pdf->cell(35,7,utf8_decode( $date),1,0,'C');
   $pdf->cell(50,7,utf8_decode( $ret['nom_ret']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $ret['montant_ret']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $ret['montant_ret']),1,0,'C');
   $pdf->cell(30,7,utf8_decode( $ret['montant_ret']),1,0,'C');
   $pdf->Ln();
}  

$pdf->Output();

exit();

@endphp




        
