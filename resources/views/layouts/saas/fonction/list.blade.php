
				
            <!-- New widget -->
 							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Liste des modules</h2>
							</header>
							<div class="panel-body">
 								<table class="table table-bordered table-striped mb-none" id="datatable-default">                  
                               <thead>
                    <tr>
                      <th>Nom module</th> 
                      <th>Description</th> 
                      <th>action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach ($modules as $module)							
                  <tr> 
                    <!-- <td><input type="checkbox"></td> -->
                    <td align="center">{{ $module-> nom_module}}</td> 
                    <td align="center">{{ $module-> description}}</td>
                       <td align="center"> 
				  &nbsp;&nbsp;|&nbsp;&nbsp;
          @if($module->etat == 0)
         <a href="{{route('module.show', $module -> id)}}" title="Desactiver" ><i class="fa fa-ban"></i></a>
           @else
          <a href="{{route('module.show', $module -> id)}}" title="Activer" ><i class="fa fa-check-square"></i></a>
           @endif
          <a href="{{route('module.edit', $module -> id)}}">
                 <i class="fa fa-edit"></i> </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                 <form id="destroy{{ $module-> id}}" action="{{route('module.destroy', $module -> id)}}" method="Post">
                 @csrf
                                                            @method('DELETE')
                 <a href="" onclick="event.preventDefault();this.closest('form').submit();" >
                 <i class="fa fa-trash-o"></i></a> </form>
                      </tr>
                      @endforeach 
 
                   </tbody>
                  <tfoot>
                    <tr>
                      <th>Nom module</th> 
                      <th>Decription</th>
                      
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
			

			

