<div class="social_link_panel">
    <div class="row">
        <div class="col-md-12">
            <ul class="social-link-icons">
                <?php
                foreach ($this->social_links as $key => $href) {
                    echo "<li class='" . $key . "'><a href='" . $href . "'>" . $key . "</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>