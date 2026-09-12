$(document).on("click", "#addVacationModalBtn", function(){

    if(validateInputs() === true){
        let formData = new FormData(document.querySelector("#addVacationForm"));

        $.ajax({
            url: "actions/vacations_setup_actions.php?action=addVacation",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response.status == 1){
                    drawVacations();
                    $("#addVacationModal").modal("hide");
                    $("#addVacationForm")[0].reset();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "cannot add vacation setup type",
                        text: response.message
                    })
                }
            }
        });
    }

    return false;
});

function validateInputs(){
    let vacationName = $('#vacation_name').val();
    let requiresApproval = $('#requires_approval').val();
    let deductionFromBalance = $('#deduction_from_balance').val();

    if(vacationName === '' || requiresApproval === '' || deductionFromBalance === ''){
        Swal.fire({
            icon: "error",
            title: "Cannot add vacation setup type",
            text: "Please enter all vacation setup information"
        });
        return false;
    }

    return true;
}

$(document).on("click", ".editVacation", function(){
    let vacationId = $(this).val();

    $.ajax({
        url: "actions/vacations_setup_actions.php?action=getVacation&vacation_id=" + vacationId,
        type: "GET",
        dataType: "json",
        success: function(response){

            $("#edit_vacation_id").val(response["vacation_id"]);
            $("#edit_vacation_name").val(response["vacation_name"]);
            $("#edit_requires_approval").val(response["requires_approval"]);
            $("#edit_deduction_from_balance").val(response["deduct_from_balance"]);

            if(response["medical_document_required"] == 1){
                $("#edit_medical_document_required").prop("checked", true);
            }else{
                $("#edit_medical_document_required").prop("checked", false);
            }

            $("#editVacationModal").modal("show");
        }
    });
});

$("#modifyVacationModalBtn").on("click", function(){

    let formData = new FormData(document.querySelector("#editVacationForm"));

    $.ajax({
        url: "actions/vacations_setup_actions.php?action=editVacation",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response){

            if(response["status"] == 1){
                drawVacations();
                $("#editVacationModal").modal("hide");
            }
        }
    });

    return false;
});

$(document).on("click", ".deleteVacation", function(){
    let vacationId = $(this).val();

    Swal.fire({
        title: "Delete vacation?",
        text: "This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel"
    }).then(function(result){
        if(result.isConfirmed){
            $.ajax({
                url: "actions/vacations_setup_actions.php?action=deleteVacation&vacation_id=" + vacationId,
                type: "GET",
                dataType: "json",
                success: function(response){

                    if(response["status"] == 1){
                        $("#rowVacation" + vacationId).remove();

                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response["message"]
                        });
                    }
                }
            });
        }
    });
});

function drawVacations(){

    $.ajax({
        url: "actions/vacations_setup_actions.php?action=getVacations",
        type: "GET",
        dataType: "json",
        success: function(response){

            let dataHTML = "";

            for(let i = 0; i < response.length; i++){
                let requiresApproval = "No";
                let medicalDocumentRequired = "No";

                if(response[i]["requires_approval"] == 1){
                    requiresApproval = "Yes";
                }

                if(response[i]["medical_document_required"] == 1){
                    medicalDocumentRequired = "Yes";
                }

                dataHTML += `
                    <tr id="rowVacation${response[i]["vacation_id"]}">
                        <td id="vacationName${response[i]["vacation_id"]}">
                            ${response[i]["vacation_name"]}
                        </td>

                        <td id="requiresApproval${response[i]["vacation_id"]}">
                            ${requiresApproval}
                        </td>

                        <td id="deductionFromBalance${response[i]["vacation_id"]}">
                            ${response[i]["deduct_from_balance"]}
                        </td>

                        <td id="medicalDocumentRequired${response[i]["vacation_id"]}">
                            ${medicalDocumentRequired}
                        </td>

                        <td>
                            <button value="${response[i]["vacation_id"]}" class="editVacation btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button value="${response[i]["vacation_id"]}" class="deleteVacation btn btn-danger btn-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                `;
            }

            $("#vacationTbl tbody").html(dataHTML);
        }
    });
}
