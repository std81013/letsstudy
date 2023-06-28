//TODO: 欄位驗證還沒做 (活動發表編輯、註冊、參加活動、個人設定頁面、修改密碼、登入、忘記密碼)

$(function(){
    $('#form').validate({
        /* 常用檢測屬性
        required:必填
        noSpace:空白
        minlength:最小長度
        maxlength:最大長度
        email:信箱格式
        number:數字格式
        url:網址格式https://www.minwt.com
        */
        onkeyup: function(element, event) {
            //去除左側空白
            var value = this.elementValue(element).replace(/^\s+/g, "");
            $(element).val(value);
        },
        rules: {
            fname: {
                required: true
            },
            phone:{
                required: true,
                minlength: 8,
                        number: true
            },
            address: 'required',
            url:{
                url: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            fname: {
                required:'必填'
            },
            phone: {
                required:'必填',
                minlength:'不得少於8位',
                number:'電話需為數字'
            },
            address: '必填',
            email: {
                required:'必填',
                email:'Email格式不正確'
            },
            url:'網址格式不正確'        
        },
        submitHandler: function(form) {
            form.submit();
        }
    });


});