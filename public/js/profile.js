function errorMsg(msg) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    Command: toastr["error"](msg);
}

function FindFile() { document.getElementById('FindFile').click(); }

function LoadFile() { document.getElementById('loadFile').click(); }

function changePhoto(data) {
    $('#photo').attr("src", data);
    $('#photo_main').attr("src", data);
}

$(document).ready(function() {
    $('#loadPhoto').on('submit',
        e => {
            e.preventDefault();
            let formData = new FormData(e.currentTarget);
            $.ajax({
                url: '/upload/photo',
                method: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data == -1) errorMsg('Файл не загружен!');
                    else if (data == -2) errorMsg('Файл не прошел проверку!');
                    else if (data == -3) errorMsg('Файл не прошел валидацию!');
                    else if (data == -4) errorMsg('Файла нет!');
                    else changePhoto(data);
                },
                error: function(msg) {
                    changePhoto(msg.responseText);
                }
            });
        }
    )


});

function DiscardPerson(person){
  Swal.fire({
   title: 'Вы действительно хотите дать отказ данной персоне?',
   icon: 'warning',
   showCancelButton: true,
   showConfirmButton: true,
   cancelButtonText: 'Нет',
   confirmButtonText: 'Да',
   input: 'textarea',
   inputPlaceholder: 'Введите причину отказа...',
    customClass: {
     confirmButton: 'confirm-button-disc-pers',
     input: 'comment-textarea',
   }
  }).then((result) => {
   if(result.dismiss === 'cancel'){
    return false;
   }else{
      if( $('.comment-textarea').val() != ''){
       $.ajax({
      url: '/discard_checked_abit',
      type: 'POST',
      data: {
          comment:  $('.comment-textarea').val(),
          person : person
      },
      headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        if(data == 1){
         Swal.fire({
          title: 'Комментарий успешно добавлен!',
          icon: 'success',
         });
        }
      }
     });
      }else{
        Swal.fire({
         title: 'Укажите причину отказа!',
         icon: 'error',
        }).then((result) => {
          DiscardPerson(person);
        });
      }
   }
 });
}

function CheckedPerson(person){
 Swal.fire({
  title: 'Вы действительно хотите установить статус "Проверен" для данной персоны?',
  icon: 'warning',
  showCancelButton: true,
  showConfirmButton: true,
  cancelButtonText: 'Нет',
  confirmButtonText: 'Да',
 }).then((result) => {
  if(result.dismiss === 'cancel'){
   return false;
  }else{
   $.ajax({
  url: '/checked_abit',
  type: 'get',
  data: {
      pid : person
  },
  headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  },
  success: function(){
     Swal.fire({
      title: 'Статус успешно обновлён!',
      icon: 'success',
     }).then((result) => { location.reload(); });
  }
 });
  }
 });

}
