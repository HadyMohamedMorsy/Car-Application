
    $(document).ready(function(){
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }
        });
        function load_data(query){
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{query:query},
                success:function(data){
                    $('#result').html(data);
                }
            });
        }
});