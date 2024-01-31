<script type="text/javascript">
$( document ).ready(function() {
     load_t_t1();
});

const load_t_t1 = () =>{
    $.ajax({
        url:"{{ route('tts/loadtt1') }}",
        type:'GET',
        cache:false,
        beforeSend: () => {
            var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            document.getElementById("t_table").innerHTML = loading;
        }, 
        success:function(response){
            $('#loading').remove();
            $('#t_table').html(response);
            $('#lbl_c1').html('');
            $('#t_t1_breadcrumb').hide();
        }
    });
}

const load_t_t2 = param =>{
    var string = param.split('~!~');
    var id = string[0];
    var c1 = string[1];

    $.ajax({
        url:"{{ route('tts/loadtt2') }}",
        type:'GET',
        cache:false,
        data:{
            c1:c1
        },
        beforeSend: () => {
            var loading = `<tr id="loading"><td colspan="6" style="text-align:center;"><div class="spinner-border text-dark" role="status"><span class="sr-only">Loading...</span></div></td></tr>`;
            document.getElementById("t_table").innerHTML = loading;
        }, 
        success:function(response){
            $('#loading').remove();
            $('#t_table').html(response);
            $('#lbl_c1').html(c1);
            $('#t_t1_breadcrumb').show();
        }
    });
}
</script>