@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Mouvement;
use App\Models\User;
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
    $this->Cell(30,10,'Titre',1,0,'C');
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

  //ob_end_clean();
ob_clean(); 
//ob_get_contents();
//ob_start();

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->setSourceFile('../pdf/entete.pdf');
        // import page 1
  //  $tplIdx = $pdf->importPage(1, '/MediaBox');
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

	if(isset($_GET['id'])){
   $id = $_GET['id'];  

   $pdf->SetFont ( 'TIMES','', 14 );
   $pdf->Ln(30);   
   $pdf->cell(185,7,utf8_decode("LISTE DES MOUVEMENTS"),1,0,'C');
   $pdf->Ln(15);

   $user=User::findOrFail($id); 
   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(30,7,utf8_decode("Utilisateur:"),"",0,'');
   $pdf->cell(50,7,utf8_decode($user['name']),"",0,'');
   $pdf->Ln(15);   
  
   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(20,7,utf8_decode("N°"),1,0,'C');
   $pdf->cell(25,7,utf8_decode("Date"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Référence"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Commande"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Provenance"),1,0,'C');
   $pdf->cell(30,7,utf8_decode("Prix achat"),1,0,'C');
   $pdf->cell(20,7,utf8_decode("Qté"),1,0,'C');
   $pdf->Ln();
  

	 $pdf->SetFont ('TIMES','', 8);
	 $mouvements= Mouvement::all()->where('editorial',$user->email)->sortBy('created_at');   
	 $j=0;
	 $nns= $mouvements->rowCount();
	 if($nns!=0){
   	 $j++;
		foreach($mouvements as $mouvement){
   $pdf->cell(20,7,utf8_decode($j),1,0,'C');
   $pdf->cell(25,7,utf8_decode($mouvement['created_at']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($mouvement['reference']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($mouvement['numcmd']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($mouvement['numdest']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($mouvement['prix_achat']),1,0,'C');
   $pdf->cell(20,7,utf8_decode($mouvement['qte_stock']),1,0,'C');
   $pdf->Ln();
		}
	}elseif($nns==0){
   $pdf->SetFont ('TIMES','B', 18);
   $pdf->cell(185,100,utf8_decode("Il n'y a aucun mouvement enregistré pour cette utilisateur."),1,0,'C');
	  }}
   
 

$pdf->Output();
exit();
@endphp
        
