// Add Record
function addRecord() {
    // get values
    var bloco = $("#bloco").val();
    var sistema = $("#sistema").val();
    var descricao_sistema = $("#descricao_sistema").val();

    // Add record
    $.post("ajax/blocos/addRecord.php", {
        bloco: bloco,
        sistema: sistema,
        descricao_sistema: descricao_sistema
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#bloco").val("");
        $("#sistema").val("");
        $("#descricao_sistema").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/blocos/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function Delete(id) {
    var conf = confirm("Tem certeza que deseja excluir?");
    if (conf == true) {
        $.post("ajax/blocos/deleteRecord.php", {
                id: id
            },
            function (data, status) {
                // reload Records by using readRecords();
                readRecords();
            }
        );
    }
}

function GetDetails(id) {
    // Add User ID to the hidden field for furture usage
    //$("#hidden_user_id").val(id);
    $.post("ajax/blocos/readDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var obj = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_id").val(obj.ID);  
            $("#update_bloco").val(obj.BLOCO);            
            $("#update_sistema").val(obj.SISTEMA);  
            $("#update_descricao_sistema").val(obj.DESCRICAO_SISTEMA);  
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function UpdateDetails() {
    // get values
    var id = $("#update_id").val();
    var bloco = $("#update_bloco").val();
    var sistema = $("#update_sistema").val();
    var descricao_sistema = $("#update_descricao_sistema").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/blocos/updateDetails.php", {
            id: id,
            bloco: bloco,
            sistema: sistema,
            descricao_sistema: descricao_sistema
        },
        function (data, status) {
            // hide modal popup
            $("#update_modal").modal("hide");
            // reload Records by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});