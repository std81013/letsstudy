$(function() {
  //篩選項目添加‘active’狀態
  $('.topic-nav-wrap a').on("click", function() {
      event.preventDefault();
      $('.topic-nav-wrap a').removeClass('tag-active');
      $(this).addClass('tag-active');
  });


// 當點擊沒有 data-topic-filter 屬性的篩選器時，顯示所有 <li> 元素
$('li[data-topic-filter=""]').on("click",function() {
    $('.main-card li').show();
  });

  // 當點擊具有 data-topic-filter 屬性的篩選器時，只顯示符合條件的 <li> 元素
  $('li[data-topic-filter]').on("click",function() {
    var topicTag = $(this).data('topic-filter');
    $('.main-card li').hide();
    $('.main-card li' + topicTag).show();
  });

  $('#resetPwBtn').on('click', function () {
    $.ajax({
      method: 'POST',
      data: {
        _token: $('#csrfToken').val(),
        email: $('#forgetPwEmailInput').val()
      },
      url: '/send/forgetMail',
    }).done(function( success ) {
      if ( success ) {
        alert('郵件已寄出');
      } else {
        alert('寄信失敗');
      }
    });
  });

  $('#saveDraft, #saveEvent').on('click', function (event) {
    event.preventDefault();
    if ($(this).hasClass('draft')) {
      $('#isSaveDraft').val('1');
    }

    let formData = new FormData(document.getElementById('activityManageForm'));
    formData.append('detail', $('#editor .ql-editor')[0].innerHTML);
    formData.append('_token', $('#csrfToken').val());

    let fileObject = FilePond.find(document.querySelector('.filepond'));
    let file = fileObject.getFile();
    formData.append('filename', file.filename);
    formData.append('file', file.file);

    let registrationDateElement = document.getElementById("deadlineInput")._flatpickr;
    formData.append('registrationDate', getFormatedDate(registrationDateElement.selectedDates[0]));

    let activityDateElement = document.getElementById("activityDateInput")._flatpickr;
    formData.append('startDate', getFormatedDateTime(activityDateElement.selectedDates[0]));
    formData.append('endDate', getFormatedDateTime(activityDateElement.selectedDates[1]));//format

    $.ajax({
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      url: '/event/store',
    }).done(function( success ) {
      if ( success ) {
        if ($('#isSaveDraft').val() == '1') {
          alert('儲存成功');
        } else {
          alert('發布成功');
        }
      } else {
        alert('儲存失敗');
      }
      $('#isSaveDraft').val('0');
    });
  });
});

function getFormatedDateTime(date) {
  let hours = (date.getHours() < 10) ? '0' + date.getHours() : date.getHours();
  let minutes =  (date.getMinutes() < 10) ? '0' + date.getMinutes() : date.getMinutes();
  return getFormatedDate(date) + ' ' + hours + ':' + minutes;
}

function getFormatedDate(date) {
  return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
}