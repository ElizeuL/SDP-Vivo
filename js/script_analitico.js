// READ records
function readRecords(month) {
            $('#ajax_loader').show();
            $.ajax({
                type: "Get",
                url: "ajax/analitico/readRecords.php?month="+month,
                success: function (data,status) {
                   $(".records_content").html(data);
                },
                error: function(result) {
                    alert("error!" + result);
                },
                complete: function () {
                    //back to normal!
                    $('#ajax_loader').hide();
                }
            });	
}

$(document).ready(function () {
    var month = document.getElementById('reference_month').value;
    //alert("teste = "+month);
    // READ recods on page load
    readRecords(month); // calling function
});