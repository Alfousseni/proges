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
			<h2 class="panel-title">Liste des Depots</h2>
	  </header>
    <div class="panel-body">
 			<table class="table table-bordered table-striped mb-none" id="datatable-default">
        <thead>
          <tr>
            <th>N°</th> 
            <th>Date depot</th>
            <th>Nom Depositaire</th>
            <th>Montant déposé</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($depots as $depot)							
          <tr> 
            <!-- <td><input type="checkbox"></td> -->
            <td align="center">{{ $depot->id}}</td> 
					  <td align="center">{{ $depot->created_at}}</td>
            <td align="center">{{ $depot->nom_prop}}</td>
					  <td align="center">{{ $depot->montant}}</td>
            <td align="center"> &nbsp;&nbsp;|&nbsp;&nbsp;
				      <a href="{{route('depot.edit', $depot-> id)}}">
                <i class="fa fa-edit"></i> 
              </a>&nbsp;&nbsp;|&nbsp;&nbsp;
            </td>
          </tr>
 				  @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</div>
