<header class="panel-heading">
	<div class="panel-actions">
		<a href="#" class="fa fa-caret-down"></a>
		<a href="#" class="fa fa-times"></a>
	</div>
	<h2 class="panel-title">Liste des utilisateurs</h2>
</header>
<div class="panel-body">
 	<table class="table table-bordered table-striped mb-none" id="datatable-default"> 
        <thead>
            <tr>
                <th>Numero</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach
                    <tr>
                      <td><?php echo $lan['numero'];  ?></td>
                      <td><?php echo $lan['nom_manager'];  ?></td>
                      <td><?php echo $lan['login_manager'];  ?></td>
                      <td><?php echo $lan['groupe_manager'];  ?></td>
                      <td align="center"> 
                 <a href="index.php?jen=Param&c=Fiche-user&num=<?php echo $lan["numero"]  ?>">
                 <i class="fa fa-eye"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                 <a href="index.php?jen=Param&c=Modifier-user&num=<?php echo $lan["numero"]  ?>">
                 <i class="fa fa-edit"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                 <a href="index.php?jen=Param&c=Effacer-user&num=<?php echo $lan["numero"]  ?>" onClick="return confirmer()">
                 <i class="fa fa-trash-o"></i></a> 
                      </td>
                    </tr>
 			
 
                   </tbody>
                  <tfoot>
                    <tr>
                      <th>Numero</th>
                      <th>Nom</th>
                      <th>Email</th>
                      <th>Groupe</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
               </div>
               <!-- End .powerwidget --> 
              
   			        <script>
                    function confirmer() {
                    if(confirm("Confirmez-vous la suppression?")) return true;
                    else return false;
                    }
                    </script>
			
