@php
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\DetailVente;
@include('../pdf/fpdf.php');
@include('../pdf/fpdi.php');
 
$numfourn="";
$nomfourn="";
$telfourn="";
$pnomfourn="";
$comfourn="";
$urlfourn="";

foreach($clients as $client){
    $numfour=$client['numero'];
    $nomfourn=$client['nom'];
    $pnomfourn=$client['prenom'];
    $telfourn=$client['tel'];
    $comfourn=$client['compagnie'];
    $urlfourn=$client['site'];
 }
  
 class PDF extends FPDF
{
	
    function Header()
    {
        $this->SetFont('Arial','B',15);
        //Décalage à droite
        $this->Cell(90);
         $this->Ln(30);   
	    $this->Cell(1);
        $this->Ln(60);
    }

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

 

ob_clean(); 
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
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
  // $pdf->cell(180,7,"THIAM GENERAL BUSINESS",0,0,"C");
   
   $pdf->SetFont ( 'TIMES','', 14 );
   $pdf->Ln(30);   
   $pdf->cell(180,7,utf8_decode("FACTURE N° ").utf8_decode($facture['num_com']),1,0,'C');
   $pdf->Ln(15);   
   $pdf->SetFont ( 'TIMES','B', 14 );
   
   $pdf->cell(65,7,utf8_decode("Coordonnées du client"),0,0,'');
   $pdf->Ln();   
   $pdf->SetFont ( 'TIMES','', 10);
   $pdf->cell(30,5,"Numero:",0,0,'');
   $pdf->cell(60,5,utf8_decode($numfour),0,0,'');
   $pdf->cell(30,5,"Nom entreprise:",0,0,'');
   $pdf->cell(60,5,utf8_decode($comfourn),0,0,'');
   $pdf->Ln();   
   $pdf->cell(30,5,"Nom:",0,0,'');
   $pdf->cell(60,5,utf8_decode($nomfourn),0,0,'');
   $pdf->cell(30,5,"Prenom:",0,0,'');
   $pdf->cell(60,5,utf8_decode($pnomfourn),0,0,'');
   $pdf->Ln();
   $pdf->cell(30,5,utf8_decode("Téléphone:"),0,0,'');
   $pdf->cell(60,5,utf8_decode($telfourn),0,0,'');
   $pdf->cell(30,5,utf8_decode("Site web:"),0,0,'');
   $pdf->cell(60,5,utf8_decode($urlfourn),0,0,'');
   $pdf->Ln(15);

   $pdf->SetFont ( 'TIMES', 'B', 11 );
   $pdf->cell(35,7,utf8_decode("Référence"),1,0,'C');
   $pdf->SetFont ( 'TIMES', 'B', 11 );
   $pdf->cell(75,7,utf8_decode("Désignation"),1,0,'C');
   $pdf->SetFont ( 'TIMES', 'B', 11 );
   $pdf->cell(15,7,utf8_decode("Qté"),1,0,'C');
   $pdf->SetFont ( 'TIMES', 'B', 11 );
   $pdf->cell(30,7,"Prix unitaire",1,0,'C');
   $pdf->SetFont ( 'TIMES', 'B', 11 );
   $pdf->cell(30,7,"Prix total",1,0,'C');
   $pdf->Ln();
   $pdf->SetFont ( 'TIMES','', 10);

   $details=DetailVente::all()->where('num_com',$facture->num_com);
        $nns= $details->Count();
   foreach($details as $detail){
        if($nns <= 4){
            $pdf->cell(35,16,utf8_decode($detail['refprod']),1,0,'C');
            $txts = utf8_decode($detail['nomprod']); 
            $pdf->cell(75,16,$txts,1,0,'');
            $pdf->cell(15,16,utf8_decode($detail['quantite']),1,0,'C');
            $pdf->cell(30,16,utf8_decode($detail['prix_ht']/$detail['quantite']),1,0,'C');
            $pdf->cell(30,16,utf8_decode($detail['prix_ht']),1,0,'C');
	    }
        elseif($nns > 4){
            $pdf->cell(35,7,utf8_decode($detail['refprod']),1,0,'C');
            $txts = utf8_decode($detail['nom_prod']); 
            $pdf->cell(75,7,$txts,1,0,'');
            $pdf->cell(15,7,utf8_decode($detail['quantite']),1,0,'C');
            $pdf->cell(30,7,utf8_decode($detail['prix_ht']/$detail['quantite']),1,0,'C');
            $pdf->cell(30,7,utf8_decode($detail['prix_ht']),1,0,'C');
	    }
        $pdf->Ln();
 	}
	
    $pdf->SetFont ( 'TIMES','', 11 );
    $pdf->cell(35,7,"",0,0,'');
    $pdf->cell(75,7,"",0,0,'');
    $pdf->cell(15,7,"",0,0,'');
    $pdf->cell(30,7,"Prix HT",1,0,'C');
    $pdf->cell(30,7,utf8_decode(number_format($facture['prix_ht'],0,',','.' )),1,0,'C');
    $pdf->Ln();
    $pdf->cell(35,7,"",0,0,'C');
    $pdf->cell(75,7,"",0,0,'');
    $pdf->cell(15,7,"",0,0,'C');
    $pdf->cell(30,7,"TVA(18%)",1,0,'C');
    $pdf->cell(30,7,utf8_decode(number_format($facture['mnt_tva'],0,',','.' )),1,0,'C');
    $pdf->Ln();
    $pdf->cell(35,7,"",0,0,'C');
    $pdf->cell(75,7,"",0,0,'');
    $pdf->cell(15,7,"",0,0,'C');
    $pdf->cell(30,7,"Prix TTC",1,0,'C');
    $pdf->cell(30,7,utf8_decode(number_format($facture['prix_ttc'],0,',','.' )),1,0,'C');
    $pdf->Ln(20);


    $pdf->SetFont ( 'TIMES','B', 16 );
    $txtz = utf8_decode("Le montant total de la commande s'élève à: ");
    $pdf->cell(140,7,$txtz. number_format($facture['prix_ttc'],0,',','.' )." FCFA",0,0,'');
    $pdf->Ln(5);
    $pdf->SetFont ( 'TIMES','I', 12 );
    $statu="";
    if ($facture -> encaisser == $facture -> prix_ttc){
        $statu = 'Payé';
    }
    elseif ($facture -> encaisser > $facture -> prix_ttc){
        echo $statu = 'Payé';
    }
    elseif ($facture -> encaisser < $facture -> prix_ttc){
        $statu = 'Impayé';
    }
    if($statu=="Payé"){
        $txto = utf8_decode("La facture a été payé dans sa totalité. ");
        $pdf->cell(140,7,$txto,0,0,'');
        $pdf->Ln(20);
    }
    elseif($statu=="Impayé") {
        $txto = utf8_decode("Le facture n'a pas encore été payé ");
        $pdf->cell(140,7,$txto,0,0,'');
        $pdf->Ln(5);
        $rest = $facture["prix_ttc"] - $facture["encaisser"];
        $tet = utf8_decode("L'accompte est de:");
        $pdf->cell(140,7,utf8_decode($tet. number_format($line1['encaisser'],0,',','.' )." FCFA XOF donc reste ".number_format($rest,0,',','.' ). "  FCFA XOF à payer."),0,0,'');
        $pdf->Ln(20);
	}
   
    $pdf->SetFont ( 'TIMES','BIU', 12 );
    $pdf->cell(35,7,"",0,0,'C');
    $pdf->cell(75,7,"",0,0,'');
    $pdf->cell(15,7,"",0,0,'C');
    $pdf->cell(20,7,"",0,0,'C');
    $pdf->cell(40,7,"La direction",0,0,'C');
    $pdf->Ln(34);


    $pdf->SetFont ( 'TIMES','', 8 );
    $txt =utf8_decode("Cette facture est un titre qui fait effet des états de commande du client et devra être validé avant livraison.");
   
    $pdf->cell(15,4,"Devise:",0,0,'');
    $pdf->cell(10,4,"FRANC CFA",0,0,'');
    $pdf->Ln();
    $pdf->cell(15,4,"Notice:",0,0,'');
    $pdf->cell(140,4,$txt,0,0,'');
	   
   

$pdf->Output();
exit();

@endphp 
        
