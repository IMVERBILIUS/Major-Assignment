<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>9Eleven - Travel and Tour</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
<?php 
    // calling db connection file
    include_once('db_connect.php');

    $sql = "SELECT * from flight_result";

    $result = mysqli_query($conn, $sql);
    ?>

    <section class="banner" id="top">
        <div class="container">
            <img src="img/sasa3.png" alt="Flight Template" class="img-fluid" style="max-width: 200px;">
            <h4>Choose Your Direction:</h4>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a></li>
                <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-youtube fa-2x"></i></a></li>
                <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a></li>
            </ul>
            <a href="contact.html" class="btn btn-warning mt-4"><i class="fa fa-phone"></i> Contact Us Now</a>

        </div>
    </section>

    <section>
        <div class="container">
            <form action="flight-result.html" method="get" class="submit-form mt-5">
                <h4>Check availability for <em>direction</em>:</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="flight_origin">Select Origin:</label>
                            <select name="flight_origin" id="flight_origin" class="form-control" required>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <option value="<?php echo $row['flight_origin']; ?>"><?php echo $row['flight_origin']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="flight_destination">Select Destination:</label>
                            <select name="flight_destination" id="flight_destination" class="form-control" required>
                                <?php mysqli_data_seek($result, 0); // reset the pointer ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <option value="<?php echo $row['flight_destination']; ?>"><?php echo $row['flight_destination']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="flight_date">Departure date:</label>
                            <input name="flight_date" type="date" class="form-control" id="flight_date" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="return_date">Return date:</label>
                            <input name="return_date" type="date" class="form-control" id="return_date" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="round_trip" name="trip_type" class="custom-control-input" value="round" required>
                                <label class="custom-control-label" for="round_trip" onclick="toggleReturnDate('round')">Round Trip</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="oneway_trip" name="trip_type" class="custom-control-input" value="one-way" required>
                                <label class="custom-control-label" for="oneway_trip" onclick="toggleReturnDate('one-way')">One Way</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-warning btn-block">Search Flights</button>

                    </div>
                </div>
            </form>
        </div>
        </section>

<section class="about-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center" data-aos="fade-up">
                <h2>About Us</h2>
                <img src="img/banner-bg.jpg" alt="Flight Template" class="img-fluid rounded">
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <p>
                    9Eleven, we're passionate about simplifying your travel experience. Whether you're booking flights or activities, our platform offers comprehensive information and seamless booking processes to make planning your journey effortless. With a commitment
                    to excellence and customer satisfaction, we're here to ensure every aspect of your trip is as enjoyable as possible. Trust 9Eleven to be your reliable travel companion every step of the way. In a world inundated with complexities,
                    we stand firm in our mission to streamline your travel experience. Gone are the days of navigating through multiple websites or dealing with cumbersome booking processes. At 9Eleven, we believe that travel planning should be
                    as enjoyable as the journey itself. So why wait? Let 9Eleven simplify your travel experience and unlock a world of possibilities. Whether you're a seasoned globetrotter or a first-time traveler, trust 9Eleven to make your journey
                    unforgettable. Join us on a voyage of discovery and adventure, and experience travel like never before with 9Eleven by your side.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="most-visited">
    <div class="container">
        <div class="section-heading">
            <h2>Most Visited Places</h2>
        </div>
        <div id="owl-mostvisited" class="owl-carousel owl-theme">

            <div class="item" data-aos="zoom-in">
                <div class="visited-item">
                    <img src="img/place-01.jpg" alt="" class="img-fluid rounded">
                    <div class="text-content">
                        <span>New York</span>
                    </div>
                </div>
            </div>
            <!-- Add more items here -->

        </div>
    </div>
</section>

<section id="university-map">
    <div class="container">
        <div class="section-heading text-center">
            <h2>Our Location</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="map-embed" data-aos="fade-up">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.9898252148494!2d106.77540691498128!3d-6.13401419556198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f71f5a41c197%3A0x628259f9e8d6d7b4!2sUniversitas%20Mercu%20Buana!5e0!3m2!1sid!2sid!4v1712654433010!5m2!1sid!2sid"
                        width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<footer style="background: #333; color: white; padding: 20px 0; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <a href="#" class="btn btn-secondary scroll-top">Back To Top</a>
            </div>
            <div class="col-md-12 text-center">
                <ul class="social-icons" style="margin-top: 20px; padding-left: 0;">
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-facebook"></i></a></li>
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-youtube"></i></a></li>
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>



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
