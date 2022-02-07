$(function () {
    // Sidebar toggle behavior
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar, #content').toggleClass('active');
    });
  });
  
  
  $(document).ready(function () {
    $("#buscador").on("keyup", function () {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  
  $(function () {
    $('.checkbox-list').on('change', function () {
  
    });
  });
  
  function irAFicha(element){
    let aux = location.href.split("/").length;
    let page = location.href.split("/")[aux-1];
    switch (page) {
      case "lista-resenas":
        location.href = "ficha-resena/" + element.parentElement.children[1].innerText;
        break;
      case "lista-bares":
        location.href = "ficha-bar/" + element.parentElement.children[1].innerText;
        break;
      case "lista-pinchos":
        location.href = "ficha-pincho/" + element.parentElement.children[1].innerText;
        break;
      case "lista-usuarios":
        location.href = "ficha-usuario/" + element.parentElement.children[1].innerText;
        break;
    }
  }

  function modalFotoPincho(elemento) {  
    if (confirm("¿Desea eliminar la imagen seleccionada?")) {
      eliminarImgPincho(elemento);
    }
  } 
  function modalFotoBar(elemento) {  
    if (confirm("¿Desea eliminar la imagen seleccionada?")) {
      eliminarImgBar(elemento);
    }
  } 

  function eliminarImgBar(elemento){
    let id = elemento.id;

    $.ajax({
      type: "GET",
      url: "http://localhost/logrocho/index.php/eliminar-foto-bar/"+id,
      dataType: "json",
      success: function (response) {
        location.reload(true);
      }
    });
  }

  function eliminarImgPincho(elemento){
    let id = elemento.id;

    $.ajax({
      type: "GET",
      url: "http://localhost/logrocho/index.php/eliminar-foto-pincho/"+id,
      dataType: "json",
      success: function (response) {
        
        location.reload(true);
      }
    });
  }

var myCarousel = document.querySelector('#carouselExampleCaptions');
var carousel = new bootstrap.Carousel(myCarousel);

