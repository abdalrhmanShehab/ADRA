$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Admin Details
    $('#currentPassword').keyup(function (){
        var current_pwd = $('#currentPassword').val();
        $.ajax({
            url: '/admin/check-current-password',
            type: 'POST',
            data: {
                "current_pwd": current_pwd
            },
            success: function (res){
                if(res.success == false){
                    $('#chkCurrentPwd').html("<font color=red>Current password is incorrect</font>");
                }else {
                    $('#chkCurrentPwd').html("<font color=green>Current password is correct</font>");
                }
            },
            error: function (err){
                console.log(err);
            }
        });
    });

    //Update Section Status
    $(document).on('click','.updateSectionStatus',function (){
        var status = $(this).children('i').attr('status');
        var section_id = $(this).attr('section_id');
        $.ajax({
            url: '/admin/update-section-status',
            type: 'POST',
            data: {
                "section_id": section_id,
                "status": status
            },
            success: function (res){
                console.log(res.success);
                if(res.success == true){
                    if(res.status == 1){
                        var icon = `<i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>`;
                        $('#section-'+section_id).html(icon);
                    }else if(res.status == 0){
                        var icon = `<i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i>`;
                        $('#section-'+section_id).html(icon);
                    }
                }
            },
        });
    });


});
