$(document).ready(function () {
    $('.select').change(function() {
        var disabilitytypes = $('#disabilityselect').val();
        var structurestypes = $('#structureselect').val();
        var needs = $('#needselect').val();
        var tt = $('.arrayjson').val();
        console.log(tt);
            $.ajax({
                type: "POST",
                //data: 'select:selectedValues',
                url: "advanced/" + disabilitytypes + "/" + structurestypes + "/" + needs + "/" +tt,
                dataType: 'json',
                timeout: 3000,
                success: function (response) {
                    //$('#ahhh').html(response);
                    /*$.each(response, function (index, value) {
                        $('#structureselect').append('<option value="' + index + '">' + value + '</option>');
                        $('#needselect').append('<option value="' + index + '">' + value + '</option>')
                    })*/
                },
                error: function () {
                    alert('Ajax call error');
                }
            });
    });
});