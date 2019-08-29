$(document).ready(function(){
    const baseUrl = "http://localhost/framework/smk2/"

    $('.input-gambar-pegawai').change(function(){

        let fileName = $(this).val().split('\\').pop()
        $(this).next('.custom-file-label').addClass('selected').html(fileName)
        
    })    

})