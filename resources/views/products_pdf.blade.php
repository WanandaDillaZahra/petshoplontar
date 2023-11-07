<h1 style="text-align: center">Daftar Data Produk</h1>
<table width='100%' border='1' cellpadding='5' cellspacing='0'>
    <tr>
      <th>Nama Barang</th>
      <th>Harga Barang</th>
      <th>Tanggal Masuk</th>
    </tr>
    @foreach($productsM as $data)
    <tr>
        <td>{{ $data->nama_produk }}</td>
        <td>{{ $data->harga_produk }}</td>
        <td>{{ $data->created_at }}</td>
    </tr>
    @endforeach

  </table>