<script>
$(document).ready(function(){
    $('.btn-exit-system').on('click', function(e){
			e.preventDefault();
			var Token=$(this).attr('href')
			swal({
			title: "¿Esta seguro?",
			text: "Usted esta por salir del sistema",
			icon: "warning",
			buttons: ["Cancelar", true],
			})
			.then((willDelete) => {

			if (willDelete) {
						$.ajax({
						url:'<?php echo SERVERURL ;?>ajax/loginAjax.php?Token='+Token,
						success:function(data){
								if(data=="true"){
									window.location.href="<?php echo SERVERURL ;?>login";
								}

								else{

									swal(
										"Ocurrio un error",
										"No se pudo cerrar la sesion",
										"error"

									)

								}

						}

					});

					

			} else {

			

			}

			});

	});



});

</script>