@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Vente;
@include('../pdf/fpdf.php');
@include('../pdf/fpdi.php');

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    //$this->Cell(30,10,'Titre',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


}
 // $sq = mysql_query('select * from societe');
 // $lin = mysql_fetch_array($sq); extract($lin);
  
 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');
 // $lin2 = mysql_fetch_array($sql2); extract($lin2);

  //ob_end_clean();
ob_clean(); 
//ob_get_contents();
//ob_start();
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
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
   $pdf->cell(180,7,utf8_decode("FICHE CLIENT N° ").utf8_decode($client['numero']),1,0,'C');
   $pdf->Ln(20);   
   $pdf->cell(65,7,"Numero Client:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['numero']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Nom:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['nom']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Prenom:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['prenom']),0,0,'');
   $pdf->Ln();

   $pdf->cell(65,7,"Compagnie:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['compagnie']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Email:",0,0,'');
   $pdf->cell(120,7,$client['email'],0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Pays:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['pays']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Ville:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['ville']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"telephone:",0,0,'');
   $pdf->cell(120,7,$client['tel'],0,0,'');
   $pdf->Ln();
   
      
   $pdf->cell(65,7,"Adresse:",0,0,'');
   $pdf->cell(120,7,utf8_decode($client['adresse']),0,0,'');
   $pdf->Ln();
      
   $pdf->cell(65,7,"Site web:",0,0,'');
   $pdf->cell(120,7,$client['site'],0,0,'');
   $pdf->Ln();
  
   $pdf->SetFont ( 'TIMES','', 12);
   $txt = utf8_decode($client['infos']);  
   $pdf->cell(185,7,utf8_decode("Autres Informations:"),0,0,'C');
   $pdf->Ln();
   $pdf->SetFont ( 'TIMES','', 12);
   $pdf->multicell(185,7,$txt,0,0,'C');
   $pdf->Ln();

   $pdf->SetFont ( 'TIMES','BIU', 18);
   $pdf->cell(185,7,"SUIVI DU CLIENT",0,0,'C');
   $pdf->Ln(15);   

    foreach($ventes=Vente::All()->where('num_client',$client->numero) as $vente){
        $total=$vente->prix_ttc;
        $payer=$vente->encaisser;
        $reste=$total - $payer;
        $pdf->SetFont ('TIMES','', 14);
        $pdf->cell(92.5,7,utf8_decode("Montant total achat"),1,0,'C');
        $pdf->SetFont ('TIMES','B', 14);
        $pdf->cell(92.5,7,utf8_decode("$total"),1,0,'C');
        $pdf->Ln();

        $pdf->SetFont ('TIMES','', 14);
        $pdf->cell(92.5,7,utf8_decode("Montant total payé"),1,0,'C');
        $pdf->SetFont ('TIMES','B', 14);
        $pdf->cell(92.5,7,utf8_decode("$payer"),1,0,'C');
        $pdf->Ln();

        $pdf->SetFont ('TIMES','', 14);
        $pdf->cell(92.5,7,utf8_decode("Montant total impayé"),1,0,'C');
        $pdf->SetFont ('TIMES','B', 14);
        $pdf->cell(92.5,7,utf8_decode("$reste"),1,0,'C');
        $pdf->Ln();
    }
$pdf->Output();
exit();
@endphp
        
