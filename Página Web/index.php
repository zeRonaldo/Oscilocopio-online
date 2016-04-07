<?php
	include 'header.php';


	include 'relatorio.php';
	include 'cadastroEsp.php';
	include 'erro.php';
	include 'aviso.php';
?>



<div class="load"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	


		
		

function carregando(){
	var loading = "<div class =\"row up-down\"><div class= \"col l12 s12 center\">"+
	"<div class=\"preloader-wrapper big active\">"+
      "<div class=\"spinner-layer spinner-blue\">"+
        "<div class=\"circle-clipper left\">"+
          "<div class=\"circle\"></div>"+
        "</div><div class=\"gap-patch\">"+
          "<div class=\"circle\"></div>"+
        "</div><div class=\"circle-clipper right\">"+
          "<div class=\"circle\"></div>"+
        "</div></div></div></div>";
        console.log(loading);
        $(".load").html(loading);
      
}


	
	
	
</script>