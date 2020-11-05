let getUrl = window.location;
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];

function headerListener() {
    $('.addButton').click(function () {
        window.location.href = baseUrl + "/Pages/BookPages/addBook.html";
    });
    $('.homeButton').click(function () {
        window.location.href = baseUrl + "/Pages/index.html";
    });
    $('.searchSubmit').click(function () {
        let text = $("#searchValue").text();
        let filter = $(".searchFilter").text();
        let sort = $(".searchSort").text();
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
                printCards(result["lines"]);
                cardClick();
                formatBookCover();
            },
            error: function (message, er) {
                console.log("downloading book list: " + er);
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
    for (i = 0; i < list.length; i++) {
        if (list[i][5] === "1") {
            $(".container").append(
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
    $(window).load(function(){
        $('.card').find('img').each(function(){
            let imgClass = (this.width/this.height > 1) ? 'wide' : 'tall';
            $(this).addClass(imgClass);
        });
    });
}
