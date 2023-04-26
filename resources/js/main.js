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

});