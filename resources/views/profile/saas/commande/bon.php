<?php
include('../config.php');
require('../pdf/fpdf.php');

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


  $cli="";
 $statu="";   
 if(isset($_GET['id'])){ $cli = $_GET['id'];}
 if(isset($_GET['st'])){ $statu = $_GET['st'];}
 // $sq = mysql_query('select * from societe');
 // $lin = mysql_fetch_array($sq); extract($lin);
  
 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');
 // $lin2 = mysql_fetch_array($sql2); extract($lin2);
	
  $sql ="select * from vente where num_com='".$cli."'";
  $req=$bdd->query($sql);   
  $i=0;
  $nbre = $req->rowCount();
  if($nbre!=0){
  $line1 = $req->fetch(PDO::FETCH_ASSOC);
  extract($line1);
 
 $numfourn="";
 $nomfourn="";
 $telfourn="";
 $pnomfourn="";
 $comfourn="";
 $urlfourn="";

 $sbl ="select * from client where numero='".$line1['numfour']."'";
 $rel=$bdd->query($sbl);   
 $nnb= $rel->rowCount();  
 if($nnb!=0){
 $line2 = $rel->fetch(PDO::FETCH_ASSOC); 
  extract($line2);
 $numfourn=$line2['numero'];
 $nomfourn=$line2['nom_cli'];
 $pnomfourn=$line2['prenom_cli'];
 $telfourn=$line2['tel'];
 $comfourn=$line2['compagnie'];
 $urlfourn=$line2['url'];
 

 

  //ob_end_clean();
ob_clean(); 
//ob_get_contents();
//ob_start();
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
   //$pdf->cell(180,7,"THIAM GENERAL BUSINESS",0,0,"C");
   
   $pdf->SetFont ( 'TIMES','', 14 );
   $pdf->Ln(30);   
   $pdf->cell(180,7,utf8_decode("DETAIL DE LA VENTE N° ").utf8_decode($line1['num_com']),1,0,'C');
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
	 $res=$bdd->query($ssl);   
	 $nns= $res->rowCount();
	 if($nns!=0){
	 while($lines = $res->fetch(PDO::FETCH_ASSOC)){
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
   $pdf->cell(35,7,utf8_decode($lines['refprod']),1,0,'C');
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
   $pdf->Ln(5);
   $pdf->SetFont ( 'TIMES','I', 12 );
   if($statu=="Paye"){
   $txto = utf8_decode("La facture a été payé dans sa totalité. ");
   $pdf->cell(140,7,$txto,0,0,'');
   $pdf->Ln(20);
   }
   elseif($statu=="Impaye") {
   $txto = utf8_decode("Le facture n'a pas encore été payé ");
   $pdf->cell(140,7,$txto,0,0,'');
   $pdf->Ln(5);
   $rest = $line1["prix_ttc"] - $line1["encaisser"];
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
        
