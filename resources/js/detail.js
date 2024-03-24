
$(function() {
    flatpickr(".anotherSelector", {});
    flatpickr("#activityStartDateInput", {
      minDate: "today",
      dateFormat: "Y-m-d",
      onClose: function(selectedDates) {
          // 在選擇日期後的操作
          if (selectedDates.length > 0) {
              // 如果選擇了日期，將相應的時間輸入框解除禁用
              $('#activityStartTimeInput').prop('disabled', false);
          } else {
              // 如果未選擇日期，保持相應的時間輸入框禁用
              $('#activityStartTimeInput').prop('disabled', true);
          }
      }
    });

    flatpickr("#activityEndDateInput", {
      minDate: "today",
      dateFormat: "Y-m-d",
        onClose: function(selectedDates) {
            // 在選擇日期後的操作
            if (selectedDates.length > 0) {
                // 如果選擇了日期，將相應的時間輸入框解除禁用
                $('#activityEndTimeInput').prop('disabled', false);
            } else {
                // 如果未選擇日期，保持相應的時間輸入框禁用
                $('#activityEndTimeInput').prop('disabled', true);
            }
        }
    });

    flatpickr("#activityStartTimeInput", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i", // 24 小时制
      // 或者使用下面的选项进行 12 小时制
      // dateFormat: "h:i K", // 12 小时制
      disableMobile: true // 在移动设备上禁用原生时间选择器
    });
    flatpickr("#activityEndTimeInput", {
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i", // 24 小时制
      // 或者使用下面的选项进行 12 小时制
      // dateFormat: "h:i K", // 12 小时制
      disableMobile: true // 在移动设备上禁用原生时间选择器
    });

    if ($('#activityEndTimeInput').val() != '') {
      $('#activityEndTimeInput').prop('disabled', false);
    }

    if ($('#activityStartTimeInput').val() != '') {
      $('#activityStartTimeInput').prop('disabled', false);
    }

    var quill = new Quill( "#amDetailsTextarea", {
        theme: "snow",
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], // 粗體、斜體、底線和刪節線
                ['blockquote', 'code-block'], // 區塊、程式區塊
                [{ 'header': 1 }, { 'header': 2 }], // 標題1、標題2
                [{ 'list': 'ordered'}, { 'list': 'bullet' }], // 清單
                [{ 'script': 'sub'}, { 'script': 'super' }], // 上標、下標
                [{ 'indent': '-1'}, { 'indent': '+1' }], // 縮排
                [{ 'direction': 'rtl' }], // 文字方向
                [{ 'size': ['small', false, 'large', 'huge'] }], // 文字大小
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],// 標題
                [{ 'color': [] }, { 'background': [] }], // 顏色
                [{ 'font': [] }], // 字體
                [{ 'align': [] }], // 文字方向
                [ 'clean' ] // 清除文字格是
            ]
        }
    });

    $('.filepond').filepond();

    if ($('#id').val() != '') {
        let fileObject = FilePond.find(document.querySelector('.filepond'));
        fileObject.addFile('../../' + $('#prevImagePath').val());

        $('#amTitleInput').val($('#prevAmTitleInput').val());
        $('#amTypeSelect').val($('#prevAmTypeSelect').val());
        $('#joinNumberInput').val($('#prevJoinNumberInput').val());
        $('#amLocationInput').val($('#prevAmLocationInput').val());
        $('#organiserEmailInput').val($('#prevOrganiserEmailInput').val());
        $('#organizerInfoTextarea').val($('#prevOrganizerInfoTextarea').val());
        $('#amGoalPlanTextarea').val($('#prevAmGoalPlanTextarea').val());
        $('#organizerInfoTextarea').val($('#prevOrganizerInfoTextarea').val());
        $('#amNoticeTextarea').val($('#prevAmNoticeTextarea').val());
        flatpickr(".anotherSelector").setDate($('#prevDeadlineInput').val());

        quill.setContents(JSON.parse($('#prevDetail').val()));
    }

    $('#postEvent, #saveEvent').on('click', function (event) {
        event.preventDefault();
        if (event.target.id === 'postEvent') {
          $('#isPost').val('1');
        }
    
        let formData = new FormData(document.getElementById('activityManageForm'));
        formData.append('detail', $('#amDetailsTextarea .ql-editor')[0].innerHTML);    
        formData.append('delta_json', JSON.stringify(quill.getContents()));
        formData.append('_token', $('#csrfToken').val());
    
        let fileObject = FilePond.find(document.querySelector('.filepond'));
        let file = fileObject.getFile();
        formData.append('filename', file.filename);
        formData.append('file', file.file);
    
        let registrationDateElement = document.getElementById("deadlineInput")._flatpickr;
        formData.append('registrationDate', getFormatedDate(registrationDateElement.selectedDates[0]));
    
        let activityStartDateElement = document.getElementById("activityStartDateInput")._flatpickr;
        let activityStartTimeElement = document.getElementById("activityStartTimeInput")._flatpickr;
        formData.append('startDate', getFormatedDate(activityStartDateElement.selectedDates[0]) + ' ' + getFormatedTime(activityStartTimeElement.selectedDates[0]));

        if ($('#disableDate').is(':checked') == false) {
          let activityEndDateElement = document.getElementById("activityEndDateInput")._flatpickr;
          let activityEndTimeElement = document.getElementById("activityEndTimeInput")._flatpickr;
          formData.append('endDate', getFormatedDate(activityEndDateElement.selectedDates[0]) + ' ' + getFormatedTime(activityEndTimeElement.selectedDates[0]));
        }
    
        $.ajax({
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          url: '/event/store',
        }).done(function( success ) {
          if ( success ) {
            if ($('#isPost').val() == '1') {
              alert('發布成功');
              window.location.href = '/event/list'; 
            } else {
              alert('儲存成功');
            }
          } else {
            alert('儲存失敗');
          }
          $('#isPost').val('0');
        });
    });

    $('#deleteEvent').on('click', function (event) {
      event.preventDefault();
      $('#isPost').val('9');

      let formData = new FormData(document.getElementById('activityManageForm'));
      formData.append('_token', $('#csrfToken').val());

      $.ajax({
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        url: '/event/delete',
      }).done(function( success ) {
        if ( success ) {
          alert('解散成功');
          window.location.href = '/event/list'; 
        } else {
          alert('解散失敗');
        }
      });
    });

    $('#disableDate').on('change',function() {
      if(this.checked) {
          // 當checkbox被勾選時，設定日期和時間輸入框為disabled狀態
          $('#activityEndDateInput').prop('disabled', true).val('');
          $('#activityEndTimeInput').prop('disabled', true).val('');
          $('#activityEndDateInput-error').remove();
      } else {
          // 當checkbox未被勾選時，移除日期和時間輸入框的disabled狀態
          $('#activityEndDateInput').prop('disabled', false);
          $('#activityEndTimeInput').prop('disabled', true);
      }
    });
    if ($('#activityEndDateInput').val() == '' && $('#activityEndTimeInput').val() == '') {
      $('#disableDate').prop('checked', true).trigger('change');
    }
});

function getFormatedTime(date) {
    let hours = (date.getHours() < 10) ? '0' + date.getHours() : date.getHours();
    let minutes =  (date.getMinutes() < 10) ? '0' + date.getMinutes() : date.getMinutes();
    return hours + ':' + minutes;
}
  
function getFormatedDate(date) {
    return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
}