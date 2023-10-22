
$(function() {
    flatpickr(".anotherSelector", {});
    let activityDateSettings = {
        mode: "range",
        enableTime: true,
        minDate: "today",
        minTime: "00:00",
        dateFormat: "Y-m-d H:i"
    };

    var quill = new Quill( "#editor", {
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

        activityDateSettings.defaultDate = JSON.parse($('#prevActivityDateInput').val());
        
        quill.setContents(JSON.parse($('#prevDetail').val()));
    }
    flatpickr("#activityDateInput", activityDateSettings);

    $('#postEvent, #saveEvent').on('click', function (event) {
        event.preventDefault();
        if (event.target.id === 'postEvent') {
          $('#isPost').val('1');
        }
    
        let formData = new FormData(document.getElementById('activityManageForm'));
        formData.append('detail', $('#editor .ql-editor')[0].innerHTML);    
        formData.append('delta_json', JSON.stringify(quill.getContents()));
        formData.append('_token', $('#csrfToken').val());
    
        let fileObject = FilePond.find(document.querySelector('.filepond'));
        let file = fileObject.getFile();
        formData.append('filename', file.filename);
        formData.append('file', file.file);
    
        let registrationDateElement = document.getElementById("deadlineInput")._flatpickr;
        formData.append('registrationDate', getFormatedDate(registrationDateElement.selectedDates[0]));
    
        let activityDateElement = document.getElementById("activityDateInput")._flatpickr;
        formData.append('startDate', getFormatedDateTime(activityDateElement.selectedDates[0]));
        formData.append('endDate', getFormatedDateTime(activityDateElement.selectedDates[1]));
    
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
});

function getFormatedDateTime(date) {
    let hours = (date.getHours() < 10) ? '0' + date.getHours() : date.getHours();
    let minutes =  (date.getMinutes() < 10) ? '0' + date.getMinutes() : date.getMinutes();
    return getFormatedDate(date) + ' ' + hours + ':' + minutes;
}
  
function getFormatedDate(date) {
    return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
}