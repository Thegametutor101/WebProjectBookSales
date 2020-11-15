let getUrl = window.location;
// let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2] + "/" + getUrl.pathname.split('/')[3] + "/" + getUrl.pathname.split('/')[4];
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
                    window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=" + result['loggedUser'][0];
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
function addUser() {
    $("#phone").keydown(function(){
        let keycode = event.keyCode || event.charCode;
        let value = $("#phone").val();
        let length = $("#phone").val().length;
        if (keycode !== 8 && keycode !== 46) {
            if (length === 4 && (value.substr(0,1) !== "(")) {
                $("#phone").val("(" + value.substr(0, 3) + ") " + value.substr(3));
            }
            if (length === 10 && value.substr(9) !== "-") {
                $("#phone").val(value.substr(0, 9) + "-" + value.substr(9));
            }
        } else {
            if (length === 8) {
                $("#phone").val(value.substr(1, 3) + value.substr(6));
            }
            if (length === 12) {
                console.log("ok");
                $("#phone").val(value.substr(0, 9) + value.substr(10));
            }
        }
    });
    $(".submitButton").click(function (e) {
        e.preventDefault();
        let firstName = $("#firstName").val();
        let lastName = $("#lastName").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let password = $("#password").val();
        let passwordConfirm = $("#passwordConfirm").val();
        let values = {
            "firstName": firstName,
            "lastName": lastName,
            "email": email,
            "phone": phone,
            "password": password
        }
        if (phone.match(/(?:\(\d{3}\)|\d{3})[ ]?\d{3}[- ]?\d{4}/g)) {
            if (isNaN(password) || isNaN(passwordConfirm)) {
                if (password === passwordConfirm) {
                    $.ajax({
                        url: "../../Management/addUser.php",
                        type: "POST",
                        data: values,
                        dataType: "json",
                        success: function(result){
                            if (result["message"] === "ok") {
                                window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=" + result['loggedUser'][0];
                            } else if (result["message"] === "no") {
                                $(".messages").empty();
                                $(".messages").append("<div>Il existe déjà un compte sur ce courriel<br>Ou une erreur est survenue.</div><br><hr>")
                            }
                        },
                        error: function (message, er) {
                            console.log("downloading book list: " + er);
                        }
                    });
                } else {
                    $(".messages").empty();
                    $(".messages").append("<div>Veuillez confirmer votre mot de passe.</div><br><hr>");
                }
            } else {
                $(".messages").empty();
                $(".messages").append("<div>Veuillez entrer et confirmer votre mot de passe.</div><br><hr>");
            }
        } else {
            $(".messages").empty();
            $(".messages").append("<div>Veuillez entrer un téléphone valide.</div><br><hr>");
        }
    });
    $(".resetButton").click(function (e) {
        $(".inputs").val("");
    });
}
function addBook() {
    $(".submitButton").click(function (e) {
        e.preventDefault();
        let regex = /[^a-z0-9 _.'éèêûîâàçïëöä:;,?!-]/gi;
        let title = $("#title").val().replace(regex, '');
        let author = $("#author").val().replace(regex, '');
        let category = $("#category").val().replace(/[^a-z0-9 ,'éèêûîâàçïëöä]/gi, ',');
        let description = $("#description").val().replace(regex, '');
        let price = parseFloat($("#price").val().replace(/[^0-9.]/gi, ',')).toFixed(2);
        let formData = new FormData();
        let files = $('#cover')[0].files;
        if (title.length > 1) {
            if (author.length > 1) {
                if (category.length > 1) {
                    if ($("#availableBookYes").is(':checked') || $("#availableBookNo").is(':checked')) {
                        let available = 0;
                        if ($("#availableBookYes").is(':checked')) {
                            available = 1;
                        }
                        if (!isNaN(price)) {
                            if(files.length > 0 ) {
                                formData.append('title', title);
                                formData.append('author', author);
                                formData.append('category', category);
                                formData.append('description', description);
                                formData.append('available', available);
                                formData.append('price', price);
                                formData.append('cover', files[0]);
                                formData.append('owner', getUrlParameter('isLoggedIn'));
                                $.ajax({
                                    url: "../../Management/addBook.php",
                                    type: "POST",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function(result){
                                        if (result["message"] === "ok") {
                                            window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=" + getUrlParameter('isLoggedIn');
                                        } else if (result["message"] === "no") {
                                            $(".messages").empty();
                                            $(".messages").append("<div>Une erreur est survenue lors de l'ajout du livre.</div><br><hr>")
                                        } else if (result["message"] === "file error") {
                                            $(".messages").empty();
                                            $(".messages").append("<div>Une erreur est survenue lors de l'ajout de l'image de couverture.</div><br><hr>")
                                        }
                                    },
                                    error: function (message, er) {
                                        console.log("downloading book list: " + message);
                                    }
                                });
                            } else {
                                $(".messages").empty();
                                $(".messages").append("<div>Veuillez choisir une image de couverture.</div><br><hr>");
                            }
                        } else {
                            $(".messages").empty();
                            $(".messages").append("<div>Veuillez entrer un prix valide.</div><br><hr>");
                        }
                    } else {
                        $(".messages").empty();
                        $(".messages").append("<div>Veuillez choisir la disponibilitée du livre.</div><br><hr>");
                    }
                } else {
                    $(".messages").empty();
                    $(".messages").append("<div>Veuillez choisir une catégorie.</div><br><hr>");
                }
            } else {
                $(".messages").empty();
                $(".messages").append("<div>Veuillez entrez un autheur.</div><br><hr>");
            }
        } else {
            $(".messages").empty();
            $(".messages").append("<div>Veuillez entrez un titre.</div><br><hr>");
        }
    });
    $(".resetButton").click(function (e) {
        $(".inputs").val("");
        $("#categoryBook").val("0");
        $("#availableBookYes").prop('checked', false);
        $("#availableBookNo").prop('checked', false);
    });
}
function headerListener() {
    $('.addButton').click(function () {
        if (isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/BookPages/addBook.html";
        } else {
            window.location.href = baseUrl + "/Pages/BookPages/addBook.html?isLoggedIn=" + getUrlParameter('isLoggedIn');
        }
    });
    $('.homeButton').click(function () {
        if (isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/index.html";
        } else {
            window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=" + getUrlParameter('isLoggedIn');
        }
    });
    $('.profilePicture').click(function () {
        if (isNaN(getUrlParameter('isLoggedIn'))) {
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
function buyBook() {
    $(".buyButton").click(function () {
        if (isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/UserPages/connectUser.html";
        } else {
            let values = {
                "bookID": getUrlParameter('id'),
                "userID": getUrlParameter('isLoggedIn')
            };
            $.ajax({
               url: "../../Management/rentBook.php",
               type: "POST",
               data: values,
               dataType: "json",
               success:function (result) {
                    if (result['message'] === "ok") {
                        window.location.href = baseUrl + "/Pages/index.html?isLoggedIn=" + getUrlParameter('isLoggedIn');
                    } else if (result['message'] === "no") {
                        $(".messages").empty();
                        $(".messages").append("<div>Une erreur c'est produite lors de la requête.</div><br><hr>")
                    }
               },
                error:function (message, er) {
                   console.log("erreur lors de l'emprunt: " + message);
                }
            });
        }
    });
}
function cardClick()
{
    $('.card').click(function(){
        let id = $(this).find(".id").text();
        let title = $(this).find(".title").text();
        if (isNaN(getUrlParameter('isLoggedIn'))) {
            window.location.href = baseUrl + "/Pages/BookPages/viewBook.html?id=" + id + "&title=" + title;
        } else {
            window.location.href = baseUrl + "/Pages/BookPages/viewBook.html?isLoggedIn=" + getUrlParameter('isLoggedIn') + "&id=" + id + "&title=" + title;
        }
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
