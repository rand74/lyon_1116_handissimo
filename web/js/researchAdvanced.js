$(document).ready(function () {
    $('.select').change(function() {
        var disabilitytypes = $('#disabilityselect').val();
        var structurestypes = $('#structureselect').val();
        var needs = $('#needselect').val();
        var idsearch = $('.iddata').data("searchid");
        //console.log(tt);
            $.ajax({
                type: "POST",
                url: "advanced/" + disabilitytypes + "/" + structurestypes + "/" + needs + "/" +idsearch,
                //url:search_advanced,
                dataType: 'json',
                timeout: 3000,
                success: function (response) {
                    //$('#ahhh').html(response);

                },
                error: function () {
                    alert('Ajax call error');
                }
            });
    });
});