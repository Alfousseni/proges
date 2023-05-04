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
        <th>Site web</th>
        <th>Responsable</th> 
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($societes as $societe)							
      <tr> 
        <!-- <td><input type="checkbox"></td> -->
        <td align="center">{{ $societe-> nom_societe}}</td> 
        <td align="center">{{ $societe-> adresse}}</td>
        <td align="center">{{ $societe-> tel}}</td>
        <td align="center">{{ $societe-> email}}</td>
        <td align="center">{{ $societe-> site}}</td> 
        <td align="center">{{ $societe-> responsable}}</td> 
        <td align="center"> &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="{{route('societe.edit', $societe -> id)}}">
            <i class="fa fa-edit"></i> 
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;
          <form id="destroy{{ $societe-> id}}" action="{{route('societe.destroy', $societe -> id)}}" method="Post">
            @csrf
            @method('DELETE')
            <a href="" onclick="event.preventDefault();this.closest('form').submit();" >
              <i class="fa fa-trash-o"></i>
            </a> 
          </form>
        </td>
      </tr>
      @endforeach 
    </tbody>
    <tfoot>
      <tr>
        <th>Nom de L'institut</th> 
        <th>Adresse</th>
        <th>Tel</th>
        <th>Email</th>
        <th>Site web</th>
        <th>Responsable</th> 
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>