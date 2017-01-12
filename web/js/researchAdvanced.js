$(document).ready(function () {
    $('.select').change(function() {
        var disabilitytypes = $('#disabilityselect').val();
        var structurestypes = $('#structureselect').val();
        var needs = $('#needselect').val();
            $.ajax({
                type: "POST",
                url: "/search/advanced/" + disabilitytypes + "/" + structurestypes + "/" + needs,
                dataType: 'json',
                timeout: 3000,
                success: function (response) {
                    var disabilitytypes = JSON.parse(response.data);
                    var structurestypes = JSON.parse(response.data);
                    var needs = JSON.parse(response.data);
                    alert(needs);
                    $.each(response, function (index, value) {
                        $('#structureselect').append('<option value="' + index + '">' + value + '</option>');
                        $('#needselect').append('<option value="' + index + '">' + value + '</option>')
                    })
                },
                error: function () {
                    alert('Ajax call error');
                }
            });
    });
});