$(document).ready(function(){
    const baseUrl = "http://localhost/framework/smk2/"

    $('.input-gambar-pegawai').change(function(){

        let fileName = $(this).val().split('\\').pop()
        $(this).next('.custom-file-label').addClass('selected').html(fileName)
        
    })
   	
   	// Detail Peminjam
   	$('.list-peminjam ul li').on('click', function(){

   		let idPeminjaman = $(this).data('id')

   		let namaPeminjam = $(this).data('nama')

   		let baseUrl = 'http://localhost/smk2/pegawai/'

   		$.ajax({
   			url : baseUrl + 'detailPeminjam',
   			type : 'post',
   			data : {
   				'idPeminjaman' : idPeminjaman
   			},
   			dataType : 'json',
   			success : function(result)
   			{

   				$.ajax({
   					url : baseUrl + 'barangDiPinjam',
   					type : 'post',
   					data : {
   						'kode_barang' : result.kode_inventaris
   					},
   					dataType : 'json',
   					success : function(barang)
   					{

   						$('.modalDetailPeminjam div.modal-body').html(
		   					`<ul class="list-group list-group-flush">
				              <li class="list-group-item">Nama Peminjam : ` + namaPeminjam + `</li>
				              <li class="list-group-item">Kode Barang : ` + result.kode_inventaris + `</li>
				              <li class="list-group-item">Nama Barang : ` + barang.nama + `</li>
				              <li class="list-group-item">Tanggal Pinjam : ` + result.tanggal_pinjam + `</li>
				              <li class="list-group-item">Tanggal Kembali : ` + result.tanggal_kembali + `</li>
				              <li class="list-group-item">Status : 
				              	<input type="text" name="status" class="form-control text-center" value="` + result.status_peminjaman + `">
				              </li>
				            </ul>`
			            )

   					}
   				})

   			}
   		})

   	})

})