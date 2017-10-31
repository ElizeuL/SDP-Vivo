// Add Record
function addRecord() {
    // get values
    var bloco = $("#bloco").val();
    var tipo_atividade = $("#tipo_atividade").val();
    var unidade_esforco = $("#unidade_esforco").val();
    var valor_unitario = $("#valor_unitario").val();

    // Add record
    $.post("ajax/valores/addRecord.php", {
        bloco: bloco,
        tipo_atividade: tipo_atividade,
        unidade_esforco: unidade_esforco,
        valor_unitario: valor_unitario
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#bloco").val("");
        $("#tipo_atividade").val("");
        $("#unidade_esforco").val("");
        $("#valor_unitario").val("");        
    });
}

// READ records
function readRecords() {
    $.get("ajax/valores/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function Delete(id) {
    var conf = confirm("Tem certeza que deseja excluir?");
    if (conf == true) {
        $.post("ajax/valores/deleteRecord.php", {
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
    $.post("ajax/valores/readDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var obj = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_id").val(obj.id);  
            $("#update_bloco").val(obj.BLOCO);            
            $("#update_tipo_atividade").val(obj.TIPO_ATIVIDADE);  
            $("#update_unidade_esforco").val(obj.UNIDADE_ESFORCO);  
            $("#update_valor_unitario").val(obj.VALOR_UNITARIO);  
        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function UpdateDetails() {
    // get values
    var id = $("#update_id").val();
    var bloco = $("#update_bloco").val();
    var tipo_atividade = $("#update_tipo_atividade").val();
    var unidade_esforco = $("#update_unidade_esforco").val();
    var valor_unitario = $("#update_valor_unitario").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/valores/updateDetails.php", {
            id: id,
            bloco: bloco,
            tipo_atividade: tipo_atividade,
            unidade_esforco: unidade_esforco,
            valor_unitario: valor_unitario
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