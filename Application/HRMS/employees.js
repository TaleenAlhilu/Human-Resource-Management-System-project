$(document).on("click", "button.editEmployee", function(){
    let employeeId = $(this).val();

    $.ajax({
        url: "actions/employees_actions.php?action=getEmployee&employee_id=" + employeeId,
        type: "GET",
        dataType: "json",
        success: function(response){

            $("#edit_employee_id").val(response['employee_id']);
            $("#edit_full_name").val(response['full_name']);
            $("#edit_email").val(response['email']);
            $("#edit_salary").val(response['salary']);
            $("#edit_vacation_balance").val(response['vacation_balance']);
            $("#edit_old_img").val(response['img']);

            if(response['eligible_for_overtime'] == 1){
                $("#edit_eligible_for_overtime").prop("checked", true);
            }else{
                $("#edit_eligible_for_overtime").prop("checked", false);
            }

            $("#editEmployeeModal").modal("show");
        }
    });
});

$(document).on("click", ".generatePassword", function(){
    let employeeId = $(this).val();

    Swal.fire({
        title: "Sending password",
        text: "Please wait",
        allowOutsideClick: false,
        didOpen: function(){
            Swal.showLoading();
        }
    });

    $.ajax({
        url: "actions/employees_actions.php?action=generatePassword&employee_id=" + employeeId,
        type: "GET",
        success: function(response){
            Swal.fire({
                icon: "success",
                title: "Password sent",
                text: response.message
            });
        }
    });
});

$('#addEmployeeModalBtn').on('click', function(){

    if(validateInputs() === true){
        let formData = new FormData(document.querySelector('#addEmployeeForm'));

        $.ajax({
            url: "actions/employees_actions.php?action=addEmployee",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response['status'] == 1){
                    drawEmployees();
                    $("#addEmployeeModal").modal("hide");
                    $("#addEmployeeForm")[0].reset();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Cannot add employee",
                        text:response.message
                    })
                }
            }
        });
    }

    return false;
});

function validateInputs(){
    let fullName = $('#full_name').val();
    let email = $('#email').val();
    let salary = $('#salary').val();
    let vacationBalance = $('#vacation_balance').val();
    let img = $('#img').val();
    // Practical, widely used email regex
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(fullName === '' || email === '' || salary === '' || vacationBalance === '' || img === ''){
        Swal.fire({
            icon: "error",
            title: "Cannot add employee",
            text: "Please enter all employee information"
        });
        return false;
    }

    if(regex.test(email) === false){
        Swal.fire({
            icon: "error",
            title: "Cannot add employee",
            text: "Please enter a valid email"
        });
        return false;
    }

    return true;
}
 

$(document).on("click", ".deleteEmployee", function(){
    let employeeId = $(this).val();

    Swal.fire({
        title: "Delete employee?",
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
                url: 'actions/employees_actions.php?action=deleteEmployee&employee_id=' + employeeId,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if(response.status == 1){
                        $("#row" + employeeId).remove();

                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: response.message
                        });
                    }
                }
            });
        }
    });
});


$('#modifyEmployeeModalBtn').on('click',function(){
      let formData = new FormData(document.querySelector('#editEmployeeForm'));
 

    $.ajax({
        url: "actions/employees_actions.php?action=editEmployee",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response){

            if(response['status'] == 1){
                //ad alert read from
                    drawEmployees();
                $("#editEmployeeModal").modal("hide");
            }
        }
    });
    return false;
});

$("#searchEmployeeBtn").on("click", function(){

    let search = $("#searchEmployeeInput").val();

    drawEmployees(search);
});

function drawEmployees(search = ""){
    
    $.ajax({
        url: "actions/employees_actions.php?action=getEmployees&search=" + encodeURIComponent(search),
        type: "get",
        dataType: "json",
        success: function(response){
                console.log(response);

            let dataHTML = '';
            for(let i = 0; i< response.length; i++){
                let overtime = "No";

                if(response[i]['eligible_for_overtime'] == 1){
                    overtime = "Yes";
                }
                dataHTML += `  
                    <tr id="row${response[i]['employee_id']}">
        
                        <td id="fullName${response[i]['employee_id']}">
                            ${response[i]['full_name']}
                        </td>

                        <td id="email${response[i]['employee_id']}">
                            ${response[i]['email']}
                        </td>

                        <td id="salary${response[i]['employee_id']}">
                            ${response[i]['salary']}
                        </td>

                        <td id="vacationBalance${response[i]['employee_id']}">
                            ${response[i]['vacation_balance']}
                        </td>

                        <td id="overtime${response[i]['employee_id']}">
                            ${overtime}
                        </td>

                        <td>
                            <img id="img${response[i]['employee_id']}" src="uploads/${response[i]['img']}" width="50" height="50">
                        </td>

                        <td>
                            <button type="button" value="${response[i]['employee_id']}" class="editEmployee btn btn-warning btn-sm">Edit</button>
                            <button type="button" value="${response[i]['employee_id']}" class="deleteEmployee btn btn-danger btn-sm">Delete</button>
                            <button type="button" value="${response[i]['employee_id']}" class="btn btn-success generatePassword">Generate Password</button>
                        </td>
                    </tr>
                
                `
            }

            $('#employeeTbl tbody').html(dataHTML);

        }
    });
}
