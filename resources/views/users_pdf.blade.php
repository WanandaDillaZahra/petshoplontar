<h1 style="text-align: center">Data Produk</h1>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
      <th>Username</th>
      <th>Nama</th>
      <th>Role</th>
    </tr>
    
     @foreach ($User as $users)
    <tr>
      <td>{{ $users->username}}</td>
      <td>{{ $users->name}}</td>
      <td>{{ $users->role}}</td>
    </tr>
    @endforeach
    
  </table>