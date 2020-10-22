$(document).ready(function () {
    let getUrl = window.location;
    let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2];
    $('.addButton').click(function () {
        window.location.href = baseUrl + "/Pages/addItem.php";
    });
    $('.homeButton').click(function () {
        window.location.href = baseUrl + "/index.php";
    });
    $('.card').click(function(){
        let item = $(this).find(".id")     // Gets a descendent with class="nr"
            .text();         // Retrieves the text within <td>
        if (confirm("Voullez vous vraiment supprimer la formation : " + item.substr(1, item.length))) {
            window.location.href = "index.php?formationID=" + item.substr(1, item.length);
        }
    });
});
$(document).ready(function(){
    let date_input=$('input[name="date"]'); //our date input has the name "date"
    let container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    let options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options);
});
function todayDate() {
    var today = new Date(); // get the current date
    var dd = today.getDate(); //get the day from today.
    var mm = today.getMonth()+1; //get the month from today +1 because january is 0!
    var yyyy = today.getFullYear(); //get the year from today

    //if day is below 10, add a zero before (ex: 9 -> 09)
    if(dd<10) {
        dd='0'+dd
    }

    //like the day, do the same to month (3->03)
    if(mm<10) {
        mm='0'+mm
    }

    //finally join yyyy mm and dd with a "-" between then
    return yyyy+'-'+mm+'-'+dd;
}
$(document).ready(function(){
    $('#date').attr('min', todayDate());
    $('#date').attr('value', todayDate());
});