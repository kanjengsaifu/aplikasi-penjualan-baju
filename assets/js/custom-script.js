// Notifasi
// title = judul pesan
// messsage = isi pesan
// type = warna pesan pakai button dari bootstrap seperti primary, succes, warning atau danger
// time = lama pesan muncul (milisecond)
// position = posisi pesan
function notification(title, message, type, time = 1000, position = ['top', 'right'])
{
  $.notify({
    message: message,
    title: title,
    icon: 'la la-bell'
  },{
    type: type,
    placement: {
      from: position[0],
      align: position[1]
    },
    time: 1000,
  });
}

// Memunculkan pesan tertentu saat data kosong ditabel
// id = id tabel
// pesan = isi pesan
// tombol = tulisan pada tombol
function noRowsTable(id, pesan = "Tidak ada data yang ditampilkan." , tombol = "Muat Ulang")
{
  if(document.getElementById(id).rows.length == 1)
  {
    // Ambil dom tabelnya
    var tabel = document.getElementById(id).getElementsByTagName('tbody')[0];

    // tambahkan baris baru diakhir baris setelah tabel heading
    var barisBaru = tabel.insertRow(tabel.rows.length);
    
    // Insert a cell in the row at index 0
    var kolomBaru = barisBaru.insertCell(0);
    
    kolomBaru.colSpan = document.getElementById('tabel').rows[0].cells.length;
    kolomBaru.innerHTML = "<center><b>" + pesan + "</b> <br/> <br/> <a href='index.php' class='btn btn-primary'>" + tombol + "</a></center>";
  }
}
