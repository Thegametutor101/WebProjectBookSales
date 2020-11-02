
let getUrl = window.location;
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];

function headerListener() {
    $('.addButton').click(function () {
        window.location.href = baseUrl + "/Pages/BookPages/addBook.html";
    });
    $('.homeButton').click(function () {
        window.location.href = baseUrl + "/Pages/index.html";
    });
}

function cardClick()
{
    $('.card').click(function(){
        let item = $(this).find(".id").text();
        if (confirm("Voullez vous vraiment supprimer la formation : " + item)) {
            // window.location.href = "index.html?formationID=" + item.substr(1, item.length);
            console.log("ded");
        }
    });
}