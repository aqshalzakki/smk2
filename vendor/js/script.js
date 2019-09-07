$(document).ready(function(){
	
	const convertTime = (timestamp) => {
		if (timestamp == 0){
			return ' - '
		}
		let date = new Date( timestamp * 1000);
		
		let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		let tanggal = date.getDate();
		let bulan = months[date.getMonth()];
		let tahun = date.getFullYear();
		
		let tanggal_pinjam = tanggal + ' ' + bulan + ' ' +tahun
		
		return tanggal_pinjam;
	}

    $('.input-gambar-pegawai').change(function(){

        let fileName = $(this).val().split('\\').pop()
        $(this).next('.custom-file-label').addClass('selected').html(fileName)
        
    })
   	
	// Peminjaman Barang
	$('.form-peminjaman #kode-barang').on('keyup', function(){

		let input = $(this).val()

		if(input == '')
		{

			$('#form-group-kode-barang').html('')

		}
		else
		{

			$.ajax({
				url : 'http://localhost/smk2/pegawai/getBarangByKode',
				type : 'post',
				data : {
					'kodeBarang' : input
				},
				dataType : 'json',
				success : function(result)
				{	
	
					if(result.result)
					{
	
						$('#form-group-kode-barang').removeClass('text-success')
						$('#form-group-kode-barang').addClass('text-danger')
						$('#form-group-kode-barang').html('Barang tidak di temukan')
	
					}
					else
					{
	
						$('#form-group-kode-barang').removeClass('text-danger')
						$('#form-group-kode-barang').addClass('text-success')
						$('#form-group-kode-barang').html(`Barang ditemukan (` + result.nama + `)`)
	
					}
	
				}
			})

		}				

	})

   	// Detail Peminjam
   	$('.list-peminjam ul li:not(a)').on('click', function(){

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
						let tanggal_pinjam = convertTime(result.tanggal_pinjam)
						let tanggal_kembali = convertTime(result.tanggal_kembali)
			
						$('.modal-footer button[type=button]').css('display', 'none')
   						$('#modalDetailPeminjam div.modal-body').html(
		   					`<ul class="list-group list-group-flush">
				              <li class="list-group-item">Nama Peminjam : ` + namaPeminjam + `</li>
				              <li class="list-group-item">Kode Barang : ` + result.kode_inventaris + `</li>
				              <li class="list-group-item">Nama Barang : ` + barang.nama + `</li>
				              <li class="list-group-item">Jumlah Barang : ` + result.jumlah + `</li>
				              <li class="list-group-item">Tanggal Pinjam : ` + tanggal_pinjam + `</li>
				              <li class="list-group-item">Tanggal Kembali : ` + tanggal_kembali + `</li>
				              <li class="list-group-item">Status : ` + result.status_peminjaman + ` </li>
				            </ul>`
			            )

   					}
   				})

   			}
   		})

   	})

   	$('.list-peminjam li a').on('click', function(){

   		let list = $(this).parent()

   		list.attr('data-toggle', '')

   	})



	//    TAMBAH INVENTARIS MODAL 
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


   // EDIT INVENTARIS MODAL  
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


   // Hapus Modal
   $('.hapusModal').on('click', function(){

   		let kode = $(this).data('kode')

   		$('#hapusModal input').attr('value', kode)

   })

})