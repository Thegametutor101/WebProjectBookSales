let getUrl = window.location;
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];


let getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function connectAccount() {
    $(".loginButton").click(function (e) {
        e.preventDefault();
        let email = $("#email").val();
        let password = $("#password").val();
        let values = {
            "email" : email,
            "password" : password
        }
        $.ajax({
            url: "../../Management/login.php",
            type: "POST",
            data: values,
            dataType: "json",
            success: function(result){
                if (result["message"] === "ok") {
                    window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=1";
                } else if (result["message"] === "no") {
                    $(".messages").empty();
                    $(".messages").append("<div>Courriel ou mot de passe invalide.</div><br><hr>")
                } else if (result["message"] === "not email") {
                    $(".messages").empty();
                    $(".messages").append("<div>Veuillez entrer un courriel valide.</div><br><hr>")
                } else if (result["message"] === "error") {
                    $(".messages").empty();
                    $(".messages").append("<div>Veuillez entrer des données valides.</div><br><hr>")
                }

            },
            error: function (message, er) {
                console.log("login: " + er);
            }
        });
    });
    $(".createAccountButton").click(function () {
        window.location.href = baseUrl + "/Pages/UserPages/addUser.html";
    });
}
function headerListener() {
    $('.addButton').click(function () {
        if (getUrlParameter('isLoggedIn') === "0" || isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/BookPages/addBook.html";
        } else {
            window.location.href = baseUrl + "/Pages/BookPages/addBook.html?isLoggedIn=1";
        }
    });
    $('.homeButton').click(function () {
        if (getUrlParameter('isLoggedIn') === "0" || isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/index.html";
        } else {
            window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=1";
        }

    });
    $('.profilePicture').click(function () {
        if (getUrlParameter('isLoggedIn') === "0" || isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/UserPages/connectUser.html";
        } else {

        }
    });
    $('.searchSubmit').click(function () {
        let text = $("#searchValue").val();
        let filter = $(".searchFilter").text();
        let sort = $(".searchSort").text();
        filter = filter.replace(/é/g, "e");
        sort = sort.replace(/é/g, "e");
        let values = {
            "searchValue" : text,
            "searchFilter" : filter,
            "searchSort" : sort
        }
        $.ajax({
            url: "../Management/loadBooks.php",
            type: "POST",
            data: values,
            dataType: "json",
            success: function(result){
                $(".bookList").empty();
                if (result["notFound"]) {
                    $(".messages").empty();
                    $(".messages").append("<div>Aucun livre correspondant à votre recherche n'a été trouvé.</div><br><hr>")
                } else {
                    $(".messages").empty();
                }
                printCards(result["lines"]);
                cardClick();
                formatBookCover();
            },
            error: function (message, er) {
                console.log("downloading book list: " + message);
            }
        });


    });
}
function cardClick()
{
    $('.card').click(function(){
        // let item = $(this).find(".id").text();
        // if (confirm("Voullez vous vraiment supprimer la formation : " + item)) {
        //     // window.location.href = "index.html?formationID=" + item.substr(1, item.length);
        //     console.log("ded");
        // }
    });
}
function printCards(list) {
    console.log("downloading book list: success");
    console.log(list);
    for (i = 0; i < list.length; i++) {
        if (list[i][5] === "1") {
            $(".bookList").append(
                "<div class='card'>" +
                "<img src='../ressources/bookPictures/" + list[i][0] + "' class='bookPicture' alt='" + list[i][1] + "'>" +
                "<div class='id' style=';vertical-align: top;display: none'>" + list[i][0] + "</div>" +
                "<div class='title' style=';vertical-align: top;display: none'>" + list[i][1] + "</div>" +
                "<div class='author' style=';vertical-align: top;display: none'>" + list[i][2] + "</div>" +
                "<div class='category' style=';vertical-align: top;display: none'>" + list[i][3] + "</div>" +
                "<div class='price' style=';vertical-align: top;display: none'>" + list[i][6] + "</div>" +
                "<div class='available' style=';vertical-align: top;display: none'>" + list[i][5] + "</div>" +
                "</div>");
        }
    }
}
function formatBookCover() {
    $('.card').find('img').each(function(i, item){
        $(this).css({"width":"100%", "height":"100%"});
    });
}
