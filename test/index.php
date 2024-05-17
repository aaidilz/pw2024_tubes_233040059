<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contoh Pencarian dengan AJAX</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<h2>Pencarian Inventory</h2>
<input type="text" id="searchInput" placeholder="Masukkan kata kunci...">
<ul id="searchResults"></ul>

<script>
$(document).ready(function(){
    $('#searchInput').on('input', function(){
        var query = $(this).val();
        if(query.length > 0){
            search(query);
        } else {
            $('#searchResults').empty();
        }
    });

    function search(query){
        $.ajax({
            url: 'search.php', // Ganti dengan URL endpoint untuk pencarian data
            method: 'GET',
            data: {query: query},
            success: function(response){
                $('#searchResults').html(response);
            }
        });
    }
});
</script>

</body>
</html>
