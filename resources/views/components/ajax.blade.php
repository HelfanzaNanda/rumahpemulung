<script>
    function insert(url, form_data){
        return $.ajax({
            type: 'post',
            url: url,
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
        });
    }
</script>