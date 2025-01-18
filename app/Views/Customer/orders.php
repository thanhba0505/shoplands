<h1>Order</h1>

<div id="tabs">
    <a href="#" data-tab="tab1" class="tab-link active">Tab 1</a>
    <a href="#" data-tab="tab2" class="tab-link">Tab 2</a>
    <a href="#" data-tab="tab3" class="tab-link">Tab 3</a>
</div>
<div id="tab-content">
    <!-- Nội dung sẽ được load qua AJAX -->
    <p>Loading content...</p>
</div>

<form action="<?= Redirect::to('api/ajax')->getUrl() ?>" method="post">
    <!-- <?= CSRF::input() ?> -->
    <input type="text" name="action" value="loadTabContent">
    <input type="text" name="tab" value="tab1">
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

            // Fetch tab content via AJAX
            $.post('<?= Redirect::to('api/ajax')->getUrl() ?>', {
                tab: tab
            }, function(response) {
                if (response) {
                    $('#tab-content').html(response);
                } else {
                    $('#tab-content').html('<p>Error loading content.</p>');
                }
            }, 'json');
        });

        // Trigger click on the first tab to load its content initially
        $('.tab-link.active').trigger('click');
    });
</script>