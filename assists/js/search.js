
    $(document).ready(function(){
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }else{
                load_data('');
            }
        });
        function load_data(query){
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{query:query},
                success:function(data){
                    if(query != ''){
                        $('#result').html(data);
                        console.log(data);
                    }else{
                        $('#result').html('');
                    }                    
                }
            });
        }
});