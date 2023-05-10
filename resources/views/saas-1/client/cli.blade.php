@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Vente;

@include('../pdf/fpdf.php');
@include('../pdf/fpdi.php');

$nom_soc="";
 $mail_soc="";
 $tel_soc="";
 $adres_soc="";
 $logo="";
 
//  foreach($Societ as $soc){
// //$nom_soc ="";
// $nom_soc = $soc['nom_societe'];
// $mail_soc = $soc['email']; 
// $tel_soc = $soc['tel']; 
// $adres_soc = $soc['adresse']; 
// $logo = $soc['logo']; 

//  }

class PDF extends FPDF
{
// En-tête
function Header()
{global $nom_soc, $mail_soc,$logo;
        // Logo
       
       
        $this->setxY(10,$this->GetY());
        // Police Arial gras 15
        $this->Ln(2);
        $this->SetFont('ARIAL','B', 10);
        $this->cell(190, 4, utf8_decode($nom_soc), 0, 5, 'R');
    
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        $this->Cell(40,10,utf8_decode($nom_soc),0,0,'L');
        $this->Ln();  
        $this->Cell(40,10,utf8_decode($mail_soc),0,0,'L');
        
        // Décalage à droite
        $this->Cell(90);
        $this->Ln(30);   
	$this->Cell(1);
	 
        // Titre
        //$this->Cell(40,10,utf8_decode($nom_soc),1,0,'L');
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
//    $pdf->Image('uploads/societe/logo/'.$logo ,'10','10','50','30');

   $pdf->Cell(180,10,utf8_decode($nom_soc),0,0,'R');
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(180,5,utf8_decode('Email: '.$mail_soc),0,0,'R');
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(180,5,utf8_decode('Adresse: '.$adres_soc),0,0,'R');
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(180,5,utf8_decode('Tel: '.$tel_soc),0,0,'R');
  
        
  // $pdf->cell(180,7,"$produit->Societe->nom_societe",0,0,"C");
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
   $txt = utf8_decode($client['adresse']);  
   $pdf->multicell(120,7,$txt,0,0,'');
   //$pdf->cell(120,7,utf8_decode($client['adresse']),0,0,'');
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

    // $ventes=Vente::All()->where('num_client',$client->numero);
    // $nns=$ventes->count();
    // if($nns!=0){
    //     $total=$ventes->sum('prix_ttc');
    //     $payer=$ventes->sum('encaisser');
    //     $reste=$total - $payer;
    //     $pdf->SetFont ('TIMES','', 14);
    //     $pdf->cell(92.5,7,utf8_decode("Montant total achat"),1,0,'C');
    //     $pdf->SetFont ('TIMES','B', 14);
    //     $pdf->cell(92.5,7,utf8_decode("$total"),1,0,'C');
    //     $pdf->Ln();

    //     $pdf->SetFont ('TIMES','', 14);
    //     $pdf->cell(92.5,7,utf8_decode("Montant total payé"),1,0,'C');
    //     $pdf->SetFont ('TIMES','B', 14);
    //     $pdf->cell(92.5,7,utf8_decode("$payer"),1,0,'C');
    //     $pdf->Ln();

    //     $pdf->SetFont ('TIMES','', 14);
    //     $pdf->cell(92.5,7,utf8_decode("Montant total impayé"),1,0,'C');
    //     $pdf->SetFont ('TIMES','B', 14);
    //     $pdf->cell(92.5,7,utf8_decode("$reste"),1,0,'C');
    //     $pdf->Ln();
    // }
    // elseif($nns==0){
    //     $pdf->SetFont ('TIMES','B', 18);
    //     $pdf->cell(185,50,utf8_decode("Aucune vente n'a encore été enregistré pour ce client."),1,0,'C');
    // }
$pdf->Output();
exit();
@endphp

