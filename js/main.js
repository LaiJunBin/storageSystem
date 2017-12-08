$(function(){
    var fadeOn = false;
    if(localStorage['currentPage'] === "undefined"){
        localStorage['currentPage']="home";
    }
    checkoutMenu($("a[va="+localStorage['currentPage']+"]"));
    $(".nav-masthead a").click(function(){
        if($(this).attr("va")=="LogOut"){
            $.ajax({
                url: './database/LogOut.php',
                type: 'GET',
                error: function(xhr) {
                    alert('Ajax request 發生錯誤')
                },
                success: function(result) {
                    localStorage.removeItem("autoLogin");
                    alert("登出成功!");
                    $("a[va=home]").click();
                    location.reload();
                }
            });
        }else if($(this).attr("va")!=localStorage['currentPage'])
            checkoutMenu(this);
    });
    function checkoutMenu(obj){
        localStorage['currentPage'] = $(obj).attr("va");
        $(".content").css("display","none");
        if (fadeOn){
            $("div[type="+localStorage['currentPage']+"]").fadeIn();
        }else{
            $("div[type="+localStorage['currentPage']+"]").css("display","block");
            fadeOn=true;
        }
        
        $(".nav-masthead a").removeClass("active");
        $(obj).addClass("active");
    }
});
function onLogin(){
    var username = $("input[name=username]").val();
    var password = $("input[name=password]").val();
    var autoLogin = $("input[name=autoLogin]").prop("checked");
    $.ajax({
        url: './database/Login.php',
        type: 'POST',
        data: {
            username:username,
            password:password,
            autoLogin:autoLogin,
        },
        error: function(xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function(result) {
            if(result=="false"){
                alert("帳號或密碼錯誤!");
            }else{
                if(autoLogin){
                    localStorage['autoLogin']=result;
                }
                $("a[va=home]").click();
                location.reload();
            }
        }
    });
    return false;
}