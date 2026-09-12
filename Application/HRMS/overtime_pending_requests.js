$(document).on("click", ".approveOvertimeRequest", function(){

    let requestId = $(this).val();

    $.ajax({
        url: "overtime_pending_requests_actions.php?action=approveOvertimeRequest&request_id=" + requestId,
        type: "GET",
        dataType : "json",
        success: function(response){
            if(response.status == 1){
                drawOvertimeRequests();

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


$(document).on("click", ".rejectOvertimeRequest", function(){

    let requestId = $(this).val();

    $.ajax({
        url: "overtime_pending_requests_actions.php?action=rejectOvertimeRequest&request_id=" + requestId,
        type: "GET",
        dataType : "json",
        success: function(response){
            if(response.status == 1){
                drawOvertimeRequests();

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


function drawOvertimeRequests(){

    $.ajax({
        url: "overtime_pending_requests_actions.php?action=getOvertimeRequests",
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
                            <button type="button" value="${response[i]["id"]}" class="approveOvertimeRequest btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>

                        <form class="d-inline">
                            <button type="button" value="${response[i]["id"]}" class="rejectOvertimeRequest btn btn-danger btn-sm">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    `;
                }

                dataHTML += `
                    <tr id="rowOvertimeRequest${response[i]["id"]}">
                        <td>${response[i]["full_name"]}</td>
                        <td>${response[i]["overtime_name"]}</td>
                        <td>${response[i]["overtime_request_date"]}</td>
                        <td>${response[i]["overtime_from_time"]}</td>
                        <td>${response[i]["overtime_to_time"]}</td>
                        <td>${status}</td>
                        <td>${actions}</td>
                    </tr>
                `;
            }

            $("#overtimeRequestsTbl tbody").html(dataHTML);
        }
    });
}
