@php
use Codedge\Fpdf\Fpdf\Fpdf;
@include('../pdf/fpdf.php');
@include('../pdf/fpdi.php');
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
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(90);
     $this->Ln(30);   
  $this->Cell(1);

    // Titre
    //$this->Cell(40,10,'Fiche fournisseur',1,0,'L');
    // Saut de ligne
    $this->Ln(60);
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
// Instanciation de la classe dérivée
$pdf = new FPDF();
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
   
   $pdf->SetFont ( 'TIMES','', 16 );
   $pdf->Ln(30);   
   $pdf->cell(180,7,utf8_decode("FICHE FOURNISSEUR N° ").utf8_decode( $fournisseur['numero']),1,0,'C');
   $pdf->Ln(20);   
   $pdf->cell(65,7,"Numero du fournisseur:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['numero']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Nom:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['nom']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Prenom:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['prenom']),0,0,'');
   $pdf->Ln();

   $pdf->cell(65,7,"Compagnie:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['compagnie']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Specialité:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['specialite']),0,0,'');
   $pdf->Ln();

   $pdf->cell(65,7,"Email:",0,0,'');
   $pdf->cell(120,7, $fournisseur['email'],0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Pays:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['pays']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Ville:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['ville']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"telephone:",0,0,'');
   $pdf->cell(120,7, $fournisseur['tel'],0,0,'');
   $pdf->Ln();
   
      
   $pdf->cell(65,7,"Adresse:",0,0,'');
   $pdf->cell(120,7,utf8_decode( $fournisseur['adresse']),0,0,'');
   $pdf->Ln();
      
   $pdf->cell(65,7,"Site web:",0,0,'');
   $pdf->cell(120,7, $fournisseur['site'],0,0,'');
   $pdf->Ln(10);
   $pdf->SetFont ( 'TIMES','', 12);
   $txt = utf8_decode( $fournisseur['info']);  
   $pdf->cell(185,7,utf8_decode("Autres Informations:"),0,0,'C');
   $pdf->Ln();
   $pdf->SetFont ( 'TIMES','', 12);
   $pdf->multicell(185,7,$txt,0,0,'C');
   $pdf->Ln();

   

 
   $pdf->SetFont ( 'TIMES','BIU', 18);
   $pdf->cell(185,7,"SUIVI DU FOURNISSEUR",0,0,'C');
   $pdf->Ln(15);   

  
   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(92.5,7,utf8_decode("Montant total achat"),1,0,'C');
   $pdf->cell(92.5,7,utf8_decode(""),1,0,'C');
   $pdf->Ln();

   $pdf->cell(92.5,7,utf8_decode("Montant total payé"),1,0,'C');
   $pdf->cell(92.5,7,utf8_decode(""),1,0,'C');
   $pdf->Ln();

   $pdf->cell(92.5,7,utf8_decode("Montant total impayé"),1,0,'C');
   $pdf->cell(92.5,7,utf8_decode(""),1,0,'C');
   $pdf->Ln();
$pdf->Output();

exit();

@endphp




        
 
