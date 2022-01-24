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
  
  /*$(function () {
    $('td').on('click', function () {
      let aux = location.href.split("/").length;
      let page = location.href.split("/")[aux-1];
      switch (page) {
        case "lista-resenas":
          location.href = "ficha-resena/" + this.parentElement.children[1].innerText;
          break;
        case "lista-bares":
          location.href = "ficha-bar/" + this.parentElement.children[1].innerText;
          break;
        case "lista-pinchos":
          location.href = "ficha-pincho/" + this.parentElement.children[1].innerText;
          break;
        case "lista-usuarios":
          location.href = "ficha-usuario/" + this.parentElement.children[1].innerText;
          break;
      }
    });
  });*/

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

  
