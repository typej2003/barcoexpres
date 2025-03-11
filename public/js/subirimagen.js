$(document).ready(function(){

    // Modal

    $(".modal").on("click", function (e) {
        console.log(e);
        if (($(e.target).hasClass("modal-main") || $(e.target).hasClass("close-modal")) && $("#loading").css("display") == "none") {
            closeModal();
        }
    });

    // -> Modal

    // Abrir el inspector de archivos
    
    $(document).on("click", "#add-photo", function(){
        $("#add-new-photo").click();
    });
    
    // -> Abrir el inspector de archivos

    // Cachamos el evento change
    
    $(document).on("change", "#add-new-photo", function () {
    
        console.log(this.files);
        var files = this.files;
        var element;
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var seEncontraronElementoNoValidos = false;

        for (var i = 0; i < files.length; i++) {
            element = files[i];
            
            if (supportedImages.indexOf(element.type) != -1) {
                createPreview(element);
            }
            else {
                seEncontraronElementoNoValidos = true;
            }
        }

        //Aquí empieza la creación de un nuevo input file
        $("#add-new-photo").removeAttr("id");
        var newInputFile = createInputFile();
        $("#add-photo-container").append(newInputFile);

        if (seEncontraronElementoNoValidos) {
            showMessage("Se encontraron archivos no validos.");
        }
        else {
            showMessage("Todos los archivos se subieron correctamente.");
        }
    
    });
    
    // -> Cachamos el evento change

    // Eliminar previsualizaciones
    
    $(document).on("click", "#Images .image-container", function(e){
        $(this).parent().remove();
    });
    
    // -> Eliminar previsualizaciones

    // Eliminar imagenes subidas

    $(document).on("click", "#MyImages .image-container", function (e) {
        var parent = $(this).parent();
        var id = $(parent).attr("data-id");
        var data = {
            id : id,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //inicio
            $.ajax({
              type: 'POST',
              url: '/deleteImagen',
              data: JSON.stringify(data),
              contentType: 'application/json',
            })
              .done((data) => {
                console.log({ data });
                showMessage("¡Imagenes eliminadas correctamente!");
                $(parent).remove();
              })
              .fail((err) => {
                console.error(err);
                showMessage("Lo sentimos, hubo un error eliminando esta imagen.");
              })
              .always(() => {
                console.log('always called');
              });
          

        // fin

    });

    // -> Eliminar imagenes subidas

});

//Genera una cadena aleatoria según la longitud dada
function getRandomString(length) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

//Genera las previsualizaciones
function createPreview(file) {
    var imgCodified = URL.createObjectURL(file);
    var rand = getRandomString(5);
    var name = file.name;
    var img = $('<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-xs-12"> <input type="hidden" name="photo-' + rand + '" value="' + name + '"> <div class="image-container"> <figure> <img src="' + imgCodified + '" alt="Foto del usuario"> <figcaption> <i class="icon-cross"></i> </figcaption> </figure> </div></div>');
    $(img).insertBefore("#add-photo-container");
}

//Crea un nuevo input file
function createInputFile() {
    var rand = getRandomString(5);
    return $('<input type="file" multiple id="add-new-photo" name="photo-file-' + rand + '[]">');
}

function showModal(card) {
    $("#" + card).show();
    $(".modal").addClass("show");
  }
  
  function closeModal() {
    $(".modal").removeClass("show");
    setTimeout(function () {
      $(".modal .modal-card").hide();
    }, 300);
  }
  
  function loading(status, tag) {
    if (status) {
      $("#loading .tag").text(tag);
      showModal("loading");
    }
    else {
      closeModal();
    }
  }
  
  function showMessage(message) {
    $("#Message .tag").text(message);
    showModal("Message");
  }