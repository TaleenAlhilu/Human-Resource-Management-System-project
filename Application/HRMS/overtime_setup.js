$(document).on("click", "#addOvertimeModalBtn", function(){

    if(validateInputs() === true){
        let formData = new FormData(document.querySelector("#addOvertimeForm"));

        $.ajax({
            url: "actions/overtime_setup_actions.php?action=addOvertime",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response.status == 1){
                    drawOvertimes();
                    $("#addOvertimeModal").modal("hide");
                    $("#addOvertimeForm")[0].reset();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "cannot overtime setup type",
                        text: response.message
                    })
                }
            }
        });
    }

    return false;
});

function validateInputs(){
    let overtimeName = $('#overtime_name').val();
    let hourlyRate = $('#hourly_rate').val();

    if(overtimeName === '' || hourlyRate === ''){
        Swal.fire({
            icon: "error",
            title: "Cannot add overtime setup type",
            text: "Please enter all overtime setup information"
        });
        return false;
    }

    return true;
}

$(document).on("click", ".editOvertime", function(){
    let overtimeTypeId = $(this).val();

    $.ajax({
        url: "actions/overtime_setup_actions.php?action=getOvertime&overtime_type_id=" + overtimeTypeId,
        type: "GET",
        dataType: "json",
        success: function(response){

            $("#edit_overtime_type_id").val(response["overtime_type_id"]);
            $("#edit_overtime_name").val(response["overtime_name"]);
            $("#edit_hourly_rate").val(response["hourly_rate"]);

            $("#editOvertimeModal").modal("show");
        }
    });
});

$("#modifyOvertimeModalBtn").on("click", function(){

    let formData = new FormData(document.querySelector("#editOvertimeForm"));

    $.ajax({
        url: "actions/overtime_setup_actions.php?action=editOvertime",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response){

            if(response["status"] == 1){
                drawOvertimes();
                $("#editOvertimeModal").modal("hide");
            }
        }
    });

    return false;
});

$(document).on("click", ".deleteOvertime", function(){
    let overtimeTypeId = $(this).val();

    Swal.fire({
        title: "Delete overtime?",
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
                url: "actions/overtime_setup_actions.php?action=deleteOvertime&overtime_type_id=" + overtimeTypeId,
                type: "GET",
                dataType: "json",
                success: function(response){

                    if(response["status"] == 1){
                        $("#rowOvertime" + overtimeTypeId).remove();

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

function drawOvertimes(){

    $.ajax({
        url: "actions/overtime_setup_actions.php?action=getOvertimes",
        type: "GET",
        dataType: "json",
        success: function(response){

            let dataHTML = "";

            for(let i = 0; i < response.length; i++){

                dataHTML += `
                    <tr id="rowOvertime${response[i]["overtime_type_id"]}">
                        <td id="overtimeName${response[i]["overtime_type_id"]}">
                            ${response[i]["overtime_name"]}
                        </td>

                        <td id="hourlyRate${response[i]["overtime_type_id"]}">
                            ${response[i]["hourly_rate"]}
                        </td>

                        <td>
                            <button value="${response[i]["overtime_type_id"]}" class="editOvertime btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button value="${response[i]["overtime_type_id"]}" class="deleteOvertime btn btn-danger btn-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                `;
            }

            $("#overtimeTbl tbody").html(dataHTML);
        }
    });
}
