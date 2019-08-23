/*global $ */
$(function() {
    function slideMenu() {
        var activeState = $("#menu-container .menu-list").hasClass("active");
        $("#menu-container .menu-list").animate({
            left: activeState ? "0%" : "-100%"
        }, 400);
    }
    $("#menu-wrapper").click(function(event) {
        event.stopPropagation();
        $("#hamburger-menu").toggleClass("open");
        $("#menu-container .menu-list").toggleClass("active");
        slideMenu();

        $("body").toggleClass("overflow-hidden");
    });

    $(".menu-list").find(".accordion-toggle").click(function() {
        $(this).next().toggleClass("open").slideToggle("fast");
        $(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");

        $(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
        $(".menu-list .accordion-toggle").not(jQuery(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
    });
}); // jQuery load

function logout() {
    if (window.confirm('ログアウトしても宜しいですか？')) {
        location.href = "logout.php";
    }
}

jQuery('.icon-hamburger').on('click', function() {
    jQuery('body').append('<div id="modal-overlay"></div>');
    jQuery('#modal-overlay').fadeIn('1500');
    jQuery('.menu-container .menu').fadeIn('1500');
});

jQuery(document).on('click', '#modal-overlay', function() {
    jQuery('#modal-overlay').fadeOut('1500');
    jQuery('.menu-container .menu').fadeOut('1500');
});

function delUsercheck() {
    if (window.confirm('削除すると勤怠情報も削除されます。　削除してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function delcheck() {
    if (window.confirm('削除してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}

function pwcheck() {
    var element = document.getElementById("password");
    var element2 = document.getElementById("pass");
    if (element.value != element2.value) {
        alert("パスワードが一致していません。");
        return false;
    }

    if (window.confirm('パスワードを更新してもよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}