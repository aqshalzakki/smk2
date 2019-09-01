$(document).ready(function(){

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
				              <li class="list-group-item">Jumlah Barang : ` + result.jumlah + `</li>
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

		//    TAMBAH MODAL 
	   $('.tambahModal').on('click', function(){

		   $('#titleModal').html('Tambah Data');
		   $('#kodeinventaris').removeAttr('readonly',false);
		   $('.modal-footer button[type=submit]').html('Tambah');
		   $('.modal-body form').attr('action','http://localhost/smk2/admin/tambahData');
			   
		   $('#kodeinventaris').val('')
		   $('#namabarang').val('')
		   $('#jumlah').val('')
		   $('#kondisi').val('')
		   $('#jenis').val(1)
		   $('#keterangan').val('')
		   $('#id').val('')
	   });


	   // EDIT MODAL  
	   $('.editModal').on('click', function(){
			
			$('#titleModal').html('Ubah Data');
			$('.modal-body form').attr('action','http://localhost/smk2/admin/edit_barang');
			$('#kodeinventaris').attr('readonly',true);
			$('.modal-footer button[type=submit]').html('Ubah');

			const id = $(this).data('id');
			
			$.ajax({
				url: 'http://localhost/smk2/admin/getEditData',
				data: {id : id},
				method:'post' ,
				dataType: 'json',
				success: function(data){

					$('#kodeinventaris').val(data.kode_inventaris)
					$('#namabarang').val(data.nama)
					$('#jumlah').val(data.jumlah)
					$('#kondisi').val(data.kondisi)
					$('#jenis').val(data.id_jenis)
					$('#keterangan').val(data.keterangan)
					$('#id').val(data.id)
				}
			})

		})
	})