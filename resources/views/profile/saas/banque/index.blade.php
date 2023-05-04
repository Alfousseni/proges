<header class="panel-heading">
	<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<a href="#" class="fa fa-times"></a>
	</div>
	<h2 class="panel-title">Liste des Banques</h2>
</header>
<div class="panel-body">
 	<table class="table table-bordered table-striped mb-none" id="datatable-default">                  
    <thead>
      <tr>
        <th>Nom de la banque</th> 
        <th>Tel</th>
        <th>Email</th>
        <th>gestionnaire</th>
        <th>RIB</th> 
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($banks as $bank)							
      <tr> 
        <!-- <td><input type="checkbox"></td> -->
        <td align="center">{{ $bank-> nom_banque}}</td> 
        <td align="center">{{ $bank-> tel}}</td>
        <td align="center">{{ $bank-> email}}</td>
        <td align="center">{{ $bank-> gestionnaire}}</td> 
        <td align="center">{{ $bank-> rib}}</td> 
        <td align="center"> &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="{{route('banque.edit', $bank -> id)}}">
            <i class="fa fa-edit"></i> 
          </a>&nbsp;&nbsp;|&nbsp;&nbsp;
          <form id="destroy{{ $bank-> id}}" action="{{route('banque.destroy', $bank -> id)}}" method="Post">
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
        <th>Nom de la banque</th> 
        <th>Tel</th>
        <th>Email</th>
        <th>gestionnaire</th>
        <th>RIB</th> 
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
</div>