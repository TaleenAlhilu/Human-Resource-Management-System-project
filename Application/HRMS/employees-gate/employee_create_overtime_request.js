

$(document).on("click", "#createOvertimeRequestBtn", function(){
    
   if(validateInputs() === true){
        let formData = new FormData(document.querySelector("#overtimeRequestForm"));

        $.ajax({
            url: "employee_create_overtime_request.php?action=createOvertimeRequest",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response.status == 1){
                    $("#overtimeRequestForm")[0].reset();

                    Swal.fire({
                        icon: "success",
                        title: "Request submitted",
                        text: response.message
                    });
                }
            }
        });
   }

    return false;
});

function validateInputs(){

    let overtimeTypeValue = parseInt($('#overtime_type_id').val());
    let overtimeRequestValue = ($('#overtime_request_date').val());
    let overtimeFromTime = $('#overtime_from_time').val();
    let overtimeToTime = $('#overtime_to_time').val();    
    


    if(overtimeTypeValue === 0){
        Swal.fire({
                    icon: "error",
                    title: "Request not submitted",
                    text: "Please select overtime type!"
                });
        return false;
    }

    if(overtimeRequestValue === ''){
        Swal.fire({
                    icon: "error",
                    title: "Request not submitted",
                    text: "Please select a date!"
                });
        return false;
    }

     if(overtimeToTime === '' || overtimeFromTime === ''){
        Swal.fire({
                    icon: "error",
                    title: "Request not submitted",
                    text: "Please select overtime hours"
                });
        return false;
    }

    return true;
}

 