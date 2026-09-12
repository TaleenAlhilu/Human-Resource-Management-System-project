$(document).on("click", "#addAdminModalBtn", function(){

    if(validateInputs() === true){
        let formData = new FormData(document.querySelector("#addAdminForm"));

        $.ajax({
            url: "actions/users_management_actions.php?action=addAdmin",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response){

                if(response.status == 1){
                    drawAdmins();
                    $("#addAdminModal").modal("hide");
                    $("#addAdminForm")[0].reset();
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "cannot add admin",
                        text: response.message
                    })
                }
            }
        });
    }

    return false;
});

function validateInputs(){
    let adminEmail = $('#admin_email').val();
    let adminPass = $('#admin_pass').val();
    let role = $('#role').val();

    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(adminEmail === '' || adminPass === '' || role === ''){
        Swal.fire({
            icon: "error",
            title: "Cannot add admin",
            text: "Please enter all admin information"
        });
        return false;
    }

    if(regex.test(adminEmail) === false){
        Swal.fire({
            icon: "error",
            title: "Cannot add admin",
            text: "Please enter a valid email"
        });
        return false;
    }

    return true;
}

$(document).on("click", ".editAdmin", function(){
    let adminId = $(this).val();

    $.ajax({
        url: "actions/users_management_actions.php?action=getAdmin&admin_id=" + adminId,
        type: "GET",
        dataType: "json",
        success: function(response){

            $("#edit_admin_id").val(response["admin_id"]);
            $("#edit_admin_email").val(response["admin_email"]);
            $("#edit_admin_pass").val("");
            $("#edit_admin_role").val(response["role"]);

            $("#editAdminModal").modal("show");
        }
    });
});

$("#modifyAdminModalBtn").on("click", function(){

    let formData = new FormData(document.querySelector("#editAdminForm"));

    $.ajax({
        url: "actions/users_management_actions.php?action=editAdmin",
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response){

            if(response["status"] == 1){
                drawAdmins();
                $("#editAdminModal").modal("hide");
            }
        }
    });

    return false;
});

$(document).on("click", ".deleteAdmin", function(){
    let adminId = $(this).val();

    Swal.fire({
        title: "Delete admin?",
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
                url: "actions/users_management_actions.php?action=deleteAdmin&admin_id=" + adminId,
                type: "GET",
                dataType: "json",
                success: function(response){

                    if(response["status"] == 1){
                        $("#rowAdmin" + adminId).remove();

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

function drawAdmins(){

    $.ajax({
        url: "actions/users_management_actions.php?action=getAdmins",
        type: "GET",
        dataType: "json",
        success: function(response){

            let dataHTML = "";

            for(let i = 0; i < response.length; i++){

                dataHTML += `
                    <tr id="rowAdmin${response[i]["admin_id"]}">
                        <td id="adminEmail${response[i]["admin_id"]}">
                            ${response[i]["admin_email"]}
                        </td>

                        <td id="adminRole${response[i]["admin_id"]}">
                            ${response[i]["role"]}
                        </td>

                        <td>
                            <button value="${response[i]["admin_id"]}" class="editAdmin btn btn-warning btn-sm">
                                Edit
                            </button>

                            <button value="${response[i]["admin_id"]}" class="deleteAdmin btn btn-danger btn-sm">
                                Delete
                            </button>
                        </td>
                    </tr>
                `;
            }

            $("#adminTbl tbody").html(dataHTML);
        }
    });
}
