<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9Eleven - Travel and Tour</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- AOS (Animate On Scroll) CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../MJ/css/stylee.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
</head>
<body>

<section class="banner" id="top">
    <div class="container">
        <img src="img/sasa3.png" alt="Flight Template" class="img-fluid" style="max-width: 200px;">
        <h4>Choose Your Direction:</h4>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-facebook fa-2x" aria-label="Facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-youtube fa-2x" aria-label="YouTube"></i></a></li>
            <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-instagram fa-2x" aria-label="Instagram"></i></a></li>
        </ul>
        <a href="contact.html" class="btn btn-warning mt-4"><i class="fa fa-phone"></i> Contact Us Now</a>
    </div>
</section>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- AOS (Animate On Scroll) JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
    function toggleReturnDate(tripType) {
        var returnDateInput = $('#return_date');
        if (tripType === 'one-way') {
            returnDateInput.prop('disabled', true);
        } else {
            returnDateInput.prop('disabled', false);
        }
    }

    $(document).ready(function() {
        AOS.init();

        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });

        $('#owl-mostvisited').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
</script>

</body>
</html>
