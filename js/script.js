$(function () {
  // Sidebar toggle behavior
  $("#sidebarCollapse").on("click", function () {
    $("#sidebar, #content").toggleClass("active");
  });
});

$(document).ready(function () {
  $("#buscador").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});

$(function () {
  $(".checkbox-list").on("change", function () {});
});

function irAFicha(element) {
  let aux = location.href.split("/").length;
  let page = location.href.split("/")[aux - 1];
  switch (page) {
    case "lista-resenas":
      location.href =
        "ficha-resena/" + element.parentElement.children[1].innerText;
      break;
    case "lista-bares":
      location.href =
        "ficha-bar/" + element.parentElement.children[1].innerText;
      break;
    case "bares":
      location.href = "bar/" + element.parentElement.childNodes[1].children[0].value;
      break;
    case "pinchos":
        location.href = "pincho/" + element.parentElement.childNodes[1].children[0].value;
        break;
    case "lista-pinchos":
      location.href =
        "ficha-pincho/" + element.parentElement.children[1].innerText;
      break;
    case "lista-usuarios":
      location.href =
        "ficha-usuario/" + element.parentElement.children[1].innerText;
      break;
  }
}

function irAFichaDesdeOtraFicha(element) {
  let auxUrl = "";
  let aux = location.href.split("/").length;
  let page = location.href.split("/")[aux - 2];
  let ultimo = location.href.lastIndexOf("/");
  let auxUlt = location.href.substring(0,ultimo+1);
  switch (page) {
    case "bar":
      auxUrl = auxUlt.replace("bar/", "pincho/");
      location.href = auxUrl + element.parentElement.childNodes[1].children[0].value;
      break;
    case "zona-usuario":
      auxUrl = auxUlt.replace("zona-usuario/", "pincho/");
      location.href = auxUrl + element.parentElement.childNodes[1].children[0].value;
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

function eliminarImgBar(elemento) {
  let id = elemento.id;

  $.ajax({
    type: "GET",
    url: "http://localhost/logrocho/index.php/eliminar-foto-bar/" + id,
    dataType: "json",
    success: function (response) {
      location.reload(true);
    },
  });
}

function eliminarImgPincho(elemento) {
  let id = elemento.id;

  $.ajax({
    type: "GET",
    url: "http://localhost/logrocho/index.php/eliminar-foto-pincho/" + id,
    dataType: "json",
    success: function (response) {
      location.reload(true);
    },
  });
}


function ocultarColumna(columna) {
  switch (columna) {
    //lista bares
    case "colNombreBar":
      $(".nombrebar").toggle();
      $("td:nth-child(3)").toggle();
      break;
    case "colLatitudBar":
      $(".latitudbar").toggle();
      $("td:nth-child(4)").toggle();
      break;
    case "colLongitudBar":
      $(".longitudbar").toggle();
      $("td:nth-child(5)").toggle();
      break;
    case "colIdBar":
      $(".idbar").toggle();
      $("td:nth-child(2)").toggle();
      break;
    //lista pinchos
    case "colIdPincho":
      $(".idpincho").toggle();
      $("td:nth-child(2)").toggle();
      break;
    case "colNombrePincho":
      $(".nombrepincho").toggle();
      $("td:nth-child(3)").toggle();
      break;
    case "colDescripcionPincho":
      $(".descripcionpincho").toggle();
      $("td:nth-child(4)").toggle();
      break;
    case "colPrecioPincho":
      $(".preciopincho").toggle();
      $("td:nth-child(5)").toggle();
      break;
    case "colBarPincho":
      $(".barpincho").toggle();
      $("td:nth-child(6)").toggle();
      break;
    //lista reseñas
    case "colIdResena":
      $(".idresena").toggle();
      $("td:nth-child(2)").toggle();
      break;
    case "colUsuarioResena":
      $(".usuarioresena").toggle();
      $("td:nth-child(3)").toggle();
      break;
    case "colPinchoResena":
      $(".pinchoresena").toggle();
      $("td:nth-child(4)").toggle();
      break;
    case "colComentarioResena":
      $(".comentarioresena").toggle();
      $("td:nth-child(5)").toggle();
      break;
    case "colLikesResena":
      $(".likesresena").toggle();
      $("td:nth-child(6)").toggle();
      break;
    //lista usuarios
    case "colCorreoUsuario":
      $(".correousuario").toggle();
      $("td:nth-child(2)").toggle();
      break;
    case "colNombreUsuario":
      $(".nombreusuario").toggle();
      $("td:nth-child(3)").toggle();
      break;
    case "colAdminUsuario":
      $(".adminusuario").toggle();
      $("td:nth-child(4)").toggle();
      break;
  }
}
