// Add Record
function addRecord() {
    // get values
    var num_contrato_sap = $("#num_contrato_sap").val();
    var bloco = $("#bloco").val();
    var vigencia_inicial = $("#vigencia_inicial").val();
    var vigencia_final = $("#vigencia_final").val();
    var cnpj = $("#cnpj").val();

    // Add record
    $.post("ajax/contratos/addRecord.php", {
        num_contrato_sap: num_contrato_sap,
        bloco: bloco,
        vigencia_inicial: vigencia_inicial,
        vigencia_final: vigencia_final,
        cnpj: cnpj
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#num_contrato_sap").val("");
        $("#bloco").val("");
        $("#vigencia_inicial").val("");
        $("#vigencia_final").val("");
        $("#cnpj").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/contratos/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function Delete(id) {
    var conf = confirm("Tem certeza que deseja excluir?");
    if (conf == true) {
        $.post("ajax/contratos/deleteRecord.php", {
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
    $.post("ajax/contratos/readDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var obj = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_num_contrato_sap").val(obj.NUM_CONTRATO_SAP);
            $("#update_bloco").val(obj.BLOCO);
            $("#update_vigencia_inicial").val(obj.VIGENCIA_INICIAL);
            $("#update_vigencia_final").val(obj.VIGENCIA_FINAL);
            $("#update_cnpj").val(obj.CNPJ);            
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function UpdateDetails() {
    // get values
    var num_contrato_sap = $("#update_num_contrato_sap").val();
    var bloco = $("#update_bloco").val();
    var vigencia_inicial = $("#update_vigencia_inicial").val();
    var vigencia_final = $("#update_vigencia_final").val();
    var cnpj = $("#update_cnpj").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/contratos/updateDetails.php", {
            id: num_contrato_sap,
            num_contrato_sap: num_contrato_sap,
            bloco: bloco,
            vigencia_inicial: vigencia_inicial,
            vigencia_final: vigencia_inicial,
            cnpj: cnpj
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