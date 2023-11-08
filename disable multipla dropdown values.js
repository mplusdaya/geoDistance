  assign_name_id();
            $('option').prop('disabled', false);
            $('.process_id').each(function() {
                var val = this.value;
                $('.process_id').not(this).find('option').filter(function() {
                    return this.value === val;
                }).prop('disabled', true);
            });
            $("#js_add_details").prop('disabled', false);


function assign_name_id() {
    var p = 1;
    var r = 0;
    $('.sr_no').each(function() {
        $(this).html(p);
        p++;
    });
