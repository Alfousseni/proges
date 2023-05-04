<header class="panel-heading">
	<div class="panel-actions">
		<a href="#" class="fa fa-caret-down"></a>
		<a href="#" class="fa fa-times"></a>
	</div>
  @if(session()->has('mes'))
  <div class="alert alert-icon alert-success">
    <em class="icon ni ni-alert-circle"></em>
    {{session('mes')}}
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
  <h2 class="panel-title">Liste des types</h2>
</header>
<div class="panel-body">
 	<table class="table table-bordered table-striped mb-none" id="datatable-default">
    <thead>
      <tr>
        <th>Nom du type</th> 
        <th>date</th> 
        <th>Actions</th>
        </tr>
    </thead>    
    <tbody>
    @foreach($types as $type)									
      <tr> 
        <td align="center">{{$type->nom_type}}</td> 
        <td align="center">{{$type->created_at}}</td> 
        <td align="center"> &nbsp;|&nbsp;
          <a href="{{route('type_prod.edit', $type -> id)}}">
            <i class="fa fa-edit"></i> 
          </a> &nbsp;|&nbsp;
          <form id="destroy{{ $type-> id}}" action="{{route('type_prod.destroy', $type -> id)}}" method="POST">
            @csrf
            @method('DELETE')
            <a href="" title="Supprimer" onclick="event.preventDefault();this.closest('form').submit();">
              <i class="fa fa-trash-o"></i>
            </a> 
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<script>
  function confirmer() {
    if(confirm("Confirmez-vous la suppression?")) 
    return true;
    else 
    return false;
  }
</script>
			
