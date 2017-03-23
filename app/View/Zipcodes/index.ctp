<script type="text/javascript">
$(document).ready(function(){
    $("#lookup").click(function(){
        var zip1 = $.trim($('#zip1').val().match(/^[0-9]+$/));
        var zip2 = $.trim($('#zip2').val());
        var zipcode = zip1 + zip2;
console.log(zipcode)
        $.ajax({
            type: "post",
            url: "http://blog.dev/AclTest/Zipcodes/getdata/",
            data: {'zipcode' : zipcode},
            crossDomain: false,
            dataType : "json",
            scriptCharset: 'utf-8'
        }).done(function(data){
          console.log(data)
            if(data[0] == ""){
                alert('見つかりませんでした。');
            } else {
                $('#address').val(data[0] + data[1] + data[2]);
            }
          });
        // }).fail(function(XMLHttpRequest, textStatus, errorThrown){
        //     alert(errorThrown);
        // });
     });
});
</script>

<form>
    <p><input type="text" name="zip1" id="zip1" size="6">-
       <input type="text" name="zip2" id="zip2" size="6">
    <input type="button" id="lookup" value="Lookup address"></p>
    <p><input size="50" type="text" name="address" id="address"></p>
</form>
