<?php 
    require_once '../resources/config.php';
?>
<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
  <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3>  <?php display_message(); ?> </h3>
                </div>

            </div>
            <div class="row">
                <div class="col-5 m-auto">
                    <form name="sentMessage" id="contactForm" method="POST">
                        <?php sendMessage(); ?>
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Your subject *" id="subject" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-info btn-block" name="submit">Send Message</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
    <?php require_once(TEMPLATE_FRONT . DS . "footer.php"); ?>
    