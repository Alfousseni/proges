<?php
include('../config.php');
include('../pdf/fpdf.php');
include('../pdf/fpdi.php');
//include('class.pdf.php');
 // En-tête
//$choix = htmlspecialchars($_GET['choix']);


     
  $cli = $_GET['id'];
 // $sq = mysql_query('select * from societe');
 // $lin = mysql_fetch_array($sq); extract($lin);
  
 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');
 // $lin2 = mysql_fetch_array($sql2); extract($lin2);
	
  $sql ="select * from vente where num_com='".$cli."'";
  $req=mysql_query($sql)or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());   
  $i=0;
  $nbre = mysql_num_rows($req);
  if($nbre!=0){
  $line1 = mysql_fetch_array($req);
  extract($line1);
 
 $numfourn="";
 $nomfourn="";
 $telfourn="";
 $pnomfourn="";
 $comfourn="";
 $urlfourn="";

 $sbl ="select * from client where numero='".$line1['numfour']."'";
 $rel=mysql_query($sbl)or die('Erreur SQL !<br />'.$sbl.'<br />'.mysql_error());   
 $nnb= mysql_num_rows($rel);
 if($nnb!=0){
  $line2 = mysql_fetch_array($rel);
  extract($line2);
 $numfourn=$line2['numero'];
 $nomfourn=$line2['nom_cli'];
 $pnomfourn=$line2['prenom_cli'];
 $telfourn=$line2['tel'];
 $comfourn=$line2['compagnie'];
 $urlfourn=$line2['url'];
  
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
    $this->Cell(40,10,'Fiche fournisseur',1,0,'L');
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

$pdf = new FPDI();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setSourceFile('../pdf/entete.pdf');
        // import page 1
    $tplIdx = $pdf->importPage(1, '/MediaBox');
        // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplIdx, 0, 0, 210);
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
   $pdf->cell(180,7,utf8_decode("FACTURE N° ").utf8_decode($line1['num_com']),1,0,'C');
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
	 $ssl ="select * from detail_vte where num_com='".$cli."'";
	 $res=mysql_query($ssl)or die('Erreur SQL !<br />'.$ssl.'<br />'.mysql_error());   
	 $nns= mysql_num_rows($res);
	 if($nns!=0){
	 while($lines = mysql_fetch_array($res)){
	 extract($lines);
   	if($nns <= 4){
   $pdf->cell(35,16,utf8_decode($lines['refprod']),1,0,'C');
   $txts = utf8_decode($lines['nom_prod']); 
   $pdf->cell(75,16,$txts,1,0,'');
   $pdf->cell(15,16,utf8_decode($lines['quantite']),1,0,'C');
   $pdf->cell(30,16,utf8_decode($lines['prix_ht']/$lines['quantite']),1,0,'C');
   $pdf->cell(30,16,utf8_decode($lines['prix_ht']),1,0,'C');
			}
   elseif($nns > 4){
   $pdf->cell(35,"",utf8_decode($lines['refprod']),1,0,'C');
   $txts = utf8_decode($lines['nom_prod']); 
   $pdf->cell(75,7,$txts,1,0,'');
   $pdf->cell(15,7,utf8_decode($lines['quantite']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($lines['prix_ht']/$lines['quantite']),1,0,'C');
   $pdf->cell(30,7,utf8_decode($lines['prix_ht']),1,0,'C');
	   		}
   $pdf->Ln();
 	  }
	
   $pdf->SetFont ( 'TIMES','', 11 );
   $pdf->cell(35,7,"",0,0,'');
   $pdf->cell(75,7,"",0,0,'');
   $pdf->cell(15,7,"",0,0,'');
   $pdf->cell(30,7,"Prix HT",1,0,'C');
   $pdf->cell(30,7,utf8_decode(number_format($line1['prix_ht'],0,',','.' )),1,0,'C');
   $pdf->Ln();
   $pdf->cell(35,7,"",0,0,'C');
   $pdf->cell(75,7,"",0,0,'');
   $pdf->cell(15,7,"",0,0,'C');
   $pdf->cell(30,7,"TVA(18%)",1,0,'C');
   $pdf->cell(30,7,utf8_decode(number_format($line1['mnt_tva'],0,',','.' )),1,0,'C');
   $pdf->Ln();
   $pdf->cell(35,7,"",0,0,'C');
   $pdf->cell(75,7,"",0,0,'');
   $pdf->cell(15,7,"",0,0,'C');
   $pdf->cell(30,7,"Prix TTC",1,0,'C');
   $pdf->cell(30,7,utf8_decode(number_format($line1['prix_ttc'],0,',','.' )),1,0,'C');
   $pdf->Ln(20);


   $pdf->SetFont ( 'TIMES','B', 16 );
   $txtz = utf8_decode("Le montant total de la commande s'élève à: ");
   $pdf->cell(140,7,$txtz. number_format($line1['prix_ttc'],0,',','.' )." FCFA",0,0,'');
   $pdf->Ln(30);
   
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
   
	  }
   
   
   }}
   else{
	   
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
   $pdf->SetFont ( 'TIMES', 'B', 15 );
   $pdf->setY(20, $yPos);

   $pdf->SetFont ( 'TIMES', 'B', 14 );
   $pdf->Cell(65,5,"Fiche fournisseur",1,0,'C' );
   $pdf->setxY(10, $yPos+10);
   $pdf->SetFont ( 'TIMES', 'B', 11 );
   
   $pdf->Ln(5);

   
   $pdf->cell(180,7,"Aucun client trouve à ce numero",0,0,'C');
   $pdf->Ln();
	   
	   }

$pdf->Output();

?>  
        
