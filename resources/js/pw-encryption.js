// 获取按钮元素并添加点击事件
const loginBtn = document.querySelector('button[type="submit"]');
loginBtn.addEventListener('click', function (event) {
  // 防止表单默认提交行为
  event.preventDefault();

  // 获取密码输入框元素和其值
  const passwordInput = document.getElementById('passwordInput');
  const password = passwordInput.value;

  // 对密码进行 SHA256 加密
  const encryptedPassword = CryptoJS.SHA256(password).toString();

  console.log("加密後的密碼：", encryptedPassword);

  // TODO: 将加密后的密码发送给后端
});


