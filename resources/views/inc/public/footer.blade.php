  <footer class="main-footer" id="Contact" style="background-image: url({{asset('assets/images/background/footer-bg.png')}});">
    <div class="auto-container">
      <div class="widgets-section">
        <div class="row clearfix">
          <div class="column col-xl-4  col-lg-6 col-sm-12" data-wow-delay="200ms" data-wow-duration="1200ms">
            <div class="footer-widget logo-widget">
              <div class="widget-content">
                <div class="footer-logo">
                  <a href="index-2.html"><img class="lazy-image" src="assets/images/resource/image-spacer-for-validation.png" data-src="assets/images/footer-logo.png" alt="" /></a>
              </div>
            <ul class="list-address">
              <li><i class="fas fa-map-marker-alt"></i>Next to Bhat Bhateni Anam Nagar Kathmandu</li>
              <li><i class="fas fa-map-marker-alt"></i>Opp. to Kumari Cinema Kamal Pokhari Kathmandu</li>
              {{-- <li class="line">Office No 3956</li> --}}
              <li><i class="fas fa-envelope"></i><a href="mailto:{{$email->value??'info@asp.com'}}">{{$email->value??'info@asp.com'}}</a></li>
              <li><i class="fas fa-phone">+977 {{$phone->value??''}}</i></li>
              </ul>
              </div>
            </div>
          </div>
          <div class="column col-xl-2 col-lg-6 col-sm-12" data-wow-delay="400ms" data-wow-duration="1200ms">
            <div class="footer-widget links-widget">
              <div class="widget-content">
              <h3>Links</h3>
              <ul>
                <li><a href="#">Consultng Services</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#Contact">Contact Us</a></li>
                <li><a href="{{route('home.index')}}">Home</a></li>
              </ul>
            </div>	
            </div>
          </div>
          <div class="column col-xl-2 col-lg-6 col-sm-12" data-wow-delay="600ms" data-wow-duration="1200ms">
            <div class="footer-widget links-widget">
              <div class="widget-content">
              <h3>About Us.</h3>
              <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#Blogss">Blog</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="{{route('login')}}">Sign in</a></li>
                <li><a href="{{route('account.index')}}">My account</a></li>
              </ul>
            </div>	
            </div>
          </div>
          <div class="column col-xl-4  col-lg-6 col-sm-12" data-wow-delay="800ms" data-wow-duration="1200ms">
            <div class="footer-widget contact-widget">
              <div class="widget-content">
                <h3>Contact Us.</h3>
              <p></p>
                <ul class="social-links clearfix">
                    <li><a href="{{$facebook->value??''}}"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="{{$whatsapp->value??''}}"><span class="fab fa-whatsapp"></span></a></li>
                    <li><a href="{{$twitter->value??''}}"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="{{$linkedin->value??''}}"><span class="fab fa-linkedin-in"></span></a></li>
                    <li><a href="{{$instagram->value??''}}"><span class="fab fa-instagram"></span></a></li>
                </ul>
            </div>	
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 col-lg-12 col-sm-12" data-wow-delay="800ms" data-wow-duration="800ms">
          <div class="help">
            <h4></h4>
            <p>The company is managed by a team of professionals who have graduated from universities in the UK and gained combined experience of more than 30 years in advisory and consulting roles in Australian and British corporations.</p>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-sm-12" data-wow-delay="800ms" data-wow-duration="800ms">
          <div class="subscribe">
            <h4></h4>
            <form method="post" action="#" id="contact-form">
            <div class="row clearfix">
              <div class="col-md-12 form-group">
                <input type="email" name="email" id="email" placeholder="Your mail here" required="">
                <button type="submit" name="submit-form"><span class="btn-title">Submit</span></button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
</footer>
  
<section class="footer-bottom">
  <div class="auto-container" data-wow-delay="800ms" data-wow-duration="800ms">
    <div class="copyright"><p>@ {{now()->format('Y')}}.All Right Reserved. <span>ASP-Abroad Study Planner</span></p></div>
  </div>
</section>

