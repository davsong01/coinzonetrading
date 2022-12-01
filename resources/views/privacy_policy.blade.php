@extends('layouts.frontapp')
@section('css')
<style>
    .privacy-heading{
        margin-top: 10px;
    }
</style>
@endsection
@section('body')
<!---page Title --->
<section class="bg-img pt-150 pb-20 sub-pages" data-overlay="7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="page-title text-white">Privacy Policy</h2>
                    <ol class="breadcrumb bg-transparent justify-content-center">
                        <li class="breadcrumb-item"><a href="/" class="text-white-50"><i
                                    class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Privacy Policy</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page content -->

<section class="py-50 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 col-12">
				<h4 class="fw-400">HOW YOUR PERSONAL INFORMATION IS USED</h4>
                <p class="fs-15" style="text-align: justify">
                    Our primary purpose in collecting personal information is to provide you with a secure, smooth, efficient, and customized experience. We generally use personal information to create, develop, operate, deliver, and improve our Services, content and advertising; and for loss prevention and anti-fraud purposes. We may use this information in the following ways:
                   <ol style="text-align: justify;margin-bottom: 10px;">
                        <li>
                            <h5 class="privacy-heading">To maintain legal and regulatory compliance</h5>
                            <span class="privacy-block">
                                Most of our core Services are subject to laws and regulations requiring us to collect, use, and store your personal information in certain ways. For example, CZ must identify and verify customers using our Services in order to comply with anti-money laundering laws across jurisdictions. This includes collection and storage of your photo identification. In addition, we use third parties to verify your identity by comparing the personal information you provide against third-party databases and public records. When you seek to link a bank account to your CZ Account, we may require you to provide additional information which we may use in collaboration with service providers acting on our behalf to verify your identity or address, and/or to manage risk as required under applicable law. If you do not provide personal information required by law, we will have to close your account.
                            </span>
                        </li>
                        <li>
                            <h5 class="privacy-heading">To enforce our terms in our user agreement and other agreements</h5> 
                            <span class="privacy-block">
                                CZ handles sensitive information, such as your identification and financial data, so it is very important for us and our customers that we actively monitor, investigate, prevent, and mitigate any potentially prohibited or illegal activities, enforce our agreements with third parties, and/or prevent and detect violations of our posted user agreement or agreements for other Services. In addition, we may need to collect fees based on your use of our Services. We collect information about your account usage and closely monitor your interactions with our Services. We may use any of your personal information collected for these purposes. The consequences of not processing your personal information for such purposes is the termination of your account.
                            </span>
                        </li>
                        <li>
                            <h5 class="privacy-heading">To detect and prevent fraud and/or funds loss</h5>
                            <span class="privacy-block">
                                We process your personal information in order to help detect, prevent, and mitigate fraud and abuse of our services and to protect you against account compromise or funds loss.
                            </span>
                        </li>
                        <li>
                            <h5 class="privacy-heading">To provide Coinzone's Services</h5>
                            <span class="privacy-block">
                                We process your personal information to provide the Services to you. For example, when you want to store funds on our platform, we require certain information such as your identification, contact information, and payment information. We cannot provide you with Services without such information. Third parties such as identity verification services may also access and/or collect your personal information when providing identity verification and/or fraud prevention services.
                            </span>
                        </li>
                        <li>
                           <h5 class="privacy-heading">To provide customer service</h5>
                            <span class="privacy-block">
                                We process your personal information to provide the Services to you. For example, when you want to store funds on our platform, we require certain information such as your identification, contact information, and payment information. We cannot provide you with Services without such information. Third parties such as identity verification services may also access and/or collect your personal information when providing identity verification and/or fraud prevention services.
                            </span>
                        </li>
                        <li>
                           <h5 class="privacy-heading">To provide customer service</h5>
                            <span class="privacy-block">
                                We process your personal information when you contact us to resolve any questions, disputes, collect fees, or to troubleshoot problems. Without processing your personal information for such purposes, we cannot respond to your requests and ensure your uninterrupted use of the Services.
                            </span>
                        </li>
                    </ol>
                </p>

            </div>

            <div class="col-lg-12 col-12">
				<h4 class="fw-400">HOW WE PROTECT AND STORE PERSONAL INFORMATION</h4>
                <p class="fs-15" style="text-align: justify">
                    <span class="privacy-block">
                        We understand how important your privacy is, which is why CZ maintains (and contractually requires third parties it shares your information with to maintain) appropriate physical, technical and administrative safeguards to protect the security and confidentiality of the personal information you entrust to us. <br> <br>
                        We may store and process all or part of your personal and transactional information, including certain payment information, such as your encrypted bank account and/or routing numbers, in the US and elsewhere in the world where our facilities or our service providers are located. We protect your personal information by maintaining physical, electronic, and procedural safeguards in compliance with the applicable laws and regulations.
                    </span>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection