<script>
jQuery(document).ready(function($){

    var csrf = $('meta[name="csrf-token"]').attr('content');

    $("a#shedulelink").unbind('click').click(function(){
        $("div#searchboxmain").toggle();
    });

    $("select[name='depts']").unbind('change').change(function(){

        var deptid = $(this).val();
        $.post("{{url('/getarrivals')}}", {_token:csrf,deptid:deptid}, function(data){
            $("select[name='arrive']").html(data);
        });

    });
    $("input[data-text='only']").keypress(function(event){
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0)) {
            event.preventDefault();
        }
    });

    $('input[data-phone]').on('input', function (e) {
        var x = $(this).val().replace(/\D/g, '').match(/(\d{0,4})(\d{0,7})/);
        $(this).val(!x[2] ? x[1] : x[1] + '-' + x[2]);
    });

    $('input[data-cnic]').on('input', function (e) {
        var x = $(this).val().replace(/\D/g, '').match(/(\d{0,5})(\d{0,7})(\d{0,1})/);
        $(this).val(!x[2] ? x[1] : x[1] + '-' + x[2] + (x[3] ? '-' + x[3] : ''));
    });


});//end:ready

</script>