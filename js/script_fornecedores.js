// Add Record
function addRecord() {
    // get values
    var cnpj = $("#cnpj").val();
    var razao_social = $("#razao_social").val();

    // Add record
    $.post("ajax/fornecedores/addRecord.php", {
        cnpj: cnpj,
        razao_social: razao_social
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#cnpj").val("");
        $("#razao_social").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/fornecedores/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function Delete(id) {
    var conf = confirm("Tem certeza que deseja excluir?");
    if (conf == true) {
        $.post("ajax/fornecedores/deleteRecord.php", {
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
    $.post("ajax/fornecedores/readDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var obj = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_cnpj").val(obj.CNPJ);            
            $("#update_razao_social").val(obj.RAZAO_SOCIAL);  
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function UpdateDetails() {
    // get values
    var cnpj = $("#update_cnpj").val();
    var razao_social = $("#update_razao_social").val();

    // get hidden field value
    //var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/fornecedores/updateDetails.php", {
            id: cnpj,
            cnpj: cnpj,
            razao_social: razao_social
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