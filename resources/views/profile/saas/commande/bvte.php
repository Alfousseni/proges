
					<header class="page-header">
						<h2>Gestion des Ventes</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Ventes</span></li>
								<li><a href="index.php?jen=Vente&c=encours-vte"><span>Lister les ventes en cours</span></a></li>
								<li><span>Fiche de ventes</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
      
 
 
					<div class="row">
						<div class="col-md-12">



 
<?php if(isset($_GET["num"])&&(isset($_GET["stat"]))){ 

$num = $_GET["num"];  
$statu= $_GET["stat"];

?>

  
<?php $sql=$bdd->query('select num_com from vente where num_com="'.$_GET['num'].'"'); ?>

 <iframe width="100%" src="vente/bon.php?id=<?php echo $_GET['num'] ?>&st=<?php echo $statu; ?>" height="800" frameborder="1"></iframe>  


<?php }  ?>

			</div>
         </div>
