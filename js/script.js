/**
 * Created by julien on 23/03/17.
 */
$(document).ready(function() {

    $(function() {
        $( "#search-input" ).autocomplete({
            source: '../search.php'
        });
    });

});
