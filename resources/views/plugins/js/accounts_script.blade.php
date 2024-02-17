<script type="text/javascript">
    // DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
        load_accounts();
        load_accounts2();
    });

    const load_accounts = () => {
        $.ajax({
            url: "{{ route('accounts/load') }}",
            type: 'GET',
            cache: false,
            success: function (response) {
                document.getElementById("list_of_accounts").innerHTML = response;
            }
        });
    }

    // JQUERY AJAX Load
    const load_accounts2 = () => {
        $("#list_of_accounts2").load("{{ route('accounts/load') }}");
    }

    const search_accounts = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        var user_type = document.getElementById('user_type_search').value;
        $.ajax({
            url: "{{ route('accounts/search') }}",
            type: 'GET',
            cache: false,
            data: {
                employee_no: employee_no,
                full_name: full_name,
                user_type: user_type
            }, success: function (response) {
                document.getElementById("list_of_accounts").innerHTML = response;
            }
        });
    }

    const register_accounts = () => {
        var employee_no = document.getElementById('employee_no').value;
        var full_name = document.getElementById('full_name').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var section = document.getElementById('section').value;
        var user_type = document.getElementById('user_type').value;
        if (employee_no == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Employee No !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (full_name == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Full Name !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (username == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Username !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (password == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Password !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (section == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Section !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else if (user_type == '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Select User Type !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
        } else {
            $.ajax({
                url: "{{ route('accounts/insert') }}",
                type: 'POST',
                cache: false,
                data: {
                    employee_no: employee_no,
                    full_name: full_name,
                    username: username,
                    password: password,
                    section: section,
                    user_type: user_type
                }, success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succesfully Recorded!!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#employee_no').val('');
                        $('#full_name').val('');
                        $('#username').val('');
                        $('#password').val('');
                        $('#section').val('');
                        $('#user_type').val('');
                        load_accounts();
                        load_accounts2();
                        $('#new_account').modal('hide');
                    } else if (response == 'Already Exist') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Duplicate Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            });
        }
    }

    const get_accounts_details = (param) => {
        var string = param.split('~!~');
        var id = string[0];
        var id_number = string[1];
        var username = string[2];
        var full_name = string[3];
        var password = string[4];
        var section = string[5];
        var role = string[6];

        document.getElementById('id_account_update').value = id;
        document.getElementById('employee_no_update').value = id_number;
        document.getElementById('username_update').value = username;
        document.getElementById('full_name_update').value = full_name;
        document.getElementById('password_update').value = password;
        document.getElementById('section_update').value = section;
        document.getElementById('user_type_update').value = role;
    }

    const update_account = () => {
        var id = document.getElementById('id_account_update').value;
        var id_number = document.getElementById('employee_no_update').value;
        var username = document.getElementById('username_update').value;
        var full_name = document.getElementById('full_name_update').value;
        var password = document.getElementById('password_update').value;
        var section = document.getElementById('section_update').value;
        var role = document.getElementById('user_type_update').value;

        $.ajax({
            url: "{{ route('accounts/update') }}",
            type: 'POST',
            cache: false,
            data: {
                id: id,
                id_number: id_number,
                username: username,
                full_name: full_name,
                password: password,
                section: section,
                role: role
            }, success: function (response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succesfully Recorded!!!',
                        text: 'Success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#employee_no').val('');
                    $('#full_name').val('');
                    $('#username').val('');
                    $('#password').val('');
                    $('#section').val('');
                    $('#user_type').val('');
                    load_accounts();
                    load_accounts2();
                    $('#update_account').modal('hide');
                } else if (response == 'duplicate') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Duplicate Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer: 1000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
    }

    const delete_account = () => {
        var id = document.getElementById('id_account_update').value;
        $.ajax({
            url: "{{ route('accounts/delete') }}",
            type: 'POST',
            cache: false,
            data: {
                id: id
            }, success: function (response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Succesfully Deleted !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    load_accounts();
                    load_accounts2();
                    $('#update_account').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
    }

    const export_employees = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        //window.open('../../process/export/exp_accounts.php?employee_no='+employee_no+'&full_name='+full_name,'_blank');
        var url = "{{ route('accounts/export', ['employee_no' => ':employee_no', 'full_name' => ':full_name']) }}";
        url = url.replace(':employee_no', employee_no);
        url = url.replace(':full_name', full_name);
        window.open(url, '_blank');
    }

    const export_employees3 = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        //window.open('../../process/export/exp_accounts3.php?employee_no='+employee_no+'&full_name='+full_name,'_blank');
        var url = "{{ route('accounts/export3', ['employee_no' => ':employee_no', 'full_name' => ':full_name']) }}";
        url = url.replace(':employee_no', employee_no);
        url = url.replace(':full_name', full_name);
        window.open(url, '_blank');
    }

    const export_csv = (table_id, separator = ',') => {
        // Select rows from table_id
        var rows = document.querySelectorAll('table#' + table_id + ' tr');
        // Construct csv
        var csv = [];
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                data = data.replace(/"/g, '""');
                // Push escaped string
                row.push('"' + data + '"');
            }
            csv.push(row.join(separator));
        }
        var csv_string = csv.join('\n');
        // Download it
        var filename = 'Export-Accounts' + '_' + new Date().toLocaleDateString() + '.csv';
        var link = document.createElement('a');
        link.style.display = 'none';
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    const upload_csv = () => {
        var file_form = document.getElementById('file_form');
        var form_data = new FormData(file_form);
        $.ajax({
            url: "{{ route('accounts/import2') }}",
            type: 'POST',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: (jqXHR, settings) => {
                Swal.fire({
                    icon: 'info',
                    title: 'Uploading Please Wait...',
                    text: 'Info',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false
                });
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            },
            success: response => {
                setTimeout(() => {
                    swal.close();
                    if (response != '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload CSV Error',
                            text: `Error: ${response}`,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Upload CSV',
                            text: 'Uploaded and updated successfully',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        document.getElementById("file2").value = '';
                        load_accounts();
                        load_accounts2();
                    }
                }, 500);
            }
        })
            .fail((jqXHR, textStatus, errorThrown) => {
                console.log(jqXHR);
                swal('System Error', `Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`, 'error');
            });
    }

    const popup1 = () => {
        var employee_no = document.getElementById('employee_no_search').value;
        var full_name = document.getElementById('full_name_search').value;
        var url = "{{ route('accounts/export3', ['employee_no' => ':employee_no', 'full_name' => ':full_name']) }}";
        url = url.replace(':employee_no', employee_no);
        url = url.replace(':full_name', full_name);
        //PopupCenter('../../process/export/exp_accounts3.php?employee_no='+employee_no+'&full_name='+full_name, 'Popup Export Accounts 3', '1190', '600');
        PopupCenter(url, 'Popup Export Accounts 3', '1190', '600');
    }
</script>
