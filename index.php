<?php include '../MJ/layout/Nav.php'; ?>

<section>
    <div class="container">
        <form action="flight-result.php" method="post" class="submit-form mt-5">
            <h4>Check availability for <em>direction</em>:</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="flight_origin">Select Origin:</label>
                        <select name="flight_origin" id="flight_origin" class="form-control" required>
                            <?php while($row = mysqli_fetch_assoc($result_origin)): ?>
                                <option value="<?php echo htmlspecialchars($row['flight_origin']); ?>"><?php echo htmlspecialchars($row['flight_origin']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="flight_destination">Select Destination:</label>
                        <select name="flight_destination" id="flight_destination" class="form-control" required>
                            <?php while($row = mysqli_fetch_assoc($result_destination)): ?>
                                <option value="<?php echo htmlspecialchars($row['flight_destination']); ?>"><?php echo htmlspecialchars($row['flight_destination']); ?></option>
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
                <img src="img/banner-bg.jpg" alt="About Us" class="img-fluid rounded">
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
                    <img src="img/place-01.jpg" alt="New York" class="img-fluid rounded">
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
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-facebook" aria-label="Facebook"></i></a></li>
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-youtube" aria-label="YouTube"></i></a></li>
                    <li style="display: inline-block; margin: 0 10px; background-color: rgba(255, 255, 255, 0.1); padding: 10px; border-radius: 5px;"><a href="#" style="color: white;"><i class="fab fa-instagram" aria-label="Instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
