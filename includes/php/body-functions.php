
        <script type="text/javascript">
            $('.slider').slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: true,
                infinite: true,
                cssEase: 'linear'
            });
        </script>

        <script type="text/javascript">
            $('.slider2').slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                centerMode: false,
                dots: true,
                infinite: true,
                cssEase: 'linear'
            });
        </script>

        <script type="text/javascript">
            function markActiveLink(clicked_id) {
                var id = clicked_id;
                var attr = jQuery('#' + id).attr('src');
                var src = jQuery('.product-container-image img').attr('src');
                jQuery('.product-container-image img').attr('src', attr);
            };
        </script>