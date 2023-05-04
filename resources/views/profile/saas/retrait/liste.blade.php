<div class="row">
						<div class="col-md-12">
						@if(session()->has('messages'))
                                	<div class="alert alert-icon alert-success">
                                		<em class="icon ni ni-alert-circle"></em>
                                			{{session('messages')}}
                                		</div>
                        @endif
                                	
						@if($errors->any())
                            	@foreach ($errors->all() as $error)
                                		<div class="alert alert-icon alert-danger">
                                		<em class="icon ni ni-alert-circle"></em>
                                		{{$error}}
                                		</div>
                                	@endforeach
                        @endif
             <header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>
						
								<h2 class="panel-title">Liste des retraits</h2>
							</header>
                    
 
					
               
							<div class="panel-body">
 								<table class="table table-bordered table-striped mb-none" id="datatable-default">                  <thead>
                    <tr>
                      <th>N°</th> 
                      <th>Date retrait</th>
                      <th>Nom Bénéficiaire</th>
                      <th>Montant retiré</th>
                      
                      <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach ($retraits as $retrait)							
                  <tr> 
                    <!-- <td><input type="checkbox"></td> -->
                    <td align="center">{{ $retrait->id}}</td> 
					<td align="center">{{ $retrait->created_at}}</td>
                    <td align="center">{{ $retrait->nom_ret}}</td>
					<td align="center">{{ $retrait->montant_ret}}</td>
                   
                    
                       <td align="center"> 
				  &nbsp;&nbsp;|&nbsp;&nbsp;
				  <a href="{{route('retrait.edit', $retrait-> id)}}">
              <i class="fa fa-edit"></i> 
            </a>&nbsp;&nbsp;|&nbsp;&nbsp;
   
                      </td>
                      
                    </tr>
 					
                    @endforeach 
 
                
                   </tbody>
                  <tfoot>
                    <tr>
					<th>N°</th> 
                      <th>Date $retrait</th>
                      <th>Nom Bénéficiaire</th>
                      <th>Montant retiré</th>
                      
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
                         
