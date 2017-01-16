$(document).ready(function() {
    var disabilitytypes = $('#disabilityselect');
    var structurestypes = $('#structureselect');
    var needs = $('#needselect');
    //var val = $('#imput-keyword').val();
    //alert(val);
    disabilitytypes.change(function() {
        disabilitytypes = $(this).val();
        //structurestypes = $(this).val();
        //needs = $(this).val();
        if(disabilitytypes != null) {
            structurestypes.empty();
            needs.empty();
            structurestypes.append('<option value="">Choisir le type de structure</option>');
            needs.append('<option value="">Choisir le type de service</option>');
            $.ajax({
                type: "POST",
                url: "/search/advanced/" + disabilitytypes /*+ "/" + structurestypes + "/" + needs*/,
                dataType: 'json',
                timeout: 3000,
                success: function(json) {
                    disabilitytypes = JSON.parse(json.data);
                    structurestypes = JSON.parse(json.data);
                    needs = JSON.parse(json.data);
                    $.each(json, function(index, value) {
                        structurestypes.append('<option value="'+ index +'">'+ value +'</option>');
                        needs.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }else{
            structurestypes.empty();
            structurestypes.append('<option value="">Choisir le type de structure</option>');
        }
    });

    structurestypes.change(function() {
        structurestypes = $(this).val();
        if(structurestypes != null) {
            needs.empty();
            disabilitytypes.empty();
            needs.append('<option value="">Choisir le type de services</option>');
            disabilitytypes.append('<option value="">Choisir le type de maladies</option>');
            $.ajax({
                type: "POST",
                url: "/search/advanced/" /*+ disabilitytypes + "/" */+ structurestypes /*+ "/" + needs*/,
                dataType: 'json',
                timeout: 3000,
                success: function(json) {
                    structurestypes = JSON.parse(json.data);
                    $.each(json, function(index, value) {
                        needs.append('<option value="'+ index +'">'+ value +'</option>');
                        disabilitytypes.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }else{
            needs.empty();
            needs.append('<option value="">Choisir le type de services</option>');
        }
    });

    needs.change(function() {
        needs = $(this).val();
        if(needs != null) {
            structurestypes.empty();
            disabilitytypes.empty();
            structurestypes.append('<option value="">Choisir le type de structures</option>');
            disabilitytypes.append('<option value="">Choisir le type de maladies</option>');
            $.ajax({
                type: "POST",
                url: "/search/advanced/" /*+ disabilitytypes + "/" + structurestypes + "/"*/ + needs,
                dataType: 'json',
                timeout: 3000,
                success: function(json) {
                    needs = JSON.parse(json.data);
                    $.each(json, function(index, value) {
                        structurestypes.append('<option value="'+ index +'">'+ value +'</option>');
                        disabilitytypes.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }else{
            needs.empty();
            needs.append('<option value="">Choisir le type de services</option>');
        }
    });
});