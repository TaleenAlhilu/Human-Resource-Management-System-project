$(document).on("click", "#createVacationRequestBtn", function(){
    if(validateInputs() === true){
        let formData = new FormData(document.querySelector("#vacationRequestForm"));

        $.ajax({
            url: "employee_create_vacation_request.php?action=createVacationRequest",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response.status == 1){
                    $("#vacationRequestForm")[0].reset();

                    Swal.fire({
                        icon: "success",
                        title: "Request submitted",
                        text: response.message
                    });
                }

                if(response.status == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Request not submitted",
                        text: response.message
                    });
                }
            }
        });

    }

    return false;
});


function validateInputs(){

    let vacationTypeValue = parseInt($('#vacation_id').val());
    let vacationFromTime = $('#vacation_from_date').val();
    let vacationToTime = $('#vacation_to_date').val();    

    if(vacationTypeValue === 0){
        Swal.fire({
                    icon: "error",
                    title: "Request not submitted",
                    text: "Please select vacation type!"
                });
        return false;
    }

     if(vacationFromTime === '' || vacationToTime === ''){
        Swal.fire({
                    icon: "error",
                    title: "Request not submitted",
                    text: "Please select vacation dates"
                });
        return false;
    }

    return true;
}