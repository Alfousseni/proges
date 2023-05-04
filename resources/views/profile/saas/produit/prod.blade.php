@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Stock;

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
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->setSourceFile('../pdf/entete.pdf');
        // import page 1
   // $tplIdx = $pdf->importPage(1, '/MediaBox');
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
   $pdf->cell(180,7,utf8_decode("FICHE PRODUIT N° ").utf8_decode($produit['numero']),1,0,'C');
   $pdf->Ln(20);   
   $pdf->cell(65,7,"Numero Produit:",0,0,'');
   $pdf->cell(120,7,utf8_decode($produit['numero']),0,0,'');
   $pdf->Ln();
   
   $pdf->cell(65,7,"Nom Produit:",0,0,'');
   $pdf->cell(120,7,utf8_decode($produit['nom_prod']),0,0,'');
   $pdf->Ln();

   $pdf->cell(65,7,"Type Produit:",0,0,'');
   $pdf->cell(120,7,utf8_decode($produit['type_prod'] != "" ? $produit['type_prod'] : "Non renseigne"),0,0,'');
   $pdf->Ln();
    
   foreach($stocks=Stock::all()->where('reference',$produit->numero) as $stock){
        $pdf->cell(65,7,utf8_decode("Quantité disponible:"),0,0,'');
        if($stock->qte_stock==""){
            $pdf->cell(120,7,utf8_decode("Non disponible"),0,0,'');
            $pdf->Ln();
        }
        else{
            $pdf->cell(120,7,$stock['qte_stock'].utf8_decode(" unités"),0,0,'');
            $pdf->Ln();
        }

        $pdf->cell(65,7,utf8_decode("Prix d'achat:"),0,0,'');
        if($stock->prix_achat==""){
            $pdf->cell(65,7,utf8_decode("Non disponible"),0,0,'');
            $pdf->Ln();
        }
        else{
            $pdf->cell(120,7,$stock['prix_achat'].utf8_decode(" fcfa"),0,0,'');
            $pdf->Ln();
        }

        $pdf->cell(65,7,utf8_decode("Prix de vente:"),0,0,'');
        if($stock->prix_vente==""){
            $pdf->cell(65,7,utf8_decode("Non disponible"),0,0,'');
            $pdf->Ln();
        }
        else{
            $pdf->cell(120,7,$stock['prix_vente'].utf8_decode(" fcfa"),0,0,'');
            $pdf->Ln();
        }
    }

    $pdf->SetFont ( 'TIMES','', 12);
    $txt = utf8_decode($produit['infos']);  
    $pdf->cell(185,7,utf8_decode("Caractéristiques:"),0,0,'C');
    $pdf->Ln();
    $pdf->SetFont ( 'TIMES','', 12);
    $pdf->multicell(185,7,$txt,0,0,'C');
    $pdf->Ln();

$pdf->Output();
exit();
@endphp      
