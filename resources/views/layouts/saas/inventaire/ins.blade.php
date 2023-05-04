@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\StockMagasin;
use App\Models\Produit;
//include('class.pdf.php');
 // En-tête
//$choix = htmlspecialchars($_GET['choix']);


     
  // $sq = mysql_query('select * from societe');
 // $lin = mysql_fetch_array($sq); extract($lin);
  
 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');
 // $lin2 = mysql_fetch_array($sql2); extract($lin2);
	
  
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

$pdf = new PDF();
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

	


   $pdf->SetFont ( 'TIMES','', 14 );
   $pdf->Ln(30);   
   $pdf->cell(185,7,utf8_decode("INVENTAIRE DU STOCK"),1,0,'C');
   $pdf->Ln(15);   

   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(30,7,utf8_decode("Magasin:"),"",0,'');
   $pdf->cell(50,7,utf8_decode($magasin['nom_mag']),"",0,'');
   $pdf->Ln(15);   
  
   $pdf->SetFont ('TIMES','B', 12);
   $pdf->cell(20,7,utf8_decode("N°"),1,0,'C');
   $pdf->cell(40,7,utf8_decode("Référence"),1,0,'C');
   $pdf->cell(90,7,utf8_decode("Nom Produit"),1,0,'C');
   $pdf->cell(35,7,utf8_decode("Quantité"),1,0,'C');
   $pdf->Ln();
  
	 $pdf->SetFont ('TIMES','', 8);
	 $inventaires=StockMagasin::all()->where('id', $magasin->id)->sortBy('reference');  
	 $j=0;
	 $nns= $inventaires->count();
	 if($nns!=0){
   	 $j++;
		foreach($inventaires as $inventaire){
   $pdf->cell(20,7,utf8_decode($j),1,0,'C');
   $pdf->cell(40,7,utf8_decode($inventaire['reference']),1,0,'');
	foreach($produits =Produit::all()->where('numero',$inventaire->reference) as $produit){
   $pdf->cell(90,7,utf8_decode($produit['nom_prod']),1,0,'');
	}
   $pdf->cell(35,7,utf8_decode($inventaire['qte_stock']),1,0,'C');
   $pdf->Ln();
 	  
 	  
	  }
	  }


$pdf->Output();
exit();
@endphp  
        
