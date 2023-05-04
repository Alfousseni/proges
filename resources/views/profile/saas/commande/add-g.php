 					<div class="row">
						<div class="col-md-12">
      
            
 							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Liste des produits</h2>
							</header>
							<div class="panel-body">
 								<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
                                  <thead>
                    <tr>
                      <th>Numero</th>
                      <th>Nom produit</th>
                      <th>Qte min</th>
                      <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
				   <?php 
				   $sas = $bdd->query('select * from produit order by nom_prod asc');
				   $raw = $sas->rowCount();
				   if($raw!=0){
					   while($lan=$sas->fetch(PDO::FETCH_ASSOC)){ extract($lan);
				   ?>
 
                    <tr>
 				  <form action="./act/add-vpanier.php" class="orb-form"  method="post" enctype="multipart/form-data" >	
                   <input type="hidden" name="numcom" value="<?php echo $lin['numcmd'];  ?>">
                      <td><input type="hidden" name="refprod" value="<?php echo $lan['numero'];  ?>"><?php echo $lan['numero'];  ?></td>
                      <td><input type="hidden" name="nomprod" value="<?php echo $lan['nom_prod'];  ?>"><?php echo $lan['nom_prod'];  ?></td>
                      <td><?php echo $lan['qte'];  ?></td>
                      <td align="center"> 
                 &nbsp;&nbsp;|&nbsp;&nbsp;
                 <button type="submit"  class="btn btn-default"><i class="fa fa-plus"></i></button>
                 &nbsp;&nbsp;|&nbsp;&nbsp;
                      </td>
 					<div id="post"></div>
                   </form>
                    </tr>
 					<?php }} ?>
                   </tbody>
                  <tfoot>
                    <tr>
                       <th>Numero</th>
                      <th>Nom produit</th>
                      <th>Qte min</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
 	        
                        </div>
                     </div>
                     
					 
					 <script>
                    function confirmer() {
                    if(confirm("Confirmez-vous la suppression?")) return true;
                    else return false;
                    }
                    </script>
			
