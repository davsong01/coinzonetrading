@extends('layouts.frontapp')
@section('body')
<!---page Title --->
<section class="bg-img pt-150 pb-20 sub-pages" data-overlay="7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Faq</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Frequently asked questions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->
<section class="py-50 cust-accordion">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-wrapper v1">
                    <div class="list">
                        <div class="item">
                            <div class="tab-btn">
                                <a href="#">What is the meaning of Lorem ipsum?<em class="mdi mdi-plus"></em></a>
                            </div>
                            <div class="tab-content">
                                <p>Literally it does not mean anything. It is a sequence of words without a sense of Latin derivation that make up a text also known as filler text, fictitious, blind or placeholder</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Why is Lorem Ipsum Dolor used? <em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>The Lorem Ipsum text is used to fill spaces designated to host texts that have not yet been published. They use programmers, graphic designers, typographers to get a real impression of the digital / advertising / editorial product they are working on.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#"> What is the most used version? <em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#"> What are the origins of Lorem Ipsum Dolor Sit? <em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>Its origins date back to 45 BC. In fact, his words were randomly extracted from the De finibus bonorum et malorum , a classic of Latin literature written by Cicero over 2000 years ago.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#"> What is the original text of Lorem Ipsum Dolor Sit Amet? <em class="mdi mdi-plus"></em></a></div>
                            <div class="tab-content">
                                <p>The original Latin text<br>Dal De finibus bonorum et malorum sections 1.10.32 and 1.10.33 - Marco Tullio Cicerone<br>
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn">
                                <a href="#">Can I reserve a magazine via Phone or E-mail?<em class="mdi mdi-plus"></em></a>
                            </div>
                            <div class="tab-content">
                                <p>No, this isn’t possible. We want all of our magazines to be available for all customers. So you have to order the magazine.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Where on your website can I open a customer account?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>You can create a new account at the end of the order process or on the following page: Create new account. You can view all of your orders and subscriptions in your customer account. You can also change your addresses and your password.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Do I need to create an account to make an order?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>No, you don’t have to create an account. But there are a few advantages if you create an account.</p>
                            <ul class="list-unstyled">
                                <li>You never have to enter your billing and shipping address again</li>
                                <li>Find all of your orders, subscriptions and addresses in your account</li>
                                <li>Download invoices of your orders</li>
                            </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">What are your opening hours?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>The products in our shop can only be ordered online at present and are sent out by Swiss Post.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Do you also have a physical store?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>No, we don’t have a physical store location at the moment. We accept only orders through our online shop and we’re shipping all orders with the Swiss Post Service. Please visit our shipping section for more details.<br><br>From time to time you will find us at design fairs and popup markets in Switzerland. Subscribe to our newsletter and you’ll receive the latest news.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Why do the prices in the shop sometimes change?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Many of the magazines that we sell are from far-away countries. Prices depend largely on factors such as the shipping cost, customs duties, and general price changes imposed by our suppliers and the individual publishers. We therefore have to pass any changes in costs on to our customers. For subscription orders, however, the prices are not changed until the subscription is renewed. The prices at the time of ordering always apply.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Do you also sell magazines that have been financed by crowdfunding?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Yes, we sell many different magazines from various publishers that were financed from capital raised on Kickstarter.com, Indiegogo.com, Startnext.de and other crowdfunding platforms. We’re always pleased to add new magazines that have been funded in this way, and we’ve even helped support some of them ourselves.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">General Terms & Conditions (GTC)<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Our current General Terms & Conditions (GTC), including all important information about prices, payment methods, returns and cancellation periods, can be found on our website at loremnotipsum.com.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Information for Press and Media<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Please find logos, photos, press releases and more in Press and Media.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">I’d like to suggest a new magazine<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>We are always looking for new and interesting Independent Magazines. Please drop us a short line if you know a magazine, which you want to be added to our shop. Please note that we cannot add all suggested magazines to our shop.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">From which countries do you sell magazines?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Please visit this page to view all of the countries, we are selling magazines from.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Do you sell gift cards?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Yes, we sell gift cards that can be used to buy items in our online shop.</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="tab-btn"><a href="#">Why do some of your prices differ from those of other retailers?<em class="mdi mdi-plus"></em></a> </div>
                            <div class="tab-content">
                            <p>Our retail prices are based on the trade price that we pay per magazine. We also have to take into account various other factors such as customs duties and shipping costs. These are especially high for magazines ordered from the USA or Australia, for example, and have to be considered in the final price. We also put a lot of time and effort into presenting each magazine in an optimum way in our shop and on social media. All of these factors therefore have to be taken into account when calculating the individual prices.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	
@endsection
