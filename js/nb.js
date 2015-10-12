  function trim(str){ //删除左右两端的空格
      　　     return str.replace(/(^\s*)|(\s*$)/g, "");
    　　}
    $(".mail_button").click(function(){
      var unitname = $('input[name="unitname"]').val();
      if(unitname == '单位名称*' || trim(unitname) == ''){
        $('input[name="unitname"]').focus();
        return false;
      }
      var realname = $('input[name="realname"]').val();
      if(realname == '姓名*' || trim(realname) == ''){
        $('input[name="realname"]').focus();
        return false;
      }
      var business = $('input[name="business"]').val();
      if(business == '职务*' || trim(business) == ''){
        $('input[name="business"]').focus();
        return false;
      }
      var phone    = trim($('input[name="phone"]').val());
      if(phone == '电话/手机*' || phone == ''){
        $('input[name="phone"]').focus();
        return false;
      }
      if(!(/^1[3|5|7|8]\d{9}$/.test(phone))) {
        $(".warning").css({"display":"block"});
        return false;
      }else{
        $(".warning").css({"display":"none"});
      }
      // var email    = $('input[name="email"]').val();
      // if(email == '邮箱' || trim(email) == ''){
      //   $('input[name="email"]').focus();
      //   return false;
      // }
      // if(!(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(email))){
      //   alert('邮箱不正确');
      //   return false;
      // }
      $.ajax({
        url: "sendmail.php",
        type: 'POST',
        data:{unitname:unitname,realname:realname,business:business,phone:phone},
        dataType: "json",
        success:function(data){
          if(data.status == 1){
            $(".fade_content_form").css({"display":"none"});
            $(".fade_content_succuss").css({"display":"block"});
            setTimeout(function(){$('.fade_content_succuss').css({'display':'none'});location.reload();},3000);
            //成功
          }else{
            alert("邮件发送失败");
            //失败
          }
        },
        error:function(){
          //超时
        }
      });
    });