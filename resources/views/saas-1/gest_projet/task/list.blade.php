@php

use Codedge\Fpdf\Fpdf\Fpdf;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;





  // $sq = mysql_query('select * from societe');

 // $lin = mysql_fetch_array($sq); extract($lin);

  

 // $sql2 = mysql_query('select * from dossieretud where num_etudiant="'.$etud.'"');

 // $lin2 = mysql_fetch_array($sql2); extract($lin2);

	

  

 class PDF extends FPDF

{

// En-tête

function Header()

{

  global $nom_soc, $mail_soc;
        // Logo
        //$this->Image('',10,6,30);
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
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(40,5,utf8_decode('Email: '),0,0,'L');
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(40,6,utf8_decode('Adresse: '),0,0,'L');
   $pdf->Ln();  
   $pdf->SetFont('Arial','',10);
   $pdf->Cell(40,5,utf8_decode('Tel: '),0,0,'L');
        
   $pdf->Ln(10);   

   //$pdf->cell(180,7,"THIAM GENERAL BUSINESS",0,0,"C");

   

   $pdf->SetFont ( 'TIMES','', 14 );

   $pdf->Ln(30);   

   $pdf->cell(185,7,utf8_decode("LISTE DES CLIENTS"),1,0,'C');

   $pdf->Ln(15);   



  

   $pdf->SetFont ('TIMES','B', 12);

   $pdf->cell(35,7,utf8_decode("Numero"),1,0,'C');

   $pdf->cell(50,7,utf8_decode(" Responsable "),1,0,'C');
   $pdf->cell(40,7,utf8_decode("Telephone "),1,0,'C');

   $pdf->cell(60,7,utf8_decode("Email"),1,0,'C');


   $pdf->Ln();


   $pdf->SetFont ('TIMES','', 8);
   $Soci= User::all()->Where('email','=',Auth::user()->email)->first();
        $soce= $Soci->societe_id;
  
	$clients = Client::all()->Where('societe_id',$soce)->sortBy('created_at');
	$nns= $clients->count();
  if($nns!=0){
    foreach($clients as $client){
    
   $pdf->cell(35,7,utf8_decode($client['numero']),1,0,'C');

$pdf->cell(50,7,utf8_decode($client->prenom.' '.$client->nom),1,0,'C');
$pdf->cell(40,7,utf8_decode($client->tel ),1,0,'C');

$pdf->cell(60,7,utf8_decode($client['email']),1,0,'C');


$pdf->Ln();

 }

}elseif($nns==0){

$pdf->SetFont ('TIMES','B', 18);

$pdf->cell(185,100,utf8_decode("Aucun client n'a encore été enregistré."),1,0,'C');

 }




$pdf->Output();

exit();

@endphp 

        

