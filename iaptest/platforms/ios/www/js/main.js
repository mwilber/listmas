// This is a JavaScript file

function check_barcode(){
    window.plugins.barcodeScanner.scan( function(result) {
                //alert("We got a barcode\n" +
                //          "Result: " + result.text + "\n" +
                //          "Format: " + result.format + "\n" +
                //          "Cancelled: " + result.cancelled);
                GetBarcode(result.text);
            }, function(error) {
                alert("Scanning failed: " + error);
            }
      );
}

function GetBarcode(pUpc){
    //alert('getting upc data');
    $('#scandescription').html('checking');
    $.ajax({
        url: 'http://grocerygamer.herokuapp.com/reactor/jsonapi/upcscan/'+pUpc,
        dataType: 'json',
        crossDomain: true,
        success: function(data) {
            $('#scandescription').html(data.data.description);
            $('#scansize').html(data.data.size);
            $('#scanunit').html(data.data.unit);
        }
    });
    
}