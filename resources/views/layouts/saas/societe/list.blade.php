
				
            <!-- New widget -->
 							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Liste des sociétés</h2>
							</header>
							<div class="panel-body">
 								<table class="table table-bordered table-striped mb-none" id="datatable-default">                  
                               <thead>
                    <tr>
                      <th>Nom de L'institut</th> 
                      <th>Adresse</th>
                      <th>Tel</th>
                      <th>Email</th>
                      <th>Responsable</th>
                      <th>Module</th> 
                      <th>action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach ($societes as $societe)							
                  <tr> 
                    <!-- <td><input type="checkbox"></td> -->
                    <td align="center">{{ $societe-> nom_societe}}</td> 
                    <td align="center">{{ $societe-> adresse}}</td>
                    <td align="center">{{ $societe-> telephone}}</td>
                    <td align="center">{{ $societe-> email}}</td>
                    <td align="center">{{ $societe-> responsable}}</td> 
                    <td align="center">{{ $societe-> nom_module}}</td> 
                       <td align="center"> 
				  &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="{{route('societe.edit', $societe -> id)}}">
                 <i class="fa fa-edit"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                 <form id="destroy{{ $societe-> id}}" action="{{route('societe.destroy', $societe -> id)}}" method="Post">
                 @csrf
                                                            @method('DELETE')
                 <a href="" onclick="event.preventDefault();this.closest('form').submit(); return confirm('voulez vous suprimer');" >
                 <i class="fa fa-trash-o"></i></a> </form>
                      </tr>
                      @endforeach 
 
                   </tbody>
                  <tfoot>
                    <tr>
                      <th>Nom de L'institut</th> 
                      <th>Adresse</th>
                      <th>Tel</th>
                      <th>Email</th>
                     
                      <th>Responsable</th> 
                      <th>Module</th> 
                      <th>Action</th>
                     </tr>
                  </tfoot>
                </table>
          </div>
  			        <script>
                    function confirmer() {
                    if(confirm("Confirmez-vous la suppression?")) return true;
                    else return false;
                    }
                    </script>
			

			

