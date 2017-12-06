$(function(){
    var fadeOn = false;
    if(localStorage['currentPage'] === undefined){
        localStorage['currentPage']="home";
    }
    checkoutMenu($("a[va="+localStorage['currentPage']+"]"));
    $(".nav-masthead a").click(function(){
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
    return false;
}