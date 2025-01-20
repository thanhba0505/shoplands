<!-- <h1>Order</h1>

<div id="tabs">
    <a href="#" data-tab="all" class="tab-link active">Tab 1</a>
    <a href="#" data-tab="pending" class="tab-link">Tab 2</a>
    <a href="#" data-tab="packed" class="tab-link">Tab 3</a>
</div>
<div id="tab-content">
    <p>aaaaa</p>
</div>

<form action="<?= Redirect::to('api/seller/order/tab')->getUrl() ?>" method="post">
    <input type="text" name="page" value="all">
    <button type="submit">Load Tab 1</button>
</form>

<script>
    $(document).ready(function() {
        // Handle tab click
        $('.tab-link').click(function(e) {
            e.preventDefault();
            $('#tab-content').html('<p>Error loading content.</p>');

            const $this = $(this);
            const tab = $this.data('tab');

            // Highlight active tab
            $('.tab-link').removeClass('active');
            $this.addClass('active');

            // Show loading indicator
            $('#tab-content').html('<p>Loading content...</p>');
console.log(tab);
            // Fetch tab content via AJAX
            $.post('<?= Redirect::to('api/seller/order/tab')->getUrl() ?>', {
                page: tab
            }, function(response) {
                console.log(response);
                if (response) {
                    if (response.content !== '') {
                        $('#tab-content').html(response.content);
                    } else {
                        $('#tab-content').html('<p>No content.</p>');
                    }
                } else {
                    $('#tab-content').html('<p>Error loading content.</p>');
                }
            }, 'json');
        });

        // Trigger click on the first tab to load its content initially
        $('.tab-link.active').trigger('click');
    });
</script> -->