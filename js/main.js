var mainJsLoad = true;
$(function () {
    $( "#classSet,#itemSet" ).buttonset();
    var fadeOn = false;
    if (typeof(localStorage['currentPage']) === "undefined" || localStorage['currentPage']=="undefined") {
        localStorage['currentPage'] = "home";
    }
    checkoutMenu($("a[va=" + localStorage['currentPage'] + "]"));
    $(".nav-masthead a,.content a").click(function () {
        if ($(this).attr("va") == "LogOut") {
            $.ajax({
                url: './database/LogOut.php',
                type: 'GET',
                error: function (xhr) {
                    alert('Ajax request 發生錯誤')
                },
                success: function (result) {
                    localStorage.removeItem("autoLogin");
                    alert("登出成功!");
                    reload();
                }
            });
        } else if ($(this).attr("va") !== undefined && $(this).attr("va") != localStorage['currentPage'])
            checkoutMenu(this);
        // console.log($(this).attr("va"));
    });
    function checkoutMenu(obj) {
        if($(obj).attr("va")==undefined){
            reload();
        }else{
            localStorage['currentPage'] = $(obj).attr("va");
            $(".content").css("display", "none");
            if (fadeOn) {
                $("div[type=" + localStorage['currentPage'] + "]").fadeIn();
            } else {
                $("div[type=" + localStorage['currentPage'] + "]").css("display", "block");
                fadeOn = true;
            }
            if (!$(obj).hasClass("btn")) {
                $(".nav-masthead a").removeClass("active");
                $(obj).addClass("active");
            }
        }
    }
    mainJsLoad = typeof(checkoutMenu)==undefined?false:mainJsLoad;
    // alert(typeof(checkoutMenu));
    // alert(mainJsLoad);
});
function onLogin() {
    var username = $("input[name=username]").val();
    var password = $("input[name=password]").val();
    var autoLogin = $("input[name=autoLogin]").prop("checked");
    $.ajax({
        url: './database/Login.php',
        type: 'POST',
        data: {
            username: username,
            password: password,
            autoLogin: autoLogin,
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            if (result == "false") {
                alert("帳號或密碼錯誤!");
            } else {
                if (autoLogin) {
                    localStorage['autoLogin'] = result;
                }
                reload();
            }
        }
    });
    return false;
}

function addClassName() {
    $.ajax({
        url: './database/insert.php',
        type: 'POST',
        data: {
            table: "storage_classlist",
            title: ["sc_className"],
            data: [$("div[type=addClassName] input[name=className]").val()],
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            alert("新增成功!");
            reload();
        }
    });
    return false;
}

function removeClassName() {
    $.ajax({
        url: './database/delete.php',
        type: 'POST',
        data: {
            table: "storage_classlist",
            title: "sc_className",
            data: $("div[type=removeClassName] input[name=className]").val(),
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            alert("刪除成功!");
            reload();
        }
    });
    return false;
}

function addItem() {
    $.ajax({
        url: './database/insert.php',
        type: 'POST',
        data: {
            table: "storage_itemlist",
            title: ["si_item","si_unit"],
            data: [$("div[type=addItem] input[name=item]").val(),$("div[type=addItem] input[name=unit]").val()],
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            alert("新增成功!");
            reload();
        }
    });
    return false;
}

function removeItem() {
    $.ajax({
        url: './database/delete.php',
        type: 'POST',
        data: {
            table: "storage_itemlist",
            title: "si_item",
            data: $("div[type=removeItem] input[name=item]").val(),
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            alert("刪除成功!");
            reload();
        }
    });
    return false;
}

function purchase() {
    var item = $("#itemSet input:checked").attr("va");
    var className = $("#classSet input:checked").attr("va");
    var amount = $("input[name=amount]").val();
    $.ajax({
        url: './database/insert.php',
        type: 'POST',
        data: {
            table: "storage_record",
            title: ["sr_item","sr_amount","sr_location"],
            data: [item,amount,className],
        },
        error: function (xhr) {
            alert('Ajax request 發生錯誤')
        },
        success: function (result) {
            alert("新增紀錄成功!");
            reload();
        }
    });
    return false;
}

function reload() {
    $("a[va=home]").click();
    location.href="index.html";
}
