<script type="text/javascript">
$( document ).ready(function() {
    search_accounts(1);
});

document.getElementById("employee_no_search").addEventListener("keyup", e => {
    search_accounts(1);
});

const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_accounts(next_page);
    }
}

const count_accounts = () => {
    var employee_no = sessionStorage.getItem('employee_no_search');
    $.ajax({
        url:"{{ route('accounts/count') }}",
        type:'GET',
        cache:false,
        data:{
            employee_no:employee_no
        }, 
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#accounts_table_info').html(count);

            if (response > 0) {
                load_accounts_last_page();
                /*document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');*/
            } else {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            }
        }
    });
}

const load_accounts_last_page = () =>{
    var employee_no = sessionStorage.getItem('employee_no_search');
    var current_page = parseInt(sessionStorage.getItem('accounts_table_pagination'));
    $.ajax({
        url:"{{ route('accounts/searchlastpagek') }}",
        type:'GET',
        cache:false,
        data:{
            employee_no:employee_no
        },
        success:function(response){
            sessionStorage.setItem('last_page', response);
            let total = sessionStorage.getItem('count_rows');
            var next_page = current_page + 1;
            if (next_page > response || total < 1) {
                document.getElementById("btnNextPage").style.display = "none";
                document.getElementById("btnNextPage").setAttribute('disabled', true);
            } else {
                document.getElementById("btnNextPage").style.display = "block";
                document.getElementById("btnNextPage").removeAttribute('disabled');
            }
        }
    });
}

const search_accounts = current_page =>{
    var employee_no = document.getElementById('employee_no_search').value;

    var employee_no_1 = sessionStorage.getItem('employee_no_search');

    if (current_page > 1) {
        switch(true) {
            case employee_no !== employee_no_1:
                employee_no = employee_no_1;
                break;
            default:
        }
        /*if (employee_no !== employee_no_1) {
            employee_no = employee_no_1;
        }*/
    } else {
        sessionStorage.setItem('employee_no_search', employee_no);
    }
    $.ajax({
        url:"{{ route('accounts/searchpagek') }}",
        type:'GET',
        cache:false,
        data:{
            employee_no:employee_no,
            current_page:current_page
        },
        beforeSend: () => {
            var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            if (current_page == 1) {
                document.getElementById("list_of_accounts").innerHTML = loading;
            } else {
                $('#accounts_table tbody').append(loading);
            }
        }, 
        success:function(response){
            $('#loading').remove();
            if (current_page == 1) {
                $('#accounts_table tbody').html(response);
            } else {
                $('#accounts_table tbody').append(response);
            }
            sessionStorage.setItem('accounts_table_pagination', current_page);
            count_accounts();
        }
    });
}
</script>