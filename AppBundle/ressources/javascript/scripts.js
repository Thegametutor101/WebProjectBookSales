let getUrl = window.location;
let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];
    
let completeUrlAdd= baseUrl + "/Pages/UserPages/addUser.html"
$('.addButton').click(function() {location.replace(completeUrlAdd);});

let completeUrlMain= baseUrl + "/Pages/index.html"
$('.addButton').click(function() {location.replace(completeUrlMain);});
/*
$(document).ready(function () {
    let getUrl = window.location;
    let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];
    
    $('.addButton').click(function () {
        console.log(baseUrl);
    //  window.location.href = baseUrl + "/Pages/UserPages/addUser.html";
    });
    $('.homeButton').click(function () {
        window.location.href = baseUrl + "/Pages/index.html";
    });
    $('.card').click(function(){
        let item = $(this).find(".id")     // Gets a descendent with class="nr"
            .text();         // Retrieves the text within <td>
        if (confirm("Voullez vous vraiment supprimer la formation : " + item.substr(1, item.length))) {
            window.location.href = "index.html?formationID=" + item.substr(1, item.length);
        }
    });
});*/
