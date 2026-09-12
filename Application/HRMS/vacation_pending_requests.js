$(document).on("click", ".approveVacationRequest", function(){

    let requestId = $(this).val();

    $.ajax({
        url: "vacation_pending_requests_actions.php?action=approveVacationRequest&request_id=" + requestId,
        type: "GET",
        dataType: "json",
        success: function(response){
            if(response.status == 1){
                drawVacationRequests();

                Swal.fire({
                    icon: "success",
                    title: "Request Approved",
                    text: response.message
                });
            }
        }
    });
    return false;
});

$(document).on("click", ".rejectVacationRequest", function(){

    let requestId = $(this).val();

    $.ajax({
        url: "vacation_pending_requests_actions.php?action=rejectVacationRequest&request_id=" + requestId,
        type: "GET",
        dataType: "json",
        success: function(response){
            if(response.status == 1){
                drawVacationRequests();

                Swal.fire({
                    icon: "success",
                    title: "Request Rejected",
                    text: response.message
                });
            }
        }
    });
    return false;
});

function drawVacationRequests(){

    $.ajax({
        url: "vacation_pending_requests_actions.php?action=getVacationRequests",
        type: "GET",
        dataType: "json",
        success: function(response){

            let dataHTML = "";

            for(let i = 0; i < response.length; i++){
                let status = "Pending";
                let actions = "";

                if(response[i]["status"] == 2){
                    status = "Approved";
                }

                if(response[i]["status"] == 3){
                    status = "Rejected";
                }

                if(response[i]["status"] == 1){
                    actions = `
                        <form class="d-inline">
                            <button type="button" value="${response[i]["id"]}" class="approveVacationRequest btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>

                        <form class="d-inline">
                            <button type="button" value="${response[i]["id"]}" class="rejectVacationRequest btn btn-danger btn-sm">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    `;
                }

                dataHTML += `
                    <tr id="rowVacationRequest${response[i]["id"]}">
                        <td>${response[i]["full_name"]}</td>
                        <td>${response[i]["vacation_name"]}</td>
                        <td>${response[i]["vacation_from_date"]}</td>
                        <td>${response[i]["vacation_to_date"]}</td>
                        <td>${response[i]["request_date"]}</td>
                        <td>${status}</td>
                        <td>${actions}</td>
                    </tr>
                `;
            }

            $("#vacationRequestsTbl tbody").html(dataHTML);
        }
    });
}
