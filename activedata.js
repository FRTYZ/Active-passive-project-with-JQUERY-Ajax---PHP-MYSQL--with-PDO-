$(document).ready(function () {
    $('.ActivePassive').click(function (event) {
        var id = $(this).attr("id");  //we get the id value

        var status = ($(this).is(':checked')) ? '1' : '0';
        //According to the checkbox, we get the information whether it is active or passive.

        $.ajax({
            type: 'POST',
            url: 'activepassive.php',  //We indicate the page we are processing
            data: {id: id, status: status}, //We send our data
            success: function (result) {
                $('#result').text(result);
                //We show the result in h2 tag
            },
            error: function () {
                alert('Error');
            }
        });
    });
});